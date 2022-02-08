<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Notification;
use App\Models\Pasien;
use App\Models\RekamMedik;
use App\Models\Apoteker;
use App\Events\ObatSent;
use App\Models\Diagnosa;
use App\Models\Obat;
use App\Models\Tenkesehatan;
use App\Models\User;
use Carbon\Carbon;

class NakesController extends Controller
{    

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function nakesDashboard($id)
    {
        $notifs = Notification::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $notifCount = Notification::where('user_id', $id)->count();
        $tenkes = Tenkesehatan::where('user_id', $id)->first();
        $pasiens = RekamMedik::where('tenkesehatan_id', $tenkes->id)
            ->whereDate('rekammedik_created_at', Carbon::now()->toDateString())
            ->whereNotNull('keluhan')
            ->get()
        ;
        $pasienCount = $pasiens->count();
        
        return view('nakes.dashboard', compact('notifs', 'notifCount', 'pasiens', 'pasienCount'));
    }

    public function nakesProfil($id)
    {
        $notifs = Notification::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $notifCount = Notification::where('user_id', $id)->count();
        $nakes = Tenkesehatan::where('user_id', $id)->first();
        $age = Carbon::parse($nakes->tgl_lhr_tenkes)->diff(Carbon::now())->y;

        return view('nakes.nakes_profil', compact('notifs', 'notifCount', 'nakes', 'age'));
    }

    public function nakesEditProfil($id)
    {
        $notifs = Notification::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $notifCount = Notification::where('user_id', $id)->count();
        $nakes = Tenkesehatan::where('user_id', $id)->first();
        $age = Carbon::parse($nakes->tgl_lhr_tenkes)->diff(Carbon::now())->y;

        return view('nakes.edit.nakes_edit_profil', compact('notifs', 'notifCount', 'nakes', 'age'));
    }

    public function nakesUpdateProfil(Request $request, $id)
    {
        $nakes = Tenkesehatan::where('user_id', $id)->first();

        $nakes->update([
            'nama_tenkes' => $request->input('nama'),
            'jk_tenkes' => $request->input('jk'),
            'tempat_lhr_tenkes' => $request->input('tempat_lhr'),
            'tgl_lhr_tenkes' => $request->input('tgl_lhr'),
            'nohp_tenkes' => $request->input('no_hp'),
            'alamat_tenkes' => $request->input('alamat'),
            'tenkes_updated_at' => Carbon::now(),
        ]);

        return redirect()->route('nakes_profil', $nakes->user_id)->with(['success' => 'Profil berhasil diperbarui!']);
    }

    public function nakesEditUserPw($id)
    {
        $notifs = Notification::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $notifCount = Notification::where('user_id', $id)->count();
        $nakes = User::where('id', $id)->first();

        return view('nakes.edit.nakes_edit_userpw', compact('notifs', 'notifCount', 'nakes'));
    }

    public function nakesUpdateUserPw(UpdatePasswordRequest $request, $id)
    {
        $nakes = User::where('id', $id)->first();
        
        if($request->input('username') != $nakes->username) {
            Request()->validate([
                'username' => 'unique:users,username',
                'password' => 'min:8|confirmed',
            ], [
                'username.unique' => 'Username telah digunakan',
                'password.confirmed' => 'Password konfirmasi tidak sesuai',
                'password.min' => 'Password minimal 8 karakter',
            ]);
        }
        else {
            Request()->validate([
                'username' => 'required',
                'current_password' => 'required',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
            ], [
                'username.required' => 'Username wajib diisi',
                'current_password.required' => 'Password wajib diisi !',
                'password.required' => 'Password wajib diisi !',
                'password.confirmed' => 'Password konfirmasi tidak sesuai',
            ]);
        }
        
        $nakes->update([
            'username' => $request->input('username'),
            'password' => Hash::make($request->get('password')),
        ]);

        return redirect()->route('nakes_profil', $nakes->id)->with(['success' => 'Username atau password berhasil diperbarui!']);
    }

    public function nakesEditRekamMedik($id)
    {
        $notif = Notification::where('id', $id)->first();
        $rekammedik = RekamMedik::find($notif->rekam_medik_id);
        $diagnosa = Diagnosa::all();
        $obat = Obat::all();

        return view('nakes.edit.nakes_edit_rekammedik', compact('notif', 'rekammedik', 'diagnosa', 'obat'));
    }

    public function nakesKirimDataRekamMedik(Request $request, $id)
    {
        $currentNotif = Notification::where('id', $id)->first();
        $rekammedik = RekamMedik::find($currentNotif->rekam_medik_id);
        $rekammedik->update([
            'suhu' => $request->input('suhu'),
            'tensi' => $request->input('tensi'),
            'diagnosa_id' => $request->input('diagnosa'),
            'keluhan' => $request->input('keluhan'),
            'obat_id' => $request->input('obat'),
            'keterangan' => $request->input('keterangan'),
            'rekammedik_updated_at' => Carbon::now(),
        ]);

        $apotekers = Apoteker::all();
        foreach ($apotekers as $key) {
            $notif = Notification::create([
                'rekam_medik_id' => $rekammedik->id,
                'user_id' => $key->user->id,
                'isi' => 'Obat pasien',
            ]);
        }

        $currentNotif->delete();

        ObatSent::dispatch($rekammedik, $notif);

        return redirect()->route('nakes_dashboard', $rekammedik->tenkesehatan->user->id)->with(['success' => 'Rekam Medik berhasil dikirim!']);
    }

    
}

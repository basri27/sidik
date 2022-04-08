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
use App\Models\ResepObat;
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
            ->whereDate('rekammedik_created_at', Carbon::now())
            ->where('status_rekam_medik', 'selesai')
            ->get();
        $pasienCount = $pasiens->count();
        
        return view('nakes.dashboard', compact('notifs', 'notifCount', 'pasiens', 'pasienCount'));
    }

    public function nakesProfil($id)
    {
        $notifs = Notification::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $notifCount = Notification::where('user_id', $id)->count();
        $nakes = Tenkesehatan::where('user_id', $id)->first();
        $age = Carbon::parse($nakes->tgl_lhr_tenkes)->age;

        return view('nakes.nakes_profil', compact('notifs', 'notifCount', 'nakes', 'age'));
    }

    public function nakesEditProfil($id)
    {
        $notifs = Notification::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $notifCount = Notification::where('user_id', $id)->count();
        $nakes = Tenkesehatan::where('user_id', $id)->first();
        $age = Carbon::parse($nakes->tgl_lhr_tenkes)->age;

        return view('nakes.edit.nakes_edit_profil', compact('notifs', 'notifCount', 'nakes', 'age'));
    }

    public function nakesUpdateProfil(Request $request, $id)
    {
        $nakes = Tenkesehatan::where('user_id', $id)->first();
        
        if(Request()->foto_tenkes <> "") {
            $image = Request()->foto_tenkes;
            $imageName = $id . '_nakes' . '.' . $image->extension();
            $image->move(public_path('foto_profil/nakes'), $imageName);

            $nakes->update([
                'nama_tenkes' => $request->input('nama'),
                'jk_tenkes' => $request->input('jk'),
                'tempat_lhr_tenkes' => $request->input('tempat_lhr'),
                'tgl_lhr_tenkes' => $request->input('tgl_lhr'),
                'nohp_tenkes' => $request->input('no_hp'),
                'alamat_tenkes' => $request->input('alamat'),
                'foto_tenkes' => $imageName,
                'tenkes_updated_at' => Carbon::now(),
            ]);
        }
        else {
            $nakes->update([
                'nama_tenkes' => $request->input('nama'),
                'jk_tenkes' => $request->input('jk'),
                'tempat_lhr_tenkes' => $request->input('tempat_lhr'),
                'tgl_lhr_tenkes' => $request->input('tgl_lhr'),
                'nohp_tenkes' => $request->input('no_hp'),
                'alamat_tenkes' => $request->input('alamat'),
                'tenkes_updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('nakes_profil', $nakes->user_id)->with(['success' => 'Profil berhasil diperbarui!']);
    }

    public function nakesResetFoto($id)
    {
        $nakes = Tenkesehatan::where('user_id', $id)->first();
        unlink(public_path('foto_profil/nakes') . '/' . $nakes->foto_tenkes);
        $nakes->update([
            'foto_tenkes' => 'default.jpg',
        ]);

        return redirect()->route('nakes_profil', $nakes->user_id)->with(['success' => 'Foto profil berhasil dihapus!']);
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
        $user = User::where('id', $id)->first();

        if($request->input('password') <> "") {
            if($request->input('username') != $user->username) {
                Request()->validate([
                    'username' => 'unique:users,username',
                    'password' => 'min:8|confirmed',
                ], [
                    'username.unique' => 'Username ' . $request->input('username') . ' telah digunakan',
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
            
            $user->update([
                'username' => $request->input('username'),
                'password' => Hash::make($request->get('password')),
            ]);
        }
        else {
            if($request->input('username') != $user->username) {
                Request()->validate([
                    'username' => 'unique:users,username',
                ], [
                    'username.unique' => 'Username ' . $request->input('username') . ' telah digunakan',
                ]);
            }
            else {
                Request()->validate([
                    'username' => 'required',
                ], [
                    'username.required' => 'Username wajib diisi',
                ]);
            }

            $user->update([
                'username' => $request->input('username')
            ]);
        }

        return redirect()->route('nakes_profil', $user->id)->with(['success' => 'Username atau password berhasil diganti!']);
    }

    public function nakesEditRekamMedik($id)
    {
        $notif = Notification::where('id', $id)->first();
        $notifs = Notification::where('user_id', $notif->user_id)->orderBy('id', 'DESC')->get();
        $notifCount = $notifs->count();
        $rekammedik = RekamMedik::where('id', $notif->rekam_medik_id)->first();
        //dd($rekammedik);
        $resep = ResepObat::where('rekam_medik_id', $rekammedik->id)->get();
        //dd($resep);
        $diagnosa = Diagnosa::all();
        $obat = Obat::all();
        
        return view('nakes.edit.nakes_edit_rekammedik', compact('notif', 'notifs', 'notifCount', 'rekammedik', 'resep', 'diagnosa', 'obat'));
    }

    public function addResepObat(Request $request, $id)
    {   
        $keterangan = $request->input('resep').' x '.$request->input('hari').' hari | '.$request->input('takaran').' '.$request->input('kuantitas').' ('.$request->input('waktu').') | Keterangan: ' . $request->input('keterangan_resep');
        ResepObat::create([
            'obat_id' => $request->input('obat_id'),
            'rekam_medik_id' => $request->input('rekammedik_id'),
            'keterangan' => $request->input('keterangan_resep'),
            'resepobat_created_at' => Carbon::now(),
            'resepobat_updated_at' => Carbon::now(),
        ]);

        return redirect()->route('nakes_edit_rekammedik_last', $id)->with(['success' => 'Resep obat berhasil ditambah!']);
    }

    public function editRekamMedikLast($id)
    {
        $diagnosa = Diagnosa::all();
        $obat = Obat::all();
        $currentNotif = Notification::where('id', $id)->first();
        $rekammedik = RekamMedik::find($currentNotif->rekam_medik_id);
        $resep = ResepObat::where('rekam_medik_id', $rekammedik->id)->get();

        return view('nakes.edit.resepobat', compact('rekammedik', 'currentNotif', 'diagnosa', 'obat', 'resep'));
    }

    public function deleteResepObat($id, $notif_id)
    {
        $resep = ResepObat::where('id', $id)->first();
        $resep->delete();

        return redirect()->route('nakes_edit_rekammedik', $notif_id)->with(['success' => 'Resep obat berhasil dihapus!']);
    }

    public function nakesKirimDataRekamMedik(Request $request, $id)
    {
        $diagnosa = Diagnosa::all();
        $obat = Obat::all();
        
        $currentNotif = Notification::where('id', $id)->first();
        $rekammedik = RekamMedik::find($currentNotif->rekam_medik_id);
        $rekammedik->update([
            'suhu' => $request->input('suhu'),
            'siastol' => $request->input('tensi1'),
            'diastol' => $request->input('tensi2'),
            'diagnosa_id' => $request->input('diagnosa'),
            'keluhan' => $request->input('keluhan'),
            'keterangan' => $request->input('keterangan'),
            'rekammedik_updated_at' => Carbon::now(),
        ]);

        $resep = ResepObat::where('rekam_medik_id', $rekammedik->id)->get();
        // $apotekers = Apoteker::all();
        // foreach ($apotekers as $key) {
        //     $notif = Notification::create([
        //         'rekam_medik_id' => $rekammedik->id,
        //         'user_id' => $key->user->id,
        //         'isi' => 'Obat pasien',
        //     ]);
        // }

        return redirect()->route('nakes_edit_rekammedik_last', $id)->with(['success' => 'Pemeriksaan berhasil diperbarui!']);
        // $currentNotif->delete();

        // ObatSent::dispatch($rekammedik, $notif);

        
        // return redirect()->route('nakes_dashboard', $rekammedik->tenkesehatan->user->id)->with(['success' => 'Rekam Medik berhasil dikirim!']);

        // return view('nakes.edit.resepobat', compact('rekammedik', 'currentNotif', 'diagnosa', 'obat', 'resep'));
    }

    public function kirimRekamMedik(Request $request, $id)
    {
        $currentNotif = Notification::where('id', $id)->first();
        $rekammedik = RekamMedik::find($currentNotif->rekam_medik_id);
        
        $apotekers = Apoteker::all();
        foreach ($apotekers as $key) {
            $notif = Notification::create([
                'rekam_medik_id' => $rekammedik->id,
                'user_id' => $key->user->id,
                'isi' => 'Obat pasien',
            ]);
        }

        $currentNotif->delete();

        return redirect()->route('nakes_dashboard', $rekammedik->tenkesehatan->user->id)->with(['success' => 'Rekam Medik berhasil dikirim!']);
    }
}

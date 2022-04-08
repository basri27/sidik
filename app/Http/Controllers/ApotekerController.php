<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Notification;
use App\Models\RekamMedik;
use App\Models\ResepObat;
use App\Models\Apoteker;
use App\Models\User;
use App\Models\Obat;
use Carbon\Carbon;

class ApotekerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function apotekerDashboard($id)
    {
        $notifications = Notification::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $notifCount = Notification::where('user_id', $id)->count();
        $pasiens = RekamMedik::where('status_rekam_medik', 'selesai')->whereDate('rekammedik_created_at', Carbon::now()->toDateString())->get();
        // $resep = ResepObat::whereDate('resepobat_created_at', Carbon::now()->toDateString())->get();
        $pasienCount = $pasiens->count();

        return view('apoteker.dashboard', compact('notifications', 'notifCount', 'pasienCount', 'pasiens'));
    }

    public function apotekerObatPasien($id)
    {
        $rekammedik = RekamMedik::find($id);

        return view('apoteker.obat_pasien', compact('rekammedik'));
    }

    public function apotekerProfil($id)
    {
        $notifications = Notification::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $notifCount = $notifications->count();
        $apoteker = Apoteker::where('user_id', $id)->first();
        $age = Carbon::parse($apoteker->tgl_lhr_apoteker)->diff(Carbon::now())->y;

        return view('apoteker.apoteker_profil', compact('notifications', 'notifCount', 'apoteker', 'age'));
    }

    public function apotekerEditProfil($id)
    {
        $notifications = Notification::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $notifCount = $notifications->count();
        $apoteker = Apoteker::where('user_id', $id)->first();
        $age = Carbon::parse($apoteker->tgl_lhr_apoteker)->diff(Carbon::now())->y;

        return view('apoteker.edit.apoteker_edit_profil', compact('notifications', 'notifCount', 'apoteker', 'age'));    
    }

    public function apotekerUpdateProfil(Request $request, $id)
    {
        $apoteker = Apoteker::where('user_id', $id)->first();

        if(Request()->foto_apoteker <> "") {
            $image = Request()->foto_apoteker;
            $imageName = $id. '_apoteker' . '.' . $image->extension();
            $image->move(public_path('foto_profil'), $imageName);

            $apoteker->update([
                'nama_apoteker' => $request->input('nama'),
                'jk_apoteker' => $request->input('jk'),
                'tempat_lhr_apoteker' => $request->input('tempat_lhr'),
                'tgl_lhr_apoteker' => $request->input('tgl_lhr'),
                'nohp_apoteker' => $request->input('no_hp'),
                'alamat_apoteker' => $request->input('alamat'),
                'foto_apoteker' => $imageName,
                'apoteker_updated_at' => Carbon::now(),
            ]);
        }
        else {
            $apoteker->update([
                'nama_apoteker' => $request->input('nama'),
                'jk_apoteker' => $request->input('jk'),
                'tempat_lhr_apoteker' => $request->input('tempat_lhr'),
                'tgl_lhr_apoteker' => $request->input('tgl_lhr'),
                'nohp_apoteker' => $request->input('no_hp'),
                'alamat_apoteker' => $request->input('alamat'),
                'apoteker_updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('apoteker_profil', $apoteker->user_id)->with(['success' => 'Profil berhasil diperbarui!']);
    }

    public function apotekerResetFoto($id)
    {
        $apoteker = Apoteker::where('user_id', $id)->first();
        unlink(public_path('foto_profil') . '/' . $apoteker->foto_apoteker);
        $apoteker->update([
            'foto_apoteker' => 'default.jpg',
        ]);

        return redirect()->route('apoteker_profil', $apoteker->user_id)->with(['success' => 'Foto profil berhasil dihapus!']);
    }

    public function apotekerEditUserPw($id)
    {
        $notifications = Notification::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $notifs = Notification::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $notifCount = Notification::where('user_id', $id)->count();
        $apoteker = User::where('id', $id)->first();

        return view('apoteker.edit.apoteker_edit_userpw', compact('notifications', 'notifs', 'notifCount', 'apoteker'));
    }

    public function apotekerUpdateUserPw(UpdatePasswordRequest $request, $id)
    {
        $user = User::where('id', $id)->first();
        
        if($request->input('password') <> "") {
            if($request->input('username') != $user->username) {
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
            
            $user->update([
                'username' => $request->input('username'),
                'password' => Hash::make($request->get('password')),
            ]);
        }
        else {
            $user->update([
                'username' => $request->input('username')
            ]);
        }

        return redirect()->route('apoteker_profil', $user->id)->with(['success' => 'Username atau password berhasil diganti!']);
    }

    public function apotekerDataObat($id)
    {
        $notifications = Notification::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $notifCount = $notifications->count();
        $apoteker = Apoteker::where('user_id', $id)->first();
        $obats = Obat::where('status_obat', 'aktif')->get();

        return view('apoteker.man_dataobat', compact('notifications', 'notifCount', 'apoteker', 'obats'));
    }

    public function addObat(Request $request, $id)
    {
        Obat::create([
            'nama_obat' => $request->input('obat'),
            'status_obat' => 'aktif',
        ]);

        return redirect()->route('apoteker_data_obat', $id)->with(['success' => 'Data obat berhasil ditambahkan!']);
    }

    public function editObat(Request $request, $id, $user_id)
    {
        $obat = Obat::where('id', $id)->first();
        $obat->update([
            'nama_obat' => $request->input('obat'),
        ]);

        return redirect()->route('apoteker_data_obat', $user_id)->with(['success' => 'Data obat berhasil diperbarui!']);
    }

    public function deleteObat($id, $user_id)
    {
        $obat = Obat::where('id', $id)->first();
        $obat->update([
            'status_obat' => 'non-aktif',
        ]);

        return redirect()->route('apoteker_data_obat', $user_id)->with(['success' => 'Data obat berhasil dihapus!']);
    }
    public function pengobatanSelesai($id, $user_id)
    {
        $notifs = Notification::where('rekam_medik_id', $id)->get();
        $rekammedik = RekamMedik::find($id);

        foreach($notifs as $notif) {
            $notif->delete();
        }
        $rekammedik->update(['status_rekam_medik' => 'selesai']);

        return redirect()->route('apoteker_dashboard', $user_id)->with(['success' => 'Pengobatan telah selesai']);
    }
}

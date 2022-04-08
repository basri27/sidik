<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdatePasswordRequest;
use Carbon\Carbon;
use App\Models\Pasien;
use App\Models\User;
use App\Models\Category;
use App\Models\Fakulta;
use App\Models\Prodi;
use App\Models\Jadwal;
use App\Models\JadwalPraktek;
use App\Models\KeluargaPasien;
use App\Models\RekamMedik;

class PasienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewBio()
    {
        
        $kategori = Category::all();
        $fakultas = Fakulta::all();
        $prodi = Prodi::all();
        return view('bio', compact('kategori', 'fakultas', 'prodi'));
    }
    public function add_bio(Request $request)
    {
        $image = Request()->foto_pasien;
        $imageName = $request->input('id_user') . '_pasien' . '.' . $image->extension();
        $image->move(public_path('foto_profil/pasien'), $imageName);
    
        if(Request()->fakulta_id <> ""){
            if(Request()->prodi_id <> ""){
                Pasien::create([
                'user_id' => $request->input('id_user'),
                'category_id' => $request->input('kategori'),
                'fakulta_id' => $request->input('fakulta_id'),
                'prodi_id' => $request->input('prodi_id'),
                'nama_pasien' => $request->input('nama'),
                'tempat_lhr_pasien' => $request->input('tempat_lhr'),
                'tgl_lhr_pasien' => $request->input('tgl_lhr'),
                'no_hp_pasien' => $request->input('nohp'),
                'alamat_pasien' => $request->input('alamat'),
                'jk_pasien' => $request->input('jk'),
                'foto_pasien' => $imageName,
                'status_pasien' => 'aktif'
                ]);
            }
            else {
                Pasien::create([
                'user_id' => $request->input('id_user'),
                'category_id' => $request->input('kategori'),
                'fakulta_id' => $request->input('fakulta_id'),
                'prodi_id' => '1',
                'nama_pasien' => $request->input('nama'),
                'tempat_lhr_pasien' => $request->input('tempat_lhr'),
                'tgl_lhr_pasien' => $request->input('tgl_lhr'),
                'no_hp_pasien' => $request->input('nohp'),
                'alamat_pasien' => $request->input('alamat'),
                'jk_pasien' => $request->input('jk'),
                'foto_pasien' => $imageName,
                'status_pasien' => 'aktif'
                ]);
            }
        }
        else {
            Pasien::create([
                'user_id' => $request->input('id_user'),
                'category_id' => $request->input('kategori'),
                'fakulta_id' => '1',
                'prodi_id' => '1',
                'nama_pasien' => $request->input('nama'),
                'tempat_lhr_pasien' => $request->input('tempat_lhr'),
                'tgl_lhr_pasien' => $request->input('tgl_lhr'),
                'no_hp_pasien' => $request->input('nohp'),
                'alamat_pasien' => $request->input('alamat'),
                'jk_pasien' => $request->input('jk'),
                'foto_pasien' => $imageName,
                'status_pasien' => 'aktif'
            ]);
        }

        return redirect()->route('profil_pasien', $request->input('id_user'));
    }
    public function profilPasien($id)
    {
        $pasien = User::where('id', $id)->first();

        return view('pasien.profil', compact('pasien'));
    }
    public function editProfilPasien($id)
    {
        $pasien = User::where('id', $id)->first();

        return view('pasien.edit_profil', compact('pasien'));
    }
    public function updateProfilPasien(Request $request, $id)
    {
        $pasien = Pasien::where('user_id', $id)->first();
        $kpasien = KeluargaPasien::where('user_id', $id)->first();

        if ($pasien != null) {
            if(Request()->foto_pasien <> "") {
                $image = Request()->foto_pasien;
                $imageName = $id . '_pasien' . '.' . $image->extension();
                $image->move(public_path('foto_profil/pasien'), $imageName);

                $pasien->update([
                    'nama_pasien' => $request->input('nama'),
                    'jk_pasien' => $request->input('jk'),
                    'tempat_lhr_pasien' => $request->input('tempat_lhr'),
                    'tgl_lhr_pasien' => $request->input('tgl_lhr'),
                    'no_hp_pasien' => $request->input('no_hp'),
                    'alamat_pasien' => $request->input('alamat'),
                    'foto_pasien' => $imageName,
                ]);
            }
            else {
                $pasien->update([
                    'nama_pasien' => $request->input('nama'),
                    'jk_pasien' => $request->input('jk'),
                    'tempat_lhr_pasien' => $request->input('tempat_lhr'),
                    'tgl_lhr_pasien' => $request->input('tgl_lhr'),
                    'no_hp_pasien' => $request->input('no_hp'),
                    'alamat_pasien' => $request->input('alamat'),
                ]);
            }
        }
        else {
            if(Request()->foto_pasien <> "") {
                $image = Request()->foto_pasien;
                $imageName = $id . '_keluarga_pasien' . '.' . $image->extension();
                $image->move(public_path('foto_profil/keluarga_pasien'), $imageName);

                $kpasien->update([
                    'nama_kel_pasien' => $request->input('nama'),
                    'jk_kel_pasien' => $request->input('jk'),
                    'tempat_lhr_kel_pasien' => $request->input('tempat_lhr'),
                    'tgl_lhr_kel_pasien' => $request->input('tgl_lhr'),
                    'no_hp_kel_pasien' => $request->input('no_hp'),
                    'alamat_kel_pasien' => $request->input('alamat'),
                    'foto_kel_pasien' => $imageName,
                ]);
            }
            else {
                $kpasien->update([
                    'nama_kel_pasien' => $request->input('nama'),
                    'jk_kel_pasien' => $request->input('jk'),
                    'tempat_lhr_kel_pasien' => $request->input('tempat_lhr'),
                    'tgl_lhr_kel_pasien' => $request->input('tgl_lhr'),
                    'no_hp_kel_pasien' => $request->input('no_hp'),
                    'alamat_kel_pasien' => $request->input('alamat'),
                ]);
            }
        }

        return redirect()->route('profil_pasien', $id)->with(['success' => 'Profil berhasil diperbarui']);
    }
    public function resetFotoPasien($id)
    {
       $pasien = Pasien::where('user_id', $id)->first();
        unlink(public_path('foto_profil/pasien') . '/' . $pasien->foto_pasien);
        $pasien->update([
            'foto_pasien' => 'default.jpg',
        ]);

        return redirect()->route('profil_pasien', $id)->with(['success' => 'Foto profil berhasil dihapus!']);
    }
    public function updateUsername(UpdatePasswordRequest $request, $user_id)
    {
        $user = User::find($user_id);
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

        return redirect()->route('profil_pasien', $user->id)->with(['success' => 'Username berhasil diganti!']); 
    }

    public function updatePassword(UpdatePasswordRequest $request, $user_id)
    {
        $user = User::find($user_id);
        Request()->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ], [
            'current_password.required' => 'Password wajib diisi !',
            'password.required' => 'Password wajib diisi !',
            'password.confirmed' => 'Password konfirmasi tidak sesuai',
        ]);
        $user->update(['password' => Hash::make($request->get('password'))]);

        return redirect()->route('profil_pasien', $user->id)->with(['success' => 'Password berhasil diganti!']); 
    }

    public function editUserPw($id)
    {
        $pasien = User::where('id', $id)->first();

        return view('pasien.edit_userpw', compact('pasien'));
    }
    public function pasienUpdateUserPw(UpdatePasswordRequest $request, $id)
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

        return redirect()->route('profil_pasien', $id)->with(['success' => 'Username atau password berhasil diganti!']);
    }
    public function jadwalPraktik($id)
    {
        $pasien = Pasien::where('user_id', $id)->first();
        $jadwal_praktek = JadwalPraktek::get();

        return view('pasien.jadwal_praktik', compact('pasien', 'jadwal_praktek'));
    }
    public function kartuBerobat($id)
    {
        $pasien = User::where('id', $id)->first();

        return view('pasien.kartu_berobat', compact('pasien'));
    }
    public function printKartuBerobat($id)
    {
        $pasien = User::where('id', $id)->first();

        return view('pasien.print_kartu_berobat', compact('pasien'));
    }
    public function keluargaPasien($id)
    {
        $pasien = Pasien::where('user_id', $id)->first();
        $pasangan = KeluargaPasien::where('kategori_kel_pasien', 'Suami')->orWhere('kategori_kel_pasien', 'Istri')->count();
        $kelpasien = KeluargaPasien::where('pasien_id', $pasien->id)->get();

        return view('pasien.keluarga_pasien', compact('pasien', 'pasangan', 'kelpasien'));
    }
    public function addKeluarga(Request $request, $id)
    {
        User::create([
            'role_id' => '2',
            'username' => $request->input('username'),
            'password' => Hash::make(12345678)
        ]);

        $user = User::where('username', $request->input('username'))->first();
        $pasien = Pasien::where('user_id', $id)->first();

        KeluargaPasien::create([
            'user_id' => $user->id,
            'pasien_id' => $pasien->id,
            'nama_kel_pasien' => $request->input('nama'),
            'jk_kel_pasien' => $request->input('jk'),
            'kategori_kel_pasien' => $request->input('kategori'),
            'tempat_lhr_kel_pasien' => $request->input('tempat_lhr'),
            'tgl_lhr_kel_pasien' => $request->input('tgl_lhr'),
            'no_hp_kel_pasien' => $request->input('no_hp'),
            'alamat_kel_pasien' => $request->input('alamat'),
            'foto_kel_pasien' => 'default.jpg',
            'status_kel_pasien' => 'aktif',
        ]);

        return redirect()->route('keluarga_pasien', $id)->with(['success' => 'Data keluarga berhasil ditambahkan!']);
    }
    public function riwayatBerobat($id)
    {
        $pasien = User::where('id', $id)->first();
     
        return view('pasien.riwayat_berobat', compact('pasien'));
    }
}

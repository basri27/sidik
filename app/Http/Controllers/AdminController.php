<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Admin;
use App\Models\User;
use App\Models\JadwalPraktek as Jadwal;
use App\Models\TenKesehatan;
use App\Models\Pasien;
use App\Models\Fakulta;
use App\Models\Prodi;
use App\Models\Category;
use App\Models\Apoteker;
use App\Models\Kategori_tenkesehatan;
use App\Models\RekamMedik;
use App\Models\Notification;
use App\Models\ResepObat;
use App\Models\Diagnosa;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Karyawan;
use App\Models\Umum;
use App\Models\Bpjs;
use App\Models\KeluargaPasien;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Events\MedicalRecordSent;
use App\Charts\RekamMedikBarChart;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adm_dashboard()
    {
        $pasienCount = Pasien::count();
        $nakesCount = Tenkesehatan::count();
        $rekammedikCount = RekamMedik::count();
        $apotekerCount = Apoteker::count();
        $pasiens = RekamMedik::whereDate('rekammedik_created_at', Carbon::now()->toDateString())
            ->where('status_rekam_medik', 'selesai')
            ->get();
        $pCount = $pasiens->count();
        return view('admin.dashboard', compact('pasienCount', 'nakesCount', 'rekammedikCount', 'apotekerCount', 'pasiens', 'pCount'));
    }

    public function adm_profil($user_id)
    {
        $admin = Admin::where('user_id', $user_id)->first();
        $age = Carbon::parse($admin->tgl_lhr_admin)->diff(Carbon::now())->y;

        return view('admin.admin_profil', compact('admin', 'age'));
    }

    public function adm_edit($user_id)
    {
        $admins = Admin::where('user_id', $user_id)->first();
        $age = Carbon::parse($admins->tgl_lhr_admin)->diff(Carbon::now())->y;

        return view('admin.manajemen.edit.edit_profil', compact('admins', 'age'));
    }

    public function adm_update(Request $request, $user_id)
    {
        $admins = Admin::where('user_id', $user_id)->first();

        if(Request()->foto_admin <> "") {
            $image = Request()->foto_admin;
            $imageName = $user_id . '_admin' . '.' . $image->extension();
            $image->move(public_path('foto_profil/admin'), $imageName);

            $admins->update([
                'nama_admin' => $request->input('nama'),
                'jk_admin' => $request->input('jk'),
                'tempat_lhr_admin' => $request->input('tempat_lhr'),
                'tgl_lhr_admin' => $request->input('tgl_lhr'),
                'no_hp_admin' => $request->input('no_hp'),
                'alamat_admin' => $request->input('alamat'),
                'foto_admin' => $imageName,
                'admin_updated_at' => Carbon::now(),
            ]);
        }
        else {
            $admins->update([
                'nama_admin' => $request->input('nama'),
                'jk_admin' => $request->input('jk'),
                'tempat_lhr_admin' => $request->input('tempat_lhr'),
                'tgl_lhr_admin' => $request->input('tgl_lhr'),
                'no_hp_admin' => $request->input('no_hp'),
                'alamat_admin' => $request->input('alamat'),
                'admin_updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('adm_profil', $admins->user_id)->with(['success' => 'Profil berhasil diperbarui!']);
    }

    public function admResetFoto($user_id)
    {
        $admin = Admin::where('user_id', $user_id)->first();
        unlink(public_path('foto_profil/admin') . '/' . $admin->foto_admin);
        $admin->update([
            'foto_admin' => 'default.jpg',
        ]);

        return redirect()->route('adm_profil', $admin->user_id)->with(['success' => 'Foto profil berhasil dihapus!']);
    }

    public function adm_edit_userpw($user_id)
    {
        $admins = User::where('id', $user_id)->first();

        return view('admin.manajemen.edit.edit_userpw', compact('admins'));
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

        return redirect()->route('adm_profil', $user->id)->with(['success' => 'Username berhasil diganti!']); 
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

        return redirect()->route('adm_profil', $user->id)->with(['success' => 'Password berhasil diganti!']); 
    }

    public function adm_update_userpw(UpdatePasswordRequest $request, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        
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

        return redirect()->route('adm_profil', $user->id)->with(['success' => 'Username atau password berhasil diganti!']);    
    }

    // public function adm_jadwal()
    // {
    //     $jadwals = Jadwal::get();
        
    //     return view('admin.admin_jadwal', compact('jadwals'));
    // }

    // public function adm_jadwal_edit($id)
    // {
    //     $jadwals = Jadwal::where('id', $id)->first();
    //     $tenkes = Tenkesehatan::all();
        
    //     return view('admin.manajemen.edit.edit_jadwal', compact('jadwals', 'tenkes'));
    // }

    // public function adm_jadwal_update(Request $request, $id)
    // {
    //     $jadwals = Jadwal::find($id);
    //     $tenkes = ('jadwal_tenkesehatan')->where('jadwal_id', $id)->get();
        
    //     if(Request()->tenkes1) {
    //         if(Request()->tenkes2) {
    //             $tenkes1 = Request()->tenkes1;
    //             $tenkes2 = Request()->tenkes2;
                
    //             foreach ($tenkes as $t) {
    //                 $jadwals->tenkesehatan()->detach($t);
    //             }
    //             $jadwals->tenkesehatan()->attach([$tenkes1, $tenkes2]);
    //         }
    //         else {
    //             $tenkes1 = Request()->tenkes1;
    //             $tenkes2 = null;
    //             foreach ($tenkes as $t) {
    //                 $jadwals->tenkesehatan()->detach($t);
    //             }
    //             $jadwals->tenkesehatan()->attach([$tenkes1, $tenkes2]);
    //         }
    //     }
    //     else {
    //         if(Request()->tenkes2) {
    //             $tenkes1 = null;
    //             $tenkes2 = Request()->tenkes2;
    //             foreach ($tenkes as $t) {
    //                 $jadwals->tenkesehatan()->detach($t);
    //             }
    //             $jadwals->tenkesehatan()->attach([$tenkes1, $tenkes2]);
    //         }
    //         else {
    //             $tenkes1 = null;
    //             $tenkes2 = null;
    //             foreach ($tenkes as $t) {
    //                 $jadwals->tenkesehatan()->detach($t);
    //             }
    //             $jadwals->tenkesehatan()->attach([$tenkes1, $tenkes2]);
    //         }
    //     }

    //     $jadwal = Jadwal::where('id', $id)->first();
    //     $jadwal->update([
    //         'pagi_s' => $request->input('pagi_s'),
    //         'pagi_n' => $request->input('pagi_n'),
    //         'siang_s' => $request->input('siang_s'),
    //         'siang_n' => $request->input('siang_n'),
    //     ]);

    //     #dd($jadwals, $id);
    //     return redirect()->route('adm_jadwal', $id);
    // }

    public function adm_jadwal()
    {
        $jadwals = Jadwal::with('tenkesehatan')->get();
        $tenkes = TenKesehatan::all();
        
        return view('admin.admin_jadwal', compact('jadwals', 'tenkes'));
    }

    public function adm_jadwal_edit($id)
    {
        $jadwals = Jadwal::where('id', $id)->first();
        $tenkes = Tenkesehatan::all();
        
        return view('admin.manajemen.edit.edit_jadwal', compact('jadwals', 'tenkes'));
    }

    public function adm_jadwal_update(Request $request, $id)
    {
        $jadwals = Jadwal::find($id);
        // $tenkes = Jadwal::with('tenkesehatan')->where('id', $id)->get();
        // $tenkes = 
        
        // if(Request()->tenkes1) {
        //     if(Request()->tenkes2) {
        //         $tenkes1 = Request()->tenkes1;
        //         $tenkes2 = Request()->tenkes2;
                
        //         foreach ($tenkes as $t) {
        //             $jadwals->tenkesehatan()->detach($t);
        //         }
        //         $jadwals->tenkesehatan()->attach([$tenkes1, $tenkes2]);
        //     }
        //     else {
        //         $tenkes1 = Request()->tenkes1;
        //         $tenkes2 = null;
        //         foreach ($tenkes as $t) {
        //             $jadwals->tenkesehatan()->detach($t);
        //         }
        //         $jadwals->tenkesehatan()->attach([$tenkes1, $tenkes2]);
        //     }
        // }
        // else {
        //     if(Request()->tenkes2) {
        //         $tenkes1 = null;
        //         $tenkes2 = Request()->tenkes2;
        //         foreach ($tenkes as $t) {
        //             $jadwals->tenkesehatan()->detach($t);
        //         }
        //         $jadwals->tenkesehatan()->attach([$tenkes1, $tenkes2]);
        //     }
        //     else {
        //         $tenkes1 = null;
        //         $tenkes2 = null;
        //         foreach ($tenkes as $t) {
        //             $jadwals->tenkesehatan()->detach($t);
        //         }
        //         $jadwals->tenkesehatan()->attach([$tenkes1, $tenkes2]);
        //     }
        // }

        $jadwal = Jadwal::where('id', $id)->first();
        $waktu1 = $request->input('pagi_s')." - ".$request->input('pagi_n');
        $waktu2 = $request->input('siang_s')." - ".$request->input('siang_n');
        $jadwal->update([
            'tenkes1' => $request->input('tenkes1'),
            'waktu1' => $waktu1,
            'tenkes2' => $request->input('tenkes2'),
            'waktu2' => $waktu2
        ]);

        #dd($jadwals, $id);
        return redirect()->route('adm_jadwal', $id);
    }

    //------------rekap rekam medik-------------//
    public function adm_rekap_rekam_medik()
    {
        $rekammedik = RekamMedik::where('status_rekam_medik', 'selesai')->get();
        $diagnosa = Diagnosa::all();
        $dosen = Dosen::all();
        $kary = Karyawan::all();
        $mhs = Mahasiswa::all();
        $bpjs = Bpjs::all();
        $i = 0;
        foreach($diagnosa as $r) {
            $i += 1;
            $diag[$i] = RekamMedik::where('diagnosa_id', $r->id)->orderBy('diagnosa_id', 'DESC')->count();
            $namediag[$i] = RekamMedik::where('diagnosa_id', $r->id)->first();
        }

        foreach($diag as $dg) {
            if($dg != 0) {
                $dgn[] = $dg;
            }
        }

        foreach($namediag as $r) {
            if($r != null) {
                $listdiag[] = $r->diagnosa->nama_diagnosa; 
            }
        }

        for($i = 1; $i <= 12; $i++) {
            $diagCount20[$i] = RekamMedik::fromQuery('SELECT nama_diagnosa, diagnosa_id, COUNT(diagnosa_id) AS freq FROM rekam_mediks as rk JOIN diagnosas as d ON rk.diagnosa_id = d.id WHERE YEAR (rekammedik_created_at) = 2020 AND MONTH (rekammedik_created_at) = ' . $i . ' GROUP BY diagnosa_id ORDER BY freq DESC LIMIT 5');
            $diagCount21[$i] = RekamMedik::fromQuery('SELECT nama_diagnosa, diagnosa_id, COUNT(diagnosa_id) AS freq FROM rekam_mediks as rk JOIN diagnosas as d ON rk.diagnosa_id = d.id WHERE YEAR (rekammedik_created_at) = 2021 AND MONTH (rekammedik_created_at) = ' . $i . ' GROUP BY diagnosa_id ORDER BY freq DESC LIMIT 5');
            $diagCount22[$i] = RekamMedik::fromQuery('SELECT nama_diagnosa, diagnosa_id, COUNT(diagnosa_id) AS freq FROM rekam_mediks as rk JOIN diagnosas as d ON rk.diagnosa_id = d.id WHERE YEAR (rekammedik_created_at) = 2022 AND MONTH (rekammedik_created_at) = ' . $i . ' GROUP BY diagnosa_id ORDER BY freq DESC LIMIT 5');
            $diagCount23[$i] = RekamMedik::fromQuery('SELECT nama_diagnosa, diagnosa_id, COUNT(diagnosa_id) AS freq FROM rekam_mediks as rk JOIN diagnosas as d ON rk.diagnosa_id = d.id WHERE YEAR (rekammedik_created_at) = 2023 AND MONTH (rekammedik_created_at) = ' . $i . ' GROUP BY diagnosa_id ORDER BY freq DESC LIMIT 5');
            $diagCount24[$i] = RekamMedik::fromQuery('SELECT nama_diagnosa, diagnosa_id, COUNT(diagnosa_id) AS freq FROM rekam_mediks as rk JOIN diagnosas as d ON rk.diagnosa_id = d.id WHERE YEAR (rekammedik_created_at) = 2024 AND MONTH (rekammedik_created_at) = ' . $i . ' GROUP BY diagnosa_id ORDER BY freq DESC LIMIT 5');
            $diagCount25[$i] = RekamMedik::fromQuery('SELECT nama_diagnosa, diagnosa_id, COUNT(diagnosa_id) AS freq FROM rekam_mediks as rk JOIN diagnosas as d ON rk.diagnosa_id = d.id WHERE YEAR (rekammedik_created_at) = 2025 AND MONTH (rekammedik_created_at) = ' . $i . ' GROUP BY diagnosa_id ORDER BY freq DESC LIMIT 5');
            $m20[$i] = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Mahasiswa')->whereYear('rekammedik_created_at', 2020)->whereMonth('rekammedik_created_at', $i)->count();
            $data24[$i] = RekamMedik::whereYear('rekammedik_created_at', 2024)->whereMonth('rekammedik_created_at', $i)->where('status_rekam_medik', 'selesai')->count();
            $data25[$i] = RekamMedik::whereYear('rekammedik_created_at', 2025)->whereMonth('rekammedik_created_at', $i)->where('status_rekam_medik', 'selesai')->count();
            $data20[$i] = RekamMedik::whereYear('rekammedik_created_at', 2020)->whereMonth('rekammedik_created_at', $i)->where('status_rekam_medik', 'selesai')->count();
            $data21[$i] = RekamMedik::whereYear('rekammedik_created_at', 2021)->whereMonth('rekammedik_created_at', $i)->where('status_rekam_medik', 'selesai')->count();
            $data22[$i] = RekamMedik::whereYear('rekammedik_created_at', 2022)->whereMonth('rekammedik_created_at', $i)->where('status_rekam_medik', 'selesai')->count();
            $data23[$i] = RekamMedik::whereYear('rekammedik_created_at', 2023)->whereMonth('rekammedik_created_at', $i)->where('status_rekam_medik', 'selesai')->count();
        }

        $dosen24 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Dosen')->whereYear('rekammedik_created_at', 2024)->count();
        $dosen25 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Dosen')->whereYear('rekammedik_created_at', 2025)->count();
        $dosen20 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Dosen')->whereYear('rekammedik_created_at', 2020)->count();
        $dosen21 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Dosen')->whereYear('rekammedik_created_at', 2021)->count();
        $dosen22 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Dosen')->whereYear('rekammedik_created_at', 2022)->count();
        $dosen23 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Dosen')->whereYear('rekammedik_created_at', 2023)->count();

        $mhs24 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Mahasiswa')->whereYear('rekammedik_created_at', 2024)->count();
        $mhs25 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Mahasiswa')->whereYear('rekammedik_created_at', 2025)->count();
        $mhs20 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Mahasiswa')->whereYear('rekammedik_created_at', 2020)->count();
        $mhs21 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Mahasiswa')->whereYear('rekammedik_created_at', 2021)->count();
        $mhs22 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Mahasiswa')->whereYear('rekammedik_created_at', 2022)->count();
        $mhs23 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Mahasiswa')->whereYear('rekammedik_created_at', 2023)->count();

        $kary24 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Karyawan')->whereYear('rekammedik_created_at', 2024)->count();
        $kary25 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Karyawan')->whereYear('rekammedik_created_at', 2025)->count();
        $kary20 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Karyawan')->whereYear('rekammedik_created_at', 2020)->count();
        $kary21 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Karyawan')->whereYear('rekammedik_created_at', 2021)->count();
        $kary22 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Karyawan')->whereYear('rekammedik_created_at', 2022)->count();
        $kary23 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Karyawan')->whereYear('rekammedik_created_at', 2023)->count();

        $umum24 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Umum')->whereYear('rekammedik_created_at', 2024)->count();
        $umum25 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Umum')->whereYear('rekammedik_created_at', 2025)->count();
        $umum20 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Umum')->whereYear('rekammedik_created_at', 2020)->count();
        $umum21 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Umum')->whereYear('rekammedik_created_at', 2021)->count();
        $umum22 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Umum')->whereYear('rekammedik_created_at', 2022)->count();
        $umum23 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Umum')->whereYear('rekammedik_created_at', 2023)->count();
        
        foreach($data24 as $r) {
            $y2024[] = $r;
        }
        foreach($data25 as $r) {
            $y2025[] = $r;
        }
        foreach($data20 as $r) {
            $y2020[] = $r;
        }
        foreach($data21 as $r) {
            $y2021[] = $r;
        }
        foreach($data22 as $r) {
            $y2022[] = $r;
        }
        foreach($data23 as $r) {
            $y2023[] = $r;
        }

        return view('admin.rekap_rekam_medik', compact('rekammedik', 'dosen', 'kary', 'mhs', 'bpjs', 'diagCount20', 'diagCount21', 'diagCount22', 'diagCount23', 'diagCount24', 'diagCount25', 'y2024', 'y2025', 'y2020', 'y2021', 'y2022', 'y2023', 'mhs24', 'mhs25', 'mhs20', 'mhs21', 'mhs22', 'mhs23', 'dosen24', 'dosen25', 'dosen20', 'dosen21', 'dosen22', 'dosen23', 'kary24', 'kary25', 'kary20', 'kary21', 'kary22', 'kary23', 'umum24', 'umum25', 'umum20', 'umum21', 'umum22', 'umum23', 'm20'));
    }
    public function filterRekamMedikPasien(Request $request)
    {
        $rekammedik = RekamMedik::where('status_rekam_medik', 'selesai')->whereBetween('rekammedik_created_at', [$request->input('date-start'), $request->input('date-end')])
            ->orWhereDate('rekammedik_created_at', $request->input('date-end'))->get();

        for($i = 1; $i <= 12; $i++) {
            $data24[$i] = RekamMedik::whereYear('rekammedik_created_at', 2024)->whereMonth('rekammedik_created_at', $i)->where('status_rekam_medik', 'selesai')->count();
            $data25[$i] = RekamMedik::whereYear('rekammedik_created_at', 2025)->whereMonth('rekammedik_created_at', $i)->where('status_rekam_medik', 'selesai')->count();
            $data20[$i] = RekamMedik::whereYear('rekammedik_created_at', 2020)->whereMonth('rekammedik_created_at', $i)->where('status_rekam_medik', 'selesai')->count();
            $data21[$i] = RekamMedik::whereYear('rekammedik_created_at', 2021)->whereMonth('rekammedik_created_at', $i)->where('status_rekam_medik', 'selesai')->count();
            $data22[$i] = RekamMedik::whereYear('rekammedik_created_at', 2022)->whereMonth('rekammedik_created_at', $i)->where('status_rekam_medik', 'selesai')->count();
            $data23[$i] = RekamMedik::whereYear('rekammedik_created_at', 2023)->whereMonth('rekammedik_created_at', $i)->where('status_rekam_medik', 'selesai')->count();
        }

        $civitas24 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Dosen')->orWhere('nama_kategori', 'Karyawan')->whereYear('rekammedik_created_at', 2024)->count();
        $dosen24 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Dosen')->whereYear('rekammedik_created_at', 2024)->count();
        $dosen25 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Dosen')->whereYear('rekammedik_created_at', 2025)->count();
        $dosen20 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Dosen')->whereYear('rekammedik_created_at', 2020)->count();
        $dosen21 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Dosen')->whereYear('rekammedik_created_at', 2021)->count();
        $dosen22 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Dosen')->whereYear('rekammedik_created_at', 2022)->count();
        $dosen23 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Dosen')->whereYear('rekammedik_created_at', 2023)->count();

        $mhs24 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Mahasiswa')->whereYear('rekammedik_created_at', 2024)->count();
        $mhs25 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Mahasiswa')->whereYear('rekammedik_created_at', 2025)->count();
        $mhs20 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Mahasiswa')->whereYear('rekammedik_created_at', 2020)->count();
        $mhs21 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Mahasiswa')->whereYear('rekammedik_created_at', 2021)->count();
        $mhs22 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Mahasiswa')->whereYear('rekammedik_created_at', 2022)->count();
        $mhs23 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Mahasiswa')->whereYear('rekammedik_created_at', 2023)->count();

        $kary24 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Karyawan')->whereYear('rekammedik_created_at', 2024)->count();
        $kary25 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Karyawan')->whereYear('rekammedik_created_at', 2025)->count();
        $kary20 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Karyawan')->whereYear('rekammedik_created_at', 2020)->count();
        $kary21 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Karyawan')->whereYear('rekammedik_created_at', 2021)->count();
        $kary22 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Karyawan')->whereYear('rekammedik_created_at', 2022)->count();
        $kary23 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Karyawan')->whereYear('rekammedik_created_at', 2023)->count();

        $umum24 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Umum')->whereYear('rekammedik_created_at', 2024)->count();
        $umum25 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Umum')->whereYear('rekammedik_created_at', 2025)->count();
        $umum20 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Umum')->whereYear('rekammedik_created_at', 2020)->count();
        $umum21 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Umum')->whereYear('rekammedik_created_at', 2021)->count();
        $umum22 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Umum')->whereYear('rekammedik_created_at', 2022)->count();
        $umum23 = DB::table('rekam_mediks as rk')->join('pasiens as p', 'p.id', 'rk.pasien_id')->join('categories as c', 'c.id', 'p.category_id')->where('nama_kategori', 'Umum')->whereYear('rekammedik_created_at', 2023)->count();
        
        foreach($data24 as $r) {
            $y2024[] = $r;
        }
        foreach($data25 as $r) {
            $y2025[] = $r;
        }
        foreach($data20 as $r) {
            $y2020[] = $r;
        }
        foreach($data21 as $r) {
            $y2021[] = $r;
        }
        foreach($data22 as $r) {
            $y2022[] = $r;
        }
        foreach($data23 as $r) {
            $y2023[] = $r;
        }
                
        return view('admin.rekap_rekam_medik', compact('rekammedik', 'y2024', 'y2025', 'y2020', 'y2021', 'y2022', 'y2023', 'mhs24', 'mhs25', 'mhs20', 'mhs21', 'mhs22', 'mhs23', 'dosen24', 'dosen25', 'dosen20', 'dosen21', 'dosen22', 'dosen23', 'kary24', 'kary25', 'kary20', 'kary21', 'kary22', 'kary23', 'umum24', 'umum25', 'umum20', 'umum21', 'umum22', 'umum23'));
    }
    public function filterRekamMedik()
    {
        $columns = [
            'nama_pasien',
            'rekammedik_created_at',
            'nama_kategori',
            'nama_tenkes',
            ''
        ];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = (DB::table('rekam_mediks as rk'))
        ->join('tenkesehatans as t', 't.id', 'rk.tenkesehatan_id')
        ->join('pasiens as p', 'p.id', 'rk.pasien_id')
        ->join('categories as c', 'c.id', 'p.category_id')
        ->join('diagnosas as d', 'rk.diagnosa_id', 'd.id')
        ->where('status_rekam_medik', 'selesai')
        ->select('rk.id', 'rk.pasien_id', 'rk.tenkesehatan_id', 'rk.diagnosa_id', 'rk.suhu', 'rk.tensi', 'rk.keluhan', 'rk.keterangan', 'rk.rekammedik_created_at',
            't.nama_tenkes',
            'p.nama_pasien', 
            'c.nama_kategori', 
            'd.nama_diagnosa', 'd.kode_diagnosa')
        ;

        if(request()->input("search.value")) {
            $data = $data->where(function($query){
                $query->whereRaw('LOWER(nama_pasien) like ?', ['%'.strtolower(request()->input("search.value")).'%'])
                ->orWhereRaw('LOWER(rekammedik_created_at) like ?', ['%'.strtolower(request()->input("search.value")).'%'])
                ->orWhereRaw('LOWER(nama_kategori) like ?', ['%'.strtolower(request()->input("search.value")).'%'])
                ->orWhereRaw('LOWER(nama_tenkes) like ?', ['%'.strtolower(request()->input("search.value")).'%']);
            });
        }

        if(request()->input('mulai') and request()->input('habis')) {
            $data = $data->whereBetween('rekammedik_created_at', [request()->input('mulai'), request()->input('habis')])
            ->orWhereDate('rekammedik_created_at', request()->input('habis'));
        }

        $recordsFiltered = $data->get()->count();
        $data = $data
            ->skip(request()->input('start'))
            ->take(request()->input('length'))
            ->orderBy($orderBy, request()->input("order.0.dir"))
            ->get();
        $recordsTotal = $data->count();

        return response()->json([
            'draw' => request()->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    //-----------function manajemen----------//
    public function adm_man_datapasien()
    {
        $pasiens = Pasien::where('status_pasien', 'aktif')->get();
        $dosen = Dosen::all();
        $mhs = Mahasiswa::all();
        $kary = Karyawan::all();
        $bpjs = Bpjs::all();
        $users = User::all()->last();
        $fakultas = Fakulta::all();
        $prodis = Prodi::all();
        $category = Category::all();
        
        return view('admin.manajemen.man_datapasien', compact('pasiens', 'fakultas', 'prodis', 'category', 'dosen', 'mhs', 'kary', 'bpjs'));
    }
    public function adm_man_dataapoteker()
    {
        $apotekers = Apoteker::where('status_apoteker', 'aktif')->get();

        return view('admin.manajemen.man_dataapoteker', compact('apotekers'));
    }
    public function adm_man_datanakes()
    {
        $tenkes = Tenkesehatan::where('status_tenkes', 'aktif')->get();
        $kakes = Kategori_tenkesehatan::all();
        
        return view('admin.manajemen.man_datanakes', compact('tenkes', 'kakes'));
    }
    public function admManDataDiagnosa()
    {
        $diagnosa = Diagnosa::where('status_diagnosa', 'aktif')->get();

        return view('admin.manajemen.man_datadiagnosa', compact('diagnosa'));
    }
    public function adm_man_datarekammedik()
    {
        $pasiens = Pasien::where('status_pasien', 'aktif')->get();
        $dosen = Dosen::all();
        $mhs = Mahasiswa::all();
        $kary = Karyawan::all();
        $bpjs = Bpjs::all();

        return view('admin.manajemen.man_rekammedik', compact('pasiens', 'dosen', 'mhs', 'kary', 'bpjs'));
    }

    //------------Tambah data------------//
    #Tambah data pasien
    public function adm_man_datapasien_tambah()
    {
        $users = User::all()->last();
        $fakultas = Fakulta::all();
        $prodis = Prodi::all();
        $category = Category::all();

        return view('admin.manajemen.add.add_datapasien', compact('users', 'fakultas', 'prodis', 'category'));
    }
    public function adm_man_datapasien_add(Request $request)
    {
            User::create([
                'role_id' => '2',
                'username' => Str::lower($request->input('username')),
                'password' => Hash::make(12345678),
                'user_created_at' => Carbon::now(),
                'user_updated_at' => Carbon::now(),
            ]);

            $user = User::where('username', $request->input('username'))->first();
            
            Pasien::create([
                'user_id' => $user->id,
                'category_id' => $request->input('category_id'),
                'nama_pasien' => $request->input('nama'),
                'tempat_lhr_pasien' => $request->input('tempat_lhr'),
                'tgl_lhr_pasien' => $request->input('tgl_lhr'),
                'no_hp_pasien' => $request->input('no_hp'),
                'alamat_pasien' => $request->input('alamat'),
                'jk_pasien' => $request->input('jk'),
                'foto_pasien' => 'default.jpg',
                'status_pasien' => 'aktif'
            ]);

            $pasien = Pasien::where('user_id', $user->id)->first();

            if ($request->input('category_id') == 1) {
                Dosen::create([
                    'pasien_id' => $pasien->id,
                    'fakulta_id' => $request->input('fakulta_id'),
                ]);
            }
            elseif ($request->input('category_id') == 2) {
                Karyawan::create([
                    'pasien_id' => $pasien->id,
                    'fakulta_id' => $request->input('fakulta_id'),
                ]);
            }
            elseif ($request->input('category_id') == 3) {
                Mahasiswa::create([
                    'pasien_id' => $pasien->id,
                    'fakulta_id' => $request->input('fakulta_id'),
                    'prodi_id' => $request->input('prodi_id'),
                ]);
            }
            elseif ($request->input('category_id') == 5) {
                Bpjs::create([
                    'pasien_id' => $pasien->id,
                    'no_bpjs' => $request->input('no_bpjs')
                ]);
            }

        return redirect()->route('adm_man_datapasien')->with(['success' => 'Data berhasil ditambahkan!']);
    }

    #Tambah data apoteker
    public function adm_man_dataapoteker_tambah()
    {
        $users = User::all()->last();

        return view('admin.manajemen.add.add_dataapoteker', compact('users'));
    }
    public function adm_man_dataapoteker_add(Request $request)
    {
        
            User::create([
                'role_id' => '4',
                'username' => Str::lower($request->input('username')),
                'password' => Hash::make(12345678),
            ]);

            $user = User::where('username', $request->input('username'))->first();

            Apoteker::create([
                'user_id' => $user->id,
                'nama_apoteker' => $request->input('nama'),
                'tempat_lhr_apoteker' => $request->input('tempat_lhr'),
                'tgl_lhr_apoteker' => $request->input('tgl_lhr'),
                'nohp_apoteker' => $request->input('no_hp'),
                'alamat_apoteker' => $request->input('alamat'),
                'jk_apoteker' => $request->input('jk'),
                'foto_apoteker' => 'default.jpg',
                'status_apoteker' => 'aktif'
            ]);

        return redirect()->route('adm_man_dataapoteker')->with(['success' => 'Data berhasil ditambahkan!']);
    }

    #Tambah data nakes
    public function adm_man_datanakes_tambah()
    {
        $users = User::all()->last();

        return view('admin.manajemen.add.add_datanakes', compact('users'));
    }
    public function adm_man_datanakes_add(Request $request)
    {
            User::create([
                'role_id' => '3',
                'username' => Str::lower($request->input('username')),
                'password' => Hash::make(12345678),
            ]);

            $user = User::where('username', $request->input('username'))->first();

            Tenkesehatan::create([
                'user_id' => $user->id,
                'kategori_tenkesehatan_id' => $request->input('kakes'),
                'nama_tenkes' => $request->input('nama'),
                'tempat_lhr_tenkes' => $request->input('tempat_lhr'),
                'tgl_lhr_tenkes' => $request->input('tgl_lhr'),
                'nohp_tenkes' => $request->input('no_hp'),
                'alamat_tenkes' => $request->input('alamat'),
                'jk_tenkes' => $request->input('jk'),
                'foto_tenkes' => 'default.jpg',
                'status_tenkes' => 'aktif'
            ]);

        return redirect()->route('adm_man_datanakes')->with(['success' => 'Data berhasil ditambahkan!']);
    }
    public function admAddDiagnosa(Request $request)
    {
        Diagnosa::create([
            'kode_diagnosa' => $request->input('kode_diagnosa'),
            'nama_diagnosa' => $request->input('diagnosa'),
            'status_diagnosa' => 'aktif',
        ]);

        return redirect()->route('adm_man_datadiagnosa')->with(['success' => 'Data berhasil ditambahkan!']);
    }

    //--------------Edit data-------------//
    #Edit data pasien
    public function adm_man_datapasien_edit($id)
    {
        $pasien = Pasien::find($id);
        $fakultas = Fakulta::all();
        $prodis = Prodi::all();
        $category = Category::all();
        
        return view('admin.manajemen.edit.edit_datapasien', compact('pasien', 'fakultas', 'prodis', 'category'));
    }
    public function adm_man_datapasien_update(Request $request, $id)
    {
        $pasien = Pasien::find($id);

        if ($request->input('category_id') == $pasien->category_id) {
            if ($pasien->category_id == 1) {
                $dosen = Dosen::where('pasien_id', $pasien->id)->first();
                $dosen->update([
                    'fakulta_id' => $request->input('fakulta_id')
                ]);
            }
            else if ($pasien->category_id == 2) {
                $kary = Karyawan::where('pasien_id', $pasien->id)->first();
                $kary->update([
                    'fakulta_id' => $request->input('fakulta_id')
                ]);
            }
            else if ($pasien->category_id == 3) {
                $mhs = Mahasiswa::where('pasien_id', $pasien->id)->first();
                $mhs->update([
                    'fakulta_id' => $request->input('fakulta_id'),
                    'prodi_id' => $request->input('prodi_id')
                ]);
            }
            else if ($pasien->category_id == 5) {
                $bpjs = Bpjs::where('pasien_id', $pasien->id)->first();
                $bpjs->update([
                    'no_bpjs' => $request->input('no_bpjs')
                ]);
            }
        }
        else {
            if ($pasien->category_id == 1) {
                $dosen = Dosen::where('pasien_id', $pasien->id)->first();
                if ($request->input('category_id') == 2) {
                    $bagian = Fakulta::find($request->input('fakulta_id'));
                    Karyawan::create([
                        'pasien_id' => $pasien->id,
                        'fakulta_id' => $request->input('fakulta_id')
                    ]);
                }
                else if ($request->input('category_id') == 3) {
                    Mahasiswa::create([
                        'pasien_id' => $pasien->id,
                        'fakulta_id' => $request->input('fakulta_id'),
                        'prodi_id' => $request->input('prodi_id'),
                    ]);
                }
                else if ($request->input('category_id') == 5) {
                    Bpjs::create([
                        'pasien_id' => $pasien->id,
                        'no_bpjs' => $request->input('no_bpjs')
                    ]);
                }
                $dosen->delete();
            }
            else if ($pasien->category_id == 2) {
                $kary = Karyawan::where('pasien_id', $pasien->id)->first();
                if ($request->input('category_id') == 1) {
                    Dosen::create([
                        'pasien_id' => $pasien->id,
                        'fakulta_id' => $request->input('fakulta_id')
                    ]);
                }
                else if ($request->input('category_id') == 3) {
                    Mahasiswa::create([
                        'pasien_id' => $pasien->id,
                        'fakulta_id' => $request->input('fakulta_id'),
                        'prodi_id' => $request->input('prodi_id'),
                    ]);
                }
                else if ($request->input('category_id') == 5) {
                    Bpjs::create([
                        'pasien_id' => $pasien->id,
                        'no_bpjs' => $request->input('no_bpjs')
                    ]);
                }
                $kary->delete();
            }
            else if ($pasien->category_id == 3) {
                $mhs = Mahasiswa::where('pasien_id', $pasien->id)->first();
                if ($request->input('category_id') == 1) {
                    Dosen::create([
                        'pasien_id' => $pasien->id,
                        'fakulta_id' => $request->input('fakulta_id')
                    ]);
                }
                else if ($request->input('category_id') == 2) {
                    Karyawan::create([
                        'pasien_id' => $pasien->id,
                        'fakulta_id' => $request->input('fakulta_id'),
                    ]);
                }
                else if ($request->input('category_id') == 5) {
                    Bpjs::create([
                        'pasien_id' => $pasien->id,
                        'no_bpjs' => $request->input('no_bpjs')
                    ]);
                }
                $mhs->delete();
            }
            else if ($pasien->category_id == 4) {
                if ($request->input('category_id') == 1) {
                    Dosen::create([
                        'pasien_id' => $pasien->id,
                        'fakulta_id' => $request->input('fakulta_id')
                    ]);
                }
                else if ($request->input('category_id') == 2) {
                    Karyawan::create([
                        'pasien_id' => $pasien->id,
                        'fakulta_id' => $request->input('fakulta_id'),
                    ]);
                }
                else if ($request->input('category_id') == 3) {
                    Mahasiswa::create([
                        'pasien_id' => $pasien->id,
                        'fakulta_id' => $request->input('fakulta_id'),
                        'prodi_id' => $request->input('prodi_id'),
                    ]);
                }
                else if ($request->input('category_id') == 5) {
                    Bpjs::create([
                        'pasien_id' => $pasien->id,
                        'no_bpjs' => $request->input('no_bpjs')
                    ]);
                }
            }
            else if ($pasien->category_id == 5) {
                $bpjs = Bpjs::where('pasien_id', $pasien->id)->first();
                if ($request->input('category_id') == 1) {
                    Dosen::create([
                        'pasien_id' => $pasien->id,
                        'fakulta_id' => $request->input('fakulta_id')
                    ]);
                }
                else if ($request->input('category_id') == 2) {
                    Karyawan::create([
                        'pasien_id' => $pasien->id,
                        'fakulta_id' => $request->input('fakulta_id'),
                    ]);
                }
                else if ($request->input('category_id') == 3) {
                    Mahasiswa::create([
                        'pasien_id' => $pasien->id,
                        'fakulta_id' => $request->input('fakulta_id'),
                        'prodi_id' => $request->input('prodi_id')
                    ]);
                }
                $bpjs->delete();
            }
        }

        $pasien->update([
            'category_id' => $request->input('category_id'),
            'nama_pasien' => $request->input('nama'),
            'tempat_lhr_pasien' => $request->input('tempat_lhr'),
            'tgl_lhr_pasien' => $request->input('tgl_lhr'),
            'no_hp_pasien' => $request->input('no_hp'),
            'alamat_pasien' => $request->input('alamat'),
            'jk_pasien' => $request->input('jk'),
            'foto_pasien' => 'default.jpg',
            'status_pasien' => 'aktif'
        ]);
        
        return redirect()->route('adm_man_datapasien')->with(['success' => 'Data berhasil diubah!']);
    }

    #Edit data apoteker
    public function adm_man_dataapoteker_edit($id)
    {
        $apoteker = Apoteker::where('id', $id)->first();

        return view('admin.manajemen.edit.edit_dataapoteker', compact('apoteker'));
    }
    public function adm_man_dataapoteker_update(Request $request, $id)
    {
        $apoteker = Apoteker::where('id', $id);

        $apoteker->update([
            'nama_apoteker' => $request->input('nama'),
            'tempat_lhr_apoteker' => $request->input('tempat_lhr'),
            'tgl_lhr_apoteker' => $request->input('tgl_lhr'),
            'nohp_apoteker' => $request->input('no_hp'),
            'alamat_apoteker' => $request->input('alamat'),
            'jk_apoteker' => $request->input('jk'),
        ]);

        return redirect()->route('adm_man_dataapoteker')->with(['success' => 'Data berhasil diubah!']);
    }

    #Edit data nakes
    public function adm_man_datanakes_edit($id)
    {
        $tenkes = Tenkesehatan::where('id', $id)->first();
        $katenkes = Kategori_tenkesehatan::all();

        return view('admin.manajemen.edit.edit_datanakes', compact('tenkes', 'katenkes'));
    }
    public function adm_man_datanakes_update(Request $request, $id)
    {
        $tenkes = Tenkesehatan::where('id', $id)->first();
        $tenkes->update([
            'nama_tenkes' => $request->input('nama'),
            'kategori_tenkesehatan_id' => $request->input('kakes'),
            'tempat_lhr_tenkes' => $request->input('tempat_lhr'),
            'tgl_lhr_tenkes' => $request->input('tgl_lhr'),
            'nohp_tenkes' => $request->input('no_hp'),
            'alamat_tenkes' => $request->input('alamat'),
            'jk_tenkes' => $request->input('jk'),
        ]);

        return redirect()->route('adm_man_datanakes')->with(['success' => 'Data berhasil diubah!']);
    }

    #Edit data rekam medik
    public function edit_datarekammedik($id)
    {
        $pasien = Pasien::find($id);
        $diagnosas = Diagnosa::all();
        $tenkes = Tenkesehatan::all();

        return view('admin.manajemen.edit.edit_datarekammedik', compact('pasien', 'diagnosas', 'tenkes'));
    }
    public function editRekamMedikKeluarga($id)
    {
        $pasien = KeluargaPasien::find($id);
        $tenkes = Tenkesehatan::all();
        $diagnosas = Diagnosa::all();

        return view('admin.manajemen.edit.edit_datarekammedik_keluarga', compact('pasien', 'tenkes', 'diagnosas'));

    }
    public function kirim_datarekammedik(Request $request, $id)
    {
        $validated = $request->validate([
            'nakes_id' => 'required',
        ]);
        
        $tenkes = Tenkesehatan::find(Request()->nakes_id);

        if($validated) {
            $rekammedik = RekamMedik::create([
                'pasien_id' => $id,
                'tenkesehatan_id' => Request()->nakes_id,
                'suhu' => Request()->suhu,
                'siastol' => Request()->tensi1,
                'diastol' => Request()->tensi2,
                'status_rekam_medik' => 'dalam proses',
            ]);

            $rkm = RekamMedik::all()->last();
            $notif = Notification::create([
                'rekam_medik_id' => $rkm->id,
                'user_id' => $tenkes->user->id,
                'isi' => 'Pasien ingin berobat!',
            ]);

            // MedicalRecordSent::dispatch($rekammedik, $notif);
        }

        return redirect()->route('adm_man_datarekammedik')->with(['success' => 'Data berhasil dikirim!']);
    }
    public function kirimRekamMedikKeluarga(Request $request, $id)
    {
        $tenkes = Tenkesehatan::find(Request()->nakes_id);
        $rekammedik = RekamMedik::create([
            'keluarga_pasien_id' => $id,
            'tenkesehatan_id' => Request()->nakes_id,
            'suhu' => Request()->suhu,
            'siastol' => Request()->tensi1,
            'diastol' => Request()->tensi2,
            'status_rekam_medik' => 'dalam proses',
        ]);

        $notif = Notification::create([
            'rekam_medik_id' => $rekammedik->id,
            'user_id' => $tenkes->user->id,
            'isi' => 'Pasien ingin berobat!',
        ]);

        // MedicalRecordSent::dispatch($rekammedik, $notif);

        return redirect()->route('adm_man_datarekammedik')->with(['success' => 'Data berhasil dikirim!']);
    }
    public function admEditDiagnosa(Request $request, $id)
    {
        $diagnosa = Diagnosa::find($id);
        $diagnosa->update([
            'kode_diagnosa' => $request->input('kode_diagnosa'),
            'nama_diagnosa' => $request->input('diagnosa'),
        ]);

        return redirect()->route('adm_man_datadiagnosa')->with(['success' => 'Data berhasil diperbarui!']);
    }

    //---------------Delete data---------//
    public function delete_datapasien($id)
    {
        $pasiens = Pasien::where('id', $id)->first();
        $pasiens->update([
            'status_pasien' => 'non-aktif'
        ]);

        return redirect()->route('adm_man_datapasien')->with(['success' => 'Data berhasil dihapus!']);
    }
    public function delete_dataapoteker($id)
    {
        $apoteker = Apoteker::where('id', $id)->first();
        $apoteker->update([
            'status_apoteker' => 'non-aktif'
        ]);

        return redirect()->route('adm_man_dataapoteker')->with(['success' => 'Data berhasil dihapus!']);
    }
    public function delete_datanakes($id)
    {
        // $jadwal = Jadwal::where('tenkesehatan_id', $id)->get();
        $jadwal = (DB::table('jadwal_tenkesehatan'))->where('tenkesehatan_id', $id)->update(['tenkesehatan_id' => null]);
        $tenkes = Tenkesehatan::where('id', $id)->first();
        $tenkes->update([
            'status_tenkes' => 'non-aktif'
        ]);

        return redirect()->route('adm_man_datanakes')->with(['success' => 'Data berhasil dihapus!']);
    }
    public function admDeleteDiagnosa($id)
    {
        $diagnosa = Diagnosa::find($id);
        $diagnosa->update([
            'status_diagnosa' => 'non-aktif',
        ]);

        return redirect()->route('adm_man_datadiagnosa')->with(['success' => 'Data berhasil dihapus!']);
    }
    public function detail_datarekammedik($id)
    {
        $user = User::find($id);

        return view('admin.detail_datarekammedik', compact('user'));
    }
}
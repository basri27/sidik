<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\TenKesehatan;
use App\Models\Pasien;
use App\Models\Fakulta;
use App\Models\Prodi;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function adm_dashboard()
    {
        $pasiens = DB::table('pasiens')->count();
        $nakes = DB::table('tenkesehatans')->count();

        return view('admin.dashboard', compact('pasiens', 'nakes'));
    }

    public function adm_profil($user_id)
    {
        $admins = Admin::where('user_id', '=', $user_id)->first();
        $age = Carbon::parse($admins->tgl_lhr)->diff(Carbon::now())->y;

        return view('admin.admin_profil', compact('admins', 'age'));
    }

    public function adm_edit($user_id)
    {
        $admins = Admin::where('user_id', '=', $user_id)->first();
        $age = Carbon::parse($admins->tgl_lhr)->diff(Carbon::now())->y;

        return view('admin.edit.edit_profil', compact('admins', 'age'));
    }

    public function adm_update(Request $request, $user_id)
    {
        $admins = Admin::where('user_id', '=', $user_id)->first();

        $admins->update([
            'nama' => $request->input('nama'),
            'jk' => $request->input('jk'),
            'tempat_lhr' => $request->input('tempat_lhr'),
            'tgl_lhr' => $request->input('tgl_lhr'),
            'no_hp' => $request->input('no_hp'),
            'alamat' => $request->input('alamat'),
        ]);

        return redirect()->route('adm_profil', $admins->user_id);
    }

    public function adm_edit_userpw($user_id)
    {
        $admins = User::where('id', '=', $user_id)->first();

        return view('admin.edit.edit_userpw', compact('admins'));
    }

    public function adm_update_userpw(Request $request, $user_id)
    {
        $admins = User::where('id', '=', $user_id)->first();

        $admins->update([
            'username' => $request->input('username'),
            'password' => Hash::make($request->get('password')),
        ]);

        return redirect()->route('adm_profil', $admins->id);    
    }

    public function adm_jadwal()
    {
        $jadwals = Jadwal::all();
        $tenkes1 = Jadwal::join('tenkesehatans', 'tenkes1_id', 'tenkesehatans.id')->get();
        $tenkes2 = Jadwal::join('tenkesehatans', 'tenkes2_id', 'tenkesehatans.id')->get();
        
        return view('admin.admin_jadwal', compact('jadwals', 'tenkes1', 'tenkes2'));
    }

    public function adm_jadwal_edit($id)
    {
        $jadwals = Jadwal::where('id', $id)->first();
        $tenkes = Tenkesehatan::all();
        #dd($jadwals);
        return view('admin.edit.edit_jadwal', compact('jadwals', 'tenkes'));
    }

    public function adm_jadwal_update(Request $request, $id)
    {
        $jadwals = Jadwal::where('id', $id)->first();

        $jadwals->update([
            'tenkes1_id' => $request->input('tenkes1'),
            'tenkes2_id' => $request->input('tenkes2'),
            'pagi_s' => $request->input('pagi_s'),
            'pagi_n' => $request->input('pagi_n'),
            'siang_s' => $request->input('siang_s'),
            'siang_n' => $request->input('siang_n'),
        ]);

        #dd($jadwals, $id);
        return redirect()->route('adm_jadwal', $id);
    }

    public function show_jadwal()
    {
        $jadwals = Jadwal::all();
        $tenkes1 = Jadwal::join('tenkesehatans', 'tenkes1_id', 'tenkesehatans.id')->get();
        $tenkes2 = Jadwal::join('tenkesehatans', 'tenkes2_id', 'tenkesehatans.id')->get();
        
        return view('jadwal', compact('jadwals', 'tenkes1', 'tenkes2'));
    }

    public function adm_man_datapasien()
    {
        $pasiens = Pasien::all();

        return view('admin.manajemen.man_datapasien', compact('pasiens'));
    }

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
        $validated = $request->validate([
            'nama' => 'required',
            'tempat_lhr' => 'required',
            'tgl_lhr' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'jk' => 'required',
            'category_id' => 'required',
        ]);

        if($validated)
        {
            User::create([
                'role_id' => '2',
                'username' => Str::lower(Str::random(6)),
                'password' => Hash::make(12345678),
            ]);
            if(Request()->fakulta_id <> ""){
                Pasien::create([
                    'user_id' => $request->input('user_id'),
                    'fakulta_id' => $request->input('fakulta_id'),
                    'prodi_id' => $request->input('prodi_id'),
                    'category_id' => $request->input('category_id'),
                    'nama' => $request->input('nama'),
                    'jk' => $request->input('jk'),
                    'tempat_lhr' => $request->input('tempat_lhr'),
                    'tgl_lhr' => $request->input('tgl_lhr'),
                    'no_hp' => $request->input('no_hp'),
                    'alamat' => $request->input('alamat'),
                ]);
            }
            else {
                Pasien::create([
                    'user_id' => $request->input('user_id'),
                    'fakulta_id' => '1',
                    'prodi_id' => '1',
                    'category_id' => $request->input('category_id'),
                    'nama' => $request->input('nama'),
                    'jk' => $request->input('jk'),
                    'tempat_lhr' => $request->input('tempat_lhr'),
                    'tgl_lhr' => $request->input('tgl_lhr'),
                    'no_hp' => $request->input('no_hp'),
                    'alamat' => $request->input('alamat'),
                ]);
            }
        }

        return redirect()->route('adm_man_datapasien')->with(['success' => 'Data berhasil ditambahkan!']);
    }

    public function adm_man_datapasien_edit($id)
    {
        $pasiens = Pasien::where('id', $id)->first();
        $fakultas = Fakulta::all();
        $prodis = Prodi::all();
        $category = Category::all();
        
        return view('admin.manajemen.edit.edit_datapasien', compact('pasiens', 'fakultas', 'prodis', 'category'));
    }

    public function adm_man_datapasien_update(Request $request, $id)
    {
        $pasiens = Pasien::where('id', $id);

        if(Request()->fakulta_id <> ""){
            $pasiens->update([
                'category_id' => $request->input('category_id'),
                'fakulta_id' => $request->input('fakulta_id'),
                'prodi_id' => $request->input('prodi_id'),
                'nama' => $request->input('nama'),
                'tempat_lhr' => $request->input('tempat_lhr'),
                'tgl_lhr' => $request->input('tgl_lhr'),
                'no_hp' => $request->input('no_hp'),
                'alamat' => $request->input('alamat'),
                'jk' => $request->input('jk'),
            ]);
        }
        else {
            $pasiens->update([
                'category_id' => $request->input('category_id'),
                'fakulta_id' => '1',
                'prodi_id' => '1',
                'nama' => $request->input('nama'),
                'tempat_lhr' => $request->input('tempat_lhr'),
                'tgl_lhr' => $request->input('tgl_lhr'),
                'no_hp' => $request->input('no_hp'),
                'alamat' => $request->input('alamat'),
                'jk' => $request->input('jk'),
            ]);
        }

        return redirect()->route('adm_man_datapasien')->with(['success' => 'Data berhasil diubah!']);
    }

    public function delete_datapasien($id)
    {
        $pasiens = Pasien::where('id', $id)->first();
        $users = User::where('id', $pasiens->user_id)->first();
        $pasiens->delete();
        $users->delete();

        return redirect()->route('adm_man_datapasien')->with(['success' => 'Data berhasil dihapus!']);
    }
}
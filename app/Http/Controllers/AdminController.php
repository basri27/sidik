<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\TenKesehatan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


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
        $tenkes = Tenkesehatan::get();

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
}

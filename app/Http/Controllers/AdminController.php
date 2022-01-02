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
        #$jadwals = Jadwal::join('tenkesehatans', function ($join) {
        #    $join->on('tenkes_id', '=', 'tenkesehatans.id')->orOn('tenkes2_id', '=', 'tenkesehatans.id');
        #})
        #->get();
        #$tenkes1 = TenKesehatan::join('jadwals', 'tenkes_id', '=', 'tenkesehatans.id')->get();
        #$tenkes2 = TenKesehatan::join('jadwals', 'tenkes2_id', '=', 'tenkesehatans.id')->first();
        #$jadwals = Jadwal::join('tenkesehatans', 'tenkesehatans.id', '=', 'tenkes_id')->get();
        $jadwals = Jadwal::with('tenkesehatan')->get();

        #dd($jadwals);

        return view('admin.admin_jadwal', compact('jadwals'));
    }
}

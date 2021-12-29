<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    public function add_bio(Request $request)
    {
        $validated = $request->validate([
            'id_pasien' => 'required', 
            'name' => 'required',
            'fakultas' => 'required',
            'prodi' => 'required',
            'kategori' => 'required',
            'jk' => 'required',
            'tgl_lhr' => 'required',
            'nohp' => 'required',
            'alamat' => 'required',
        ]);

        if($validated) {
            Pasien::create([
                'user_id' => $request->input('id_pasien'),
                'fakulta_id' => $request->input('fakultas'),
                'prodi_id' => $request->input('prodi'),
                'category_id' => $request->input('kategori'),
                'nama' => $request->input('name'),
                'jk' => $request->input('jk'),
                'tgl_lhr' => $request->input('tgl_lhr'),
                'no_hp' => $request->input('nohp'),
                'alamat' => $request->input('alamat'),
            ]);
        }

        return redirect()->route('admin_profil');
    }
}

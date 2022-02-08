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
            'tempat_lhr' => 'required',
            'tgl_lhr' => 'required',
            'nohp' => 'required',
            'alamat' => 'required',
        ]);

        if($validated) {
            if(Request()->fakulta_id <> ""){
                if(Request()->prodi_id <> ""){
                    Pasien::create([
                        'user_id' => $request->input('user_id'),
                        'category_id' => $request->input('category_id'),
                        'fakulta_id' => $request->input('fakulta_id'),
                        'prodi_id' => $request->input('prodi_id'),
                        'nama_pasien' => $request->input('nama'),
                        'tempat_lhr_pasien' => $request->input('tempat_lhr'),
                        'tgl_lhr_pasien' => $request->input('tgl_lhr'),
                        'no_hp_pasien' => $request->input('no_hp'),
                        'alamat_pasien' => $request->input('alamat'),
                        'jk_pasien' => $request->input('jk'),
                        'pasien_created_at' => Carbon::now(),
                        'pasien_updated_at' => Carbon::now(),
                    ]);
                }
                else {
                    Pasien::create([
                        'user_id' => $request->input('user_id'),
                        'category_id' => $request->input('category_id'),
                        'fakulta_id' => $request->input('fakulta_id'),
                        'prodi_id' => '1',
                        'nama_pasien' => $request->input('nama'),
                        'tempat_lhr_pasien' => $request->input('tempat_lhr'),
                        'tgl_lhr_pasien' => $request->input('tgl_lhr'),
                        'no_hp_pasien' => $request->input('no_hp'),
                        'alamat_pasien' => $request->input('alamat'),
                        'jk_pasien' => $request->input('jk'),
                        'pasien_created_at' => Carbon::now(),
                        'pasien_updated_at' => Carbon::now(),
                    ]);
                }
            }
            else {
                Pasien::create([
                    'user_id' => $request->input('user_id'),
                    'category_id' => $request->input('category_id'),
                    'fakulta_id' => '1',
                    'prodi_id' => '1',
                    'nama_pasien' => $request->input('nama'),
                    'tempat_lhr_pasien' => $request->input('tempat_lhr'),
                    'tgl_lhr_pasien' => $request->input('tgl_lhr'),
                    'no_hp_pasien' => $request->input('no_hp'),
                    'alamat_pasien' => $request->input('alamat'),
                    'jk_pasien' => $request->input('jk'),
                    'pasien_created_at' => Carbon::now(),
                    'pasien_updated_at' => Carbon::now(),
                ]);
            }
        }

        return redirect()->route('home');
    }
}

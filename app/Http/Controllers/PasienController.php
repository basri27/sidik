<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pasien;
use App\Models\User;
use App\Models\Category;
use App\Models\Fakulta;
use App\Models\Prodi;

class PasienController extends Controller
{
    public function viewBio()
    {
        
        $kategori = Category::all();
        $fakultas = Fakulta::all();
        $prodi = Prodi::all();
        return view('bio', compact('kategori', 'fakultas', 'prodi'));
    }
    public function add_bio(Request $request)
    {
        $pasien = User::latest()->first();
        // dd($request->all(), $pasien->id+1);
        if(Request()->fakulta_id <> ""){
            if(Request()->prodi_id <> ""){
                Pasien::create([
                'user_id' => $pasien->id,
                'category_id' => $request->input('kategori'),
                'fakulta_id' => $request->input('fakulta_id'),
                'prodi_id' => $request->input('prodi_id'),
                'nama_pasien' => $request->input('nama'),
                'tempat_lhr_pasien' => $request->input('tempat_lhr'),
                'tgl_lhr_pasien' => $request->input('tgl_lhr'),
                'no_hp_pasien' => $request->input('nohp'),
                'alamat_pasien' => $request->input('alamat'),
                'jk_pasien' => $request->input('jk'),
                'pasien_created_at' => Carbon::now(),
                'pasien_updated_at' => Carbon::now(),
                ]);
            }
            else {
                Pasien::create([
                'user_id' => $pasien->id,
                'category_id' => $request->input('kategori'),
                'fakulta_id' => $request->input('fakulta_id'),
                'prodi_id' => '1',
                'nama_pasien' => $request->input('nama'),
                'tempat_lhr_pasien' => $request->input('tempat_lhr'),
                'tgl_lhr_pasien' => $request->input('tgl_lhr'),
                'no_hp_pasien' => $request->input('nohp'),
                'alamat_pasien' => $request->input('alamat'),
                'jk_pasien' => $request->input('jk'),
                'pasien_created_at' => Carbon::now(),
                'pasien_updated_at' => Carbon::now(),
                ]);
            }
        }
        else {
            Pasien::create([
                'user_id' => $pasien->id,
                'category_id' => $request->input('kategori'),
                'fakulta_id' => '1',
                'prodi_id' => '1',
                'nama_pasien' => $request->input('nama'),
                'tempat_lhr_pasien' => $request->input('tempat_lhr'),
                'tgl_lhr_pasien' => $request->input('tgl_lhr'),
                'no_hp_pasien' => $request->input('nohp'),
                'alamat_pasien' => $request->input('alamat'),
                'jk_pasien' => $request->input('jk'),
                'pasien_created_at' => Carbon::now(),
                'pasien_updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('home');
    }
}

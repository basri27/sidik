<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Dosen', 'Karyawan', 'Mahasiswa', 'Umum'];
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'nama' => $category
            ]);
        }

        $fakultas = [
            'Teknik',
            'Matematika dan Ilmu Pengetahuan', 
            'Keguruan dan Ilmu Pengetahuan', 
            'Ilmu Sosial dan Ilmu Pemerintahan',
            'Perikanan dan Kelautan',
            'Pertanian'
        ];
        foreach ($fakultas as $fak) {
            DB::table('fakultas')->insert([
                'nama' => $fak
            ]);
        }

        $prodi = [
            'Teknologi Informasi',
            'Teknik Sipil',
            'Teknik Kimia',
            'Teknik Mesin',
            'Teknik Lingkungan',
            'Arsitektur',
            'Matematika',
            'Fisika',
            'Sastra Indonesia'
        ];
        foreach ($prodi as $pro) {
            DB::table('prodis')->insert([
                'nama' => $pro
            ]);
        } 
    }
}

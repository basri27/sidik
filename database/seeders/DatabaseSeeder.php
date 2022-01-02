<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Admin', 'Pasien', 'Nakes'];
        foreach ($roles as $role) {
            DB::table('roles')->insert(['nama' => $role]);
        }

        DB::table('users')->insert([
            'role_id' => '1',
            'username' => 'fauzi12',
            'password' => Hash::make(12345678),
        ]);
        DB::table('admins')->insert([
            'user_id' => '1',
            'nama' => 'Fauzi',
            'jk' => 'Laki-laki',
            'tempat_lhr' => 'Banjarmasin',
            'tgl_lhr' => '2000-09-27',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. H. Hasan Basri No. 5',
        ]);
        
        DB::table('users')->insert([
            'role_id' => '1',
            'username' => 'lisa22',
            'password' => Hash::make(12345678),
        ]);
        DB::table('admins')->insert([
            'user_id' => '2',
            'nama' => 'Lisa',
            'jk' => 'Perempuan',
            'tempat_lhr' => 'Banjarmasin',
            'tgl_lhr' => '1992-09-20',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. S. Parman No. 20',
        ]);

        $kategori_tenkes = ['Dokter Umum', 'Bidan', 'Dokter Gigi'];
        $nakes = ['dr. Edyson, M.Kes', 'dr. Lena Rosida, M.Kes.PhD', 'dr. Alfi Yasmina, M.Kes.PhD', 'dr. Khusnul Khatimah, M.Sc', 'dr. Farida Heriyani, M.PH', 'dr. Tara'];
        foreach ($kategori_tenkes as $ktk) {
            DB::table('kategori_tenkesehatan')->insert(['nama' => $ktk]);
        }
        foreach ($nakes as $nakes) {
            DB::table('tenkesehatans')->insert([
                'nama' => $nakes,
                'user_id' => '1',
                'kategori_tenkes_id' => '1',
            ]);
        }

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at"];
        foreach ($days as $day) {
            DB::table('jadwals')->insert([
                'hari' => $day,
                'tenkes_id' => random_int(1,6),
                'tenkes2_id' => random_int(1,6),
            ]);
        }

        $categories = ['Dosen', 'Karyawan', 'Mahasiswa', 'Umum'];
        foreach ($categories as $category) {
            DB::table('categories')->insert(['nama' => $category]);
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
            DB::table('fakultas')->insert(['nama' => $fak]);
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
            DB::table('prodis')->insert(['nama' => $pro]);
        } 
    }
}

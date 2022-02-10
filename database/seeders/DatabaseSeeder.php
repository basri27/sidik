<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Admin', 'Pasien', 'Nakes', 'Apoteker'];
        foreach ($roles as $role) {
            DB::table('roles')->insert(['nama_role' => $role]);
        }

        DB::table('users')->insert([
            'role_id' => '1',
            'username' => 'fauzi12',
            'password' => Hash::make(12345678),
        ]);
        DB::table('admins')->insert([
            'user_id' => '1',
            'nama_admin' => 'Fauzi',
            'jk_admin' => 'Laki-laki',
            'tempat_lhr_admin' => 'Banjarmasin',
            'tgl_lhr_admin' => '2000-09-27',
            'no_hp_admin' => '081234567890',
            'alamat_admin' => 'Jl. H. Hasan Basri No. 5',
            'foto_admin' => 'default.jpg',
        ]);
        
        DB::table('users')->insert([
            'role_id' => '1',
            'username' => 'lisa22',
            'password' => Hash::make(12345678),
        ]);
        DB::table('admins')->insert([
            'user_id' => '2',
            'nama_admin' => 'Lisa',
            'jk_admin' => 'Perempuan',
            'tempat_lhr_admin' => 'Banjarmasin',
            'tgl_lhr_admin' => '1992-09-20',
            'no_hp_admin' => '081234567890',
            'alamat_admin' => 'Jl. S. Parman No. 20',
            'foto_admin' => 'default.jpg',
        ]);

        for($i = 3; $i < 9; $i++) {
            DB::table('users')->insert([
                'role_id' => '3',
                'username' => Str::lower(Str::random(5)),
                'password' => Hash::make(12345678),
            ]);
        }

        $kategori_tenkes = ['Dokter Umum', 'Bidan', 'Dokter Gigi'];
        $nakes = ['dr. Edyson, M.Kes', 'dr. Lena Rosida, M.Kes.PhD', 'dr. Alfi Yasmina, M.Kes.PhD', 'dr. Khusnul Khatimah, M.Sc', 'dr. Farida Heriyani, M.PH', 'dr. Tara'];
        $i = 2;
        foreach ($kategori_tenkes as $ktk) {
            DB::table('kategori_tenkesehatans')->insert(['nama_kategori_tenkes' => $ktk]);
        }
        foreach ($nakes as $nakes) {
            $i = $i+1;
            DB::table('tenkesehatans')->insert([
                'nama_tenkes' => $nakes,
                'user_id' => $i,
                'tempat_lhr_tenkes' => "Banjarmasin",
                'kategori_tenkesehatan_id' => random_int(1,3),
                'foto_tenkes' => 'default.jpg',
            ]);
        }

        DB::table('users')->insert([
            'role_id' => '4',
            'username' => 'apoteker1',
            'password' => Hash::make(12345678),
        ]);

        DB::table('apotekers')->insert([
            'nama_apoteker' => 'Didin',
            'user_id' => '9',
            'tempat_lhr_apoteker' => 'Banjarmasin',
            'jk_apoteker' => 'Laki-laki',
            'tgl_lhr_apoteker' => '1988-7-10',
            'foto_apoteker' => 'default.jpg',
        ]);

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at"];
        foreach ($days as $day) {
            DB::table('jadwals')->insert([
                'hari' => $day,
                'pagi_s' => '10:00',
                'pagi_n' => '12:00',
                'siang_s' => '13:00',
                'siang_n' => '16:00',
            ]);
        }

        $categories = ['Dosen', 'Karyawan', 'Mahasiswa', 'Umum'];
        foreach ($categories as $category) {
            DB::table('categories')->insert(['nama_kategori' => $category]);
        }

        $fakultas = [
            'Tidak ada',
            'Teknik',
            'Matematika dan Ilmu Pengetahuan', 
            'Keguruan dan Ilmu Pengetahuan', 
            'Ilmu Sosial dan Ilmu Pemerintahan',
            'Perikanan dan Kelautan',
            'Pertanian'
        ];
        foreach ($fakultas as $fak) {
            DB::table('fakultas')->insert(['nama_fakultas' => $fak]);
        }

        $prodi = [
            'Tidak ada',
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
            DB::table('prodis')->insert(['nama_prodi' => $pro]);
        } 

        for ($k = 0; $k < 2; $k++) {
            for ($t = 1; $t < 6; $t++) {
                DB::table('jadwal_tenkesehatan')->insert([
                    'jadwal_id' => $t,
                    'tenkesehatan_id' => $t,
                ]);
            }
        }

        $diagnosa = array(
            array('nama_diagnosa' => 'Acute Nasopharyngitis (common cold)', 'kode_diagnosa' => 'J00'),
            array('nama_diagnosa' => 'Essential (primary) hypertension', 'kode_diagnosa' => 'I10'),
            array('nama_diagnosa' => 'Non-insulin-dependent diabetes mellitus', 'kode_diagnosa' => 'E11'),
            array('nama_diagnosa' => 'Pure Hypercholesterolaemia', 'kode_diagnosa' => 'E78.0'), 
            array('nama_diagnosa' => 'Dyspepsia', 'kode_diagnosa' => 'K30'), 
            array('nama_diagnosa' => 'Necrosis of pulp', 'kode_diagnosa' => 'K04.1'), 
            array('nama_diagnosa' => 'Myalgia', 'kode_diagnosa' => 'M79.1'), 
            array('nama_diagnosa' => 'Astigmatism', 'kode_diagnosa' => 'H52.2'), 
            array('nama_diagnosa' => 'Myopia', 'kode_diagnosa' => 'H52.1'), 
            array('nama_diagnosa' => 'Hypermetropia', 'kode_diagnosa' => 'H52.0')
        );
        DB::table('diagnosas')->insert($diagnosa);

        $obat = ['Hydrocodone', 'Simvastatin', 'Lisinopril', 'Levothyroxine Sodium', 'Amlodipine Besylate', 'Omeprazole', 'Azithromycin', 'Amoxicillin', 'Metformin'];
        foreach($obat as $o) {
            DB::table('obats')->insert(['nama_obat' => $o]);
        }
    }
}

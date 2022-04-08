<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakulta extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function prodi() {
        return $this->hasMany(Prodi::class);
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class);
    }
}

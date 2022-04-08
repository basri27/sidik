<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
	
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'fakulta_id',
        'prodi_id',
        'category_id',
        'nama_pasien',
        'jk_pasien',
        'tempat_lhr_pasien',
        'tgl_lhr_pasien',
        'no_hp_pasien',
        'alamat_pasien',
        'foto_pasien',
        'status_pasien',
    ];

	public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function rekammedik()
    {
        return $this->hasMany(RekamMedik::class);
    }

    public function keluargapasien()
    {
        return $this->hasMany(Pasien::class);
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }

    public function bpjs()
    {
        return $this->hasMany(Bpjs::class);
    }

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class);
    }
}

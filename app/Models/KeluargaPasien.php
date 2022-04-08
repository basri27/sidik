<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluargaPasien extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'pasien_id',
        'nama_kel_pasien',
        'jk_kel_pasien',
        'kategori_kel_pasien',
        'tempat_lhr_kel_pasien',
        'tgl_lhr_kel_pasien',
        'no_hp_kel_pasien',
        'alamat_kel_pasien',
        'foto_kel_pasien',
        'status_kel_pasien',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function pasien() 
    {
        return $this->belongsTo(Pasien::class);
    }

    public function rekammedik()
    {
        return $this->hasMany(RekamMedik::class);
    }
}

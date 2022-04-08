<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenkesehatan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'kategori_tenkesehatan_id',
        'nama_tenkes',
        'jk_tenkes',
        'tempat_lhr_tenkes',
        'tgl_lhr_tenkes',
        'nohp_tenkes',
        'alamat_tenkes',
        'foto_tenkes',
        'status_tenkes',
    ];

    public function kategori_tenkesehatan()
    {
        return $this->belongsTo(Kategori_tenkesehatan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwal()
    {
        return $this->belongsToMany(JadwalPraktek::class);
    }
    
    public function rekammedik()
    {
        return $this->hasMany(RekamMedik::class);
    }

    // public function jadwal_praktek()
    // {
    //     return $this->hasMany(JadwalPraktek::class);
    // }

}

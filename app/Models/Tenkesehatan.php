<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenkesehatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori_tenkes_id',
        'nama',
        'jk',
        'tempat_lhr',
        'tgl_lhr',
        'nohp',
        'alamat',
    ];

    public function kategoritenkes()
    {
        return $this->belongsTo(KategoriTenKes::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}

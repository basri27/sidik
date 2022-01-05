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
        return $this->hasMany(Jadwal::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apoteker extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'nama_apoteker',
        'tempat_lhr_apoteker',
        'tgl_lhr_apoteker',
        'nohp_apoteker',
        'alamat_apoteker',
        'jk_apoteker',
        'foto_apoteker',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

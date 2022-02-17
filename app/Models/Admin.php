<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'nama_admin',
        'jk_admin',
        'tempat_lhr_admin',
        'tgl_lhr_admin',
        'no_hp_admin',
        'alamat_admin',
        'foto_admin',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

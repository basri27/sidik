<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'jk',
        'tempat_lhr',
        'tgl_lhr',
        'no_hp',
        'alamat',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari',
        'pagi_s',
        'pagi_n',
        'siang_s',
        'siang_n',
    ];

    public function tenkesehatan()
    {
        return $this->belongsToMany(Tenkesehatan::class, 'jadwal_tenkesehatan', 'jadwal_id', 'tenkesehatan_id');
    }
}

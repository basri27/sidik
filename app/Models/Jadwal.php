<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenkes1_id',
        'tenkes2_id',
        'hari',
        'pagi_s',
        'pagi_n',
        'siang_s',
        'siang_n',
    ];

    public function tenkesehatan()
    {
        return $this->hasMany(Tenkesehatan::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPraktek extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'hari_jadwal',
        'waktu1',
        'tenkes1',
        'waktu2',
        'tenkes2',
    ];

    public function tenkesehatan()
    {
        return $this->belongsTo(Tenkesehatan::class, 'id')->withDefault([
            'nama_tenkes' => 'Guest',
        ]);
    }
}

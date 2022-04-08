<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'pasien_id',
        'fakulta_id',
        'prodi_id',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function fakulta()
    {
        return $this->belongsTo(Fakulta::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}

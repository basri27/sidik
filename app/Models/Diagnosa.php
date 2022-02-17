<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_diagnosa',
        'nama_diagnosa',
        'status_diagnosa',
    ];

    public function rekammedik()
    {
        return $this->hasMany(RekamMedik::class);
    }
}

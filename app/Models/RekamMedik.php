<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedik extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'pasien_id',
        'tenkesehatan_id',
        'suhu',
        'tensi',
        'diagnosa',
        'obat',
        'keterangan',
        'keluhan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function tenkesehatan()
    {
        return $this->belongsTo(Tenkesehatan::class);
    }
}

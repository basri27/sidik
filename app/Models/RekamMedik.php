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
        'diagnosa_id',
        'obat_id',
        'suhu',
        'tensi',
        'keterangan',
        'keluhan',
        'rekammedik_created_at',
        'rekammedik_updated_at',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function tenkesehatan()
    {
        return $this->belongsTo(Tenkesehatan::class);
    }

    public function notification()
    {
        return $this->hasMany(Notification::class);
    }

    public function diagnosa()
    {
        return $this->belongsTo(Diagnosa::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}

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
        'keluarga_pasien_id',
        'tenkesehatan_id',
        'diagnosa_id',
        'suhu',
        'siastol',
        'diastol',
        'keterangan',
        'keluhan',
        'status_rekam_medik',
        'rekammedik_created_at',
        'rekammedik_updated_at',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function keluarga_pasien()
    {
        return $this->belongsTo(KeluargaPasien::class);
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

    public function resepobat()
    {
        return $this->hasMany(ResepObat::class);
    }
}

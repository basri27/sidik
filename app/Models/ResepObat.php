<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'obat_id',
        'rekam_medik_id',
        'keterangan',
        'resepobat_created_at',
        'resepobat_updated_at',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function rekammedik()
    {
        return $this->belongsTo(RekamMedik::class);
    }
}

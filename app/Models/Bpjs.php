<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bpjs extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'pasien_id',
        'no_bpjs',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}

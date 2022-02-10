<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
	
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'fakulta_id',
        'prodi_id',
        'category_id',
        'nama_pasien',
        'jk_pasien',
        'tempat_lhr_pasien',
        'tgl_lhr_pasien',
        'no_hp_pasien',
        'alamat_pasien',
        'foto_pasien',
        'pasien_created_at',
        'pasien_updated_at',
    ];

	public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function fakulta() 
    {
        return $this->belongsTo(Fakulta::class);
    }

    public function prodi() 
    {
        return $this->belongsTo(Prodi::class);
    }
        public function rekammedik()
    {
        return $this->hasMany(RekamMedik::class);
    }
}

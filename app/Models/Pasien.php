<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
	
    protected $fillable = [
        'user_id',
        'fakulta_id',
        'prodi_id',
        'category_id',
        'nama',
        'jk',
        'tempat_lhr',
        'tgl_lhr',
        'no_hp',
        'alamat',
    ];

	public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function fakulta() {
        return $this->belongsTo(Fakulta::class);
    }

    public function prodi() {
        return $this->belongsTo(Prodi::class);
    }
}

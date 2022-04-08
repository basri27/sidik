<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_tenkesehatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori_tenkes'
    ];

    public $timestamps = false;

    public function tenkesehatan() {
		    return $this->hasMany(Tenkesehatan::class);
    }
}

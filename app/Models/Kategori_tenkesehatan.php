<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_tenkesehatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama'
    ];

    public function tenkesehatan() {
		return $this->hasOne(TenKesehatan::class);
    }
}

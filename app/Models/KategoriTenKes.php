<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriTenKes extends Model
{
    use HasFactory;

    public function tenkesehatan() {
		return $this->hasOne(TenKesehatan::class);
    }
}

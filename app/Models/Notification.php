<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'tenkesehatan_id',
        'isi',
    ];

    public function tenkesehatan()
    {
        return $this->belongsTo(Tenkesehatan::class);
    }
}

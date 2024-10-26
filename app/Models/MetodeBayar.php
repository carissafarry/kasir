<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodeBayar extends Model
{
    use HasFactory;

    protected $table = 'metode_bayar';

    protected $fillable = [
        'kode_metode_bayar',
        'nama',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}

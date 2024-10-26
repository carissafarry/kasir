<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    use HasFactory;

    protected $table = 'pesanan_detail';
    
    protected $fillable = [
        'pesanan_id', 'barang_id', 'qty', 'subtotal', 'catatan'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

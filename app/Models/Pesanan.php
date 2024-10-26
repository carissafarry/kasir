<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'nama_pemesan', 'kasir_id', 'total_harga', 'total_bayar', 'kembalian', 'metode_bayar_id', 'status', 'kode_pesanan'
    ];

    public function pesananDetail()
    {
        return $this->hasMany(PesananDetail::class);
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }

    public function metodeBayar()
    {
        return $this->belongsTo(MetodeBayar::class, 'metode_bayar_id');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::count();
        $barangMasuk = BarangMasuk::count();
        $transaksi = Pesanan::count();
        return view('dashboard.kasir.index', compact('barangKeluar', 'barangMasuk', 'transaksi'));
    }
}


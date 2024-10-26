<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::count();
        $barangMasuk = BarangMasuk::count();
        $barang = Barang::count();
        return view('dashboard.produksi.index', compact('barangKeluar', 'barangMasuk', 'barang'));
    }
}

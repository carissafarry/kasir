<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\MetodeBayarController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProduksiController;

// auth
Route::get('login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'loginPost'])->name('login.aksi')->middleware('guest');
Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware(['auth']);

Route::get('pdf', function ()
{
    return view('templates.barangmasuk-pdf');
});

Route::get('/', function () {
    if (Auth::user()->role_id == 1) {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::user()->role_id == 2) {
        return redirect()->route('produksi.dashboard');
    } elseif (Auth::user()->role_id == 3) {
        return redirect()->route('kasir.dashboard');
    } else {
        throw new \Exception('User tidak ditemukan');
    }
})->name('dashboard')->middleware(['auth']);

// admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('pengguna', [PenggunaController::class, 'index'])->name('admin.pengguna');
    Route::get('pengguna/tambah', [PenggunaController::class, 'create'])->name('admin.pengguna.tambah');
    Route::post('pengguna/tambah', [PenggunaController::class, 'store'])->name('admin.pengguna.tambah.aksi');
    Route::get('pengguna/edit/{id}', [PenggunaController::class, 'edit'])->name('admin.pengguna.edit');
    Route::post('pengguna/edit/{id}', [PenggunaController::class, 'update'])->name('admin.pengguna.edit.aksi');
    Route::get('pengguna/hapus/{id}', [PenggunaController::class, 'destroy'])->name('admin.pengguna.hapus');

    Route::get('laporan-penjualan', [AdminController::class, 'laporanPenjualan'])->name('admin.laporan-penjualan');
    Route::get('laporan-penjualan/export/pdf', [AdminController::class, 'exportPDFLaporanPenjualan'])->name('admin.laporan-penjualan.pdf');
    Route::get('laporan-penjualan/export/excel', [AdminController::class, 'exportExcelLaporanPenjualan'])->name('admin.laporan-penjualan.excel');
    Route::get('laporan-penjualan/export/csv', [AdminController::class, 'exportCsvLaporanPenjualan'])->name('admin.laporan-penjualan.csv');

    Route::get('laporan-barang/masuk', [BarangMasukController::class, 'laporanBarangMasuk'])->name('admin.laporan-barang.masuk');
    Route::get('laporan-barang/masuk/export/pdf', [BarangMasukController::class, 'exportPDF'])->name('admin.laporan-barang.masuk.pdf');
    Route::get('laporan-barang/masuk/export/excel', [BarangMasukController::class, 'exportExcel'])->name('admin.laporan-barang.masuk.excel');
    Route::get('laporan-barang/masuk/export/csv', [BarangMasukController::class, 'exportCsv'])->name('admin.laporan-barang.masuk.csv');

    Route::get('laporan-barang/keluar', [BarangKeluarController::class, 'laporanBarangKeluar'])->name('admin.laporan-barang.keluar');
    Route::get('laporan-barang/keluar/export/pdf', [BarangKeluarController::class, 'exportPDF'])->name('admin.laporan-barang.keluar.pdf');
    Route::get('laporan-barang/keluar/export/excel', [BarangKeluarController::class, 'exportExcel'])->name('admin.laporan-barang.keluar.excel');
    Route::get('laporan-barang/keluar/export/csv', [BarangKeluarController::class, 'exportCsv'])->name('admin.laporan-barang.keluar.csv');

    Route::get('metode_bayar', [MetodeBayarController::class, 'index'])->name('admin.metode_bayar');
    Route::get('metode_bayar/tambah', [MetodeBayarController::class, 'create'])->name('admin.metode_bayar.tambah');
    Route::post('metode_bayar/tambah', [MetodeBayarController::class, 'store'])->name('admin.metode_bayar.tambah.aksi');
    Route::get('metode_bayar/edit/{id}', [MetodeBayarController::class, 'edit'])->name('admin.metode_bayar.edit');
    Route::post('metode_bayar/edit/{id}', [MetodeBayarController::class, 'update'])->name('admin.metode_bayar.edit.aksi');
    Route::get('metode_bayar/hapus/{id}', [MetodeBayarController::class, 'destroy'])->name('admin.metode_bayar.hapus');
});


// produksi
Route::group(['prefix' => 'produksi', 'middleware' => ['auth', 'produksi']], function () {
    Route::get('/', [ProduksiController::class, 'index'])->name('produksi.dashboard');

    Route::get('kelola-barang/masuk', [BarangMasukController::class, 'index'])->name('produksi.kelola-barang.masuk');
    Route::get('kelola-barang/masuk/tambah', [BarangMasukController::class, 'create'])->name('produksi.kelola-barang.masuk.tambah');
    Route::post('kelola-barang/masuk/tambah', [BarangMasukController::class, 'store'])->name('produksi.kelola-barang.masuk.tambah.aksi');
    Route::get('kelola-barang/masuk/edit/{id}', [BarangMasukController::class, 'edit'])->name('produksi.kelola-barang.masuk.edit');
    Route::post('kelola-barang/masuk/edit/{id}', [BarangMasukController::class, 'update'])->name('produksi.kelola-barang.masuk.edit.aksi');
    Route::get('kelola-barang/masuk/hapus/{id}', [BarangMasukController::class, 'destroy'])->name('produksi.kelola-barang.masuk.hapus');

    Route::get('kelola-barang/keluar', [BarangKeluarController::class, 'index'])->name('produksi.kelola-barang.keluar');
    Route::get('kelola-barang/keluar/tambah', [BarangKeluarController::class, 'create'])->name('produksi.kelola-barang.keluar.tambah');
    Route::post('kelola-barang/keluar/tambah', [BarangKeluarController::class, 'store'])->name('produksi.kelola-barang.keluar.tambah.aksi');
    Route::get('kelola-barang/keluar/edit/{id}', [BarangKeluarController::class, 'edit'])->name('produksi.kelola-barang.keluar.edit');
    Route::post('kelola-barang/keluar/edit/{id}', [BarangKeluarController::class, 'update'])->name('produksi.kelola-barang.keluar.edit.aksi');
    Route::get('kelola-barang/keluar/hapus/{id}', [BarangKeluarController::class, 'destroy'])->name('produksi.kelola-barang.keluar.hapus');

    Route::get('kelola-barang/stok', [BarangController::class, 'jumlahStok'])->name('produksi.kelola-barang.stok');

    Route::get('kelola-barang', [BarangController::class, 'index'])->name('produksi.kelola-barang');
    Route::get('kelola-barang/tambah', [BarangController::class, 'create'])->name('produksi.kelola-barang.tambah');
    Route::post('kelola-barang/tambah', [BarangController::class, 'store'])->name('produksi.kelola-barang.tambah.aksi');
    Route::get('kelola-barang/edit/{id}', [BarangController::class, 'edit'])->name('produksi.kelola-barang.edit');
    Route::post('kelola-barang/edit/{id}', [BarangController::class, 'update'])->name('produksi.kelola-barang.edit.aksi');
    Route::get('kelola-barang/hapus/{id}', [BarangController::class, 'destroy'])->name('produksi.kelola-barang.hapus');
    
});

// kasir
Route::group(['prefix' => 'kasir', 'middleware' => ['auth', 'kasir']], function () {
   Route::get('/', [KasirController::class, 'index'])->name('kasir.dashboard');

   Route::get('kelola-barang/stok', [BarangController::class, 'jumlahStok'])->name('kasir.kelola-barang.stok');

    Route::get('kelola-barang/masuk', [BarangMasukController::class, 'index'])->name('kasir.kelola-barang.masuk');
    Route::get('kelola-barang/masuk/tambah', [BarangMasukController::class, 'create'])->name('kasir.kelola-barang.masuk.tambah');
    Route::post('kelola-barang/masuk/tambah', [BarangMasukController::class, 'store'])->name('kasir.kelola-barang.masuk.tambah.aksi');
    Route::get('kelola-barang/masuk/edit/{id}', [BarangMasukController::class, 'edit'])->name('kasir.kelola-barang.masuk.edit');
    Route::post('kelola-barang/masuk/edit/{id}', [BarangMasukController::class, 'update'])->name('kasir.kelola-barang.masuk.edit.aksi');
    Route::get('kelola-barang/masuk/hapus/{id}', [BarangMasukController::class, 'destroy'])->name('kasir.kelola-barang.masuk.hapus');

    Route::get('transaksi', [PesananController::class, 'index'])->name('kasir.transaksi');
    Route::get('transaksi/tambah', [PesananController::class, 'create'])->name('kasir.transaksi.tambah');
    Route::post('transaksi/tambah', [PesananController::class, 'store'])->name('kasir.transaksi.tambah.aksi');
    Route::get('transaksi/edit/{id?}', [PesananController::class, 'edit'])->name('kasir.transaksi.edit');
    Route::post('transaksi/edit/{id}', [PesananController::class, 'update'])->name('kasir.transaksi.edit.aksi');
    Route::get('transaksi/hapus/{id}', [PesananController::class, 'destroy'])->name('kasir.transaksi.hapus');
    Route::get('transaksi/getBarangHarga', [PesananController::class, 'getBarangHarga'])->name('kasir.transaksi.getBarangHarga');
    Route::get('transaksi/getTotalHarga', [PesananController::class, 'getTotalHarga'])->name('kasir.transaksi.getTotalHarga');
    Route::post('transaksi/bayar', [PesananController::class, 'bayar'])->name('kasir.transaksi.bayar');
    Route::get('transaksi/riwayat', [PesananController::class, 'riwayat'])->name('kasir.transaksi.riwayat');
    Route::get('transaksi/riwayat/detail/{id}', [PesananController::class, 'detail'])->name('kasir.transaksi.riwayat.detail');
    
});
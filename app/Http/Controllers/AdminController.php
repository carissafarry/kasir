<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::count();
        $barangMasuk = BarangMasuk::count();
        $transaksi = Pesanan::count();
        $pengguna = User::count();
        return view('dashboard.admin.index', compact('barangKeluar', 'barangMasuk', 'transaksi', 'pengguna'));
    }

    public function kombinasiPaketPenjualan(Request $request)
    {
        $barang = DB::table('barang')
        ->select(
            'id',
            'nama',
            'harga',
            'harga_beli',
            'stok',
            DB::raw('(harga - harga_beli) AS KeuntunganPerUnit'),
            DB::raw('(stok * (harga - harga_beli)) AS TotalKeuntungan')
        )
        ->orderBy('TotalKeuntungan', 'DESC')
        ->get();

        // Menghitung total keuntungan
        $totalKeuntungan = $barang->sum('TotalKeuntungan');

        return view('dashboard.admin.laporan.kombinasi_paket', compact('barang', 'totalKeuntungan'));
    }

    public function laporanLabaRugi(Request $request)
    {
        $query = DB::table('barang_keluar AS bk')
        ->join('barang AS b', 'bk.barang_id', '=', 'b.id')
        ->join('pesanan AS p', 'p.id', '=', 'bk.id')
        ->select(
            'b.nama AS NamaBarang',
            'b.harga_beli AS HargaBeliBarang',
            'b.harga AS HargaJualBarang',
            DB::raw('SUM(bk.jumlah_keluar) AS TotalTerjual'),
            DB::raw('(SUM(bk.jumlah_keluar) * b.harga_beli) AS Modal'),
            DB::raw('(SUM(bk.jumlah_keluar) * b.harga) AS Pendapatan'),
            DB::raw('(SUM(bk.jumlah_keluar) * b.harga) - (SUM(bk.jumlah_keluar) * b.harga_beli) AS LabaKotor')
        )
        ->where('p.status', 'Lunas');

        // Jika ada filter tanggal
        if ($request->has('dari') || $request->has('sampai')) {
            $query->whereDate('p.created_at', '>=', $request->dari ? $request->dari : DB::raw('CURDATE()'))
            ->whereDate('p.created_at', '<=', $request->sampai ? $request->sampai : DB::raw('CURDATE()'));
        }
        $laporanLabaRugi = $query->groupBy('b.id', 'b.nama', 'b.harga_beli', 'b.harga')->get();
        return view('dashboard.admin.laporan.labarugi', compact('laporanLabaRugi'));
    }

    public function laporanPenjualan(Request $request)
    {
        if ($request->has('dari') || $request->has('sampai')) {
            $penjualan = Pesanan::whereDate('created_at', '>=', $request->dari ? $request->dari : DB::raw('CURDATE()'))
                ->whereDate('created_at', '<=', $request->sampai ? $request->sampai : DB::raw('CURDATE()'))
                ->get();
        } else {
            $penjualan = Pesanan::all();
        }
        $totalPenjualan = Pesanan::sum('total_harga');
        return view('dashboard.admin.laporan.penjualan', compact('penjualan', 'totalPenjualan'));
    }

    public function exportExcelLaporanPenjualan(Request $request)
    {
        if ($request->dari || $request->sampai) {
            return Excel::download(new \App\Exports\PenjualanExport($request->dari ? $request->dari : date('Y-m-d H:i:s'), $request->sampai ? $request->sampai :date('Y-m-d H:i:s')), 'laporan penjualan.xlsx');
        } else {
            return Excel::download(new \App\Exports\PenjualanExportAll(), 'laporan penjualan.xlsx');
        }
    }

    public function exportCsvLaporanPenjualan(Request $request)
    {
        if ($request->dari || $request->sampai) {
            return Excel::download(new \App\Exports\PenjualanExport($request->dari ? $request->dari : date('Y-m-d H:i:s'), $request->sampai ? $request->sampai :date('Y-m-d H:i:s')), 'laporan penjualan.csv');
        } else {
            return Excel::download(new \App\Exports\PenjualanExportAll(), 'laporan penjualan.csv');
        }
    }

    public function exportPDFLaporanPenjualan(Request $request)
    {
        if ($request->dari || $request->sampai) {
            return Excel::download(new \App\Exports\PenjualanExport($request->dari ? $request->dari : date('Y-m-d H:i:s'), $request->sampai ? $request->sampai :date('Y-m-d H:i:s')), 'laporan penjualan.pdf');
        } else {
            return Excel::download(new \App\Exports\PenjualanExportAll(), 'laporan penjualan.pdf');
        }

    }
}

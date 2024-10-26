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

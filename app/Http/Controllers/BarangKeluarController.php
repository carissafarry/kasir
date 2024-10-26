<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BarangKeluarController extends Controller
{
    public function laporanBarangKeluar()
    {
        $barangKeluar = BarangKeluar::all();
        return view('dashboard.admin.laporan.barang-keluar', compact('barangKeluar'));
    }

    public function exportExcel(Request $request)
    {
        if ($request->dari || $request->sampai) {
            return Excel::download(new \App\Exports\BarangKeluarExport($request->dari ? $request->dari : date('Y-m-d H:i:s'), $request->sampai ? $request->sampai :date('Y-m-d H:i:s')), 'barang-keluar.xlsx');
        } else {
            return Excel::download(new \App\Exports\BarangKeluarExportAll(), 'barang-keluar.xlsx');
        }
    }
    
    public function exportCsv(Request $request)
    {
        if ($request->dari || $request->sampai) {
            return Excel::download(new \App\Exports\BarangKeluarExport($request->dari ? $request->dari : date('Y-m-d H:i:s'), $request->sampai ? $request->sampai :date('Y-m-d H:i:s')), 'barang-keluar.csv');
        } else {
            return Excel::download(new \App\Exports\BarangKeluarExportAll(), 'barang-keluar.csv');
        }
    }

    public function exportPDF(Request $request)
    {
        if ($request->dari || $request->sampai) {
            $barangKeluar = BarangKeluar::whereDate('created_at', '>=', $request->dari ? $request->dari : DB::raw('CURDATE()'))
                ->whereDate('created_at', '<=', $request->sampai ? $request->sampai : DB::raw('CURDATE()'))
                ->get();
        } else {
            $barangKeluar = BarangKeluar::all();
        }

        $pdf = PDF::loadView('templates.barangkeluar-pdf', compact('barangKeluar'));
        return $pdf->download('laporan barang keluar.pdf');
        
    }

    public function index()
    {
        $barangKeluar = BarangKeluar::all();
        return view('dashboard.produksi.kelolabarang.keluar.index', compact('barangKeluar'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('dashboard.produksi.kelolabarang.keluar.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'barang_id' => 'required',
            'jumlah_keluar' => 'required|integer',
            'stok_akhir' => 'required|integer',
        ]);

        $barangKeluar = BarangKeluar::create([
            'kode_barang_keluar' => $this->getLastID(BarangKeluar::class),
            'barang_id' => $request->barang_id,
            'jumlah_keluar' => $request->jumlah_keluar,
            'stok_akhir' => $request->stok_akhir,
            'user_id' => Auth::user()->id,
        ]);
        if (Auth::user()->role_id == 2) {
            return redirect()->route('produksi.kelola-barang.keluar')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('kasir.kelola-barang.keluar')->with('success', 'Data berhasil ditambahkan');
        }
    }

    public function show($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        return view('dashboard.produksi.kelolabarang.keluar.show', compact('barangKeluar'));
    }

    public function edit($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        $barang = Barang::all();
        return view('dashboard.produksi.kelolabarang.keluar.edit', compact('barangKeluar', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'barang_id' => 'required',
            'jumlah_keluar' => 'required|integer',
            'stok_akhir' => 'required|integer',
        ]);

        $barangKeluar = BarangKeluar::findOrFail($id);
        $barangKeluar->update([
            'barang_id' => $request->barang_id,
            'jumlah_keluar' => $request->jumlah_keluar,
            'stok_akhir' => $request->stok_akhir,
        ]);

        if (Auth::user()->role_id == 2) {
            return redirect()->route('produksi.kelola-barang.keluar')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('kasir.kelola-barang.keluar')->with('success', 'Data berhasil diubah');
        }

        
    }

    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        $barangKeluar->delete();
        if (Auth::user()->role_id == 2) {
            return redirect()->route('produksi.kelola-barang.keluar')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('kasir.kelola-barang.keluar')->with('success', 'Data berhasil dihapus');
        }
        
    }
}

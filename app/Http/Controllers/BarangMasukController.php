<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Carbon\Carbon;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BarangMasukController extends Controller
{
    public function laporanBarangMasuk(Request $request)
    {
        if ($request->has('dari') || $request->has('sampai')) {
            $barangMasuk = BarangMasuk::whereDate('created_at', '>=', $request->dari ? $request->dari : DB::raw('CURDATE()'))
                ->whereDate('created_at', '<=', $request->sampai ? $request->sampai : DB::raw('CURDATE()'))
                ->get();
        } else {
            $barangMasuk = BarangMasuk::all();
        }
        return view('dashboard.admin.laporan.barang-masuk', compact('barangMasuk'));
    }

    public function exportExcel(Request $request)
    {
        if ($request->dari || $request->sampai) {
            return Excel::download(new \App\Exports\BarangMasukExport($request->dari ? $request->dari : date('Y-m-d H:i:s'), $request->sampai ? $request->sampai :date('Y-m-d H:i:s')), 'barang-masuk.xlsx');
        } else {
            return Excel::download(new \App\Exports\BarangMasukExportAll(), 'barang-masuk.xlsx');
        }
    }
    
    public function exportCsv(Request $request)
    {
        if ($request->dari || $request->sampai) {
            return Excel::download(new \App\Exports\BarangMasukExport($request->dari ? $request->dari : date('Y-m-d H:i:s'), $request->sampai ? $request->sampai :date('Y-m-d H:i:s')), 'barang-masuk.csv');
        } else {
            return Excel::download(new \App\Exports\BarangMasukExportAll(), 'barang-masuk.csv');
        }
    }

    public function exportPDF(Request $request)
    {
        if ($request->dari || $request->sampai) {
            $barangMasuk = BarangMasuk::whereDate('created_at', '>=', $request->dari ? $request->dari : DB::raw('CURDATE()'))
                ->whereDate('created_at', '<=', $request->sampai ? $request->sampai : DB::raw('CURDATE()'))
                ->get();
        } else {
            $barangMasuk = BarangMasuk::get();
        }

        $pdf = PDF::loadView('templates.barangmasuk-pdf', compact('barangMasuk'));
        return $pdf->download('laporan barang masuk.pdf');
    }

    public function index()
    {
        $barangMasuk = BarangMasuk::all();
        if (Auth::user()->role_id == 2) {
            return view('dashboard.produksi.kelolabarang.masuk.index', compact('barangMasuk'));
        } else {
            return view('dashboard.kasir.kelolabarang.masuk.index', compact('barangMasuk'));
        }
    }

    public function create()
    {
        $barang = Barang::all();
        if (Auth::user()->role_id == 2) {
            return view('dashboard.produksi.kelolabarang.masuk.create', compact('barang'));
        } else {
            return view('dashboard.kasir.kelolabarang.masuk.create', compact('barang'));
        }
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'barang_id' => 'required',
            'jumlah_masuk' => 'required|integer',
            'stok_akhir' => 'required|integer',
        ]);

        $barangMasuk = BarangMasuk::create([
            'kode_barang_masuk' => $this->getLastID(BarangMasuk::class),
            'barang_id' => $request->barang_id,
            'jumlah_masuk' => $request->jumlah_masuk,
            'stok_akhir' => $request->stok_akhir,
            'user_id' => Auth::user()->id,
        ]);
        if (Auth::user()->role_id == 2) {
            return redirect()->route('produksi.kelola-barang.masuk')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('kasir.kelola-barang.masuk')->with('success', 'Data berhasil ditambahkan');
        }
    }

    public function show($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        if (Auth::user()->role_id == 2) {
            return view('dashboard.produksi.kelolabarang.masuk.show', compact('barangMasuk'));
        } else {
            return view('dashboard.kasir.kelolabarang.masuk.show', compact('barangMasuk'));
        }
        
    }

    public function edit($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barang = Barang::all();
        if (Auth::user()->role_id == 2) {
            return view('dashboard.produksi.kelolabarang.masuk.edit', compact('barangMasuk', 'barang'));
        } else {
            return view('dashboard.kasir.kelolabarang.masuk.edit', compact('barangMasuk', 'barang'));
        }
        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'barang_id' => 'required',
            'jumlah_masuk' => 'required|integer',
            'stok_akhir' => 'required|integer',
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->update([
            'barang_id' => $request->barang_id,
            'jumlah_masuk' => $request->jumlah_masuk,
            'stok_akhir' => $request->stok_akhir,
        ]);

        if (Auth::user()->role_id == 2) {
            return redirect()->route('produksi.kelola-barang.masuk')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('kasir.kelola-barang.masuk')->with('success', 'Data berhasil diubah');
        }

        
    }

    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->delete();
        if (Auth::user()->role_id == 2) {
            return redirect()->route('produksi.kelola-barang.masuk')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('kasir.kelola-barang.masuk')->with('success', 'Data berhasil dihapus');
        }
        
    }

    
}

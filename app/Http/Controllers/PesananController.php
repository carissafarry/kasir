<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\MetodeBayar;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::all();
        $metodebayar = MetodeBayar::all();
        return view('dashboard.kasir.transaksi.index', compact('pesanan', 'metodebayar'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('dashboard.kasir.transaksi.create', compact('barang'));
    }

    public function getBarangHarga(Request $request)
    {
        $barang = Barang::findOrFail($request->barang_id);
        return response()->json($barang->harga);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $pesanan = Pesanan::create([
                'kode_pesanan' => $this->getLastID(Pesanan::class),
                'nama_pemesan' => $request->nama_pemesan,
                'kasir_id' => Auth::user()->id,
                'total_harga' => 0,
                'status' => 'Belum Lunas'
                // 'total_bayar' => $request->total_bayar,
                // 'kembalian' => 0,
                // 'metode_pembayaran' => $request->metode_pembayaran,
            ]);
            
            for ($i=0; $i < count($request->barang_id); $i++) { 
                $pesanan->pesananDetail()->create([
                    'barang_id' => $request->barang_id[$i],
                    'qty' => $request->qty[$i],
                    'subtotal' => Barang::find($request->barang_id[$i])->harga * $request->qty[$i],
                    'catatan' => $request->catatan[$i],
                ]);
    
                $barang = Barang::find($request->barang_id[$i]);
                $barang->stok = $barang->stok - $request->qty[$i];
                $barang->save();

                BarangKeluar::create([
                    'kode_barang_keluar' => $this->getLastID(BarangKeluar::class),
                    'barang_id' => $request->barang_id[$i],
                    'jumlah_keluar' => $request->qty[$i],
                    'stok_akhir' => $barang->stok,
                    'user_id' => Auth::user()->id,
                ]);
    
                // update total harga
                $pesanan->total_harga = $pesanan->total_harga + $barang->harga * $request->qty[$i];
                // $pesanan->kembalian = $request->total_bayar - $pesanan->total_harga
                $pesanan->save();
            }
            DB::commit();
            return redirect()->route('kasir.transaksi')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menyimpan data!');
        }
    }

    public function show($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('dashboard.kasir.transaksi.show', compact('pesanan'));
    }

    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('dashboard.kasir.transaksi.edit', compact('pesanan'));
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update([
            'nama_pemesan' => $request->nama_pemesan,
            'total_harga' => $request->total_harga,
            'total_bayar' => $request->total_bayar,
            'kembalian' => $request->kembalian,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return redirect()->route('kasir.transaksi')->with('success', 'Transaksi berhasil!');
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();
        return redirect()->route('kasir.transaksi')->with('success', 'Transaksi Dihapus!');
    }

    public function bayar(Request $request)
    {
        $pesanan = Pesanan::findOrFail($request->pesanan_id);
        if ($request->total_bayar < $pesanan->total_harga) {
            return response()->json([
                'status' => 'error',
                'message' => 'Total bayar tidak boleh kurang dari total harga!'
            ]);
        } else {
            $pesanan->update([
                'total_bayar' => $request->total_bayar,
                'kembalian' => $request->total_bayar - $pesanan->total_harga,
                'metode_bayar_id' => $request->metode_bayar_id,
                'status' => 'Lunas'
            ]);
            return redirect()->route('kasir.transaksi')->with('success', 'Transaksi berhasil!');
        }
    }

    function getTotalHarga(Request $request)
    {
        $pesanan = Pesanan::findOrFail($request->pesanan_id);
        return response()->json($pesanan->total_harga);
    }

    public function riwayat()
    {
        $pesanan = Pesanan::where('status', 'Lunas')->get();
        return view('dashboard.kasir.transaksi.riwayat', compact('pesanan'));
    }

    public function detail($id)
    {
        $pesanan = Pesanan::where('status', 'Lunas')->findOrFail($id);
        return view('dashboard.kasir.transaksi.detail', compact('pesanan'));
    }
}

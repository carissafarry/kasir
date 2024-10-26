<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function jumlahStok()
    {
        $barang = Barang::all();
        return view('dashboard.kasir.kelolabarang.jumlah-stok', compact('barang'));
    }

    public function index()
    {
        $barang = Barang::all();
        return view('dashboard.produksi.kelolabarang.barang.index', compact('barang'));
    }

    public function create()
    {
        return view('dashboard.produksi.kelolabarang.barang.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
        ]);

        $barang = new Barang;
        $barang->kode_barang = $this->getLastID(Barang::class);
        $barang->nama = $request->nama;
        $barang->stok = $request->stok;
        $barang->harga = $request->harga;
        $barang->satuan = $request->satuan;
        $barang->save();

        return redirect()->route('produksi.kelola-barang')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        return view('dashboard.produksi.kelolabarang.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
        ]);

        $barang = Barang::find($id);
        $barang->nama = $request->nama;
        $barang->stok = $request->stok;
        $barang->harga = $request->harga;
        $barang->satuan = $request->satuan;
        $barang->save();

        return redirect()->route('produksi.kelola-barang')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return redirect()->route('produksi.kelola-barang')->with('success', 'Data berhasil dihapus');
    }
}

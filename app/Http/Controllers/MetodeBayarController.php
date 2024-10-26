<?php

namespace App\Http\Controllers;

use App\Models\MetodeBayar;
use Illuminate\Http\Request;

class MetodeBayarController extends Controller
{
    public function index()
    {
        $metode_bayar = MetodeBayar::all();
        return view('dashboard.admin.metode_bayar.index', compact('metode_bayar'));
    }

    public function create()
    {
        return view('dashboard.admin.metode_bayar.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:255',
        ]);

        $metode_bayar = MetodeBayar::create([
            'kode_metode_bayar' => $this->getLastID(MetodeBayar::class),
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.metode_bayar')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $metode_bayar = MetodeBayar::findOrFail($id);
        return view('dashboard.admin.metode_bayar.edit', compact('metode_bayar'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:255',
        ]);

        $metode_bayar = MetodeBayar::findOrFail($id);
        $metode_bayar->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.metode_bayar')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $metode_bayar = MetodeBayar::findOrFail($id);
        $metode_bayar->delete();

        return redirect()->route('admin.metode_bayar')->with('success', 'Data berhasil dihapus');
    }
}

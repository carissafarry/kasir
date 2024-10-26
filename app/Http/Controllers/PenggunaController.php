<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::all();
        return view('dashboard.admin.pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        return view('dashboard.admin.pengguna.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:pengguna',
            'password' => 'required|string',
            'role_id' => 'required|integer',
        ]);

        $user = User::create([
            'kode_pengguna' => $this->getLastID(User::class),
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admin.pengguna')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengguna = User::findOrFail($id);
        return view('dashboard.admin.pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:pengguna,email,' . $id,
            'password' => 'nullable|string',
            'role_id' => 'required|integer',
        ]);

        $pengguna = User::findOrFail($id);
        $pengguna->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $pengguna->password ? Hash::make($request->password) : $pengguna->password,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admin.pengguna')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $pengguna = User::findOrFail($id);
        $pengguna->delete();

        return redirect()->route('admin.pengguna')->with('success', 'Data berhasil dihapus');
    }
    
}

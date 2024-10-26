@extends('layouts.app')
@section('title', '- Barang Keluar')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kelola Barang</h1>
    </div>
    <div class="row">
        <div class="col-sm-5 offset-sm-3">
            <div class="card card-primary">
                <div class="card-header mr-auto">
                    <h4>Edit Barang Keluar</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('produksi.kelola-barang.keluar.edit.aksi', $barangKeluar->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Kode Barang Keluar</label>
                            <input type="text" disabled class="form-control" value="{{ $barangKeluar->kode_barang }}">
                        </div>
                        <div class="form-group">
                            <label for="">Barang</label>
                            <select name="barang_id" id="" class="form-control" required>
                                <option selected disabled></option>
                                @foreach ($barang as $item)
                                    <option value="{{ $item->id }}" {{ $barangKeluar->barang_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Keluar</label>
                            <input type="number" name="jumlah_keluar" class="form-control" value="{{ $barangKeluar->jumlah_keluar }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Stok Akhir</label>
                            <input type="number" name="stok_akhir" class="form-control" value="{{ $barangKeluar->stok_akhir }}" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
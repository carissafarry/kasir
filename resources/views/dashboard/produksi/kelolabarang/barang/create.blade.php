@extends('layouts.app')
@section('title', '- Barang')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kelola Barang</h1>
    </div>
    <div class="row">
        <div class="col-sm-5 offset-sm-3">
            <div class="card card-primary">
                <div class="card-header mr-auto">
                    <h4>Tambah Barang</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('produksi.kelola-barang.tambah.aksi') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Satuan</label>
                            <input type="text" name="satuan" class="form-control" required>
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
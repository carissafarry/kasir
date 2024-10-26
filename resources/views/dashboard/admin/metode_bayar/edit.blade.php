@extends('layouts.app')
@section('title', '- Metode Bayar')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Metode Bayar</h1>
    </div>
    <div class="row">
        <div class="col-sm-5 offset-sm-3">
            <div class="card card-primary">
                <div class="card-header mr-auto">
                    <h4>Edit Metode Bayar</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.metode_bayar.edit.aksi', $metode_bayar->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Kode Metode Bayar</label>
                            <input type="text" disabled required class="form-control"
                                value="{{ $metode_bayar->kode_metode_bayar }}">
                        </div>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" required
                                value="{{ $metode_bayar->nama }}">
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
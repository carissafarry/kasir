@extends('layouts.app')
@section('title', '- Riwayat Transaksi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Transaksi</h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header mr-auto">
                    <h4>Riwayat Transaksi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table-1">
                            <thead>
                                <th>Kode Pesanan</th>
                                <th>Nama Pemesan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Kasir</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($pesanan as $item)
                                <tr>
                                    <td>{{ $item->kode_pesanan }}</td>
                                    <td>{{ $item->nama_pemesan }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->kasir->nama }}</td>
                                    <td>
                                        <a href="{{ route('kasir.transaksi.riwayat.detail', $item->id) }}" class="btn btn-warning">Detail Pesanan</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
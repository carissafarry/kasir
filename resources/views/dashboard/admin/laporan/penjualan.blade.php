@extends('layouts.app')
@section('title', '- Data Penjualan')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Laporan Penjualan</h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header mr-auto">
                    <h4>Data Penjualan</h4>
                    <div class="card-header-action">
                        <form class="form-inline" method="get" action="{{ route('admin.laporan-penjualan') }}">
                            <input type="date" name="dari" class="form-control mb-2 mr-sm-2" {{ request()->dari ?
                            'value='. request()->dari : '' }}>
                            <input type="date" name="sampai" class="form-control mb-2 mr-sm-2" {{ request()->sampai ?
                            'value='. request()->sampai : '' }}>
                            <button type="submit" class="btn btn-primary mb-2 mr-sm-2">Submit</button>
                            <a href="{{ route('admin.laporan-penjualan') }}"
                                class="btn btn-danger mb-2 mr-sm-2">Reset</a>
                        </form>
                        <a class="btn btn-info"
                            href="{{ route('admin.laporan-penjualan.csv', ['dari' => request()->dari ? request()->dari : '', 'sampai' => request()->sampai ? request()->sampai : '']) }}">CSV</a>
                        <a class="btn btn-info"
                            href="{{ route('admin.laporan-penjualan.excel', ['dari' => request()->dari ? request()->dari : '', 'sampai' => request()->sampai ? request()->sampai : '']) }}">Excel</a>
                        <a class="btn btn-info"
                            href="{{ route('admin.laporan-penjualan.pdf', ['dari' => request()->dari ? request()->dari : '', 'sampai' => request()->sampai ? request()->sampai : '']) }}">PDF</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table-1">
                            <thead>
                                <th>Tanggal</th>
                                <th>Kode Pesanan</th>
                                <th>Nama Pelanggan</th>
                                <th>Metode Pembayaran</th>
                                <th>Total Harga</th>
                            </thead>
                            <tbody>
                                @foreach ($penjualan as $item)
                                <tr>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->kode_pesanan }}</td>
                                    <td>{{$item->nama_pemesan}}</td>
                                    <td>{{$item->metode_pembayaran}}</td>
                                    <td>{{$item->total_harga}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tr>
                                <th>Total Penjualan</th>
                                <td colspan="2">{{ $totalPenjualan }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
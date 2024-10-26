@extends('layouts.app')
 
@section('title', '- Data Barang Keluar')
 
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Laporan Barang</h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header mr-auto">
                    <h4>Data Barang Keluar</h4>
                    <div class="card-header-action">
                        <form class="form-inline" method="get" action="{{ route('admin.laporan-barang.keluar') }}">
                            <input type="date" name="dari" class="form-control mb-2 mr-sm-2" {{ request()->dari ? 'value='. request()->dari : '' }}>
                            <input type="date" name="sampai" class="form-control mb-2 mr-sm-2" {{ request()->sampai ? 'value='. request()->sampai : '' }}>
                            <button type="submit" class="btn btn-primary mb-2 mr-sm-2">Submit</button>
                            <a href="{{ route('admin.laporan-barang.keluar') }}" class="btn btn-danger mb-2 mr-sm-2">Reset</a>
                        </form>
                        <a class="btn btn-info" href="{{ route('admin.laporan-barang.keluar.csv', ['dari' => request()->dari ? request()->dari : '', 'sampai' => request()->sampai ? request()->sampai : '']) }}">CSV</a>
                        <a class="btn btn-info" href="{{ route('admin.laporan-barang.keluar.excel', ['dari' => request()->dari ? request()->dari : '', 'sampai' => request()->sampai ? request()->sampai : '']) }}">Excel</a>
                        <a class="btn btn-info" href="{{ route('admin.laporan-barang.keluar.pdf', ['dari' => request()->dari ? request()->dari : '', 'sampai' => request()->sampai ? request()->sampai : '']) }}">PDF</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table-1">
                            <thead>
                                <th>Tanggal</th>
                                <th>Kode Barang Keluar</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Keluar</th>
                                <th>Stok Akhir</th>
                                <th>Satuan</th>
                                <th>Produsen</th>
                            </thead>
                            <tbody>
                                @foreach ($barangKeluar as $item)
                                <tr>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->kode_barang_keluar }}</td>
                                    <td>{{ $item->barang->nama }}</td>
                                    <td>{{ $item->jumlah_keluar }}</td>
                                    <td>{{ $item->stok_akhir }}</td>
                                    <td>{{ $item->barang->satuan }}</td>
                                    <td>{{ $item->user->nama }}</td>
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
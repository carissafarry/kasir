@extends('layouts.app')
@section('title', '- Paket Penjualan')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kombinasi Paket Penjualan</h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header mr-auto">
                    <h4>Paket Penjualan</h4>
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
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table-1">
                            <thead>
                                <th>Nama Barang</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Keuntungan per Unit</th>
                                <th>Stok</th>
                                <th>Total Keuntungan</th>
                            </thead>
                            <tbody>
                                @foreach ($barang as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->harga_beli }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>{{ $item->KeuntunganPerUnit }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->TotalKeuntungan }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="5">Total Keuntungan</th>
                                    <td colspan="1">{{ $totalKeuntungan }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')
@section('title', '- Laporan Laba Rugi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Laporan Laba Rugi</h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header mr-auto">
                    <h4>Laporan Laba Rugi</h4>
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
                                <th>Total Terjual</th>
                                <th>Total Modal</th>
                                <th>Total Pendapatan</th>
                                <th>Laba Kotor</th>
                            </thead>
                            <tbody>
                                @foreach ($laporanLabaRugi as $item)
                                <tr>
                                    <td>{{ $item->NamaBarang }}</td>
                                    <td>{{ $item->HargaBeliBarang }}</td>
                                    <td>{{ $item->HargaJualBarang }}</td>
                                    <td>{{ $item->TotalTerjual }}</td>
                                    <td>{{ $item->Modal }}</td>
                                    <td>{{ $item->Pendapatan }}</td>
                                    <td>{{ $item->LabaKotor }}</td>
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

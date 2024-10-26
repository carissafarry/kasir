@extends('layouts.app')


@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Transaksi</h4>
                    </div>
                    <div class="card-body"> {{$transaksi}} </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Barang Masuk</h4>
                    </div>
                    <div class="card-body"> {{$barangMasuk}} </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Barang Keluar</h4>
                    </div>
                    <div class="card-body"> {{$barangKeluar}} </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
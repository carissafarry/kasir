@extends('layouts.app')
@section('title', '- Detail Transaksi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kelola Transaksi</h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header mr-auto">
                    <h4>Detail Transaksi</h4>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Nama Pemesan</label>
                                <input type="text" readonly class="form-control" value="{{ $pesanan->nama_pemesan }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="text" readonly class="form-control" value="{{ $pesanan->created_at }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Kasir</label>
                                <input type="text" readonly class="form-control" value="{{ $pesanan->kasir->nama }}">
                            </div>
                        </div>
                    </div>

                    <h6>Transaksi Detail</h6>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($pesanan->pesananDetail as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{ $item->barang->nama }}</td>
                                    <td>@rupiah($item->barang->harga)</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>@rupiah($item->subtotal)</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Total</label>
                                <input type="text" readonly class="form-control" value="@rupiah($pesanan->total_harga)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Bayar</label>
                                <input type="text" readonly class="form-control" value="@rupiah($pesanan->total_bayar)">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Kembalian</label>
                                <input type="text" readonly class="form-control" value="@rupiah($pesanan->kembalian)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Metode Pembayaran</label>
                                <input type="text" readonly class="form-control" value="{{ $pesanan->metodebayar->nama }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
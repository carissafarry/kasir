@extends('layouts.app')
@section('title', '- Barang Masuk')
@section('content')
<section class="section">
    <div class="section-header">
       <h1>Kelola Barang</h1>
    </div>
    <div class="row">
         <div class="col-sm-12">
             <div class="card card-primary">
                 <div class="card-header mr-auto">
                     <h4>Data Barang Masuk</h4>
                     <div class="card-header-action">
                         <a href="{{ route('produksi.kelola-barang.masuk.tambah') }}" class="btn btn-primary">Tambah Barang Masuk</a>
                     </div>
                 </div>
                 <div class="card-body">
                     <div class="table-responsive">
                         <table class="table table-striped table-bordered" id="table-1">
                             <thead>
                                    <th>Kode Barang Masuk</th>
                                 <th>Barang</th>
                                 <th>Jumlah Masuk</th>
                                 <th>Stok Akhir</th>
                                 <th>Pengelola</th>
                                 <th>Aksi</th>
                             </thead>
                             <tbody>
                               @foreach ($barangMasuk as $item)
                                <tr>
                                    <td>{{ $item->kode_barang_masuk }}</td>
                                    <td>{{ $item->barang->nama }}</td>
                                    <td>{{ $item->jumlah_masuk }}</td>
                                    <td>{{ $item->stok_akhir }}</td>
                                    <td>{{ $item->user->nama }}</td>
                                    <td>
                                        <a href="{{ route('produksi.kelola-barang.masuk.edit', $item->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('produksi.kelola-barang.masuk.hapus', $item->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
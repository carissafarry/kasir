@extends('layouts.app')
@section('title', '- Barang')
@section('content')
<section class="section">
    <div class="section-header">
       <h1>Kelola Barang</h1>
    </div>
    <div class="row">
         <div class="col-sm-12">
             <div class="card card-primary">
                 <div class="card-header mr-auto">
                     <h4>Data Barang</h4>
                     <div class="card-header-action">
                         <a href="{{ route('produksi.kelola-barang.tambah') }}" class="btn btn-primary">Tambah Barang</a>
                     </div>
                 </div>
                 <div class="card-body">
                     <div class="table-responsive">
                         <table class="table table-striped table-bordered" id="table-1">
                             <thead>
                                    <th>Kode Barang</th>
                                 <th>Nama</th>
                                 <th>Stok</th>
                                 <th>Harga</th>
                                 <th>Satuan</th>
                                 <th>Aksi</th>
                             </thead>
                             <tbody>
                               @foreach ($barang as $item)
                                <tr>
                                    <td>{{ $item->kode_barang }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>@rupiah($item->harga)</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>
                                        <a href="{{ route('produksi.kelola-barang.edit', $item->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('produksi.kelola-barang.hapus', $item->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
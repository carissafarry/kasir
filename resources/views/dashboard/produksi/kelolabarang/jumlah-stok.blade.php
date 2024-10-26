@extends('layouts.app')
@section('title', '- Jumlah Stok')
@section('content')
<section class="section">
    <div class="section-header">
       <h1>Kelola Barang</h1>
    </div>
    <div class="row">
         <div class="col-sm-12">
             <div class="card card-primary">
                 <div class="card-header mr-auto">
                     <h4>Data Jumlah Stok Barang</h4>
                 </div>
                 <div class="card-body">
                     <div class="table-responsive">
                         <table class="table table-striped table-bordered" id="table-1">
                             <thead>
                                    <th>Kode Barang</th>
                                 <th>Barang</th>
                                 <th>Stok Tersedia</th>
                             </thead>
                             <tbody>
                               @foreach ($barang as $item)
                                <tr>
                                    <td>{{ $item->kode_barang }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->stok }}</td>
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
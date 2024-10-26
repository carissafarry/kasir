@extends('layouts.app')
@section('title', '- Metode Bayar')
@section('content')
<section class="section">
    <div class="section-header">
       <h1>Metode Bayar</h1>
    </div>
    <div class="row">
         <div class="col-sm-12">
             <div class="card card-primary">
                 <div class="card-header mr-auto">
                     <h4>Data Metode Bayar</h4>
                     <div class="card-header-action">
                         <a href="{{ route('admin.metode_bayar.tambah') }}" class="btn btn-primary">Tambah Metode Bayar</a>
                     </div>
                 </div>
                 <div class="card-body">
                     <div class="table-responsive">
                         <table class="table table-striped table-bordered" id="table-1">
                             <thead>
                                 <th>Kode Metode Bayar</th>
                                 <th>Nama</th>
                                 <th>Aksi</th>
                             </thead>
                             <tbody>
                               @foreach ($metode_bayar as $item)
                                <tr>
                                    <td>{{ $item->kode_metode_bayar }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <a href="{{ route('admin.metode_bayar.edit', $item->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.metode_bayar.hapus', $item->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
@extends('layouts.app')
@section('title', '- Pengguna')
@section('content')
<section class="section">
    <div class="section-header">
       <h1>Pengguna</h1>
    </div>
    <div class="row">
         <div class="col-sm-12">
             <div class="card card-primary">
                 <div class="card-header mr-auto">
                     <h4>Data Pengguna</h4>
                     <div class="card-header-action">
                         <a href="{{ route('admin.pengguna.tambah') }}" class="btn btn-primary">Tambah Pengguna</a>
                     </div>
                 </div>
                 <div class="card-body">
                     <div class="table-responsive">
                         <table class="table table-striped table-bordered" id="table-1">
                             <thead>
                                 <th>Kode Pengguna</th>
                                 <th>Nama</th>
                                 <th>Email</th>
                                 <th>Role</th>
                                 <th>Aksi</th>
                             </thead>
                             <tbody>
                               @foreach ($pengguna as $item)
                                <tr>
                                    <td>{{ $item->kode_pengguna }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @if ($item->role_id == '1')
                                            <span class="badge badge-primary">Admin</span>
                                        @elseif($item->role_id == '2')
                                            <span class="badge badge-success">Produksi</span>
                                        @elseif($item->role_id == '3')
                                            <span class="badge badge-warning">Kasir</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.pengguna.edit', $item->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.pengguna.hapus', $item->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
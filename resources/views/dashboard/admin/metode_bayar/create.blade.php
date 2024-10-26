@extends('layouts.app')
@section('title', '- Metode Bayar')
@section('content')
<section class="section">
    <div class="section-header">
       <h1>Metode Bayar</h1>
    </div>
    <div class="row">
         <div class="col-sm-5 offset-sm-3">
             <div class="card card-primary">
                 <div class="card-header mr-auto">
                     <h4>Tambah Metode Bayar</h4>
                 </div>
                 <div class="card-body">
                     <form action="{{ route('admin.metode_bayar.tambah.aksi') }}" method="post">
                        @csrf
                         <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                         </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                        </div>
                     </form>
                 </div>
             </div>
         </div>
    </div>
 </section>
@endsection
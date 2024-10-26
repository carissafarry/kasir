@extends('layouts.app')
@section('title', '- Pengguna')
@section('content')
<section class="section">
    <div class="section-header">
       <h1>Pengguna</h1>
    </div>
    <div class="row">
         <div class="col-sm-5 offset-sm-3">
             <div class="card card-primary">
                 <div class="card-header mr-auto">
                     <h4>Tambah Pengguna</h4>
                 </div>
                 <div class="card-body">
                     <form action="{{ route('admin.pengguna.tambah.aksi') }}" method="post">
                        @csrf
                         <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                         </div>
                        <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                                <label for="">Role</label>
                                <select name="role_id" id="" class="form-control" required>
                                    <option selected disabled></option>
                                    <option value="1">Admin</option>
                                    <option value="2">Produksi</option>
                                    <option value="3">Kasir</option>
                                </select>
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
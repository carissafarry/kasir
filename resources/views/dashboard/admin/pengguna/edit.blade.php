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
                    <h4>Edit Pengguna</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pengguna.edit.aksi', $pengguna->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Kode Pengguna</label>
                            <input type="text" disabled required class="form-control"
                                value="{{ $pengguna->kode_pengguna }}">
                        </div>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" required
                                value="{{ $pengguna->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required
                                value="{{ $pengguna->email }}">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <small>Note: Kosongkan jika tidak diubah.</small>
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <select name="role_id" id="" class="form-control" required>
                                <option selected disabled></option>
                                <option value="1" {{ $pengguna->role_id == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ $pengguna->role_id == 2 ? 'selected' : '' }}>Produksi</option>
                                <option value="3" {{ $pengguna->role_id == 3 ? 'selected' : '' }}>Kasir</option>
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
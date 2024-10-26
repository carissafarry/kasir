@extends('layouts.app')
@section('title', '- Transaksi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Transaksi</h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header mr-auto">
                    <h4>Data Transaksi</h4>
                    <div class="card-header-action">
                        <a href="{{ route('kasir.transaksi.tambah') }}" class="btn btn-primary">Tambah Transaksi</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table-1">
                            <thead>
                                <th>Kode Pesanan</th>
                                <th>Nama Pemesan</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Kasir</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($pesanan as $item)
                                <tr>
                                    <td>{{ $item->kode_pesanan }}</td>
                                    <td>{{ $item->nama_pemesan }}</td>
                                    <td id="tableTotal">@rupiah($item->total_harga)</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->kasir->nama }}</td>
                                    <td>
                                        @if ($item->status == 'Belum Lunas')
                                        <button class="btn btn-primary" onclick="edit({{$item->id}})">Bayar</button>
                                        <a href="{{ route('kasir.transaksi.hapus', $item->id) }}"
                                            class="btn btn-danger">Hapus</a>
                                        @elseif($item->status == 'Lunas')
                                        -
                                        @endif
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bayar Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="formBayar">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Total Harga</label>
                        <div class="input-group">
                            <input class="form-control" disabled id="totalHarga">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Total Bayar</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="total_bayar">
                        </div>
                    </div>
                    @csrf
                    <input type="hidden" name="pesanan_id">
                    <div class="form-group">
                        <label for="">Metode Pembayaran</label>
                        <select name="metode_bayar_id" id="" class="form-control">
                            <option selected="" disabled=""></option>
                            @foreach ($metodebayar as $item)
                             <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Bayar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@section('js')
<script>
    function rupiah(angka)
{
	var rupiah = '';		
	var angkarev = angka.toString().split('').reverse().join('');
	for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
	return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
}
function edit(id) {
    $('input[name=pesanan_id]').val($(this).attr('idpesanan'));
    // ajax
    $.ajax({
        url: "{{ route('kasir.transaksi.getTotalHarga') }}",
        type: "GET",
        data: {
            pesanan_id: id
        },
        success: function(data) {
            $('#totalHarga').val(rupiah(data));
            $('input[name=pesanan_id]').val(id);
            $('#exampleModal').modal('show');
            $('#formBayar').attr('action', "{{ route('kasir.transaksi.bayar') }}");
        }
    });
}

</script>
@endsection
@extends('layouts.app')
@section('title', '- Transaksi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kelola Transaksi</h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header mr-auto">
                    <h4>Tambah Transaksi</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('kasir.transaksi.tambah.aksi') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Pemesan</label>
                            <input type="text" name="nama_pemesan" class="form-control" required value="{{ old('nama_pemesan') }}">
                        </div>

                        <h6>Transaksi Detail</h6>
                        <div class="pesanan-detail">
                            <div class="form-row" id="pesananRow">
                                <div class="col-sm-4">
                                    <label for="">Barang</label>
                                    <select name="barang_id[0]" id="" class="form-control">
                                        <option selected disabled></option>
                                        @foreach ($barang as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="harga_barang[0]" value="">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Qty</label>
                                        <input type="number" name="qty[0]" class="form-control" required oninput='getBarangHarga($("select[name=\"barang_id[0]\"]").val(), 0)'>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Catatan</label>
                                        <input type="text" name="catatan[0]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-secondary mb-3" type="button" id="addPesananDetail">+</button>
                        <div class="form-group">
                            <label for="">Total</label>
                            <input type="text" readonly class="form-control" id="total">
                        </div>
                        {{-- <div class="form-row mt-5">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Total Bayar</label>
                                    <input type="number" name="total_bayar" class="form-control" required value="{{ old('total_bayar') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Metode Pembayaran</label>
                                    <select name="metode_pembayaran" id="" class="form-control">
                                        <option selected disabled></option>
                                        <option value="cash">Cash</option>
                                        <option value="debit">Debit</option>
                                        <option value="kredit">Kredit</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <button class="btn btn-primary btn-lg" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    const formatRupiah = (money) => {
    return new Intl.NumberFormat('id-ID',
        { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }
    ).format(money);
    }   
      var max_fields      = 15; //maximum input boxes allowed
      var wrapper   		= $(".pesanan-detail"); //Fields wrapper
      var add_button      = $("#addPesananDetail"); //Add button ID
      
      var x = 1; //initlal text box count


    //   refresh total every sec
    setInterval(() => {
        getTotalHarga();
    }, 100);


      $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        // getTotalHarga();
        if(x < max_fields){ //max input box allowed
          $(wrapper).append(
            `<div class="form-row" id="pesananRow">
                                <div class="col-sm-4">
                                    <label for="">Barang</label>
                                    <select name="barang_id[${x}]" id="" class="form-control"">
                                        <option selected disabled></option>
                                        @foreach ($barang as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="harga_barang[${x}]" value="">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Qty</label>
                                        <input type="number" name="qty[${x}]" class="form-control" required onchange='getBarangHarga($("select[name=\\"barang_id[${x}]\\"]").val(), ${x})'>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Catatan</label>
                                        <input type="text" name="catatan[${x}]" class="form-control">
                                    </div>
                                </div>
                            </div>`
            ); //add input box
            x++; //text box increment
        }
      });
     
      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
      })

      function getBarangHarga(barang_id, x) {
        $.ajax({
            url: "{{ route('kasir.transaksi.getBarangHarga') }}",
            type: "GET",
            data: {
                barang_id: barang_id
            },
            success: function(data) {
                qty = $('input[name="qty['+x+']"]').val();
                total = $('input[name="harga_barang['+x+']"]').val(data*qty);
            }
        });
        
    }

    

    function getTotalHarga() {
        total = 0;
        $("input[name^='harga_barang']").each(function() {
            total += isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());
        });
        $('#total').val(formatRupiah(total));
    }
</script>
@endsection
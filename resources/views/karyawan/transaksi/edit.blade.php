@extends('karyawan.layouts.index')

@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Transaksi</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Data Transaksi</h4>

                        <div class="form-validation">
                            <form class="form-valide" action="{{ route('update.transaksi', $data->id) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $data->id}}">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Nama <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" name="pelanggan_id" id="val-skill">
                                            <option>-- Pilih Pelanggan --</option>
                                            @foreach ($pelanggan as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Jenis Laundry <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" name="produk_id" id="produk">
                                            <option>-- Pilih Jenis Laundry --</option>
                                            @foreach ($produk as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Harga <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" value="" id="harga" name="harga"
                                            placeholder="Masukkan Harga.." readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Berat /kg<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" id="berat" class="form-control" name="berat"
                                            value="{{ $data->berat}}" placeholder="Masukkan Berat.."
                                            onkeyup="hitungTotal()">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Jumlah <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="total" name="jumlah"
                                            placeholder="Masukkan Jumlah..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function hitungTotal() {
    var berat = parseFloat(document.getElementById("berat").value);
    var harga = parseFloat(document.getElementById("harga").value);

    if (!isNaN(berat) && !isNaN(harga)) {
        var jumlah = berat * harga;
        document.getElementById("total").value = jumlah.toFixed();
    } else {
        document.getElementById("total").value = "";
    }
}
</script>
<script>
$('#produk').change(function() {
    var produk_id = $(this).val();
    console.log(produk_id);
    $.ajax({
        url: '/get-harga-produk',
        type: 'GET',
        data: {
            produk_id: produk_id
        },
        success: function(response) {
            $('#harga').val(response.harga);
            hitungTotal();
        },
        error: function(xhr, status, error) {
            console.error(xhr
                .responseText);
            alert("Terjadi kesalahan saat mengambil data harga produk. Silakan coba lagi.");
        }
    });
});
</script>
@endsection
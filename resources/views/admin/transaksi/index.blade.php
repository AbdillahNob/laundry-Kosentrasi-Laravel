@extends('admin.layouts.index')

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
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Transaksi</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        {{-- <th>No Invoice</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th> --}}
                                        <th>Customer</th>
                                        <th>Jenis Laundry</th>
                                        <th>berat</th>
                                        <th>Harga/Kg</th>
                                        <th>Total</th>
                                        <th>Konfirmasi Pembayaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $v)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $v->pelanggan->nama }}</td>
                                        <td>{{ $v->produk->nama }}</td>
                                        <td>{{ $v->berat }} kg</td>
                                        <td>Rp. {{ $v->produk->harga }}</td>
                                        <td>Rp. {{ $v->jumlah }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('transaksi.update-status', $v->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="btn mb-1 btn-rounded 
                                                            {{ $v->status == 'belum_lunas' ? 'btn-danger' : 'btn-success' }}">
                                                    {{ $v->status == 'belum_lunas' ? 'belum_lunas' : 'lunas' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td><span><a href="{{ route('edit.transaksi', $v->id)}}" class="btn btn-warning"
                                                    data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route('destroy.transaksi', $v->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger">
                                                        <i class="fa fa-close color-danger"></i>
                                                    </button>
                                                </form>
                                            </span>
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
        <!-- #/ container -->
    </div>
    <!--**********************************
                                                                                    Content body end
                                                                                ***********************************-->


    <!--**********************************
                                                                                    Footer start
                                                                                ***********************************-->
    <!--**********************************
                                                                                    Footer end
                                                                                    ***********************************-->
    {{-- <div class="footer">
                <div class="copyright">
                    <p>Copyright &copy; Designed & Developed by <a
                            href="https://themeforest.net/user/quixlab">Quixlab</a>
                        2018</p>
                </div>
            </div> --}}
</div>
@endsection
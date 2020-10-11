@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('home') }}" class="btn btn-primary" ><i class="fa fa-arrow-left" > kembali</i></a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Riwayat Pemesanan</li>
                </ol>
              </nav>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fa fa-history" ></i> Riwayat Pemesanan</h3>
                   <table class="table table-striped" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Jumlah Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1 ?>
                        @foreach ($pesanans as $pesanan)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $pesanan->tanggal }}</td>
                            <td>
                                @if ($pesanan->status == 1)
                                    Sudah Pesan dan Belum Bayar
                                @else
                                    Sudah Bayar
                                @endif
                            </td>
                            <td>{{ number_format($pesanan->jumlah_harga+$pesanan->kode) }}</td>
                            <td>
                                <a href="{{ url('history') }}/{{ $pesanan->id }}" class="btn-sm btn-primary" > <i class="fa fa-info" > Detail</i> </a>
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
@endsection

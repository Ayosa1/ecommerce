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
                  <li class="breadcrumb-item active" aria-current="page">{{ $barang->nama_barang }}</li>
                </ol>
              </nav>
        </div>
        <div class="col-md-12 mt-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{ url('upload') }}/{{ $barang->gambar }}" class="rounded mx-auto d-block" width="400" alt="">
                        </div>
                        <div class="col-md-7 mt-5">
                            <h3>{{ $barang->nama_barang }}</h3>
                            <table class="table" >
                                <tbody>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td> Rp. {{number_format($barang->harga)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>:</td>
                                        <td>{{ $barang->stok}}</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top;" >Spekifikasi</td>
                                        <td style="vertical-align: top;">:</td>
                                        <td style="vertical-align: top;">{{$barang->keterangan}}</td>
                                    </tr>
                                   
                                        <tr>
                                            <td>Jumlah Beli</td>
                                            <td>:</td>
                                            <td>
                                                <form action="{{ url('pesan') }}/{{ $barang->id }}" method="POST">
                                                    @csrf
                                                <input type="text" name="jumlah_pesan" class="form-control" required>
                                                <button type="submit" class="btn btn-primary mt-2" ><i class="fa fa-shopping-cart" ></i> Masukan Keranjang</button>
                                            </form> 
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection

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
                  <li class="breadcrumb-item active" aria-current="page">Check Out</li>
                </ol>
              </nav>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fa fa-shopping-cart" ></i> Check Out</h3>
                    @if (!empty($pesan))
                    <p align="right" >Tanggal Pesan : {{ $pesan->tanggal }}</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            ?>
                            @foreach ($pesan_details as $pesan_detail)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><img width="100" src="{{ url('upload') }}/{{ $pesan_detail->barang->gambar }}"  ></td>
                                <td>{{ $pesan_detail->barang->nama_barang }}</td>
                                <td>{{ $pesan_detail->jumlah }}</td>
                                <td align="left" >Rp. {{ number_format($pesan_detail->barang->harga) }}</td>
                                <td align="left">Rp. {{ number_format($pesan_detail->jumlah_harga) }}</td>
                                <td> 
                                    <form action="{{url('check-out')}}/{{ $pesan_detail->id }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button  class="btn-small btn-danger" onclick=" return confirm('Anda Yakin Ingin Menghapus data?');" > <i class="fa fa-trash"></i></button>
                                    </form> 
                                </td>
                            </tr>
                            @endforeach 
                            <tr>
                                <td colspan="4" align="right" > <strong>Total Harga :</strong></td>
                                <td> <strong>Rp. {{number_format($pesan->jumlah_harga)}}</strong></td>
                                <td>
                                    <a href="{{ url('konfirmasi-check-out') }}" onclick=" return confirm('Anda Yakin Ingin Check Out Pemesanan?');" class="btn btn-success" >
                                        <i class="fa fa-shopping-cart"></i>Check Out</a>
                                </td>
                                <td></td>
                            </tr>   
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

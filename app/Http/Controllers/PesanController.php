<?php

namespace App\Http\Controllers;
use App\Barang;
use App\Pesan;
use App\User;
use App\PesananDetail;
use Carbon\Carbon;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Validate;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
        $barang = Barang::where('id', $id)->first();
        return view('pesan.index', compact('barang'));

    }

    public function pesan(request $request, $id)
    {
        // $request->validate([
        //     'user_id'=> 'required|max:255',
        //     'tanggal'=>'required|date',
        //     'status'=>'required|max:255',
        //     'jumlah_harga'=>'required|integer'
        // ]);
        $barang = Barang::where('id',$id)->first();
        $tanggal = Carbon::now();

        //validasi apakah melebihi stock
        if($request->jumlah_pesan > $barang->stok)
        {
            return redirect('pesan/'.$id);
        }

        //validasi cek
        $cek_pesanan = Pesan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        
        if(empty($cek_pesanan))
        {
            $pesan = new pesan;
            $pesan->user_id = Auth::user()->id;
            $pesan->tanggal = $tanggal;
            $pesan->status = 0;
            $pesan->jumlah_harga =0;
            $pesan->kode = mt_rand(100, 999);
            $pesan->save();
        }
       
        //simpan ke database detail
        $pesan_baru = Pesan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        //cek pesanan detail    
        $cek_pesanan_detail = PesananDetail::where('barang_id', $barang->id)
        ->where('pesanan_id', $pesan_baru->id)->first();

        if(empty($cek_pesanan_detail))
        {
            $pesan_detail = new PesananDetail;
            $pesan_detail->barang_id = $barang->id;
            $pesan_detail->pesanan_id = $pesan_baru->id;
            $pesan_detail->jumlah = $request->jumlah_pesan;
            $pesan_detail->jumlah_harga = $barang->harga*$request->jumlah_pesan;
            $pesan_detail->save();
        }else{
            $cek_pesanan_detail = PesananDetail::where('barang_id', $barang->id)
            ->where('pesanan_id', $pesan_baru->id)->first();
            $pesan_detail->jumlah = $pesan_detail->jumlah*$request->jumlah_pesan;

            //harga sekarang
            $harga_pesan_detail_baru = $barang->harga*$request->jumlah_pesan;
            $pesan_detail->jumlah_harga = $pesan_detail->jumlah_harga*$harga_pesan_detail_baru;
            $pesan_detail->update();
        }

        //jumlah total
        $pesan = Pesan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesan->jumlah_harga = $pesan->jumlah_harga+$barang->harga*$request->jumlah_pesan;
        $pesan->update();

        Alert::success('Pembelian berhasil masuk keranjang', 'Success');
        return redirect('check-out');
        

    }

    public function check_out()
    {
        $pesan = Pesan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (!empty($pesan)) 
        {
            $pesan_details = PesananDetail::where('pesanan_id', $pesan->id)->get();
        }
        return view('pesan.check_out', compact('pesan','pesan_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        
        $pesan_detail = PesananDetail::where('id', $id)->first();

        $pesanan = Pesan::where('id', $pesan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga-$pesan_detail->jumlah_harga;
        $pesanan->update();

        $pesan_detail->delete();

        Alert::error('Pembelian berhasil di hapus', 'Hapus');
        return redirect('check-out');
    }

    public function konfirmasi()
    {
        $user = User::where('id', Auth::user()->id)->first();

        if(empty($user->alamat))
        {
            Alert::error('Silahkan Lengkapi Profile anda dulu', 'gagal');
            return redirect('profile');
        }

        if(empty($user->no_hp))
        {
            Alert::error('Silahkan Lengkapi Profile anda dulu', 'gagal');
            return redirect('profile');
        }

        $pesan = Pesan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesan_id = $pesan->id;
        $pesan->status = 1;
        $pesan->update();

        $pesan_details = PesananDetail::where('pesanan_id', $pesan_id)->get();
        foreach ($pesan_details as $pesan_detail) {
            $barang = Barang::where('id',$pesan_detail->barang_id)->first();
            $barang->stok = $barang->stok-$pesan_detail->jumlah;
            $barang->update();
        }

        Alert::success('Check out Berhasil Silahkan Transfer', 'success');
        return redirect('history/'.$pesan_id);
    }
}

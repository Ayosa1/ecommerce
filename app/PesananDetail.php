<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    Protected $guarded = [
        'id'
    ];

    public function barang()
    {
        return $this->belongsTo('App\Barang','barang_id','id');
    }

    public function pesan()
    {
        return $this->belongsTo('App\Pesan','pesanan_id','id');
    }
}

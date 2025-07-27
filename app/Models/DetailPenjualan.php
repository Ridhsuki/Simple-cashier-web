<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = [
        'PenjualanId',
        'ProdukId',
        'harga',
        'JumlahProduk',
        'SubTotal',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'PenjualanId', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ProdukId', 'id');
    }
}

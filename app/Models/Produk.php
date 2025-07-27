<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'Nama',
        'Harga',
        'Stok',
        'Users_id'
    ];
    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class, 'ProdukId', 'id');
    }
}

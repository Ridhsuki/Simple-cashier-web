<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = ['TanggalPenjualan', 'TotalHarga', 'UsersId'];

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'PenjualanId', 'id');
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'UsersId');
    }

    public function bayar()
    {
        return $this->hasOne(Bayar::class, 'PenjualanId');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    protected $fillable = ['PenjualanId', 'TanggalBayar', 'TotalBayar', 'Kembalian', 'StatusBayar', 'JenisBayar'];
}

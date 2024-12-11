<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'id_transaksi',
        'metode',
        'nominal',
        'tanggal_bayar',
    ];

    public $timestamps = false;
}

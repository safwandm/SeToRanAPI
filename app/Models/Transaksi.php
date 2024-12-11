<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'id_motor',
        'id_pelanggan',
        'id_pembayaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_transaksi',
        'durasi',
        'nominal',
    ];

    public $timestamps = false;
}

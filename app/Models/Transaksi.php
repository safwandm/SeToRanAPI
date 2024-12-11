<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_motor', 'id_pelanggan', 'id_pembayaran', 
        'tanggal_mulai', 'tanggal_selesai', 'status_transaksi', 
        'durasi', 'nominal',
    ];

    public function motor()
    {
        return $this->belongsTo(Motor::class, 'id_motor');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}

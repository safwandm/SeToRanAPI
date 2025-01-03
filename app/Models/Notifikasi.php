<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $primaryKey = 'id_notifikasi';
    protected $fillable = [
        'id_pengguna', 'judul', 'deskripsi',
        'navigasi', // enum kalau notif di klik route ke mana e.g. profile, transaksi
        'data_navigasi', // data tambahan e.g. id_transaksi kalau navigasi ke transaksi
        'is_sent', // kalau is_sent false buat local notification terus update api call ke db is_sent = true, cuma perlu kalau gak jadi pake firebase push notif
        'is_read' 
    ];
}

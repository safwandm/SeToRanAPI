<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Pengguna extends Model
{
    use HasFactory, HasApiTokens;

    protected $primaryKey = 'id_pengguna';
    protected $fillable = [
        'nama', 'email', 'password', 'tanggal_lahir',
        'nomor_telepon', 'umur', 'nomor_KTP', 'alamat',
    ];

    public function sendNotif($judul, $deskripsi, $navigasi, $dataNavigasi)
    {
        $notif = new Notifikasi;
        $notif->id_pengguna = $this->id_pengguna;
        $notif->judul = $judul;
        $notif->deskripsi = $deskripsi;
        $notif->navigasi = $navigasi;
        $notif->data_navigasi = $dataNavigasi;
        $notif->is_sent = false; // kalau jadi pake firebase hapus
        $notif->is_read = false;

        $notif->save();

        // send firebase notif, perlu send notif id juga buat update is_read
    }   
}

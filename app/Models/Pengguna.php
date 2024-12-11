<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'pengguna';

    protected $fillable = [
        'nama',
        'email',
        'username',
        'password',
        'tanggal_lahir',
        'nomor_telepon',
        'nomor_KTP',
        'alamat',
    ];

    public $timestamps = false;
}

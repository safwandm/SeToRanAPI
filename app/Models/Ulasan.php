<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';

    protected $fillable = [
        'id_motor',
        'id_pelanggan',
        'rating',
        'komentar',
        'tanggal_ulasan',
    ];

    public $timestamps = false;
}

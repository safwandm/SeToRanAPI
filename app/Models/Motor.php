<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    protected $table = 'motor';

    protected $fillable = [
        'plat_nomor',
        'id_mitra',
        'nomor_STNK',
        'nomor_BPKB',
        'brand',
        'tipe',
        'tahun',
        'transmisi',
        'status_motor',
        'harga_harian',
    ];

    public $timestamps = false;
}

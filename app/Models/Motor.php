<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_motor';
    protected $fillable = [
        'plat_nomor', 'id_mitra', 'nomor_STNK', 'nomor_BPKB',
        'model', 'brand', 'tipe', 'tahun', 'transmisi',
        'status_motor', 'harga_harian',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra');
    }
}

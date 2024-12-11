<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_ulasan';
    protected $fillable = [
        'id_motor', 'id_pelanggan', 'rating', 'komentar', 'tanggal_ulasan',
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

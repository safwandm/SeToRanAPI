<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $table = 'diskons';
    
    protected $fillable = [
        'nama',
        'status_promo',
        'tanggal_mulai',
        'tanggal_akhir'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_akhir' => 'date'
    ];

    public function scopeAktif($query)
    {
        return $query->where('status_promo', 'aktif')
                    ->whereDate('tanggal_mulai', '<=', now())
                    ->whereDate('tanggal_akhir', '>=', now());
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherUsed extends Model
{
    protected $fillable = [
        'id_voucher', 
        'id_pengguna'  
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
}

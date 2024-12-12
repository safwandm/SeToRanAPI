<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_voucher';
    protected $fillable = [
        'nama_voucher', 'status_voucher', 'tanggal_mulai', 'tanggal_akhir'
    ];
}

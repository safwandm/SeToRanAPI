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
}

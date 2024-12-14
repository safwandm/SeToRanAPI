<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

// terpisah sama pengguna?
class Admin extends Model
{
    use HasFactory, HasApiTokens;

    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];
}

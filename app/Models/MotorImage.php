<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotorImage extends Model
{
    protected $fillable = [
        'id_gambar',
        'id_motor',
        'label' 
    ];
}

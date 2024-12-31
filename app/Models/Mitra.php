<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    
    protected $primaryKey = 'id_mitra';
    protected $fillable = ['id_pengguna','status'];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function motors()
    {
        return $this->hasMany(Motor::class);  
    }

}

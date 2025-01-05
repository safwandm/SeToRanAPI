<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_voucher';
    protected $fillable = [
        'nama_voucher', 
        'status_voucher', 
        'tanggal_mulai', 
        'tanggal_akhir', 
        'persen_voucher', 
        'kode_voucher'    
    ];

    public static function getActive() 
    {
        $query = Voucher::query();
    
        $query->where('status_voucher', "aktif");
    
        // Default to the current date if no date is provided
        $currentDate = $currentDate ?? now();
    
        $query->where('tanggal_mulai', '<=', $currentDate)
              ->where('tanggal_akhir', '>=', $currentDate);
    
        return $query;
    }
}

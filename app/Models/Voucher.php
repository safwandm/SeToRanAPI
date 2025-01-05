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

    public static function getActive($id_pengguna=null) 
    {
        $query = Voucher::query();
    
        $query->where('status_voucher', "aktif");
    
        // Default to the current date if no date is provided
        $currentDate = $currentDate ?? now();
    
        $query->where('tanggal_mulai', '<=', $currentDate)
              ->where('tanggal_akhir', '>=', $currentDate);
    
        if (!is_null($id_pengguna)) {
            $query->whereNotIn('id_voucher', function ($subQuery) use ($id_pengguna) {
                $subQuery->select('id_voucher')
                            ->from('voucher_useds')
                            ->where('id_pengguna', $id_pengguna);
            });
        }
        
        return $query;
    }

    public function useVoucher($id_pengguna)
    {
        VoucherUsed::create([
            "id_pengguna" => $id_pengguna,
            "id_voucher" => $this->id_voucher
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use App\Models\Voucher;
use App\Models\VoucherUsed;
use Illuminate\Support\Str;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {

            $tanggalMulai = fake()->date('Y-m-d');
            $tanggalAkhir = date('Y-m-d', strtotime($tanggalMulai . ' + ' . random_int(1, 10) . ' days'));
        
            $voucher = Voucher::create([
                'nama_voucher' => fake()->words(2, true),
                'status_voucher' => fake()->randomElement(['aktif', 'nonAktif']),
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_akhir' => $tanggalAkhir,
                'persen_voucher' => fake()->numberBetween(5, 50),
                'kode_voucher' => Str::upper(fake()->bothify('PROMO##??')),
            ]);
            
            $users = Pengguna::all(); 
            foreach ($users as $user) {
                if (fake()->boolean(50)) { 
                    $createdAt = fake()->dateTimeBetween($voucher->tanggal_mulai, $voucher->tanggal_akhir)->format('Y-m-d H:i:s');
        
                    VoucherUsed::create([
                        'id_voucher' => $voucher->id_voucher,
                        'id_pengguna' => $user->id_pengguna,
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt,
                    ]);
                }
            }
        }
    }
}

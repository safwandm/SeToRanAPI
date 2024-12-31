<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voucher;
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
        // Create 10 sample vouchers
        for ($i = 0; $i < 10; $i++) {
            Voucher::create([
                'nama_voucher' => fake()->words(2, true), 
                'status_voucher' => fake()->randomElement(['aktif', 'nonAktif']),
                'tanggal_mulai' => fake()->date('Y-m-d'), 
                'tanggal_akhir' => fake()->date('Y-m-d'),
                'persen_voucher' => fake()->numberBetween(5, 50), 
                'kode_voucher' => Str::upper(fake()->bothify('PROMO##??')), 
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MotorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Get all mitra IDs
        $mitraIds = DB::table('mitras')->pluck('id_mitra');

        // Create motor records for some of the mitras
        foreach ($mitraIds as $mitraId) {
            // Randomly skip some mitras (70% chance to create a motor)
            if ($faker->boolean(70)) {
                DB::table('motors')->insert([
                    'id_mitra' => $mitraId,
                    'plat_nomor' => $faker->numerify('##-###-##'), // 8 digit nomor polisi
                    'nomor_STNK' => $faker->numerify('##########'), // 10 digit STNK
                    'nomor_BPKB' => $faker->numerify('##########'), // 10 digit BPKB
                    'model' => $faker->randomElement(['Vario', 'Beat', 'Scoopy', 'Supra X']),
                    'brand' => $faker->randomElement(['Honda', 'Yamaha', 'Suzuki', 'Kawasaki']),
                    'tipe' => $faker->randomElement(['Scooter', 'Sport', 'Bebek']),
                    'tahun' => $faker->numberBetween(2010, 2021),
                    'transmisi' => $faker->randomElement(['Manual', 'Matic']),
                    'status_motor' => $faker->randomElement(['Tersedia', 'Disewa', 'Dipesan', 'Dalam Perbaikan', 'Tidak Tersedia']),
                    'harga_harian' => $faker->numberBetween(50000, 200000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

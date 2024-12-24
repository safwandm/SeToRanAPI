<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // Get all pengguna IDs
        $penggunaIds = DB::table('penggunas')->pluck('id_pengguna');
        
        // Create pelanggan records for some of the penggunas
        foreach ($penggunaIds as $penggunaId) {
            // Randomly skip some penggunas (70% chance to create a pelanggan)
            if ($faker->boolean(70)) {
                DB::table('pelanggans')->insert([
                    'id_pengguna' => $penggunaId,
                    'nomor_SIM' => $faker->numerify('##########'), // 10 digit SIM
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

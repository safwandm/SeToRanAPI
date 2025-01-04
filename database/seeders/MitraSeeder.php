<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        //ambil id pengguna vie table pelanggan
        $penggunaIds = DB::table('pelanggans')->pluck('id_pengguna');

        // Create mitra records for all of penggunas
        foreach ($penggunaIds as $penggunaId) {
            if ($faker->boolean(70)) {
                DB::table('mitras')->insert([
                    'id_pengguna' => $penggunaId, 
                    'status' => $faker->randomElement(['active', 'inactive']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Create 10 penggunas
        for ($i = 0; $i < 10; $i++) {
            DB::table('penggunas')->insert([
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'tanggal_lahir' => $faker->date('Y-m-d', '-18 years'),
                'nomor_telepon' => $faker->phoneNumber,
                'umur' => $faker->numberBetween(18, 65),
                'nomor_KTP' => $faker->numerify('################'), // 16 digit KTP
                'alamat' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

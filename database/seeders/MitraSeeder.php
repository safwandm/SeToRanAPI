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

        // Ambil semua id pengguna dari tabel pelanggan
        $penggunaIds = DB::table('pelanggans')->pluck('id_pengguna');

        // Tentukan berapa banyak mitra yang memiliki status 'active'
        $activeCount = ceil(count($penggunaIds) / 2); // Misalnya, setengah dari pengguna aktif

        $counter = 0; // Counter untuk menghitung berapa banyak yang diberi status 'active'

        // Loop untuk menambah data mitra
        foreach ($penggunaIds as $penggunaId) {
            $status = ($counter < $activeCount) ? 'active' : 'inactive'; // Tentukan status

            DB::table('mitras')->insert([
                'id_pengguna' => $penggunaId,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $counter++; // Increment counter
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Http;
use App\Models\ImageData;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // buat manual soalnya kalau pake faker terlalu random
        $data = [
            [
                "nama" => "Ahmad Suhendra",
                "email" => "ahmad.suhendra@gmail.com",
                "nomor_telepon" => "081234567890",
                "nomor_KTP" => "3171022304950001",
                "alamat" => "Jl. Mawar No. 10, Bandung"
            ],
            [
                "nama" => "Siti Nurhaliza",
                "email" => "siti.nurhaliza@yahoo.com",
                "nomor_telepon" => "082145678901",
                "nomor_KTP" => "3171022304950002",
                "alamat" => "Jl. Melati No. 15, Bandung"
            ],
            [
                "nama" => "Budi Santoso",
                "email" => "budi.santoso@hotmail.com",
                "nomor_telepon" => "083156789012",
                "nomor_KTP" => "3171022304950003",
                "alamat" => "Jl. Anggrek No. 20, Bandung"
            ],
            [
                "nama" => "Dewi Lestari",
                "email" => "dewi.lestari@gmail.com",
                "nomor_telepon" => "084167890123",
                "nomor_KTP" => "3171022304950004",
                "alamat" => "Jl. Dahlia No. 25, Bandung"
            ],
            [
                "nama" => "Eko Prasetyo",
                "email" => "eko.prasetyo@yahoo.com",
                "nomor_telepon" => "085178901234",
                "nomor_KTP" => "3171022304950005",
                "alamat" => "Jl. Kenanga No. 30, Bandung"
            ],
            [
                "nama" => "Fitri Indah",
                "email" => "fitri.indah@gmail.com",
                "nomor_telepon" => "086189012345",
                "nomor_KTP" => "3171022304950006",
                "alamat" => "Jl. Tulip No. 35, Bandung"
            ],
            [
                "nama" => "Gunawan Wibowo",
                "email" => "gunawan.wibowo@hotmail.com",
                "nomor_telepon" => "087190123456",
                "nomor_KTP" => "3171022304950007",
                "alamat" => "Jl. Teratai No. 40, Bandung"
            ],
            [
                "nama" => "Heni Kusuma",
                "email" => "heni.kusuma@yahoo.com",
                "nomor_telepon" => "088112345678",
                "nomor_KTP" => "3171022304950008",
                "alamat" => "Jl. Lotus No. 45, Bandung"
            ],
            [
                "nama" => "Irfan Hakim",
                "email" => "irfan.hakim@gmail.com",
                "nomor_telepon" => "089123456789",
                "nomor_KTP" => "3171022304950009",
                "alamat" => "Jl. Flamboyan No. 50, Bandung"
            ],
            [
                "nama" => "Joko Widodo",
                "email" => "joko.widodo@yahoo.com",
                "nomor_telepon" => "081234567891",
                "nomor_KTP" => "3171022304950010",
                "alamat" => "Jl. Bougenville No. 55, Bandung"
            ],
            [
                "nama" => "Kartika Sari",
                "email" => "kartika.sari@hotmail.com",
                "nomor_telepon" => "082145678902",
                "nomor_KTP" => "3171022304950011",
                "alamat" => "Jl. Kamboja No. 60, Bandung"
            ],
            [
                "nama" => "Lukman Hakim",
                "email" => "lukman.hakim@gmail.com",
                "nomor_telepon" => "083156789013",
                "nomor_KTP" => "3171022304950012",
                "alamat" => "Jl. Orchid No. 65, Bandung"
            ],
            [
                "nama" => "Maya Angelina",
                "email" => "maya.angelina@yahoo.com",
                "nomor_telepon" => "084167890124",
                "nomor_KTP" => "3171022304950013",
                "alamat" => "Jl. Lily No. 70, Bandung"
            ],
            [
                "nama" => "Nugroho Pratama",
                "email" => "nugroho.pratama@gmail.com",
                "nomor_telepon" => "085178901235",
                "nomor_KTP" => "3171022304950014",
                "alamat" => "Jl. Jasmine No. 75, Bandung"
            ],
            [
                "nama" => "Olivia Putri",
                "email" => "olivia.putri@hotmail.com",
                "nomor_telepon" => "086189012346",
                "nomor_KTP" => "3171022304950015",
                "alamat" => "Jl. Sakura No. 80, Bandung"
            ]
        ];

        // Create 15 penggunas
        foreach ($data as $item) {
            $username = $item["nama"];
            $tanggalLahir = $faker->dateTimeBetween('-27 years', '-17 years')->format('Y-m-d');
            $response = Http::get('https://avatar.iran.liara.run/username?username=' . str_replace(' ', '+', $username));
            if ($response->successful()) {
                $imageData = new ImageData();
                $imageData->data = $response->body();
                $imageData->save();
                DB::table('penggunas')->insert([
                    'nama' => $item["nama"],
                    'email' => $item["email"],
                    'password' => Hash::make('password123'), //buat default biar gampang nyoba login
                    'tanggal_lahir' => $tanggalLahir,
                    'nomor_telepon' => $item["nomor_telepon"],
                    'umur' => now()->diffInYears($tanggalLahir),
                    'nomor_KTP' => $item["nomor_KTP"],
                    'alamat' => $item["alamat"],
                    'id_gambar' => $imageData->id_gambar,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

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

        $possiblePrices = range(50000, 100000, 5000);

        $data = [
            [
                "plat_nomor" => "B 1234 ABC",
                "nomor_STNK" => "12345678901234567",
                "nomor_BPKB" => "A12345678",
                "brand" => "Honda",
                "model" => "PCX",
                "tipe" => "Scooter",
                "tahun" => 2023,
                "transmisi" => "Matic",
                "harga_harian" => 120000
            ],
            [
                "plat_nomor" => "B 2345 DEF",
                "nomor_STNK" => "23456789012345678",
                "nomor_BPKB" => "B23456789",
                "brand" => "Yamaha",
                "model" => "NMAX",
                "tipe" => "Scooter",
                "tahun" => 2022,
                "transmisi" => "Matic",
                "harga_harian" => 110000
            ],
            [
                "plat_nomor" => "B 3456 GHI",
                "nomor_STNK" => "34567890123456789",
                "nomor_BPKB" => "C34567890",
                "brand" => "Honda",
                "model" => "Vario",
                "tipe" => "Scooter",
                "tahun" => 2023,
                "transmisi" => "Matic",
                "harga_harian" => 90000
            ],
            [
                "plat_nomor" => "B 4567 JKL",
                "nomor_STNK" => "45678901234567890",
                "nomor_BPKB" => "D45678901",
                "brand" => "Yamaha",
                "model" => "XSR",
                "tipe" => "Sport",
                "tahun" => 2022,
                "transmisi" => "Manual",
                "harga_harian" => 125000
            ],
            [
                "plat_nomor" => "B 5678 MNO",
                "nomor_STNK" => "56789012345678901",
                "nomor_BPKB" => "E56789012",
                "brand" => "Kawasaki",
                "model" => "Ninja",
                "tipe" => "Sport",
                "tahun" => 2023,
                "transmisi" => "Manual",
                "harga_harian" => 125000
            ],
            [
                "plat_nomor" => "B 6789 PQR",
                "nomor_STNK" => "67890123456789012",
                "nomor_BPKB" => "F67890123",
                "brand" => "Honda",
                "model" => "Beat",
                "tipe" => "Scooter",
                "tahun" => 2022,
                "transmisi" => "Matic",
                "harga_harian" => 90000
            ],
            [
                "plat_nomor" => "B 7890 STU",
                "nomor_STNK" => "78901234567890123",
                "nomor_BPKB" => "G78901234",
                "brand" => "Honda",
                "model" => "Scoopy",
                "tipe" => "Scooter",
                "tahun" => 2023,
                "transmisi" => "Matic",
                "harga_harian" => 90000
            ],
            [
                "plat_nomor" => "B 8901 VWX",
                "nomor_STNK" => "89012345678901234",
                "nomor_BPKB" => "H89012345",
                "brand" => "Honda",
                "model" => "Supra X",
                "tipe" => "Bebek",
                "tahun" => 2022,
                "transmisi" => "Manual",
                "harga_harian" => 80000
            ],
            [
                "plat_nomor" => "B 9012 YZA",
                "nomor_STNK" => "90123456789012345",
                "nomor_BPKB" => "I90123456",
                "brand" => "Honda",
                "model" => "ADV",
                "tipe" => "Scooter",
                "tahun" => 2023,
                "transmisi" => "Matic",
                "harga_harian" => 110000
            ],
            [
                "plat_nomor" => "B 0123 BCD",
                "nomor_STNK" => "01234567890123456",
                "nomor_BPKB" => "J01234567",
                "brand" => "Vespa",
                "model" => "Sprint",
                "tipe" => "Scooter",
                "tahun" => 2022,
                "transmisi" => "Matic",
                "harga_harian" => 125000
            ],
            [
                "plat_nomor" => "B 1357 EFG",
                "nomor_STNK" => "13579246801357924",
                "nomor_BPKB" => "K13579246",
                "brand" => "Yamaha",
                "model" => "Mio",
                "tipe" => "Scooter",
                "tahun" => 2023,
                "transmisi" => "Matic",
                "harga_harian" => 90000
            ],
            [
                "plat_nomor" => "B 2468 HIJ",
                "nomor_STNK" => "24680135792468013",
                "nomor_BPKB" => "L24680135",
                "brand" => "Yamaha",
                "model" => "Lexi",
                "tipe" => "Scooter",
                "tahun" => 2023,
                "transmisi" => "Matic",
                "harga_harian" => 110000
            ],
            [
                "plat_nomor" => "B 3579 KLM",
                "nomor_STNK" => "35792468013579246",
                "nomor_BPKB" => "M35792468",
                "brand" => "Yamaha",
                "model" => "Jupiter",
                "tipe" => "Bebek",
                "tahun" => 2022,
                "transmisi" => "Manual",
                "harga_harian" => 80000
            ],
            [
                "plat_nomor" => "B 4680 NOP",
                "nomor_STNK" => "46801357924680135",
                "nomor_BPKB" => "N46801357",
                "brand" => "Honda",
                "model" => "Genio",
                "tipe" => "Scooter",
                "tahun" => 2023,
                "transmisi" => "Matic",
                "harga_harian" => 90000
            ],
            [
                "plat_nomor" => "B 5791 QRS",
                "nomor_STNK" => "57913579246801357",
                "nomor_BPKB" => "O57913579",
                "brand" => "Suzuki",
                "model" => "Address",
                "tipe" => "Scooter",
                "tahun" => 2022,
                "transmisi" => "Matic",
                "harga_harian" => 90000
            ]
        ];

        // Create motor records
        foreach ($mitraIds as $index => $mitraId) {
            // isert image data 4x

            $idMotor = DB::table('motors')->insertGetId([
                'id_mitra' => $mitraId,
                'plat_nomor' => $data[$index]['plat_nomor'],
                'nomor_STNK' => $data[$index]['nomor_STNK'],
                'nomor_BPKB' => $data[$index]['nomor_BPKB'],
                'model' => $data[$index]['model'],
                'brand' => $data[$index]['brand'],
                'tipe' => $data[$index]['tipe'],
                'tahun' => $data[$index]['tahun'],
                'transmisi' => $data[$index]['transmisi'],
                'status_motor' => "Tersedia",
                'harga_harian' => $data[$index]['harga_harian'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

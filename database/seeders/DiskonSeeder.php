<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DiskonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $data = [
            [
                'nama' => 'Diskon Awal Tahun',
                'status_promo' => 'aktif',
                'tanggal_mulai' => $faker->dateTimeBetween('-20 days', '-10 days'),
                'tanggal_akhir' => $faker->dateTimeBetween('now', '+20 days'),
            ],
            [
                'nama' => 'Promo Kemerdekaan',
                'status_promo' => 'aktif',
                'tanggal_mulai' => $faker->dateTimeBetween('-40 days', '-30 days'),
                'tanggal_akhir' => $faker->dateTimeBetween('-10 days', '-5 days'),
            ],
            [
                'nama' => 'Diskon Akhir Pekan',
                'status_promo' => 'aktif',
                'tanggal_mulai' => $faker->dateTimeBetween('-10 days', '-5 days'),
                'tanggal_akhir' => $faker->dateTimeBetween('now', '+2 days'),
            ],
            [
                'nama' => 'Flash Sale Spesial',
                'status_promo' => 'nonaktif',
                'tanggal_mulai' => $faker->dateTimeBetween('-30 days', '-20 days'),
                'tanggal_akhir' => $faker->dateTimeBetween('-20 days', '-10 days'),
            ],
            [
                'nama' => 'Promo Akhir Bulan',
                'status_promo' => 'aktif',
                'tanggal_mulai' => $faker->dateTimeBetween('+3 days', '+5 days'),
                'tanggal_akhir' => $faker->dateTimeBetween('+10 days', '+15 days'),
            ],
            [
                'nama' => 'Diskon Spesial Member',
                'status_promo' => 'aktif',
                'tanggal_mulai' => $faker->dateTimeBetween('-20 days', '-15 days'),
                'tanggal_akhir' => $faker->dateTimeBetween('now', '+5 days'),
            ],
            [
                'nama' => 'Diskon Hari Belanja',
                'status_promo' => 'nonaktif',
                'tanggal_mulai' => $faker->dateTimeBetween('-50 days', '-40 days'),
                'tanggal_akhir' => $faker->dateTimeBetween('-30 days', '-20 days'),
            ],
            [
                'nama' => 'Promo Back to School',
                'status_promo' => 'aktif',
                'tanggal_mulai' => $faker->dateTimeBetween('-10 days', '-7 days'),
                'tanggal_akhir' => $faker->dateTimeBetween('now', '+7 days'),
            ],
            [
                'nama' => 'Diskon Akhir Tahun',
                'status_promo' => 'nonaktif',
                'tanggal_mulai' => $faker->dateTimeBetween('+10 days', '+15 days'),
                'tanggal_akhir' => $faker->dateTimeBetween('+20 days', '+30 days'),
            ],
            [
                'nama' => 'Promo Hari Spesial',
                'status_promo' => 'aktif',
                'tanggal_mulai' => $faker->dateTimeBetween('-5 days', '-3 days'),
                'tanggal_akhir' => $faker->dateTimeBetween('now', '+10 days'),
            ],
        ];

        foreach ($data as $diskon) {
            DB::table('diskons')->insert($diskon);
        }
    }
}

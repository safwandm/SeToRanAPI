<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiskonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Diskon Awal Tahun',
                'status_promo' => 'aktif',
                'tanggal_mulai' => now()->subDays(10),
                'tanggal_akhir' => now()->addDays(20),
            ],
            [
                'nama' => 'Promo Kemerdekaan',
                'status_promo' => 'aktif',
                'tanggal_mulai' => now()->subDays(30),
                'tanggal_akhir' => now()->subDays(5),
            ],
            [
                'nama' => 'Diskon Akhir Pekan',
                'status_promo' => 'aktif',
                'tanggal_mulai' => now()->subDays(5),
                'tanggal_akhir' => now()->addDays(2),
            ],
            [
                'nama' => 'Flash Sale Spesial',
                'status_promo' => 'nonaktif',
                'tanggal_mulai' => now()->subDays(20),
                'tanggal_akhir' => now()->subDays(10),
            ],
            [
                'nama' => 'Promo Akhir Bulan',
                'status_promo' => 'aktif',
                'tanggal_mulai' => now()->addDays(3),
                'tanggal_akhir' => now()->addDays(10),
            ],
            [
                'nama' => 'Diskon Spesial Member',
                'status_promo' => 'aktif',
                'tanggal_mulai' => now()->subDays(15),
                'tanggal_akhir' => now()->addDays(5),
            ],
            [
                'nama' => 'Diskon Hari Belanja',
                'status_promo' => 'nonaktif',
                'tanggal_mulai' => now()->subDays(40),
                'tanggal_akhir' => now()->subDays(20),
            ],
            [
                'nama' => 'Promo Back to School',
                'status_promo' => 'aktif',
                'tanggal_mulai' => now()->subDays(7),
                'tanggal_akhir' => now()->addDays(7),
            ],
            [
                'nama' => 'Diskon Akhir Tahun',
                'status_promo' => 'nonaktif',
                'tanggal_mulai' => now()->addDays(15),
                'tanggal_akhir' => now()->addDays(30),
            ],
            [
                'nama' => 'Promo Hari Spesial',
                'status_promo' => 'aktif',
                'tanggal_mulai' => now()->subDays(3),
                'tanggal_akhir' => now()->addDays(10),
            ],
        ];

        foreach ($data as $diskon) {
            DB::table('diskons')->insert($diskon);
        }
    }
}

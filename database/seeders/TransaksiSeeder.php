<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Motor;
use DateInterval;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $id_pelanggans = DB::table('pelanggans')->pluck('id_pelanggan');
        $motors = Motor::all();
        $datas = [];
        foreach ($id_pelanggans as $id_pelanggan) {
            $tanggal_sewa = $faker->dateTimeBetween('-1 month', 'now');
            $tanggal_kembali = clone $tanggal_sewa;
            $tanggal_kembali->add(new DateInterval('P' . rand(1, 2) . 'D'));
            $motor = $motors->random();
            $durasi = $tanggal_sewa->diff($tanggal_kembali)->days;
            DB::table('transaksis')->insert([
                'id_pelanggan' => $id_pelanggan,
                'id_motor' => $motor->id_motor,
                'tanggal_mulai' => $tanggal_sewa,
                'tanggal_selesai' => $tanggal_kembali,
                'status_transaksi' => 'berlangsung',
                'durasi' => $durasi,
                'nominal' => $motor->harga_harian * $durasi,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

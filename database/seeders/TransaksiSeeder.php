<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Motor; // Add this import statement
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
        $id_motors = DB::table('motors')->pluck('id_motor');
        $datas = [];
        foreach ($id_pelanggans as $id_pelanggan) {
            $tanggal_sewa = $faker->dateTimeBetween('-1 month', 'now');
            $tanggal_kembali = $tanggal_sewa->add(new DateInterval('P' . rand(1, 2) . 'D'));
            $id_motor = $id_motors->random();
            DB::table('transaksis')->insert([
                'id_pelanggan' => $id_pelanggan,
                'id_motor' => $id_motor,
                'tanggal_mulai' => $tanggal_sewa,
                'tanggal_selesai' => $tanggal_kembali,
                'status_transaksi' => 'Berlangsung',
                'durasi' => $tanggal_sewa->diff($tanggal_kembali)->days,
                'nominal' => Motor::find($id_motor)->harga_harian * $tanggal_sewa->diff($tanggal_kembali)->days, // Updated line
            ]);
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            DB::statement("
                CREATE VIEW transaksi_motor_pelanggan_view AS
                SELECT
                    transaksis.id_transaksi,
                    transaksis.id_motor,
                    transaksis.id_pelanggan,
                    transaksis.id_pembayaran,
                    transaksis.tanggal_mulai,
                    transaksis.tanggal_selesai,
                    transaksis.status_transaksi,
                    transaksis.durasi,
                    transaksis.nominal,
                    motors.plat_nomor,
                    motors.nomor_STNK,
                    motors.nomor_BPKB,
                    motors.model,
                    motors.brand,
                    motors.tipe,
                    motors.tahun,
                    motors.transmisi,
                    motors.status_motor,
                    motors.harga_harian,
                    pelanggans.nomor_SIM,
                    penggunas.nama,
                    penggunas.email,
                    penggunas.password,
                    penggunas.tanggal_lahir,
                    penggunas.umur,
                    penggunas.nomor_KTP,
                    penggunas.nomor_telepon,
                    penggunas.alamat
                FROM transaksis
                LEFT JOIN motors ON transaksis.id_motor = motors.id_motor
                LEFT JOIN pelanggans ON transaksis.id_pelanggan = pelanggans.id_pelanggan
                LEFT JOIN penggunas ON pelanggans.id_pengguna = penggunas.id_pengguna;
                ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_motor_pelanggan_view');
    }
};

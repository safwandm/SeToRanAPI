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
            CREATE VIEW pengguna_pelanggan_view AS
            SELECT
                pelanggans.id_pelanggan,
                pelanggans.nomor_SIM,
                penggunas.nama,
                penggunas.email,
                penggunas.password,
                penggunas.tanggal_lahir,
                penggunas.umur,
                penggunas.nomor_KTP,
                penggunas.alamat
            FROM pelanggans
            JOIN penggunas ON pelanggans.id_pengguna = penggunas.id_pengguna;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna_pelanggan_view');
    }
};

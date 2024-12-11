<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Table: Pengguna
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->string('nama', 255);
            $table->string('email', 255)->unique();
            $table->string('username', 32)->unique();
            $table->string('password', 32);
            $table->date('tanggal_lahir');
            $table->string('nomor_telepon', 13);
            $table->string('nomor_KTP', 16);
            $table->string('alamat', 255);
            $table->integer('umur')->virtualAs('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE())');
        });

        // Table: Pelanggan
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('id_pelanggan');
            $table->foreignId(column: 'id_pengguna')->references('id_pengguna')->on('pengguna');
        });

        // Table: Mitra
        Schema::create('mitra', function (Blueprint $table) {
            $table->id('id_mitra');
            $table->foreignId(column: 'id_pengguna')->references('id_pengguna')->on('pengguna');
        });

        // Table: Motor
        Schema::create('motor', function (Blueprint $table) {
            $table->id('id_motor');
            $table->string('plat_nomor', 9);
            $table->foreignId('id_mitra')->references('id_mitra')->on('mitra');
            $table->string('nomor_STNK', 8);
            $table->string('nomor_BPKB', 12);
            $table->text('deskripsi');
            $table->string('brand', 16);
            $table->string('tipe', 32);
            $table->year('tahun');
            $table->string('transmisi', 32);
            $table->string('status_motor', 32);
            $table->integer('harga_harian');
        });

        // Table: Transaksi
        Schema::create('transaksi', callback: function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_motor')->references('id_motor')->on('motor');
            $table->foreignId('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('status_transaksi', 32);
            $table->integer('durasi');
            $table->integer('nominal');
        });

        // Table: Pembayaran
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_transaksi')->references('id_transaksi')->on('transaksi');
            $table->string('metode', 16);
            $table->integer('nominal');
            $table->date('tanggal_bayar');
        });

        // Menambahkan foreign key setelah migrasi awal karena adanya circular foreign key antara tabel pembayaran dan transaksi
        Schema::table('transaksi', function (Blueprint $table) {
            $table->foreignId('id_pembayaran')->nullable()->constrained('pembayaran')->references('id_pembayaran')->on('pembayaran');
        });        

        // Table: Ulasan
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id('id_ulasan');
            $table->foreignId('id_motor')->references('id_motor')->on('motor');
            $table->foreignId('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
            $table->integer('rating')->checkBetween(1, 5);
            $table->string('komentar', 255);
            $table->date('tanggal_ulasan');
        });

        // Table: Diskon
        Schema::create('diskon', function (Blueprint $table) {
            $table->id('id_ulasan');
            $table->foreignId('id_motor')->references('id_motor')->on('motor');
            $table->foreignId('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
            $table->integer('rating')->checkBetween(1, 5);
            $table->string('komentar', 255);
            $table->date('tanggal_ulasan');
        });
    }

    // | Kerjakan nanti
    // V 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('pengguna');
        // Schema::dropIfExists('ulasan');
        // Schema::dropIfExists('pembayaran');
        // Schema::dropIfExists('transaksi');
        // Schema::dropIfExists('motor');
        // Schema::dropIfExists('mitra');
        // Schema::dropIfExists('pelanggan');
    }
};

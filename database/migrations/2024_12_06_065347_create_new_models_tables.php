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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('penggunas', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->date('tanggal_lahir');
            $table->string('nomor_telepon')->nullable();
            $table->integer('umur')->nullable();
            $table->string('nomor_KTP')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
        
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id('id_pelanggan');
            $table->foreignId('id_pengguna')->constrained('pengguna')->onDelete('cascade');
            $table->string('nomor_SIM');
            $table->timestamps();
        });
        
        Schema::create('mitras', function (Blueprint $table) {
            $table->id('id_mitra');
            $table->foreignId('id_pengguna')->constrained('pengguna')->onDelete('cascade');
            $table->timestamps();
        });
        
        Schema::create('motors', function (Blueprint $table) {
            $table->id('id_motor');
            $table->string('plat_nomor')->unique();
            $table->foreignId('id_mitra')->constrained('mitra')->onDelete('cascade');
            $table->string('nomor_STNK');
            $table->string('nomor_BPKB');
            $table->string('model');
            $table->string('brand');
            $table->string('tipe');
            $table->integer('tahun');
            $table->string('transmisi');
            $table->string('status_motor');
            $table->decimal('harga_harian', 10, 2);
            $table->timestamps();
        });
        
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_motor')->constrained('motor')->onDelete('cascade');
            $table->foreignId('id_pelanggan')->constrained('pelanggan')->onDelete('cascade');
            $table->foreignId('id_pembayaran')->nullable()->constrained('pembayaran')->onDelete('cascade');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('status_transaksi');
            $table->integer('durasi');
            $table->decimal('nominal', 10, 2);
            $table->timestamps();
        });
        
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id('id_ulasan');
            $table->foreignId('id_motor')->constrained('motor')->onDelete('cascade');
            $table->foreignId('id_pelanggan')->constrained('pelanggan')->onDelete('cascade');
            $table->tinyInteger('rating')->unsigned();
            $table->text('komentar')->nullable();
            $table->timestamp('tanggal_ulasan');
            $table->timestamps();
        });
        
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_transaksi')->constrained('transaksi')->onDelete('cascade');
            $table->string('metode');
            $table->decimal('nominal', 10, 2);
            $table->timestamp('tanggal_bayar');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};

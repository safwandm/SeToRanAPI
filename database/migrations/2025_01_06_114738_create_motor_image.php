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
        Schema::create('motor_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_gambar')->references('id_gambar')->on('image_data');
            $table->foreignId('id_motor')->references('id_motor')->on('motors');
            $table->string('label')->nullable(); // ["depan", "belakang", "kiri", "kanan"]
            $table->timestamps();
        });

        // ternyata di sqlite gak bisa ubah table kalau di pake di view, jadi migrasi create view nya di pindah ke bawah migrasi ini biar gak perlu reset db
        Schema::dropIfExists('pengguna_pelanggan_view');
        Schema::dropIfExists('transaksi_motor_pelanggan_view');
        Schema::table('penggunas', function (Blueprint $table) {
            $table->foreignId('id_gambar')->nullable()->references('id_gambar')->on('image_data');
        });

        Schema::table('image_data', function (Blueprint $table) {
            $table->dropColumn('label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motor_image');

        Schema::table('penggunas', function (Blueprint $table) {
            $table->dropColumn('id_gambar');
        });

        Schema::table('image_data', function (Blueprint $table) {
            $table->string('label')->nullable();
        });
    }
};

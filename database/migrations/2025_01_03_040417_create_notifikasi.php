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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id('id_notifikasi');
            $table->foreignId('id_pengguna')->references('id_pengguna')->on('penggunas');
            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('navigasi', ['', 'transaksi', 'editProfile'])->default('');
            $table->json('data_navigasi')->nullable();
            $table->boolean('is_sent')->default(false);
            $table->boolean('is_read')->default(false);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};

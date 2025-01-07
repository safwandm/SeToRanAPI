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
        
        Schema::create('voucher_useds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_voucher')->references('id_voucher')->on('vouchers')->onDelete('cascade');
            $table->foreignId('id_pengguna')->references('id_pengguna')->on('penggunas')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_useds');
    }
};

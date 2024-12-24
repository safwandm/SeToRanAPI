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
        Schema::table('vouchers', function (Blueprint $table) {
            $table->integer('persen_voucher')->nullable(); // Add `persen_voucher`
            $table->string('kode_voucher', 100)->unique()->nullable(); // Add `kode_voucher`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropColumn(['persen_voucher', 'kode_voucher']); // Drop the columns
        });
    }
};

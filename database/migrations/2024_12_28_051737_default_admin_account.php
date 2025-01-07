<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // kalau udah sempet buat akun pake email ini
        DB::table('admins')->where('email', 'admin01@email.com')->delete();

        DB::table('admins')->insert([
            'nama' => 'Admin 01',
            'email' => 'admin01@email.com', // takutnya admin@email.com udah kepake
            'password' => Hash::make('admin1234'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('admins')->where('email', 'admin01@email.com')->delete();
    }
};

<?php

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {

    Pengguna::create(attributes: [
        'nama' => 'Jane Doe',
        'email' => 'janedoe@example.com',
        'username' => 'janedoe123',
        'password' => bcrypt('securepassword'), // Always hash passwords
        'tanggal_lahir' => '1990-01-01', // Example date
        'nomor_telepon' => '081234567890',
        'nomor_KTP' => '1234567890123456',
        'alamat' => '456 Elm Street, City',
    ]);

    return 'gaming';
});

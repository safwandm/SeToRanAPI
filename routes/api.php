<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\PelangganController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/register-admin', [AuthController::class, 'registerAdmin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->get('/protected', function () {
    return response()->json(['message' => 'This is a protected route'], 200);
});

Route::middleware('auth:sanctum')->get('/current-user', function (Request $request) {
    return response()->json(['user' => $request->user()], 200);
});

Route::middleware('auth:sanctum')->get('/voucher/filtered', [VoucherController::class, 'filtered']);

Route::middleware('auth:sanctum')->prefix('pelanggan')->group(function () {
    Route::get('/', [PelangganController::class, 'index']);
    Route::get('/{id}', [PelangganController::class, 'show']);
    Route::delete('/{id}', [PelangganController::class, 'destroy']); //idpelanggan
});

use App\Http\Controllers\GenericCrudController;

// ->where('model', 'motors|transaksis|ulasans')

Route::middleware('auth:sanctum')->prefix('{model}')->group(function () {
    Route::get('/', [GenericCrudController::class, 'index']);
    Route::get('/{id}', [GenericCrudController::class, 'show']);
    Route::post('/', [GenericCrudController::class, 'store']);
    Route::put('/{id}', [GenericCrudController::class, 'update']);
    Route::delete('/{id}', [GenericCrudController::class, 'destroy']);
});

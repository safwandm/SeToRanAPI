<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\GenericCrudController;
use App\Http\Controllers\MotorController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/register-admin', [AuthController::class, 'registerAdmin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->get('/protected', function () {
    return response()->json(['message' => 'This is a protected route'], 200);
});

Route::get('/mitras', [MitraController::class, 'index']);
Route::get('/mitras-motor', [MitraController::class, 'mitraMotor']);

Route::middleware('auth:sanctum')->get('/current-user', function (Request $request) {
    return response()->json(['user' => $request->user()], 200);
});

Route::middleware('auth:sanctum')->prefix('voucher')->group(function () {
    Route::get('/filtered', [VoucherController::class, 'filtered']);
    Route::get('/kode/{kode_voucher}', [VoucherController::class, 'get_code']);
    Route::post('/', [VoucherController::class, 'store']);
    Route::put('/{id}', [VoucherController::class, 'update']);
});

Route::middleware('auth:sanctum')->prefix('image')->group(function () {
    Route::post('/', [ImageController::class, 'store']);
    Route::get('/{id}', [ImageController::class, 'show']);
});

Route::middleware('auth:sanctum')->prefix('pelanggan')->group(function () {
    Route::get('/', [PelangganController::class, 'index']);
    Route::get('/{id}', [PelangganController::class, 'show']);
    Route::delete('/{id}', [PelangganController::class, 'destroy']); //idpelanggan
});

Route::middleware('auth:sanctum')->prefix('motor')->group(function () {
    Route::post('/filtered', [MotorController::class, 'filtered']);
});

Route::middleware('auth:sanctum')->prefix('transaksi')->group(function () {
    Route::get('/', [TransaksiController::class, 'index']);
    Route::get('/aktif', [TransaksiController::class, 'showAktif']);
    Route::get('/{id}', [TransaksiController::class, 'show']);
    Route::get('/pelanggan/{id}', [TransaksiController::class, 'showByPelanggan']);
    Route::get('/mitra/{id}', [TransaksiController::class, 'showByMitra']);
    Route::get('/motor/{id}', [TransaksiController::class, 'showByMotor']);
    Route::post('/', [TransaksiController::class, 'store']);
    Route::put('/{id}', [TransaksiController::class, 'update']);
});

// ->where('model', 'motors|transaksis|ulasans')

Route::middleware('auth:sanctum')->prefix('/generic/{model}')->group(function () {
    Route::get('/', [GenericCrudController::class, 'index']);
    Route::get('/{id}', [GenericCrudController::class, 'show']);
    Route::post('/', [GenericCrudController::class, 'store']);
    Route::put('/{id}', [GenericCrudController::class, 'update']);
    Route::delete('/{id}', [GenericCrudController::class, 'destroy']);
});

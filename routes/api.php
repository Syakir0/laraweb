<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\LoginController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\MahasiswaController;

// =========================
// ADMIN AUTH (JWT)
// =========================
Route::prefix('admin')->group(function () {
    // Login (tanpa middleware)
    Route::post('/login', [LoginController::class, 'index']);

    // Semua route ini pakai middleware JWT (auth:api_admin)
    Route::middleware('auth:api_admin')->group(function () {
        Route::get('/user', [LoginController::class, 'getUser']);
        Route::get('/refresh', [LoginController::class, 'refreshToken']);
        Route::post('/logout', [LoginController::class, 'logout']);

        // CRUD User
        Route::apiResource('users', UserController::class);

        // CRUD Mahasiswa
        Route::apiResource('mahasiswas', MahasiswaController::class)
             ->except(['create', 'edit']);
    });
});

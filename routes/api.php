<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\LoginController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\MahasiswaController;
use App\Http\Controllers\Api\Admin\ProgramStudiController;

/*
|--------------------------------------------------------------------------
| API Routes (JWT Protected)
|--------------------------------------------------------------------------
| Semua endpoint hanya bisa diakses setelah login dengan JWT Token.
| Endpoint login dikecualikan (tidak perlu token).
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    // =========================
    // 🔓 ROUTE PUBLIC (tanpa token)
    // =========================
    Route::post('/login', [LoginController::class, 'index'])->name('admin.login');

    // =========================
    // 🔐 ROUTE PROTECTED (wajib JWT)
    // =========================
    Route::middleware('auth:api_admin')->group(function () {

        // --- Auth control
        Route::get('/user', [LoginController::class, 'getUser'])->name('admin.user');
        Route::get('/refresh', [LoginController::class, 'refreshToken'])->name('admin.refresh');
        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

        // --- CRUD user
        Route::apiResource('users', UserController::class)->except(['create', 'edit']);

        // --- CRUD program studi (dilindungi JWT)
        Route::apiResource('program-studis', ProgramStudiController::class)->except(['create', 'edit']);

        // --- CRUD mahasiswa (dilindungi JWT)
        Route::apiResource('mahasiswas', MahasiswaController::class)->except(['create', 'edit']);
    });
});

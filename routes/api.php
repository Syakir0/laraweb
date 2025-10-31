<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\LoginController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\ProgramStudiController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\PangkatController;
use App\Http\Controllers\Api\KelompokBidangKeahlianController;

/*
|--------------------------------------------------------------------------
| API Routes (JWT Protected)
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/

// =====================================================
// 🔒 Semua resource CRUD (butuh JWT admin)
// =====================================================
Route::middleware('auth:api_admin')->group(function () {

    // 🎓 Mahasiswa
    Route::apiResource('mahasiswas', MahasiswaController::class)->except(['create', 'edit']);

    // 👨‍🏫 Dosen
    Route::apiResource('dosens', DosenController::class)->except(['create', 'edit']);

    // 🪶 Pangkat
    Route::apiResource('pangkats', PangkatController::class)->except(['create', 'edit']);

    // 🏫 Program Studi
    Route::apiResource('program-studis', ProgramStudiController::class)->except(['create', 'edit']);

    // 🧩 Kelompok Bidang Keahlian
    Route::apiResource('kelompok-bidang-keahlians', KelompokBidangKeahlianController::class)->except(['create', 'edit']);
});

// =====================================================
// 🔐 Endpoint khusus admin (login & user info)
// =====================================================
Route::prefix('admin')->group(function () {

    // --- Login (tanpa token)
    Route::post('/login', [LoginController::class, 'index'])->name('admin.login');

    // --- Endpoint di bawah ini butuh JWT admin
    Route::middleware('auth:api_admin')->group(function () {
        Route::get('/user', [LoginController::class, 'getUser'])->name('admin.user');
        Route::get('/refresh', [LoginController::class, 'refreshToken'])->name('admin.refresh');
        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

        // 👤 CRUD User (hanya admin)
        Route::apiResource('users', UserController::class)->except(['create', 'edit']);
    });
});

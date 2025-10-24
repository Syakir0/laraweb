<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\LoginController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\MahasiswaController;
use App\Http\Controllers\Api\Admin\ProgramStudiController;
use App\Http\Controllers\Api\Admin\DosenController;
use App\Http\Controllers\Api\Admin\PangkatController;
use App\Http\Controllers\Api\Admin\KelompokBidangKeahlianController;

/*
|--------------------------------------------------------------------------
| API Routes (JWT Protected)
|--------------------------------------------------------------------------
| Semua endpoint hanya bisa diakses setelah login dengan JWT Token.
| Endpoint login dikecualikan (tidak perlu token).
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    // --- Endpoint login (tidak butuh token)
    Route::post('/login', [LoginController::class, 'index'])->name('admin.login');

    // --- Semua endpoint di bawah ini dilindungi oleh JWT (auth:api_admin)
    Route::middleware('auth:api_admin')->group(function () {

        // 🔐 Auth Control
        Route::get('/user', [LoginController::class, 'getUser'])->name('admin.user');
        Route::get('/refresh', [LoginController::class, 'refreshToken'])->name('admin.refresh');
        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

        // 👤 CRUD Users
        Route::apiResource('users', UserController::class)->except(['create', 'edit']);

        // 🎓 CRUD Program Studi
        Route::apiResource('program-studis', ProgramStudiController::class)->except(['create', 'edit']);

        // 🎓 CRUD Mahasiswa
        Route::apiResource('mahasiswas', MahasiswaController::class)->except(['create', 'edit']);

        // 👨‍🏫 CRUD Dosen (dilindungi JWT)
        Route::apiResource('dosens', DosenController::class)->except(['create', 'edit']);

        Route::apiResource('pangkats', PangkatController::class)->except(['create', 'edit']);

        Route::apiResource('kelompok-bidang-keahlians', KelompokBidangKeahlianController::class)->except(['create', 'edit']);
    });
});

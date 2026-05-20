<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\KegiatanApiController;
use App\Http\Controllers\Api\AnggotaApiController;
use App\Http\Controllers\Api\PendaftaranApiController;

Route::prefix('v1')->group(function () {
    // Auth
    Route::post('/auth/login', [AuthApiController::class, 'login']);

    // Publik / Android CRUD tanpa Auth
    Route::match(['get', 'post'], '/anggota', [AnggotaApiController::class, 'index']);
    Route::match(['get', 'post'], '/pac-list', [AnggotaApiController::class, 'pacList']);
    Route::get('/stats', [AnggotaApiController::class, 'stats']); // Endpoint Statistik baru
    Route::post('/anggota-crud', [AnggotaApiController::class, 'crud']);

    Route::get('/kegiatan', [KegiatanApiController::class, 'indexPublik']);
    Route::get('/kegiatan/{id}', [KegiatanApiController::class, 'showPublik']);

    // Terautentikasi (Android client)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me/anggota', [AnggotaApiController::class, 'me']);
        Route::get('/me/pendaftaran', [PendaftaranApiController::class, 'listMe']);
        Route::post('/me/pendaftaran', [PendaftaranApiController::class, 'createMe']);
    });
});
>>>>>>> feature-android-app

<?php

use App\Http\Controllers\Api\AnggotaApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\KegiatanApiController;
use App\Http\Controllers\Api\MobileApiController;
use App\Http\Controllers\Api\PendaftaranApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Auth mobile native
    Route::post('/auth/login', [AuthApiController::class, 'login'])->middleware('throttle:10,1');

    // Endpoint lama untuk aplikasi Android CRUD anggota
    Route::match(['get', 'post'], '/anggota', [AnggotaApiController::class, 'index']);
    Route::match(['get', 'post'], '/pac-list', [AnggotaApiController::class, 'pacList']);
    Route::get('/stats', [AnggotaApiController::class, 'stats']);
    Route::post('/anggota-crud', [AnggotaApiController::class, 'crud']);

    // Endpoint publik
    Route::get('/kegiatan', [KegiatanApiController::class, 'indexPublik']);
    Route::get('/kegiatan/{id}', [KegiatanApiController::class, 'showPublik']);
    Route::get('/mobile/kegiatan', [MobileApiController::class, 'kegiatan']);
    Route::get('/mobile/kegiatan/{id}', [MobileApiController::class, 'showKegiatan']);
    Route::get('/mobile/pac', [MobileApiController::class, 'pacList']);
    Route::get('/mobile/pac/{pac}', [MobileApiController::class, 'pacShow']);
    Route::get('/mobile/galeri', [MobileApiController::class, 'galeri']);

    // Endpoint mobile yang membutuhkan token Sanctum
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthApiController::class, 'logout']);
        Route::get('/auth/me', [MobileApiController::class, 'me']);

        // Kompatibilitas endpoint lama
        Route::get('/me/anggota', [AnggotaApiController::class, 'me']);
        Route::get('/me/pendaftaran', [PendaftaranApiController::class, 'listMe']);
        Route::post('/me/pendaftaran', [PendaftaranApiController::class, 'createMe']);

        // Fitur mobile native SIBO
        Route::get('/mobile/dashboard', [MobileApiController::class, 'dashboard']);
        Route::post('/mobile/kegiatan/{id}/daftar', [MobileApiController::class, 'daftarKegiatan']);
        Route::get('/mobile/riwayat', [MobileApiController::class, 'riwayat']);
        Route::get('/mobile/notifikasi', [MobileApiController::class, 'notifikasi']);
        Route::match(['put', 'post'], '/mobile/notifikasi/{id}/read', [MobileApiController::class, 'readNotifikasi']);
        Route::get('/mobile/sertifikat', [MobileApiController::class, 'sertifikat']);
        Route::get('/mobile/sertifikat/{id}/download', [MobileApiController::class, 'downloadSertifikat']);
        Route::get('/mobile/profil', [MobileApiController::class, 'profil']);
        Route::put('/mobile/profil', [MobileApiController::class, 'updateProfil']);
        Route::post('/mobile/profil/password/otp', [MobileApiController::class, 'requestPasswordOtp'])->middleware('throttle:3,1');
        Route::post('/mobile/profil/password', [MobileApiController::class, 'updatePassword'])->middleware('throttle:5,1');
        Route::get('/mobile/inventory', [MobileApiController::class, 'inventory']);
        Route::get('/mobile/laporan/ringkasan', [MobileApiController::class, 'laporanRingkasan']);

        // Admin mobile CRUD
        Route::get('/mobile/admin/kegiatan', [MobileApiController::class, 'adminKegiatan']);
        Route::post('/mobile/admin/kegiatan', [MobileApiController::class, 'adminStoreKegiatan']);
        Route::post('/mobile/admin/kegiatan/{id}/update', [MobileApiController::class, 'adminUpdateKegiatan']);
        Route::post('/mobile/admin/kegiatan/{id}/delete', [MobileApiController::class, 'adminDeleteKegiatan']);
        Route::get('/mobile/admin/galeri', [MobileApiController::class, 'adminGaleri']);
        Route::post('/mobile/admin/galeri', [MobileApiController::class, 'adminStoreGaleri']);
        Route::post('/mobile/admin/galeri/{id}/delete', [MobileApiController::class, 'adminDeleteGaleri']);

    });
});

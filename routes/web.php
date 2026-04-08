<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KegiatanPublikController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\GaleriController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Publik (tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kegiatan', [KegiatanPublikController::class, 'index'])->name('kegiatan.publik.index');
Route::get('/kegiatan/{id}', [KegiatanPublikController::class, 'show'])->name('kegiatan.publik.show');

/*
|--------------------------------------------------------------------------
| Redirect setelah login (dipakai oleh Laravel Breeze)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (auth()->user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('anggota.dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Group untuk Admin (middleware auth + role:admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // CRUD Anggota
    Route::resource('anggota', AnggotaController::class);

    // CRUD Kategori
    Route::resource('kategori', KategoriController::class);

    // CRUD Kegiatan (dengan pamflet)
    Route::resource('kegiatan', KegiatanController::class);

    // Pendaftaran (admin)
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/{id_kegiatan}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::put('/pendaftaran/{id_daftar}', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.update');

    // Absensi
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/{id_kegiatan}/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/absensi/{id_kegiatan}', [AbsensiController::class, 'store'])->name('absensi.store');

    // Galeri
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::get('/galeri/{id_kegiatan}', [GaleriController::class, 'show'])->name('galeri.show');
    Route::get('/galeri/{id_kegiatan}/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/galeri/{id_kegiatan}', [GaleriController::class, 'store'])->name('galeri.store');
    Route::delete('/galeri/foto/{id_foto}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
});

/*
|--------------------------------------------------------------------------
| Group untuk Anggota (middleware auth + role:anggota)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:anggota'])->prefix('anggota')->name('anggota.')->group(function () {
    // Dashboard anggota
    Route::get('/dashboard', function () {
        return view('anggota.dashboard');
    })->name('dashboard');

    // Pendaftaran kegiatan (proses daftar)
    Route::post('/daftar/{id_kegiatan}', [PendaftaranController::class, 'daftar'])->name('daftar');

    // Riwayat pendaftaran anggota
    Route::get('/riwayat', [PendaftaranController::class, 'riwayat'])->name('riwayat');
});

/*
|--------------------------------------------------------------------------
| Auth Breeze (login, register, lupa password, verifikasi email, logout)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
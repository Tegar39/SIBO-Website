<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KegiatanPublikController;
use App\Http\Controllers\GaleriPublikController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\AnggotaProfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardPacController;

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kegiatan', [KegiatanPublikController::class, 'index'])->name('kegiatan.publik.index');
Route::get('/kegiatan/{id}', [KegiatanPublikController::class, 'show'])->name('kegiatan.publik.show');
Route::get('/galeri', [GaleriPublikController::class, 'index'])->name('galeri.publik.index');
Route::get('/galeri/{id}', [GaleriPublikController::class, 'show'])->name('galeri.publik.show');
Route::middleware(['auth', 'role.pac'])->prefix('pac')->name('pac.')->group(function () {
Route::get('/dashboard', [DashboardPacController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Redirect setelah login (dipakai Breeze)
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
| Admin Group
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('anggota', AnggotaController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('kegiatan', KegiatanController::class);
    // Pendaftaran
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/{id_kegiatan}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::get('/pendaftaran/{id_kegiatan}/tambah', [PendaftaranController::class, 'createByAdmin'])->name('pendaftaran.create');
    Route::post('/pendaftaran/{id_kegiatan}', [PendaftaranController::class, 'storeByAdmin'])->name('pendaftaran.store');
    Route::put('/pendaftaran/{id_daftar}', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.update');
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/{id_kegiatan}/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::get('/absensi/{id_kegiatan}', [AbsensiController::class, 'show'])->name('admin.absensi.show');
    Route::get('/absensi/{id_kegiatan}/export', [AbsensiController::class, 'export'])->name('admin.absensi.export');
    Route::post('/absensi/{id_kegiatan}', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::get('/galeri/{id_kegiatan}', [GaleriController::class, 'show'])->name('galeri.show');
    Route::get('/galeri/{id_kegiatan}/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/galeri/{id_kegiatan}', [GaleriController::class, 'store'])->name('galeri.store');
    Route::delete('/galeri/foto/{id_foto}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
});

/*
|--------------------------------------------------------------------------
| Anggota Group
|--------------------------------------------------------------------------
/*
|--------------------------------------------------------------------------
| Anggota Group
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:anggota'])->prefix('anggota')->name('anggota.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardAnggotaController::class, 'index'])->name('dashboard');
    Route::post('/daftar/{id_kegiatan}', [PendaftaranController::class, 'daftar'])->name('daftar');
    Route::get('/riwayat', [PendaftaranController::class, 'riwayat'])->name('riwayat');
    
    // Profil - 2 halaman terpisah
    Route::get('/profil', [AnggotaProfilController::class, 'index'])->name('profil');
    Route::put('/profil/update', [AnggotaProfilController::class, 'update'])->name('profil.update');
    
    Route::get('/keamanan', [AnggotaProfilController::class, 'keamanan'])->name('keamanan');
    Route::put('/keamanan/update-password', [AnggotaProfilController::class, 'updatePassword'])->name('keamanan.update-password');
    
    // Atau tambahkan ini jika ingin menggunakan nama route yang lama
    // Route::put('/profil/update-password', [AnggotaProfilController::class, 'updatePassword'])->name('profil.update-password');
});

require __DIR__.'/auth.php';
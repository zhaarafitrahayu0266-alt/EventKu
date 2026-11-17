<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Vendor\RegisterController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;
use App\Http\Controllers\Vendor\ProfilController as VendorProfilController;

/*
|--------------------------------------------------------------------------
| Beranda
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('beranda'))->name('beranda');

/*
|--------------------------------------------------------------------------
| Publik: daftar vendor (katalog)
|--------------------------------------------------------------------------
*/
Route::get('/vendors', [VendorController::class, 'index'])->name('vendor.index');
Route::get('/vendors/{id}', [VendorController::class, 'show'])->name('vendor.show');

/*
|--------------------------------------------------------------------------
| Tamu (belum login): masuk & daftar
|--------------------------------------------------------------------------
*/
Route::middleware('guest:pelanggan,vendor,admin')->group(function () {
    // Login (pelanggan, vendor, admin)
    Route::get('/masuk', [LoginController::class, 'create'])->name('masuk');
    Route::post('/masuk', [LoginController::class, 'proses'])
        ->name('masuk.proses')
        ->middleware('throttle:5,1');

    // Daftar pelanggan
    Route::get('/daftar', [DaftarController::class, 'create'])->name('daftar');
    Route::post('/daftar', [DaftarController::class, 'store'])
        ->name('daftar.store')
        ->middleware('throttle:10,1');

    // Daftar vendor (halaman yang sudah ada)
    Route::get('/vendor/register', [RegisterController::class, 'create'])->name('vendor.register');
    Route::post('/vendor/register', [RegisterController::class, 'store'])->middleware('throttle:10,1');
});

/*
|--------------------------------------------------------------------------
| Sisi vendor (login lewat guard 'vendor')
|--------------------------------------------------------------------------
*/
Route::middleware('auth:vendor')
    ->prefix('vendor')
    ->name('vendor.')
    ->group(function () {
        Route::redirect('/', '/vendor/pengajuan-masuk');
        Route::get('/pengajuan-masuk', [VendorDashboardController::class, 'index'])->name('pengajuan');
        Route::get('/profil', [VendorProfilController::class, 'edit'])->name('profil');
        Route::put('/profil', [VendorProfilController::class, 'update'])->name('profil.update');
    });

/*
|--------------------------------------------------------------------------
| Sisi admin (login lewat guard 'admin') - placeholder, ganti dengan halaman admin
|--------------------------------------------------------------------------
*/
Route::middleware('auth:admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', fn () => 'Dashboard admin: segera dibuat')->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| Keluar (semua peran: pelanggan, vendor, admin)
|--------------------------------------------------------------------------
*/
Route::post('/keluar', [LoginController::class, 'keluar'])->name('keluar');

/*
| Halaman khusus pelanggan (acara, pesanan, dst.) ditambahkan di sini:
|
| Route::middleware('auth:pelanggan')->group(function () {
|     // route pelanggan
| });
*/
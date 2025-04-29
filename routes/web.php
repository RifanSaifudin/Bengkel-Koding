<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dokter\DashboardController as DokterDashboardController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\Pasien\DashboardController as PasienDashboardController;
use App\Http\Controllers\Pasien\PeriksaController as PasienPeriksaController;
use App\Http\Controllers\Pasien\RiwayatController as PasienRiwayatController;

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Auth::routes();

// Home setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// DOKTER
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/', [DokterDashboardController::class, 'index'])->name('dashboard');
    Route::resource('obat', ObatController::class);
    Route::resource('periksa', PeriksaController::class);
});

// PASIEN
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/', [PasienDashboardController::class, 'index'])->name('dashboard');
    Route::get('/periksa', [PasienPeriksaController::class, 'index'])->name('periksa.index');
    Route::post('/periksa', [PasienPeriksaController::class, 'store'])->name('periksa.store');
    Route::get('/riwayat', [PasienRiwayatController::class, 'index'])->name('riwayat.index');
});

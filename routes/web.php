<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\RiwayatPasienController;
use App\Http\Controllers\Dokter\JadwalDokterController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\PasienController as AdminPasienController;
use App\Http\Controllers\Admin\ObatController as AdminObatController;
use App\Http\Controllers\DokterDashboardController;
use App\Http\Controllers\Pasien\DashboardController as PasienDashboardController;
use App\Http\Controllers\Pasien\PeriksaController as PasienPeriksaController;
use App\Http\Controllers\Pasien\RiwayatController as PasienRiwayatController;

// Tambahan: Controller Auth manual
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// ========================
//       AUTH ROUTES
// ========================
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Setelah login redirect
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Redirect berdasarkan role
Route::middleware(['auth', 'role:admin'])->get('/admin', fn () => redirect()->route('admin.dashboard'));
Route::middleware(['auth', 'role:dokter'])->get('/dokter', fn () => redirect()->route('dokter.dashboard'));
Route::middleware(['auth', 'role:pasien'])->get('/pasien', fn () => redirect()->route('pasien.dashboard'));

// ========================
//         DOKTER
// ========================
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    // Dashboard dokter
    Route::get('/dashboard', [DokterDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Obat
    Route::resource('obat', ObatController::class);

    // Periksa (jadwal + pemeriksaan)
    Route::resource('periksa', PeriksaController::class)->except(['store', 'edit', 'update', 'create']);
    Route::get('/periksa/{id}/form', [PeriksaController::class, 'form'])->name('periksa.form');
    Route::post('/periksa/{id}/form', [PeriksaController::class, 'store'])->name('periksa.form.store');
    Route::get('/periksa/{id}/edit', [PeriksaController::class, 'edit'])->name('periksa.edit');
    Route::put('/periksa/{id}/edit', [PeriksaController::class, 'update'])->name('periksa.update');

    // Resource route untuk periksa (index, show, destroy, dll)
    Route::resource('periksa', PeriksaController::class)->except(['edit', 'update', 'create', 'store']);

    // Jadwal dokter
    Route::get('/jadwal', [JadwalDokterController::class, 'index'])->name('jadwal.index');
    Route::post('/jadwal', [PeriksaController::class, 'simpanJadwal'])->name('jadwal.store');
    Route::put('/jadwal/status/{id}', [PeriksaController::class, 'ubahStatusJadwal'])->name('jadwal.status');

    // Riwayat pasien
    Route::get('/riwayat', [RiwayatPasienController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/{id}', [RiwayatPasienController::class, 'detail'])->name('riwayat.detail');

    // Profil dokter
    Route::get('/profil', [PeriksaController::class, 'profil'])->name('profil');
    Route::put('/profil', [PeriksaController::class, 'updateProfil'])->name('profil.update');
});



// ========================
//         PASIEN
// ========================
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/dashboard', [PasienDashboardController::class, 'index'])->name('dashboard');
    Route::get('/periksa', [PasienPeriksaController::class, 'index'])->name('periksa.index');
    Route::post('/periksa', [PasienPeriksaController::class, 'store'])->name('periksa.store');
    Route::get('/periksa/{id}', [PasienPeriksaController::class, 'show'])->name('periksa.show');
    Route::get('/riwayat', [PasienRiwayatController::class, 'index'])->name('riwayat.index');
});

// ========================
//         ADMIN
// ========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('poli', PoliController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('pasien', AdminPasienController::class);
    Route::resource('obat', AdminObatController::class);
});

// ========================
//       API HELPERS
// ========================
Route::get('/get-dokter-by-poli/{id}', function ($id) {
    return \App\Models\User::where('role', 'dokter')->where('id_poli', $id)->get();
});

Route::get('/get-jadwal-by-poli/{id}', function ($id) {
    $jadwals = \App\Models\JadwalPeriksa::whereHas('dokter', function ($query) use ($id) {
        $query->where('id_poli', $id);
    })->where('status', 1)->with('dokter')->get();

    return response()->json($jadwals->map(function ($jadwal) {
        return [
            'id' => $jadwal->id,
            'hari' => $jadwal->hari,
            'jam_mulai' => $jadwal->jam_mulai,
            'jam_selesai' => $jadwal->jam_selesai,
            'dokter' => $jadwal->dokter->name ?? '-',
        ];
    }));
});

<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\KeamananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ListProdukController;

// Halaman Publik
Route::get('/', function () {
    return view('pages.home');
})->name('pages.home');

// Auth Routes
Route::middleware('guest')->group(function () {
    // Pendaftaran
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/daftar', 'showRegistrationForm')->name('auth.daftar');
        Route::post('/daftar', 'register')->name('auth.daftar.submit');
    });

    // Login
    Route::controller(LoginController::class)->group(function () {
        Route::get('/masuk', 'showLoginForm')->name('login');
        Route::post('/masuk', 'login');
    });
});

// Logout
Route::post('/keluar', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Admin Routes
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
    
    // Pindahkan routes admin-only ke sini
    Route::get('/pelanggan', [DashboardController::class, 'pelanggan'])->name('pelanggan');
    Route::get('/pengaturan', [DashboardController::class, 'pengaturan'])->name('pengaturan');
    Route::get('/studio', [DashboardController::class, 'studio'])->name('studio');
    Route::get('/ulasan', [DashboardController::class, 'ulasan'])->name('ulasan');
    Route::get('/statistik-pendapatan', [ReservasiController::class, 'statistikpendapatan'])->name('statistikpendapatan');
});

// User Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LoginController::class, 'index'])
        ->name('user.dashboard');
});

Route::get('/pemesanan', [PemesananController::class, 'pemesanan'])->name('pemesanan');

Route::get('/detail-reservasi', [ReservasiController::class, 'detailreservasi'])->name('detailreservasi');
Route::get('/reservasi', [ReservasiController::class, 'reservasi'])->name('reservasi');
Route::get('/reservasi-selesai', [ReservasiController::class, 'reservasiselesai'])->name('reservasiselesai');
Route::get('/reservasi-lunas', [ReservasiController::class, 'reservasilunas'])->name('reservasilunas');

Route::middleware(['auth'])->group(function () {
    // Profil Routes
    Route::prefix('profil')->group(function () {
        Route::get('/', [ProfilController::class, 'profil'])->name('profil');
        Route::get('/edit', [ProfilController::class, 'edit'])->name('profil.edit');
        Route::put('/update', [ProfilController::class, 'update'])->name('profil.update');
    });
    
    // Keamanan Routes
    Route::prefix('keamanan')->group(function () {
        Route::get('/', [KeamananController::class, 'keamanan'])->name('keamanan');
        Route::post('/ubah-password', [KeamananController::class, 'ubahPassword'])->name('password.ubah');
    });
    
    // Riwayat Route
    Route::get('/riwayat', [RiwayatController::class, 'riwayat'])->name('riwayat');
});
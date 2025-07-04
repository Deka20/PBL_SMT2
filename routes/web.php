<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\KeamananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\StatistikPendapatanController;

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('pages.home');
Route::prefix('api')->middleware('api')->group(function () {
    Route::get('/studio/{id}', [App\Http\Controllers\DashboardController::class, 'show'])->name('api.studio.show');
});

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
        // Lupa Password Routes
        Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/verify-otp', [ForgotPasswordController::class, 'showVerifyForm'])->name('password.verify.form');
        Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify');
        Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
        Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
    });
});

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');

// Logout
Route::post('/keluar', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Admin Routes
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

   Route::post('/admin/pemesanan/{id}/update-status', [PembayaranController::class, 'updateStatus'])
        ->name('admin.pemesanan.update-status');
    Route::get('/pelanggan', [DashboardController::class, 'pelanggan'])->name('pelanggan');
    Route::get('/pelanggan/{id}', [DashboardController::class, 'showPelanggan'])->name('pelanggan.show');
    Route::put('/pelanggan/{id}', [DashboardController::class, 'updatePelanggan'])->name('pelanggan.update'); // Jika menggunakan POST dengan _method=PUT
    Route::delete('/pelanggan/{id}', [DashboardController::class, 'deletePelanggan'])->name('pelanggan.destroy');

    Route::get('/ulasan', [ReviewController::class, 'index'])->name('ulasan');
    Route::get('/statistik-pendapatan', [StatistikPendapatanController::class, 'index'])->name('statistikpendapatan');

    Route::get('/studio', [DashboardController::class, 'studio'])->name('studio');
    Route::post('/studio', [DashboardController::class, 'storeStudio'])->name('studio.store');
    Route::get('/studio/{id}/edit', [DashboardController::class, 'editStudio'])->name('studio.edit');
    Route::put('/studio/{id}', [DashboardController::class, 'updateStudio'])->name('studio.update');
    Route::delete('/studio/{id}', [DashboardController::class, 'deleteStudio'])->name('studio.destroy');
    Route::get('studio/{id}', [DashboardController::class, 'show'])->name('studio.show');

    Route::get('/pengaturan', [DashboardController::class, 'pengaturan'])->name('pengaturan');
    Route::post('/pengaturan', [PortfolioController::class, 'store'])->name('pengaturan.store');
    Route::delete('/pengaturan/{portfolio}', [PortfolioController::class, 'destroy'])->name('pengaturan.destroy');


});

//Route Search diluar auth biar bisa search juga sblm login
Route::get('/search-studio', [HomeController::class, 'searchStudio']);

// User Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LoginController::class, 'index'])
        ->name('user.dashboard');
});

Route::get('/detail-reservasi/{id}', [PemesananController::class, 'detailreservasi'])
    ->name('detailreservasi');
Route::post('/review', [ReviewController::class, 'store'])->name('review.store');

Route::middleware(['auth'])->group(function () {
    // Profil Routes
    Route::prefix('profil')->group(function () {
        Route::get('/', [ProfilController::class, 'profil'])->name('profil');
        Route::get('/edit', [ProfilController::class, 'edit'])->name('profil.edit');
        Route::put('/update', [ProfilController::class, 'update'])->name('profil.update');
    });
    
    Route::post('/booked-slots', [PemesananController::class, 'getBookedSlots']);

    // Keamanan Routes
    Route::prefix('keamanan')->group(function () {
        Route::get('/', [KeamananController::class, 'keamanan'])->name('keamanan');
        Route::post('/ubah-password', [KeamananController::class, 'ubahPassword'])->name('password.ubah');
    });
    
    // Riwayat Route
    Route::get('/riwayat', [RiwayatController::class, 'riwayat'])->name('riwayat');
    
    // Pemesanan Route
    Route::get('/pemesanan', [PemesananController::class, 'pemesanan'])->name('pemesanan');
    Route::post('/pemesanan/simpan', [PemesananController::class, 'simpan'])->name('pemesanan.simpan');
Route::get('/pembayaran/{id}', [PembayaranController::class, 'form'])->name('bukti.form');
Route::post('/pembayaran/kirim', [PembayaranController::class, 'upload'])->name('bukti.upload');
});

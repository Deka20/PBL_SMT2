<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\KeamananController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PemesananController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 🏠 Halaman Publik
Route::get('/', function () {
    return view('pages.home');
})->name('pages.home');

// 🔐 Auth Routes
Route::middleware('guest')->group(function () {
    // 📝 Pendaftaran
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/daftar', 'showRegistrationForm')->name('auth.daftar');
        Route::post('/daftar', 'register')->name('auth.daftar.submit');
    });

    // 🔑 Login
    Route::controller(LoginController::class)->group(function () {
        Route::get('/masuk', 'showLoginForm')->name('login');
        Route::post('/masuk', 'login');
    });
});

// 🚪 Logout (harus auth)
Route::post('/keluar', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// 🏢 Admin Routes
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
    
    // Tambahkan route admin lainnya di sini
});

// 👤 User Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LoginController::class, 'index'])
        ->name('user.dashboard');
    
    // Tambahkan route user lainnya di sini
});

Route::get('/profil', [ProfilController::class, 'profil'])->name('profil');
Route::get('/keamanan', [KeamananController::class, 'keamanan'])->name('keamanan');
Route::get('/riwayat', [RiwayatController::class, 'riwayat'])->name('riwayat');
Route::get('/pemesanan', [PemesananController::class, 'pemesanan'])->name('pemesanan');
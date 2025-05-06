<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
=======
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ListItemController;
use App\Http\Controllers\DashboardController;
>>>>>>> 8badcec86ddcc238fb1eebffdf7f5b441be8c22d

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('/', [HomeController::class, 'index']);
//Route::get('contact', [HomeController::class, 'contact']);

//Route::get('/welcome', function () {
    //return view('welcome');
//});

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

//Route::get('/login', [LoginController::class, 'index']);

//Route::get('/login', function () {
    //return view('auth.login'); // Sesuaikan dengan nama view login-mu
//});
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});
<<<<<<< HEAD
//Route::get('/dashboard', [AdminController::class, 'dashboard']);
Route::get('/LandingPage', function () {
    return view('LandingPage');
=======

Route::get('user/{id}', function ($id) {
    return 'User dengan ID' . $id;
});

// User Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LoginController::class, 'index'])
        ->name('user.dashboard');
});

Route::get('/profil', [ProfilController::class, 'profil'])->name('profil');
Route::get('/keamanan', [KeamananController::class, 'keamanan'])->name('keamanan');
Route::get('/riwayat', [RiwayatController::class, 'riwayat'])->name('riwayat');
Route::get('/pemesanan', [PemesananController::class, 'pemesanan'])->name('pemesanan');

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/history', function () {
    return view('riwayatPemesanan');
});

Route::get('/login', function () {
    return view('loginPage');
});

Route::get('/register', function () {
    return view('registerPage');
>>>>>>> 8badcec86ddcc238fb1eebffdf7f5b441be8c22d
});
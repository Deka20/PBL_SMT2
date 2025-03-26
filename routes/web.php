<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\DashboardController;
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/user/{id}' , function ($id) {
    return 'User dengan ID' . $id;
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return 'Admin Dashboard';
        });

        Route::get('/users', function () {
            return 'Admin Users';
            });
});

Route::get('/listbarang/{id}/{nama}', function ($id, $nama) {
    return view('list_barang', compact('id', 'nama'));
});

// Route::get('/listbarang/{id}/{nama}', function ($id, $nama) {
// return view('list_barang', compact('id', 'nama'));
// });


Route::get('/dashboard', function() {
    return 'Admin Dashboard';
});

Route::get('/lapangan', function () {
 return view('lapangan');
});

Route::get('pelanggan', function() {
    return view('pelanggan');
=======
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ListItemController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('contact', [HomeController::class, 'contact']);

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('user/{id}', function ($id) {
    return 'User dengan ID' . $id;
});

// Route::prefix('admin')->group(function () {
//     Route::get('/dashboard', function () {
//         return 'Admin Dashboard';
//     });

//     Route::get('/users', function () {
//         return 'Admin Users';
//     });
// });

Route::get('/listitem/{id}/{tipe}', [ListItemController::class, 'tampilkan']);

Route::get('/login', [LoginController::class, 'index'])->name('login');

// Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

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
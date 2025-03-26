<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ListItemController;
use App\Http\Controllers\DashboardController;

Route::get('/welcome', function () {
    return view('welcome');
});

// Route::prefix('admin')->group(function () {
//     Route::get('/dashboard', function () {
//         return 'Admin Dashboard';
//         });

//         Route::get('/users', function () {
//             return 'Admin Users';
//             });
// });

Route::get('/listbarang/{id}/{nama}', function ($id, $nama) {
    return view('list_barang', compact('id', 'nama'));
});

Route::get('/lapangan', function () {
 return view('lapangan');
});

Route::get('pelanggan', function() {
    return view('pelanggan');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

//Route::get('/dashboard', [AdminController::class, 'dashboard']);
Route::get('/LandingPage', function () {
    return view('LandingPage');
});

Route::get('user/{id}', function ($id) {
    return 'User dengan ID' . $id;
});

Route::get('/listitem/{id}/{tipe}', [ListItemController::class, 'tampilkan']);

Route::get('/login', [LoginController::class, 'index'])->name('login');

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
});
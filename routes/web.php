<?php

//use App\Http\Controllers\HomeController;
//use App\Http\Controllers\ListBarangController;
//use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('/', [HomeController::class, 'index']);
//Route::get('contact', [HomeController::class, 'contact']);

//Route::get('/welcome', function () {
    //return view('welcome');
//});

//Route::get('user/{id}', function ($id) {
    //return 'User dengan ID' . $id;
//});

//Route::prefix('admin')->group(function () {
    //Route::get('/dashboard', function () {
        //return 'Admin Dashboard';
    //});

    //Route::get('/users', function () {
        //return 'Admin Users';
    //});
//});

//Route::get('/listbarang/{id}/{nama}', [ListBarangController::class, 'tampilkan']);

//Route::get('/login', [LoginController::class, 'index']);

//Route::get('/login', function () {
    //return view('auth.login'); // Sesuaikan dengan nama view login-mu
//});
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});
//Route::get('/dashboard', [AdminController::class, 'dashboard']);
Route::get('/LandingPage', function () {
    return view('LandingPage');
});
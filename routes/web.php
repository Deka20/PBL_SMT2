<?php

use Illuminate\Support\Facades\Route;
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
});
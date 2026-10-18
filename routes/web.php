<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanMasukController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('aurellia', function () {
    return view('welcome');
});
Route::get('Naufal', function () {
    return view('welcome');
});

// Autentikasi Pengguna (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Rute yang membutuhkan autentikasi / akun yang sudah login
Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('bahan-masuk', BahanMasukController::class);
});

<?php

use App\Http\Controllers\BahanMasukController;
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
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // sementara: langsung arahkan ke dashboard
    return redirect('/dashboard');
})->name('login.submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::resource('bahan-masuk', BahanMasukController::class);

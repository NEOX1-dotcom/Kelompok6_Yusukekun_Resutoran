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


Route::resource('bahan-masuk', BahanMasukController::class);

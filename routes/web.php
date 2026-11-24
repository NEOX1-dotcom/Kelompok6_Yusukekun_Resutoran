<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanKeluarController;
use App\Http\Controllers\BahanMasukController;
use App\Http\Controllers\DataBahanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\RiwayatTransaksiController;
use App\Http\Controllers\SisaBahanAkhirBulanController;
use App\Models\Bahan;
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
Route::middleware(['auth', 'session-closing-time', 'prevent-back-history'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::post('/kasir', [KasirController::class, 'store'])->name('kasir.store');
    Route::get('/riwayat-transaksi', [RiwayatTransaksiController::class, 'index'])->name('riwayat.index');

    Route::get('/omset-harian', function () {
        return view('omset_harian.index');
    })->name('omset-harian.index');
    Route::get('/omset-bulanan', function () {
        return view('omset_bulanan.index');
    })->name('omset-bulanan.index');

    Route::resource('data-bahan', DataBahanController::class)->only([
        'index',
        'store',
        'update',
        'destroy',
    ]);
    Route::get('/bahan', function () {
        $bahan = Bahan::orderBy('nama_bahan')->paginate(10);

        return view('bahan.index', compact('bahan'));
    })->name('bahan.index');
    Route::post('/bahan', [DataBahanController::class, 'store'])->name('bahan.store');
    Route::put('/bahan/{id}', [DataBahanController::class, 'update'])->name('bahan.update');
    Route::patch('/bahan/{id}', [DataBahanController::class, 'update']);
    Route::delete('/bahan/{id}', [DataBahanController::class, 'destroy'])->name('bahan.destroy');

    Route::resource('bahan-masuk', BahanMasukController::class);
    Route::resource('bahan-keluar', BahanKeluarController::class)->only([
        'index',
        'store',
        'update',
        'destroy',
    ]);

    Route::get('/sisa-bahan', [SisaBahanAkhirBulanController::class, 'index'])
        ->name('sisa-bahan.index');
    Route::post('/sisa-bahan/sinkronisasi', [SisaBahanAkhirBulanController::class, 'sync'])
        ->name('sisa-bahan.sync');
});
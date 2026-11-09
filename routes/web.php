<?php

use App\Http\Controllers\AuthController;
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

// Autentikasi Pengguna (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Rute yang membutuhkan autentikasi / akun yang sudah login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('bahan-masuk', BahanMasukController::class);
});

Route::get('/bahan-keluar', function () {
    $data = collect([
        ['Jeruk lemon', 5], ['Sirup', 1], ['Gula cair', 1], ['Minyak cabe', 5],
        ['Timun', 2], ['Pakcoi', 1], ['Es batu', 1], ['Bawang putih', 3],
        ['Cabe merah', 4], ['Telur', 10], ['Tepung', 2],
    ])->map(fn ($r, $i) => (object) [
        'id' => $i + 1, 'nama_bahan' => $r[0], 'jumlah' => $r[1], 'tanggal' => '2026-09-29',
    ]);

    return view('bahan_keluar.index', ['bahanKeluar' => $data]);
})->name('bahan-keluar.index');

Route::get('/sisa-bahan', function () {
    // Data contoh sementara (nanti diganti data dari database)
    $sisaBahan = collect([
        ['id' => 1, 'nama_bahan' => 'Jeruk lemon', 'jumlah' => 5, 'tanggal' => '2026-09-01'],
        ['id' => 2, 'nama_bahan' => 'Sirup',       'jumlah' => 1, 'tanggal' => '2026-09-01'],
        ['id' => 3, 'nama_bahan' => 'Gula cair',   'jumlah' => 1, 'tanggal' => '2026-09-01'],
        ['id' => 4, 'nama_bahan' => 'Minyak cabe', 'jumlah' => 5, 'tanggal' => '2026-09-01'],
        ['id' => 5, 'nama_bahan' => 'Timun',       'jumlah' => 2, 'tanggal' => '2026-09-01'],
        ['id' => 6, 'nama_bahan' => 'Pakcoi',      'jumlah' => 1, 'tanggal' => '2026-09-01'],
        ['id' => 7, 'nama_bahan' => 'Es batu',     'jumlah' => 1, 'tanggal' => '2026-09-01'],
        ['id' => 8, 'nama_bahan' => 'Bawang putih','jumlah' => 3, 'tanggal' => '2026-09-01'],
    ])->map(fn ($item) => (object) $item);

    return view('sisa_bahan.index', [
        'sisaBahan' => $sisaBahan,
        'periode'   => 'September 2026',
    ]);
})->name('sisa-bahan.index');

Route::get('/kasir', function () {
    $menus = collect([
        ['id' => 1,  'nama' => 'Gyudon',                   'kategori' => 'Makanan', 'harga' => 46000, 'foto' => null],
        ['id' => 2,  'nama' => 'Beef Teriyaki Ramen',      'kategori' => 'Makanan', 'harga' => 46000, 'foto' => null],
        ['id' => 3,  'nama' => 'Tofu Don',                 'kategori' => 'Makanan', 'harga' => 25000, 'foto' => null],
        ['id' => 4,  'nama' => 'Chicken Katsu Don',        'kategori' => 'Makanan', 'harga' => 34000, 'foto' => null],
        ['id' => 5,  'nama' => 'Oyako Don',                'kategori' => 'Makanan', 'harga' => 34000, 'foto' => null],
        ['id' => 6,  'nama' => 'Sakana Dango Souyu Ramen', 'kategori' => 'Makanan', 'harga' => 37000, 'foto' => null],
        ['id' => 7,  'nama' => 'Ebi Katsu Souyu Ramen',    'kategori' => 'Makanan', 'harga' => 37000, 'foto' => null],
        ['id' => 8,  'nama' => 'Sakana Dango Miso Ramen',  'kategori' => 'Makanan', 'harga' => 37000, 'foto' => null],
        ['id' => 9,  'nama' => 'Chikin Katsu Miso Ramen',  'kategori' => 'Makanan', 'harga' => 37000, 'foto' => null],
        ['id' => 10, 'nama' => 'Es Teh',                   'kategori' => 'Minuman', 'harga' => 5000,  'foto' => null],
        ['id' => 11, 'nama' => 'Air Putih',                'kategori' => 'Minuman', 'harga' => 3000,  'foto' => null],
        ['id' => 12, 'nama' => 'Ocha',                     'kategori' => 'Minuman', 'harga' => 8000,  'foto' => null],
        ['id' => 13, 'nama' => 'Jus Jeruk',                'kategori' => 'Minuman', 'harga' => 12000, 'foto' => null],
    ])->map(fn ($item) => (object) $item);

    return view('kasir.index', compact('menus'));
})->name('kasir.index');

// ===== RIWAYAT TRANSAKSI (data dummy sementara) =====
Route::get('/riwayat-transaksi', function () {
    $buat = function ($id, $kode, $cabang, $tanggal, $items) {
        return (object) [
            'id'      => $id,
            'kode'    => $kode,
            'cabang'  => $cabang,
            'tanggal' => $tanggal,
            'items'   => $items,
            'total'   => collect($items)->sum(fn ($i) => $i['qty'] * $i['harga']),
        ];
    };

    $pesananA = [
        ['nama' => 'Tofu Don',          'qty' => 2, 'harga' => 25000],
        ['nama' => 'Chicken Katsu Don', 'qty' => 1, 'harga' => 34000],
        ['nama' => 'Es Teh',            'qty' => 2, 'harga' => 5000],
        ['nama' => 'Air Putih',         'qty' => 1, 'harga' => 3000],
    ];
    $pesananB = [
        ['nama' => 'Gyudon',  'qty' => 1, 'harga' => 46000],
        ['nama' => 'Es Teh',  'qty' => 1, 'harga' => 5000],
    ];

    $transaksi = collect([
        $buat(1,  '3JDJAPSOW',    'Cabang 1', '2026-09-01 15:12', $pesananA),
        $buat(2,  '4JF2OWAOJDA',  'Cabang 1', '2026-09-01 15:08', $pesananA),
        $buat(3,  '9CUAL3MFO',    'Cabang 1', '2026-09-01 15:00', $pesananA),
        $buat(4,  'KSIF0209FJFI', 'Cabang 1', '2026-09-01 14:45', $pesananA),
        $buat(5,  'JF99QJIR39D',  'Cabang 1', '2026-09-01 14:40', $pesananA),
        $buat(6,  'KD02QJF9E0',   'Cabang 1', '2026-09-01 14:38', $pesananA),
        $buat(7,  '93MKSF730',    'Cabang 1', '2026-09-01 14:35', $pesananA),
        $buat(8,  'P0LK2MSA1',    'Cabang 1', '2026-09-01 14:20', $pesananB),
        $buat(9,  'ZX81KQWE5',    'Cabang 2', '2026-09-01 13:10', $pesananB),
        $buat(10, 'MN45BVCX2',    'Cabang 2', '2026-09-01 12:55', $pesananA),
        $buat(11, 'QW12ERTY7',    'Cabang 3', '2026-09-01 11:30', $pesananB),
    ]);

    return view('riwayat_transaksi.index', [
        'transaksi' => $transaksi,
        'periode'   => 'September 2026',
    ]);
})->name('riwayat.index');

// ===== OMSET HARIAN (data dummy sementara) =====
Route::get('/omset-harian', function () {
    $buat = function ($id, $kode, $waktu, $metode, $items) {
        return (object) [
            'id'     => $id,
            'kode'   => $kode,
            'waktu'  => $waktu,
            'metode' => $metode,
            'items'  => $items,
            'total'  => collect($items)->sum(fn ($i) => $i['qty'] * $i['harga']),
        ];
    };

    $pesananA = [
        ['nama' => 'Tofu Don',          'qty' => 2, 'harga' => 25000],
        ['nama' => 'Chicken Katsu Don', 'qty' => 1, 'harga' => 34000],
        ['nama' => 'Es Teh',            'qty' => 2, 'harga' => 5000],
        ['nama' => 'Air Putih',         'qty' => 1, 'harga' => 3000],
    ];
    $pesananB = [
        ['nama' => 'Gyudon', 'qty' => 1, 'harga' => 46000],
        ['nama' => 'Es Teh', 'qty' => 1, 'harga' => 5000],
    ];

    $transaksi = collect([
        $buat(1, '3JDJAPSOW',    '2026-09-01 15:12', 'QRIS', $pesananA),
        $buat(2, '4JF2OWAOJDA',  '2026-09-01 15:08', 'Cash', $pesananA),
        $buat(3, '9CUAL3MFO',    '2026-09-01 15:00', 'QRIS', $pesananA),
        $buat(4, 'KSIF0209FJFI', '2026-09-01 14:45', 'QRIS', $pesananA),
        $buat(5, 'JF99QJIR39D',  '2026-09-01 14:40', 'Cash', $pesananA),
        $buat(6, 'KD02QJF9E0',   '2026-09-01 14:38', 'Cash', $pesananA),
        $buat(7, '93MKSF730',    '2026-09-01 14:35', 'Cash', $pesananA),
        $buat(8, 'P0LK2MSA1',    '2026-09-01 14:20', 'QRIS', $pesananB),
        $buat(9, 'ZX81KQWE5',    '2026-09-01 13:10', 'Cash', $pesananB),
    ]);

    return view('omset_harian.index', [
        'transaksi' => $transaksi,
        'tanggal'   => '2026-09-01',
    ]);
})->name('omset-harian.index');

// ===== OMSET BULANAN (data dummy sementara) =====
Route::get('/omset-bulanan', function () {
    $omsetHarian = collect([
        ['id' => 1, 'tanggal' => '2026-09-30', 'barang_terjual' => 80,  'transaksi' => 65,  'metode' => 'QRIS', 'total' => 5102389],
        ['id' => 2, 'tanggal' => '2026-09-29', 'barang_terjual' => 100, 'transaksi' => 82,  'metode' => 'Cash', 'total' => 7102389],
        ['id' => 3, 'tanggal' => '2026-09-28', 'barang_terjual' => 70,  'transaksi' => 54,  'metode' => 'QRIS', 'total' => 4102389],
        ['id' => 4, 'tanggal' => '2026-09-27', 'barang_terjual' => 210, 'transaksi' => 160, 'metode' => 'QRIS', 'total' => 6102389],
        ['id' => 5, 'tanggal' => '2026-09-26', 'barang_terjual' => 301, 'transaksi' => 210, 'metode' => 'Cash', 'total' => 5192389],
        ['id' => 6, 'tanggal' => '2026-09-25', 'barang_terjual' => 180, 'transaksi' => 140, 'metode' => 'Cash', 'total' => 4101389],
        ['id' => 7, 'tanggal' => '2026-09-24', 'barang_terjual' => 301, 'transaksi' => 205, 'metode' => 'Cash', 'total' => 3102389],
        ['id' => 8, 'tanggal' => '2026-09-23', 'barang_terjual' => 150, 'transaksi' => 120, 'metode' => 'QRIS', 'total' => 4802389],
        ['id' => 9, 'tanggal' => '2026-09-22', 'barang_terjual' => 95,  'transaksi' => 70,  'metode' => 'Cash', 'total' => 3902389],
    ])->map(fn ($item) => (object) $item);

    return view('omset_bulanan.index', [
        'omsetHarian' => $omsetHarian,
        'bulan'       => '2026-09-01',
    ]);
})->name('omset-bulanan.index');

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kasir</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.19.0/dist/tabler-icons.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            height: 100vh;
            overflow: hidden;
            color: #111;
        }

        .sidebar {
            width: 220px;
            background: #fff;
            border-right: 2px solid #ddd;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 22px 18px;
        }

        .brand img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
        }

        .brand span {
            color: #d40000;
            font-weight: 600;
            font-size: 15px;
            line-height: 1.3;
        }

        .sidebar nav {
            padding: 8px 12px;
        }

        .sidebar nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            margin-bottom: 8px;
            color: #111;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            border-radius: 8px;
        }

        .sidebar nav a svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .sidebar nav a:hover {
            background: #ffe3e3;
        }

        .sidebar nav a.active {
            background: #ff9a9a;
            color: #fff;
        }

        .logout-box {
            margin: auto 12px 0;
            padding: 16px 0 24px;
            border-top: 1px solid #999;
        }

        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: #f8d3d3;
            color: #d40000;
            border: none;
            border-radius: 8px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
        }

        .logout-btn i {
            font-size: 18px;
        }

        .logout-btn:hover {
            background: #f3bcbc;
        }

        .main {
            flex: 1;
            min-width: 0;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 460px;
            background: #f8f9fa;
        }

        .kiri {
            display: flex;
            flex-direction: column;
            min-height: 0;
            padding: 28px 24px 24px;
        }

        .kiri h1 {
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 16px;
        }

        .search-box {
            position: relative;
            margin-bottom: 16px;
        }

        .search-box svg {
            position: absolute;
            left: 10px;
            top: 50%;
            width: 15px;
            height: 15px;
            transform: translateY(-50%);
            color: #999;
        }

        .search-box input {
            width: 100%;
            height: 34px;
            padding: 0 12px 0 32px;
            border: 1px solid #aaa;
            border-radius: 6px;
            background: #f4f4f4;
            font-family: inherit;
            font-size: 12px;
            outline: none;
        }

        .search-box input:focus {
            border-color: #ff9a9a;
            background: #fff;
        }

        .kategori-tabs {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 16px;
        }

        .kategori-tab {
            height: 34px;
            border: 1px solid #aaa;
            border-radius: 6px;
            background: #f4f4f4;
            color: #999;
            font-family: inherit;
            font-size: 12px;
            cursor: pointer;
        }

        .kategori-tab:hover {
            background: #ececec;
        }

        .kategori-tab.active {
            background: #ff9a9a;
            border-color: #ff9a9a;
            color: #fff;
            font-weight: 500;
        }

        .menu-panel {
            flex: 1;
            min-height: 0;
            overflow-y: auto;
            background: #fff;
            border-radius: 10px;
            padding: 22px 16px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.18);
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .menu-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        .menu-foto {
            position: relative;
            aspect-ratio: 4 / 3;
            overflow: hidden;
            background: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #aaa;
            font-size: 11px;
        }

        .menu-foto img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .menu-body {
            flex: 1;
            padding: 12px 12px 12px;
            display: flex;
            flex-direction: column;
        }

        .menu-nama {
            font-size: 14px;
            font-weight: 500;
            line-height: 1.4;
        }

        .menu-kategori {
            font-size: 11px;
            color: #444;
            margin-top: 2px;
        }

        .menu-bawah {
            margin-top: auto;
            padding-top: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-harga {
            font-size: 14px;
            font-weight: 500;
        }

        .btn-add {
            width: 28px;
            height: 28px;
            border: none;
            border-radius: 6px;
            background: #ff8a8a;
            color: #fff;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-add svg {
            width: 18px;
            height: 18px;
        }

        .btn-add:hover {
            background: #f86f6f;
        }

        .menu-kosong {
            display: none;
            text-align: center;
            color: #999;
            font-size: 12px;
            padding: 30px 0;
        }

        .cart-panel {
            background: #fff;
            border-radius: 10px 0 0 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            padding: 30px 26px;
            overflow-y: auto;
        }

        .cart-title {
            font-size: 15px;
            font-weight: 500;
            padding-bottom: 10px;
            border-bottom: 1px solid #bbb;
        }

        .cart-item {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto 100px;
            align-items: center;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid #bbb;
        }

        .ci-nama,
        .ci-harga,
        .ci-total {
            font-size: 13px;
        }

        .ci-harga {
            margin-top: 6px;
        }

        .ci-total {
            text-align: right;
        }

        .qty {
            display: flex;
            height: 30px;
            border: 1px solid #888;
            border-radius: 4px;
            overflow: hidden;
        }

        .qty button {
            width: 30px;
            border: none;
            background: #fff;
            color: #777;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty button svg {
            width: 16px;
            height: 16px;
        }

        .qty button:hover {
            background: #ffe3e3;
        }

        .qty input {
            width: 40px;
            border: none;
            border-left: 1px solid #888;
            border-right: 1px solid #888;
            text-align: center;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            -moz-appearance: textfield;
        }

        .qty input::-webkit-outer-spin-button,
        .qty input::-webkit-inner-spin-button,
        .ringkasan-row input::-webkit-outer-spin-button,
        .ringkasan-row input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .cart-kosong {
            font-size: 13px;
            color: #999;
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #bbb;
        }

        .ringkasan {
            padding: 14px 0 16px;
            border-bottom: 1px solid #bbb;
        }

        .ringkasan-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .ringkasan-row:last-child {
            margin-bottom: 0;
        }

        .ringkasan-row.tebal {
            font-weight: 500;
        }

        .ringkasan-row.atas {
            margin-bottom: 14px;
        }

        .input-diskon {
            display: flex;
            align-items: center;
        }

        .input-diskon input {
            width: 40px;
            border: 1px solid transparent;
            border-radius: 4px;
            background: transparent;
            text-align: right;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            -moz-appearance: textfield;
        }


        .metode {
            display: flex;
            gap: 10px;
            padding: 16px 0 0;
        }

        .btn-metode {
            height: 34px;
            min-width: 90px;
            padding: 0 14px;
            border: 1px solid #555;
            border-radius: 6px;
            background: #fff;
            color: #111;
            font-family: inherit;
            font-size: 13px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .btn-metode img {
            height: 16px;
        }

        .btn-metode svg {
            width: 20px;
            height: 20px;
        }

        .btn-metode:hover {
            background: #fff3f3;
        }

        .btn-metode.active {
            border-color: #ff8a8a;
            background: #ffe3e3;
        }

        .btn-bayar {
            width: 100%;
            height: 42px;
            margin-top: 24px;
            border: none;
            border-radius: 6px;
            background: #ff8a8a;
            color: #fff;
            font-family: inherit;
            font-size: 15px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .btn-bayar:hover {
            background: #f86f6f;
        }
    </style>
</head>
<body>

    @php
        $menus = \App\Models\Produk::orderBy('nama_produk')->get();

        $pakaiFotoMixYaki = ['Kaniyaki', 'Beef Sosis Yaki', 'Tunayaki', 'Ebiyaki', 'Ikayaki', 'Takoyaki Octopus', 'Takoyaki Flavors'];

        if ($menus->isEmpty()) {
            $menus = collect([
                ['id_produk' => 1, 'nama_produk' => 'Sakana Dango Souyu Ramen', 'kategori' => 'Makanan', 'harga' => 22000],
                ['id_produk' => 2, 'nama_produk' => 'Ebi Katsu Souyu Ramen', 'kategori' => 'Makanan', 'harga' => 37000],
                ['id_produk' => 3, 'nama_produk' => 'Chicken Katsu Souyu Ramen', 'kategori' => 'Makanan', 'harga' => 34000],
                ['id_produk' => 4, 'nama_produk' => 'Sakana Dango Miso Ramen', 'kategori' => 'Makanan', 'harga' => 24000],
                ['id_produk' => 5, 'nama_produk' => 'Ebi Katsu Miso Ramen', 'kategori' => 'Makanan', 'harga' => 38000],
                ['id_produk' => 6, 'nama_produk' => 'Chicken Katsu Miso Ramen', 'kategori' => 'Makanan', 'harga' => 35000],
                ['id_produk' => 7, 'nama_produk' => 'Sakana Dango Kare Ramen', 'kategori' => 'Makanan', 'harga' => 25000],
                ['id_produk' => 8, 'nama_produk' => 'Ebi Katsu Kare Ramen', 'kategori' => 'Makanan', 'harga' => 39000],
                ['id_produk' => 9, 'nama_produk' => 'Chicken Katsu Kare Ramen', 'kategori' => 'Makanan', 'harga' => 36000],
                ['id_produk' => 10, 'nama_produk' => 'Beef Chasu Ramen', 'kategori' => 'Makanan', 'harga' => 49000],
                ['id_produk' => 11, 'nama_produk' => 'Chiken Chasu Ramen', 'kategori' => 'Makanan', 'harga' => 40000],
                ['id_produk' => 12, 'nama_produk' => 'Beef Teriyaki Ramen', 'kategori' => 'Makanan', 'harga' => 46000],
                ['id_produk' => 13, 'nama_produk' => 'Chicken Teriyaki Ramen', 'kategori' => 'Makanan', 'harga' => 35000],
                ['id_produk' => 14, 'nama_produk' => 'Beef Tantanmen', 'kategori' => 'Makanan', 'harga' => 45000],
                ['id_produk' => 15, 'nama_produk' => 'Chiken Tantanmen', 'kategori' => 'Makanan', 'harga' => 35000],
                ['id_produk' => 16, 'nama_produk' => 'Gyudon', 'kategori' => 'Makanan', 'harga' => 46000],
                ['id_produk' => 17, 'nama_produk' => 'Beef Teriyaki Don', 'kategori' => 'Makanan', 'harga' => 46000],
                ['id_produk' => 18, 'nama_produk' => 'Tofu Don', 'kategori' => 'Makanan', 'harga' => 25000],
                ['id_produk' => 19, 'nama_produk' => 'Ebi Katsu Don', 'kategori' => 'Makanan', 'harga' => 37000],
                ['id_produk' => 20, 'nama_produk' => 'Chicken Katsu Don', 'kategori' => 'Makanan', 'harga' => 34000],
                ['id_produk' => 21, 'nama_produk' => 'Oyakodon', 'kategori' => 'Makanan', 'harga' => 34000],
                ['id_produk' => 22, 'nama_produk' => 'Sushi Kebab Beef', 'kategori' => 'Makanan', 'harga' => 42000],
                ['id_produk' => 23, 'nama_produk' => 'Sushi Kebab Chicken', 'kategori' => 'Makanan', 'harga' => 36000],
                ['id_produk' => 24, 'nama_produk' => 'Sushi Kebab Sosis', 'kategori' => 'Makanan', 'harga' => 36000],
                ['id_produk' => 25, 'nama_produk' => 'Sushi Ebi Kastu', 'kategori' => 'Makanan', 'harga' => 37000],
                ['id_produk' => 26, 'nama_produk' => 'Sushi Chicken Katsu', 'kategori' => 'Makanan', 'harga' => 34000],
                ['id_produk' => 27, 'nama_produk' => 'Sushi Tuna Mayo', 'kategori' => 'Makanan', 'harga' => 34000],
                ['id_produk' => 28, 'nama_produk' => 'Sushi Kani Mayo', 'kategori' => 'Makanan', 'harga' => 30000],
                ['id_produk' => 29, 'nama_produk' => 'Sushi Furosu', 'kategori' => 'Makanan', 'harga' => 28000],
                ['id_produk' => 30, 'nama_produk' => 'Sushi Beef Teriyaki', 'kategori' => 'Makanan', 'harga' => 37000],
                ['id_produk' => 31, 'nama_produk' => 'Sushi Sosis', 'kategori' => 'Makanan', 'harga' => 32000],
                ['id_produk' => 32, 'nama_produk' => 'Beef Yakisoba', 'kategori' => 'Makanan', 'harga' => 32000],
                ['id_produk' => 33, 'nama_produk' => 'Chicken Yakisoba', 'kategori' => 'Makanan', 'harga' => 24000],
                ['id_produk' => 34, 'nama_produk' => 'Beef Chahan', 'kategori' => 'Makanan', 'harga' => 37000],
                ['id_produk' => 35, 'nama_produk' => 'Chicken Chahan', 'kategori' => 'Makanan', 'harga' => 26000],
                ['id_produk' => 36, 'nama_produk' => 'Ebi Chahan', 'kategori' => 'Makanan', 'harga' => 37000],
                ['id_produk' => 37, 'nama_produk' => 'Yakitori', 'kategori' => 'Makanan', 'harga' => 32000],
                ['id_produk' => 38, 'nama_produk' => 'Chicken Curry Rice', 'kategori' => 'Makanan', 'harga' => 35000],
                ['id_produk' => 39, 'nama_produk' => 'Gohan', 'kategori' => 'Makanan', 'harga' => 6000],
                ['id_produk' => 40, 'nama_produk' => 'Kaniyaki', 'kategori' => 'Makanan', 'harga' => 18000],
                ['id_produk' => 41, 'nama_produk' => 'Beef Sosis Yaki', 'kategori' => 'Makanan', 'harga' => 18000],
                ['id_produk' => 42, 'nama_produk' => 'Tunayaki', 'kategori' => 'Makanan', 'harga' => 18000],
                ['id_produk' => 43, 'nama_produk' => 'Ebiyaki', 'kategori' => 'Makanan', 'harga' => 18000],
                ['id_produk' => 44, 'nama_produk' => 'Ikayaki', 'kategori' => 'Makanan', 'harga' => 20000],
                ['id_produk' => 45, 'nama_produk' => 'Takoyaki Octopus', 'kategori' => 'Makanan', 'harga' => 25000],
                ['id_produk' => 46, 'nama_produk' => 'Takoyaki Flavors', 'kategori' => 'Makanan', 'harga' => 18000],
                ['id_produk' => 47, 'nama_produk' => 'Mix Yaki', 'kategori' => 'Makanan', 'harga' => 18000],
                ['id_produk' => 48, 'nama_produk' => 'Chicken Katsu Small', 'kategori' => 'Makanan', 'harga' => 10000],
                ['id_produk' => 49, 'nama_produk' => 'Chicken Katsu Big', 'kategori' => 'Makanan', 'harga' => 20000],
                ['id_produk' => 50, 'nama_produk' => 'Chawan Mushi', 'kategori' => 'Makanan', 'harga' => 10000],
                ['id_produk' => 51, 'nama_produk' => 'Miso Shiru', 'kategori' => 'Makanan', 'harga' => 13000],
                ['id_produk' => 52, 'nama_produk' => 'French Fries', 'kategori' => 'Makanan', 'harga' => 16000],
                ['id_produk' => 53, 'nama_produk' => 'Edamame', 'kategori' => 'Makanan', 'harga' => 16000],
                ['id_produk' => 54, 'nama_produk' => 'Tsumetai Kocha (Es Teh)', 'kategori' => 'Minuman', 'harga' => 7000],
                ['id_produk' => 55, 'nama_produk' => 'Tsumetai Shiroppu (Es Sirup)', 'kategori' => 'Minuman', 'harga' => 7000],
                ['id_produk' => 56, 'nama_produk' => 'Tsumetai Ocha (Es Green Tea)', 'kategori' => 'Minuman', 'harga' => 10000],
                ['id_produk' => 57, 'nama_produk' => 'Tsumetai Remon (Es Lemon)', 'kategori' => 'Minuman', 'harga' => 10000],
                ['id_produk' => 58, 'nama_produk' => 'Tsumetai Ko-hi (Es Kopi)', 'kategori' => 'Minuman', 'harga' => 10000],
                ['id_produk' => 59, 'nama_produk' => 'Omizu (Air Putih)', 'kategori' => 'Minuman', 'harga' => 2000],
                ['id_produk' => 60, 'nama_produk' => 'Mineraru wōtā (Air Mineral Kemasan)', 'kategori' => 'Minuman', 'harga' => 5000],
                ['id_produk' => 61, 'nama_produk' => 'Wadang Jahe', 'kategori' => 'Minuman', 'harga' => 12000],
                ['id_produk' => 62, 'nama_produk' => 'Teh Jahe', 'kategori' => 'Minuman', 'harga' => 13000],
                ['id_produk' => 63, 'nama_produk' => 'Kopi Jahe', 'kategori' => 'Minuman', 'harga' => 15000],
            ])->map(fn ($menu) => (object) $menu);
        }
    @endphp

    <div class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>Yusukekun<br>Resutoran</span>
        </div>

        <nav>
            <a href="{{ route('dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.6 19.5a9 9 0 1 1 12.8 0z"/><path d="M12 14l3.5-3.5"/><path d="M7.5 12h.5M12 7.5V8M16.5 12H16M8.8 8.8l.4.4"/></svg> Dashboard</a>
            <a href="{{ route('kasir.index') }}" class="active"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h2.5l2.3 11.5h11.4L20.5 6H5.2"/><path d="M8 19.5h1.5M15.5 19.5H17"/></svg> Kasir</a>
            <a href="{{ route('data-bahan.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.7l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.7l7 4a2 2 0 0 0 2 0l7-4a2 2 0 0 0 1-1.7z"/><path d="M3.3 7L12 12l8.7-5M12 22V12"/></svg> Stok Bahan</a>
            <a href="{{ route('riwayat.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l3.5 3.5"/></svg> Riwayat Transaksi</a>
            <a href="{{ route('omset-harian.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="19" rx="2"/><path d="M10 3h4v2h-4z"/><path d="M8 11l1.2 1.2L11 10.4M13.5 11.5H16M8 16.5h2M13.5 16.5H16"/></svg> Omset Harian</a>
            <a href="{{ route('omset-bulanan.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 9.5h18M3 7.5h18M7.5 3v4M12 3v4M16.5 3v4"/><path d="M7 13.5h.01M10.3 13.5h.01M13.7 13.5h.01M17 13.5h.01M7 17h.01M10.3 17h.01M13.7 17h.01M17 17h.01" stroke-width="2.5"/></svg> Omset Bulanan</a>
            <a href="{{ Route::has('karyawan.index') ? route('karyawan.index') : '#' }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="5.5" r="2.5"/><circle cx="5" cy="9" r="2"/><circle cx="19" cy="9" r="2"/><path d="M8.5 20.5V17a3.5 3.5 0 0 1 7 0v3.5z"/><path d="M5.5 19.5H2.5v-2a2.5 2.5 0 0 1 3.7-2.2M18.5 19.5h3v-2a2.5 2.5 0 0 0-3.7-2.2"/></svg> Kehadiran Karyawan</a>
        </nav>

        <div class="logout-box">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="ti ti-logout"></i> Log Out
                </button>
            </form>
        </div>
    </div>

    <div class="main">

        <div class="kiri">
            <h1>Kasir</h1>

            <div class="search-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/></svg>
                <input type="text" id="cariMenu" placeholder="Cari ...">
            </div>

            <div class="kategori-tabs">
                <button type="button" class="kategori-tab active" data-kategori="semua">Semua</button>
                <button type="button" class="kategori-tab" data-kategori="makanan">Makanan</button>
                <button type="button" class="kategori-tab" data-kategori="minuman">Minuman</button>
            </div>

            <div class="menu-panel">
                <div class="menu-grid">
                    @foreach ($menus as $item)
                        @php
                            $nama = $item->nama_produk ?? $item->nama_menu ?? $item->nama ?? '-';
                            $kategori = $item->kategori ?? 'Makanan';
                            $harga = (int) ($item->harga ?? 0);
                            $namaFoto = in_array($nama, $pakaiFotoMixYaki) ? 'Mix Yaki' : $nama;
                        @endphp

                        <div class="menu-card"
                             data-id="{{ $item->id_produk ?? $item->id ?? $loop->index }}"
                             data-nama="{{ $nama }}"
                             data-kategori="{{ str_contains(strtolower($kategori), 'minum') ? 'minuman' : 'makanan' }}"
                             data-harga="{{ $harga }}">

                            <div class="menu-foto">
                                Belum ada foto
                                <img src="{{ asset('images/menu/' . rawurlencode($namaFoto) . '.jpg') }}" alt="{{ $nama }}" loading="lazy" decoding="async"
                                     onerror="if (this.src.endsWith('.jpg')) { this.src = this.src.replace('.jpg', '.png'); } else if (this.src.endsWith('.png')) { this.src = this.src.replace('.png', '.jpeg'); } else { this.remove(); }">
                            </div>

                            <div class="menu-body">
                                <div class="menu-nama">{{ $nama }}</div>
                                <div class="menu-kategori">{{ ucfirst($kategori) }}</div>

                                <div class="menu-bawah">
                                    <span class="menu-harga">Rp{{ number_format($harga, 0, ',', '.') }}</span>
                                    <button type="button" class="btn-add" title="Tambah">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="menu-kosong" id="menuKosong">Menu tidak ditemukan.</div>
            </div>
        </div>

        <div class="cart-panel">
            <div class="cart-title">Item Dipilih</div>

            <div id="cartList"></div>

            <div class="ringkasan">
                <div class="ringkasan-row atas">
                    <span>Jumlah Item</span>
                    <span id="jumlahItem">0</span>
                </div>
                <div class="ringkasan-row tebal">
                    <span>Sub total</span>
                    <span id="subTotal">Rp0</span>
                </div>
                <div class="ringkasan-row tebal">
                    <span>Diskon</span>
                    <span class="input-diskon">
                        <input type="number" id="diskon" value="0" readonly>%
                    </span>
                </div>
                <div class="ringkasan-row tebal">
                    <span>Total</span>
                    <span id="total">Rp0</span>
                </div>
            </div>

            <div class="metode">
                <button type="button" class="btn-metode" data-metode="qris">
                    <img src="{{ asset('images/qris.png') }}" alt="QRIS"
                     onerror="if (this.src.includes('wikimedia')) { this.outerHTML = 'QRIS'; } else { this.src = 'https://commons.wikimedia.org/wiki/Special:FilePath/Logo_QRIS.svg'; }">
                </button>
                <button type="button" class="btn-metode" data-metode="cash">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="11" rx="1.5"/><circle cx="12" cy="12.5" r="2.5"/><path d="M5 5h14"/></svg>
                    Cash
                </button>
            </div>

            <button type="button" class="btn-bayar" id="btnBayar">Bayar</button>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: @json(session('success')),
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    <script>
        const keranjang = {};
        const cartList = document.getElementById('cartList');
        const inputDiskon = document.getElementById('diskon');
        const semuaKartu = document.querySelectorAll('.menu-card');
        let kategoriAktif = 'semua';
        let metodeBayar = '';
        const idCabang = "{{ Auth::user()->id_cabang ?? '' }}";
        const urlSimpan = "{{ route('kasir.store') }}";

        const ikonKurang = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M5 12h14"/></svg>';
        const ikonTambah = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>';

        function rupiah(angka) {
            return 'Rp' + Math.round(angka).toLocaleString('id-ID');
        }

        function filterMenu() {
            const kata = document.getElementById('cariMenu').value.trim().toLowerCase();
            let jumlahTampil = 0;

            semuaKartu.forEach(function (kartu) {
                const cocokKategori = kategoriAktif === 'semua' || kartu.dataset.kategori === kategoriAktif;
                const cocokNama = kartu.dataset.nama.toLowerCase().includes(kata);

                if (cocokKategori && cocokNama) {
                    kartu.style.display = '';
                    jumlahTampil++;
                } else {
                    kartu.style.display = 'none';
                }
            });

            document.getElementById('menuKosong').style.display = jumlahTampil === 0 ? 'block' : 'none';
        }

        document.getElementById('cariMenu').addEventListener('input', filterMenu);

        document.querySelectorAll('.kategori-tab').forEach(function (tab) {
            tab.addEventListener('click', function () {
                document.querySelectorAll('.kategori-tab').forEach(function (t) {
                    t.classList.remove('active');
                });
                tab.classList.add('active');
                kategoriAktif = tab.dataset.kategori;
                filterMenu();
            });
        });

        document.querySelectorAll('.btn-add').forEach(function (tombol) {
            tombol.addEventListener('click', function () {
                const kartu = tombol.closest('.menu-card');
                const id = kartu.dataset.id;

                if (keranjang[id]) {
                    keranjang[id].qty++;
                } else {
                    keranjang[id] = {
                        nama: kartu.dataset.nama,
                        harga: Number(kartu.dataset.harga),
                        qty: 1
                    };
                }

                tampilkanKeranjang();
            });
        });

        function ubahQty(id, qty) {
            if (!qty || qty <= 0) {
                delete keranjang[id];
            } else {
                keranjang[id].qty = qty;
            }

            tampilkanKeranjang();
        }

        function tampilkanKeranjang() {
            cartList.innerHTML = '';
            const daftarId = Object.keys(keranjang);

            if (daftarId.length === 0) {
                cartList.innerHTML = '<div class="cart-kosong">Belum ada item yang dipilih.</div>';
            }

            daftarId.forEach(function (id) {
                const item = keranjang[id];
                const baris = document.createElement('div');
                baris.className = 'cart-item';
                baris.innerHTML =
                    '<div><div class="ci-nama"></div><div class="ci-harga"></div></div>' +
                    '<div class="qty">' +
                        '<button type="button" class="kurang">' + ikonKurang + '</button>' +
                        '<input type="number" min="0">' +
                        '<button type="button" class="tambah">' + ikonTambah + '</button>' +
                    '</div>' +
                    '<div class="ci-total"></div>';

                baris.querySelector('.ci-nama').textContent = item.nama;
                baris.querySelector('.ci-harga').textContent = rupiah(item.harga);
                baris.querySelector('.ci-total').textContent = rupiah(item.harga * item.qty);

                const input = baris.querySelector('input');
                input.value = item.qty;
                input.onchange = function () { ubahQty(id, parseInt(input.value)); };
                baris.querySelector('.kurang').onclick = function () { ubahQty(id, item.qty - 1); };
                baris.querySelector('.tambah').onclick = function () { ubahQty(id, item.qty + 1); };

                cartList.appendChild(baris);
            });

            hitungTotal();
        }

        function hitungTotal() {
            let jumlahItem = 0;
            let subTotal = 0;

            Object.values(keranjang).forEach(function (item) {
                jumlahItem += item.qty;
                subTotal += item.harga * item.qty;
            });

            let diskon = Number(inputDiskon.value) || 0;
            if (diskon < 0) diskon = 0;
            if (diskon > 100) diskon = 100;

            const total = subTotal - (subTotal * diskon / 100);

            document.getElementById('jumlahItem').textContent = jumlahItem;
            document.getElementById('subTotal').textContent = rupiah(subTotal);
            document.getElementById('total').textContent = rupiah(total);

            return { diskon: diskon, total: total };
        }

        function cekDiskon() {
            const jam = new Date().getHours();
            inputDiskon.value = (jam >= 11 && jam < 13) ? 10 : 0;
            hitungTotal();
        }

        cekDiskon();
        setInterval(cekDiskon, 60000);

        document.querySelectorAll('.btn-metode').forEach(function (tombol) {
            tombol.addEventListener('click', function () {
                document.querySelectorAll('.btn-metode').forEach(function (t) {
                    t.classList.remove('active');
                });
                tombol.classList.add('active');
                metodeBayar = tombol.dataset.metode;
            });
        });

        function kosongkanKeranjang() {
            for (const id in keranjang) {
                delete keranjang[id];
            }
            metodeBayar = '';
            document.querySelectorAll('.btn-metode').forEach(function (t) {
                t.classList.remove('active');
            });
            tampilkanKeranjang();
        }

        function buatKode() {
            const huruf = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let kode = '';
            for (let i = 0; i < 10; i++) {
                kode += huruf[Math.floor(Math.random() * huruf.length)];
            }
            return kode;
        }

        async function simpanTransaksi() {
            const tanggal = new Date().toLocaleDateString('en-CA');
            const kodeTransaksi = buatKode();

            for (const id in keranjang) {
                const data = new FormData();
                data.append('tanggal', tanggal);
                data.append('id_produk', id);
                data.append('jumlah_terjual', keranjang[id].qty);
                data.append('metode_pembayaran', metodeBayar === 'qris' ? 'QRIS' : 'Tunai');
                data.append('kode_transaksi', kodeTransaksi);
                data.append('id_cabang', idCabang);

                const respon = await fetch(urlSimpan, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: data
                });

                if (!respon.ok) {
                    let pesan = `Server menolak transaksi (HTTP ${respon.status}).`;

                    if ((respon.headers.get('content-type') || '').includes('application/json')) {
                        const hasil = await respon.json();
                        const errors = Object.values(hasil.errors || {}).flat();
                        pesan = errors.join(' ') || hasil.message || pesan;
                    }

                    throw new Error(pesan);
                }
            }
        }

        async function selesaiBayar(judul, isiPesan) {
            try {
                await simpanTransaksi();
            } catch (error) {
                const pesan = error instanceof Error ? error.message : 'Terjadi kesalahan saat menyimpan transaksi.';
                Swal.fire({ icon: 'error', title: 'Gagal menyimpan', text: pesan, confirmButtonColor: '#ff8a8a' });
                return;
            }

            Swal.fire({ icon: 'success', title: judul, html: isiPesan, confirmButtonColor: '#ff8a8a' });
            kosongkanKeranjang();
        }

        document.getElementById('btnBayar').addEventListener('click', function () {
            if (Object.keys(keranjang).length === 0) {
                Swal.fire({ icon: 'warning', title: 'Belum ada item', text: 'Pilih menu terlebih dahulu.', confirmButtonColor: '#ff8a8a' });
                return;
            }

            if (metodeBayar === '') {
                Swal.fire({ icon: 'warning', title: 'Pilih metode bayar', text: 'Pilih QRIS atau Cash dulu.', confirmButtonColor: '#ff8a8a' });
                return;
            }

            const total = Math.round(hitungTotal().total);

            if (metodeBayar === 'qris') {
                Swal.fire({
                    title: 'Pembayaran QRIS',
                    text: 'Total ' + rupiah(total) + '. Pelanggan sudah scan dan bayar?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#ff8a8a',
                    cancelButtonColor: '#9aa5b8',
                    confirmButtonText: 'Sudah dibayar',
                    cancelButtonText: 'Batal'
                }).then(function (hasil) {
                    if (!hasil.isConfirmed) return;

                    selesaiBayar('Pembayaran berhasil', 'Pembayaran QRIS ' + rupiah(total) + ' diterima.');
                });
                return;
            }

            Swal.fire({
                title: 'Pembayaran Cash',
                html: 'Total yang harus dibayar <b>' + rupiah(total) + '</b>',
                input: 'number',
                inputLabel: 'Uang diterima',
                inputAttributes: { min: 0 },
                showCancelButton: true,
                confirmButtonColor: '#ff8a8a',
                cancelButtonColor: '#9aa5b8',
                confirmButtonText: 'Bayar',
                cancelButtonText: 'Batal',
                inputValidator: function (nilai) {
                    if (!nilai || Number(nilai) < total) {
                        return 'Uang yang diterima kurang dari total.';
                    }
                }
            }).then(function (hasil) {
                if (!hasil.isConfirmed) return;

                const uang = Number(hasil.value);
                selesaiBayar('Pembayaran berhasil', 'Kembalian: <b>' + rupiah(uang - total) + '</b>');
            });
        });

        tampilkanKeranjang();
    </script>
</body>
</html>
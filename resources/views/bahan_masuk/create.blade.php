<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Bahan Masuk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fff;
            display: flex;
            min-height: 100vh;
            color: #111;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 220px;
            background: #fff;
            border-right: 2px solid #ddd;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 22px 18px;
        }

        .sidebar .brand img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
        }

        .sidebar .brand span {
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
            gap: 12px;
            padding: 12px 14px;
            color: #111;
            text-decoration: none;
            font-size: 13px;
            border-radius: 8px;
            margin-bottom: 6px;
            transition: background 0.2s ease;
        }

        .sidebar nav a i {
            width: 18px;
            text-align: center;
            font-size: 15px;
        }

        .sidebar nav a.active {
            background: #ff9a9a;
            color: #fff;
            font-weight: 500;
        }

        .sidebar nav a:not(.active):hover {
            background: #ffe3e3;
        }

        .logout-box {
            margin: auto 12px 0;
            padding: 16px 0 24px;
            border-top: 1px solid #999;
        }

        .logout-btn {
            width: 100%;
            text-align: left;
            background: #f8d3d3;
            border: none;
            padding: 10px 14px;
            color: #d40000;
            font-family: inherit;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logout-btn:hover {
            background: #f3bcbc;
        }

        /* ===== MAIN & TOPBAR ===== */
        .main {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            background: #f8f9fa;
        }

        .topbar {
            background: #fafafa;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ddd;
        }

        .topbar .title {
            font-weight: 500;
            font-size: 15px;
        }

        .topbar .avatar {
            font-size: 26px;
            line-height: 1;
            color: #000;
        }

        .content {
            padding: 24px;
        }

        .content h1 {
            font-size: 15px;
            font-weight: 400;
            margin-bottom: 18px;
        }

        /* ===== KARTU FORM ===== */
        .form-card {
            display: inline-block;
            background: #fff;
            border-radius: 10px;
            padding: 22px 24px 26px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.18);
        }

        .form-row {
            display: grid;
            grid-template-columns: 110px 220px;
            align-items: center;
            margin-bottom: 14px;
        }

        .form-row label {
            font-size: 14px;
        }

        .form-row input {
            width: 100%;
            padding: 6px 10px;
            border: 1px solid #777;
            border-radius: 4px;
            font-family: inherit;
            font-size: 12px;
            outline: none;
        }

        .form-row input:focus {
            border-color: #ff9a9a;
            box-shadow: 0 0 0 2px #ffe3e3;
        }

        .form-row input.is-invalid {
            border-color: #d40000;
        }

        .error-text {
            grid-column: 2;
            color: #d40000;
            font-size: 11px;
            margin-top: 4px;
        }

        .form-actions {
            display: flex;
            gap: 14px;
            margin-top: 24px;
        }

        .btn {
            min-width: 110px;
            border: none;
            color: #fff;
            font-family: inherit;
            font-size: 11px;
            padding: 9px 20px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }

        .btn-simpan { background: #ff9a9a; }
        .btn-simpan:hover { background: #f98585; }
        .btn-kembali { background: #9aa5b8; }
        .btn-kembali:hover { background: #8893a8; }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; border-right: none; border-bottom: 2px solid #ddd; }
            .sidebar nav { display: flex; flex-wrap: wrap; }
            .logout-box { margin: 0 12px; }
            .form-card { display: block; }
            .form-row { grid-template-columns: 1fr; gap: 6px; }
            .error-text { grid-column: 1; }
        }
    </style>
</head>
<body>

    @php
        // Link aman: kalau route belum dibuat, otomatis jadi "#" (tidak error)
        $link = fn ($nama, $param = null) => \Illuminate\Support\Facades\Route::has($nama)
            ? route($nama, $param)
            : '#';
    @endphp

    <div class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>Yusukekun<br>Resutoran</span>
        </div>

        <nav>
            <a href="{{ $link('dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="{{ $link('bahan-masuk.index') }}" class="active"><i class="fa-solid fa-box"></i> Stok Bahan</a>
            <a href="{{ $link('kasir.index') }}"><i class="fa-solid fa-cart-shopping"></i> Kasir</a>
            <a href="{{ $link('riwayat.index') }}"><i class="fa-regular fa-clock"></i> Riwayat Transaksi</a>
            <a href="{{ $link('omset-harian.index') }}"><i class="fa-regular fa-calendar-check"></i> Omset Harian</a>
            <a href="{{ $link('omset-bulanan.index') }}"><i class="fa-regular fa-calendar-days"></i> Omset Bulanan</a>
        </nav>

        <div class="logout-box">
            <form action="{{ $link('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i> Log Out
                </button>
            </form>
        </div>
    </div>

    <div class="main">
        <div class="topbar">
            <div class="title">
                {{ Auth::user()->jabatan ?? 'Manajer' }}, {{ Auth::user()->nama_admin ?? $namaUser ?? 'Administrator' }}
            </div>

            <div class="avatar" title="{{ Auth::user()->username ?? 'admin' }}">
                <i class="fa-solid fa-circle-user"></i>
            </div>
        </div>

        <div class="content">
            <h1>Tambah Data Bahan Masuk</h1>

            <div class="form-card">
                <form action="{{ $link('bahan-masuk.store') }}" method="POST">
                    @csrf

                    <div class="form-row">
                        <label for="nama_bahan">Nama Bahan</label>
                        <input type="text" id="nama_bahan" name="nama_bahan"
                               value="{{ old('nama_bahan') }}"
                               class="@error('nama_bahan') is-invalid @enderror" required>
                        @error('nama_bahan') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-row">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" id="jumlah" name="jumlah" min="1"
                               value="{{ old('jumlah') }}"
                               class="@error('jumlah') is-invalid @enderror" required>
                        @error('jumlah') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-row">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal"
                               value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                               class="@error('tanggal') is-invalid @enderror" required>
                        @error('tanggal') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-simpan">Simpan</button>
                        <a href="{{ $link('bahan-masuk.index') }}" class="btn btn-kembali">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
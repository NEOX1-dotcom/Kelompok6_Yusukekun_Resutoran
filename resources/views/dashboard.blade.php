<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fff;
            display: flex;
            min-height: 100vh;
            color: #1a1a1a;
        }

        .sidebar {
            width: 230px;
            background: #fff;
            border-right: 1px solid #eee;
            display: flex;
            flex-direction: column;
        }

        .sidebar .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 24px 20px;
        }

        .sidebar .brand img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
        }

        .sidebar .brand span {
            color: #cf1a1a;
            font-weight: 700;
            font-size: 15px;
            line-height: 1.2;
        }

        .sidebar nav {
            padding: 10px 14px;
        }

        .sidebar nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: background 0.2s ease;
        }

        .sidebar nav a i {
            width: 18px;
            text-align: center;
            font-size: 15px;
        }

        .sidebar nav a.active {
            background: #f7a8a3;
            color: #7a1410;
            font-weight: 600;
        }

        .sidebar nav a:not(.active):hover {
            background: #fbdedb;
            color: #333;
        }

        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #f7f8fa;
        }

        .topbar {
            background: #fff;
            padding: 18px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        .topbar .user {
            font-weight: 600;
            font-size: 15px;
        }

        .topbar .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #1a1a1a;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .content {
            padding: 28px 32px;
        }

        .content h1 {
            font-size: 22px;
            margin-bottom: 20px;
        }

        .stat-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #fff;
            border-radius: 10px;
            padding: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }

        .stat-card .stat-title {
            font-size: 13px;
            color: #777;
            margin-bottom: 10px;
        }

        .stat-card .stat-main {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .stat-card .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: #f7b8b4;
            color: #cf1a1a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .stat-card .stat-value {
            font-size: 20px;
            font-weight: 700;
        }

        .stat-card .stat-footer {
            margin-top: 10px;
            font-size: 12px;
            color: #999;
        }

        .stat-card .stat-footer .up {
            color: #1fa34d;
            font-weight: 600;
        }

        .stat-card .stat-footer a {
            color: #cf1a1a;
            text-decoration: none;
            font-weight: 600;
        }

        .bottom-section {
            display: grid;
            grid-template-columns: 1.3fr 1fr;
            gap: 16px;
        }

        .panel {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }

        .panel-header h2 {
            font-size: 16px;
            font-weight: 600;
        }

        .panel-header .see-all {
            border: 1px solid #ddd;
            background: #fff;
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 12px;
            color: #333;
            cursor: pointer;
            text-decoration: none;
        }

        .panel-header .see-all:hover {
            background: #f5f5f5;
        }

        .transaction-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .transaction-item:last-child {
            border-bottom: none;
        }

        .transaction-item .trx-info strong {
            display: block;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .transaction-item .trx-info span {
            font-size: 13px;
            color: #888;
        }

        .transaction-item .trx-amount {
            text-align: right;
        }

        .transaction-item .trx-amount strong {
            display: block;
            font-size: 14px;
        }

        .transaction-item .trx-amount span {
            font-size: 12px;
            color: #999;
        }

        /* Panel Omset 6 Bulan Terakhir */
        .omset-list-header {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #999;
            margin-bottom: 8px;
        }

        .omset-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .omset-item:last-child {
            border-bottom: none;
        }

        .omset-item .periode {
            font-size: 14px;
            font-weight: 600;
        }

        .omset-item .nilai {
            font-size: 14px;
            font-weight: 600;
        }

        .omset-total {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #f0f0f0;
        }

        .omset-total .total-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: #f7b8b4;
            color: #cf1a1a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .omset-total .total-text {
            font-size: 12px;
            color: #888;
        }

        .omset-total .total-text strong {
            display: block;
            font-size: 14px;
            color: #1a1a1a;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>Yusukekun<br>Resutoran</span>
        </div>
        <nav>
            <a href="{{ route('dashboard') }}" class="active"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="{{ route('bahan-masuk.index') }}"><i class="fa-solid fa-box"></i> Bahan Masuk</a>
            <a href="#"><i class="fa-solid fa-cart-shopping"></i> Kasir</a>
            <a href="#"><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Transaksi</a>
            <a href="#"><i class="fa-solid fa-calendar-day"></i> Omset Harian</a>
            <a href="#"><i class="fa-solid fa-calendar-days"></i> Omset Bulanan</a>
        </nav>
        <div style="margin-top: auto; padding: 14px; border-top: 1px solid #eee;">
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" style="width: 100%; text-align: left; background: none; border: none; padding: 10px 14px; color: #b3261e; font-size: 14px; font-weight: 600; cursor: pointer; border-radius: 8px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar (Logout)
                </button>
            </form>
        </div>
    </div>

    <div class="main">
        <div class="topbar">
            <div>
                <span style="color:#888; font-size:13px;">Selamat datang,</span>
                <span class="user" style="margin-left: 4px;">{{ Auth::user()->nama_admin ?? $namaUser ?? 'Administrator' }}</span>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <div class="avatar" title="{{ Auth::user()->username ?? 'admin' }}"><i class="fa-solid fa-user"></i></div>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="background: #fdecea; color: #b3261e; border: 1px solid #f5c2be; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                        <i class="fa-solid fa-right-from-bracket"></i> Keluar
                    </button>
                </form>
            </div>
        </div>

        <div class="content">
            <h1>Dashboard</h1>

            <!-- Kartu statistik -->
            <div class="stat-cards">

                <div class="stat-card">
                    <div class="stat-title">Omset Hari ini</div>
                    <div class="stat-main">
                        <div class="stat-icon"><i class="fa-solid fa-sack-dollar"></i></div>
                        <div class="stat-value">Rp{{ number_format($omsetHariIni ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-footer">
                        <span class="up">↗ {{ $persenOmsetHarian ?? 0 }}%</span> dari kemarin
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-title">Total Penjualan</div>
                    <div class="stat-main">
                        <div class="stat-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                        <div class="stat-value">{{ $totalPenjualan ?? 0 }}</div>
                    </div>
                    <div class="stat-footer">
                        <span class="up">↗ {{ $selisihPenjualan ?? 0 }}</span> transaksi dari kemarin
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-title">Sisa Bahan Bulan Ini</div>
                    <div class="stat-main">
                        <div class="stat-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        <div class="stat-value">{{ $sisaBahanMenipis ?? 0 }}</div>
                    </div>
                    <div class="stat-footer">
                        <a href="#">Lihat detail stok &gt;</a>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-title">Omset Bulan Ini</div>
                    <div class="stat-main">
                        <div class="stat-icon"><i class="fa-solid fa-chart-line"></i></div>
                        <div class="stat-value">Rp{{ number_format($omsetBulanIni ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-footer">
                        <span class="up">↗ {{ $persenOmsetBulanan ?? 0 }}%</span> dari bulan lalu
                    </div>
                </div>

            </div>

            <div class="bottom-section">

                <div class="panel">
                    <div class="panel-header">
                        <h2>Transaksi Terbaru</h2>
                        <a href="#" class="see-all">Lihat semua</a>
                    </div>

                    @forelse ($transaksiTerbaru ?? [] as $trx)
                        <div class="transaction-item">
                            <div class="trx-info">
                                <strong>Transaksi #{{ $trx->kode ?? '-' }}</strong>
                                <span>{{ $trx->cabang ?? '-' }}</span>
                            </div>
                            <div class="trx-amount">
                                <strong>Rp{{ number_format($trx->total ?? 0, 0, ',', '.') }}</strong>
                                <span>{{ $trx->tanggal ?? '-' }}</span>
                            </div>
                        </div>
                    @empty
                        <p style="color:#999; font-size: 14px;">Belum ada transaksi.</p>
                    @endforelse
                </div>

                <div class="panel">
                    <div class="panel-header">
                        <h2>Omset Penjualan 6 Bulan Terakhir</h2>
                    </div>

                    <div class="omset-list-header">
                        <span>Periode</span>
                        <span>Omset Penjualan</span>
                    </div>

                    @forelse ($omset6Bulan ?? [] as $item)
                        <div class="omset-item">
                            <div class="periode">{{ $item->periode ?? '-' }}</div>
                            <div class="nilai">Rp{{ number_format($item->total ?? 0, 0, ',', '.') }}</div>
                        </div>
                    @empty
                        <p style="color:#999; font-size: 14px;">Belum ada data omset.</p>
                    @endforelse

                    <div class="omset-total">
                        <div class="total-icon"><i class="fa-solid fa-chart-line"></i></div>
                        <div class="total-text">
                            Total 6 bulan
                            <strong>Rp{{ number_format($totalOmset6Bulan ?? 0, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: @json(session('success')),
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        </script>
    @endif
</body>
</html>
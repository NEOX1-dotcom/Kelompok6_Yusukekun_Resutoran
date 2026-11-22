<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.19.0/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            min-height: 100vh;
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

        .sidebar nav a i {
            width: 18px;
            text-align: center;
            font-size: 18px;
        }

        .sidebar nav a i.fa-gauge {
            font-size: 15px;
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
            background: #f8f9fa;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 24px;
            background: #fafafa;
            border-bottom: 2px solid #ddd;
        }

        .topbar .title {
            font-size: 16px;
            font-weight: 600;
        }

        .topbar .avatar {
            font-size: 26px;
        }

        .content {
            padding: 24px;
        }

        .content h1 {
            font-size: 15px;
            font-weight: 400;
            margin-bottom: 14px;
        }

        .stat-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: #fff;
            border-radius: 10px;
            padding: 16px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .stat-title {
            font-size: 12px;
            margin-bottom: 12px;
        }

        .stat-main {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: #ff9a9a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #111;
            flex-shrink: 0;
        }

        .stat-value {
            font-size: 16px;
            font-weight: 600;
        }

        .stat-footer {
            margin-top: 14px;
            font-size: 10px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-footer .naik {
            color: #1fa34d;
            display: inline-flex;
            align-items: center;
            gap: 2px;
        }

        .stat-footer .naik i {
            font-size: 13px;
        }

        .stat-footer a {
            color: #d40000;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .bottom-section {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 12px;
        }

        .panel {
            background: #fff;
            border-radius: 10px;
            padding: 20px 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }

        .panel-header h2 {
            font-size: 14px;
            font-weight: 500;
        }

        .btn-lihat {
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 10px;
            color: #111;
            text-decoration: none;
        }

        .btn-lihat:hover {
            background: #f5f5f5;
        }

        .trx-item {
            display: flex;
            justify-content: space-between;
            padding: 14px 0 16px;
            border-bottom: 1px solid #888;
        }

        .trx-item:last-child {
            border-bottom: none;
        }

        .trx-kiri {
            font-size: 14px;
            line-height: 1.4;
        }

        .trx-kanan {
            text-align: right;
        }

        .trx-kanan strong {
            display: block;
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 4px;
        }

        .trx-kanan span {
            font-size: 9px;
        }

        .kosong {
            color: #999;
            font-size: 13px;
            padding: 16px 0;
        }

        .pilih-tahun {
            appearance: none;
            -webkit-appearance: none;
            background: #ff9a9a url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='5'%3E%3Cpath d='M0 0l4 5 4-5z' fill='%23fff'/%3E%3C/svg%3E") no-repeat right 12px center;
            color: #fff;
            border: none;
            outline: none;
            border-radius: 6px;
            padding: 8px 30px 8px 16px;
            font-family: inherit;
            font-size: 10px;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .pilih-tahun:hover {
            background-color: #f98585;
        }

        .pilih-tahun:focus,
        .pilih-tahun:focus-visible {
            outline: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .pilih-tahun option {
            background: #fff;
            color: #111;
        }

        .grafik {
            height: 280px;
        }

        .total-tahun {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 14px;
            font-size: 8px;
        }

        .total-tahun .stat-icon {
            width: 32px;
            height: 32px;
            font-size: 18px;
        }

        .total-tahun strong {
            display: block;
            font-size: 11px;
        }

        @media (max-width: 1024px) {
            .stat-cards { grid-template-columns: repeat(2, 1fr); }
            .bottom-section { grid-template-columns: 1fr; }
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
            <a href="{{ route('kasir.index') }}"><i class="ti ti-shopping-cart"></i> Kasir</a>
            <a href="{{ route('data-bahan.index') }}"><i class="ti ti-box"></i> Stok Bahan</a>
            <a href="{{ route('riwayat.index') }}"><i class="ti ti-clock"></i> Riwayat Transaksi</a>
            <a href="{{ route('omset-harian.index') }}"><i class="ti ti-clipboard-list"></i> Omset Harian</a>
            <a href="{{ route('omset-bulanan.index') }}"><i class="ti ti-calendar-month"></i> Omset Bulanan</a>
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

        <div class="topbar">
            <div class="title">{{ Auth::user()->jabatan ?? 'Manajer' }}, {{ Auth::user()->nama_admin ?? '' }}</div>
            <div class="avatar"><i class="fa-solid fa-circle-user"></i></div>
        </div>

        <div class="content">
            <h1>Dashboard</h1>

            <div class="stat-cards">

                <div class="stat-card">
                    <div class="stat-title">Omset Hari ini</div>
                    <div class="stat-main">
                        <div class="stat-icon"><i class="ti ti-moneybag"></i></div>
                        <div class="stat-value">Rp.{{ number_format($omsetHariIni ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-footer">
                        <span class="naik"><i class="ti ti-arrow-up-right"></i> {{ $persenOmsetHarian ?? 0 }}%</span> dari kemarin
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-title">Total Penjualan</div>
                    <div class="stat-main">
                        <div class="stat-icon"><i class="ti ti-shopping-cart"></i></div>
                        <div class="stat-value">{{ $totalPenjualan ?? 0 }}</div>
                    </div>
                    <div class="stat-footer">
                        <span class="naik"><i class="ti ti-arrow-up-right"></i> {{ $selisihPenjualan ?? 0 }}</span> transaksi dari kemarin
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-title">Sisa Bahan Bulan Ini</div>
                    <div class="stat-main">
                        <div class="stat-icon"><i class="ti ti-alert-triangle"></i></div>
                        <div class="stat-value">{{ $sisaBahan ?? 0 }}</div>
                    </div>
                    <div class="stat-footer">
                        <a href="{{ route('sisa-bahan.index') }}">Lihat detail stok <i class="ti ti-chevron-right"></i></a>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-title">Omset Bulan Ini</div>
                    <div class="stat-main">
                        <div class="stat-icon"><i class="ti ti-chart-line"></i></div>
                        <div class="stat-value">Rp.{{ number_format($omsetBulanIni ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-footer">
                        <span class="naik"><i class="ti ti-arrow-up-right"></i> {{ $persenOmsetBulanan ?? 0 }}%</span> dari bulan lalu
                    </div>
                </div>

            </div>

            <div class="bottom-section">

                <div class="panel">
                    <div class="panel-header">
                        <h2>Transaksi Terbaru</h2>
                        <a href="{{ route('riwayat.index') }}" class="btn-lihat">Lihat semua</a>
                    </div>

                    @forelse ($transaksiTerbaru ?? [] as $trx)
                        <div class="trx-item">
                            <div class="trx-kiri">
                                <div>Transaksi #{{ $trx->kode_transaksi }}</div>
                                <div>{{ $trx->cabang->nama_cabang ?? '-' }}</div>
                            </div>
                            <div class="trx-kanan">
                                <strong>Rp.{{ number_format($trx->total, 0, ',', '.') }}</strong>
                                <span>{{ \Carbon\Carbon::parse($trx->tanggal)->locale('id')->translatedFormat('d F Y H.i') }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="kosong">Belum ada transaksi.</p>
                    @endforelse
                </div>

                <div class="panel">
                    <div class="panel-header">
                        <h2>Omset Penjualan 12 Bulan</h2>
                        <form method="GET" action="{{ route('dashboard') }}">
                            <select name="tahun" class="pilih-tahun" onchange="this.form.submit()">
                                @foreach ($daftarTahun ?? range(date('Y'), date('Y') - 4) as $t)
                                    <option value="{{ $t }}" {{ $t == ($tahun ?? request('tahun', date('Y'))) ? 'selected' : '' }}>{{ $t }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <div class="grafik">
                        <canvas id="grafikOmset"></canvas>
                    </div>

                    <div class="total-tahun">
                        <div class="stat-icon"><i class="ti ti-chart-line"></i></div>
                        <div>
                            Total 12 bulan
                            <strong>Rp.{{ number_format(array_sum($omsetPerBulan ?? []), 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        const dataOmset = @json(array_values($omsetPerBulan ?? array_fill(0, 12, 0)));
        const namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        function rupiah(angka) {
            return 'Rp.' + Number(angka).toLocaleString('id-ID');
        }

        new Chart(document.getElementById('grafikOmset'), {
            type: 'bar',
            data: {
                labels: namaBulan,
                datasets: [{
                    data: dataOmset,
                    backgroundColor: '#ff8f8f',
                    barPercentage: 0.8,
                    categoryPercentage: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: (item) => rupiah(item.raw)
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 100000000,
                        ticks: {
                            stepSize: 25000000,
                            color: '#111',
                            font: { family: 'Poppins', size: 8 },
                            callback: (nilai) => nilai === 0 ? '0' : rupiah(nilai)
                        },
                        grid: { color: '#e5e5e5' },
                        border: { display: false }
                    },
                    x: {
                        ticks: {
                            color: '#111',
                            font: { family: 'Poppins', size: 9 }
                        },
                        grid: { color: '#e5e5e5' }
                    }
                }
            }
        });
    </script>
</body>
</html>
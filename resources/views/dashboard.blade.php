<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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

        /* Logout */
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
            margin-bottom: 14px;
        }

        /* ===== KARTU STATISTIK ===== */
        .stat-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: #fff;
            border-radius: 10px;
            padding: 14px 16px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.18);
        }

        .stat-card .stat-title {
            font-size: 12px;
            margin-bottom: 10px;
        }

        .stat-card .stat-main {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .stat-card .stat-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #ff9a9a;
            color: #222;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .stat-card .stat-value {
            font-size: 15px;
            font-weight: 600;
        }

        .stat-card .stat-footer {
            margin-top: 10px;
            font-size: 10px;
            color: #222;
        }

        .stat-card .stat-footer .up {
            color: #1fa34d;
        }

        .stat-card .stat-footer a {
            color: #d40000;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* ===== PANEL BAWAH ===== */
        .bottom-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .panel {
            background: #fff;
            border-radius: 10px;
            padding: 18px 16px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.18);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .panel-header h2 {
            font-size: 14px;
            font-weight: 500;
        }

        .panel-header .see-all {
            border: 1px solid #ddd;
            background: #fff;
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 10px;
            color: #111;
            text-decoration: none;
        }

        .panel-header .see-all:hover {
            background: #f5f5f5;
        }

        .empty-text {
            color: #999;
            font-size: 14px;
        }

        /* Transaksi */
        .transaction-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 14px 0;
            border-bottom: 1px solid #888;
        }

        .transaction-item:last-child {
            border-bottom: none;
        }

        .transaction-item .trx-info {
            font-size: 13px;
            line-height: 1.5;
        }

        .transaction-item .trx-amount {
            text-align: right;
        }

        .transaction-item .trx-amount strong {
            display: block;
            font-size: 13px;
            font-weight: 500;
        }

        .transaction-item .trx-amount span {
            font-size: 10px;
        }

        /* Grafik */
        .chart-wrap {
            position: relative;
            height: 300px;
        }

        .omset-total {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            margin-top: 16px;
        }

        .omset-total .total-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #ff9a9a;
            color: #222;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .omset-total .total-text {
            font-size: 10px;
        }

        .omset-total .total-text strong {
            display: block;
            font-size: 13px;
            font-weight: 500;
        }

        @media (max-width: 1024px) {
            .bottom-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; border-right: none; border-bottom: 2px solid #ddd; }
            .sidebar nav { display: flex; flex-wrap: wrap; }
            .logout-box { margin: 0 12px; }
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
            <a href="{{ route('bahan-masuk.index') }}"><i class="fa-solid fa-box"></i> Stok Bahan</a>
            <a href="{{ route('kasir.index') }}"><i class="fa-solid fa-cart-shopping"></i> Kasir</a>
            <a href="{{ route('riwayat.index') }}"><i class="fa-regular fa-clock"></i> Riwayat Transaksi</a>
            <a href="{{ route('omset-harian.index') }}"><i class="fa-regular fa-calendar-check"></i> Omset Harian</a>
            <a href="{{ route('omset-bulanan.index') }}"><i class="fa-regular fa-calendar-days"></i> Omset Bulanan</a>
        </nav>

        <div class="logout-box">
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
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
            <h1>Dashboard</h1>

            <div class="stat-cards">

                <div class="stat-card">
                    <div class="stat-title">Omset Hari Ini</div>
                    <div class="stat-main">
                        <div class="stat-icon"><i class="fa-solid fa-sack-dollar"></i></div>
                        <div class="stat-value">Rp.{{ number_format($omsetHariIni ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-footer">
                        <span class="up"><i class="fa-solid fa-arrow-trend-up"></i> {{ $persenOmsetHarian ?? 0 }}%</span> dari kemarin
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-title">Total Penjualan</div>
                    <div class="stat-main">
                        <div class="stat-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                        <div class="stat-value">{{ $totalPenjualan ?? 0 }}</div>
                    </div>
                    <div class="stat-footer">
                        <span class="up"><i class="fa-solid fa-arrow-trend-up"></i> {{ $selisihPenjualan ?? 0 }}</span> transaksi dari kemarin
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-title">Sisa Bahan Bulan Ini</div>
                    <div class="stat-main">
                        <div class="stat-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        <div class="stat-value">{{ $sisaBahanMenipis ?? 0 }}</div>
                    </div>
                    <div class="stat-footer">
                        <a href="{{ route('bahan-masuk.index') }}">Lihat detail stok <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-title">Omset Bulan Ini</div>
                    <div class="stat-main">
                        <div class="stat-icon"><i class="fa-solid fa-chart-line"></i></div>
                        <div class="stat-value">Rp.{{ number_format($omsetBulanIni ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-footer">
                        <span class="up"><i class="fa-solid fa-arrow-trend-up"></i> {{ $persenOmsetBulanan ?? 0 }}%</span> dari bulan lalu
                    </div>
                </div>

            </div>

            <div class="bottom-section">

                <div class="panel">
                    <div class="panel-header">
                        <h2>Transaksi Terbaru</h2>
                        <a href="{{ route('riwayat.index') }}" class="see-all">Lihat semua</a>
                    </div>

                    @forelse ($transaksiTerbaru ?? [] as $trx)
                        @php
                            // Cocok untuk dua versi data: kode/cabang atau id_penjualan/produk
                            $kodeTrx = $trx->kode ?? $trx->id_penjualan ?? '-';
                            $infoTrx = $trx->cabang ?? $trx->keterangan ?? $trx->produk?->nama_produk ?? '-';
                            $tglTrx  = !empty($trx->tanggal)
                                ? rescue(fn () => \Carbon\Carbon::parse($trx->tanggal)->locale('id')->translatedFormat('d F Y H.i'), '-')
                                : '-';
                        @endphp

                        <div class="transaction-item">
                            <div class="trx-info">
                                <div>Transaksi #{{ $kodeTrx }}</div>
                                <div>{{ $infoTrx }}</div>
                            </div>
                            <div class="trx-amount">
                                <strong>Rp.{{ number_format($trx->total ?? 0, 0, ',', '.') }}</strong>
                                <span>{{ $tglTrx }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="empty-text">Belum ada transaksi.</p>
                    @endforelse
                </div>

                <div class="panel">
                    <div class="panel-header">
                        <h2>Omset Penjualan 6 Bulan Terakhir</h2>
                    </div>

                    <div class="chart-wrap">
                        @if (collect($omset6Bulan ?? [])->isEmpty())
                            <p class="empty-text">Belum ada data omset.</p>
                        @else
                            <canvas id="omsetChart"></canvas>
                        @endif
                    </div>

                    <div class="omset-total">
                        <div class="total-icon"><i class="fa-solid fa-chart-line"></i></div>
                        <div class="total-text">
                            Total 6 bulan
                            <strong>Rp.{{ number_format($totalOmset6Bulan ?? 0, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    @php
        $omsetRows = collect($omset6Bulan ?? [])->map(function ($item) {
            return [
                'periode' => data_get($item, 'periode'),
                'total'   => (float) data_get($item, 'total', 0),
            ];
        })->values()->all();
    @endphp

    <script>
        const rows = @json($omsetRows);

        // Jika periode berformat "2026-05", ubah menjadi "Mei 2026"
        const labelBulan = (p) => {
            if (/^\d{4}-\d{2}/.test(p)) {
                const [y, m] = p.split('-');
                return new Date(y, m - 1, 1).toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
            }
            return p;
        };

        const labels = rows.map(r => labelBulan(r.periode));
        const data   = rows.map(r => r.total);
        const rupiah = (n) => 'Rp. ' + Number(n).toLocaleString('id-ID');

        const canvas = document.getElementById('omsetChart');

        if (canvas) {
            new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: '#ff8f8f',
                        barPercentage: 0.5,
                        categoryPercentage: 0.9
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: { callbacks: { label: (ctx) => rupiah(ctx.parsed.y) } }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { font: { family: 'Poppins', size: 11 }, color: '#222' }
                        },
                        y: {
                            beginAtZero: true,
                            suggestedMax: 40000000,
                            ticks: {
                                stepSize: 5000000,
                                font: { family: 'Poppins', size: 11 },
                                color: '#222',
                                callback: (v) => v === 0 ? '0' : rupiah(v)
                            },
                            grid: { color: '#bdbdbd' },
                            border: { display: false }
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>
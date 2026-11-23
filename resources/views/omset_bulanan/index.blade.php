<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omset Bulanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            background: #f8f9fa;
        }

        .content {
            padding: 28px 24px 24px;
        }

        .content h1 {
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 16px;
        }

        .tabs-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .tabs-row form {
            margin: 0;
        }

        .tabs {
            display: flex;
            gap: 16px;
        }

        .tab {
            min-width: 135px;
            padding: 8px 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            color: #999;
            font-size: 12px;
            text-align: center;
            text-decoration: none;
        }

        .tab:hover {
            background: #f1f1f1;
        }

        .tab.active {
            background: #ff9a9a;
            border-color: #ff9a9a;
            color: #fff;
            font-weight: 500;
        }

        .pilih-bulan {
            appearance: none;
            -webkit-appearance: none;
            background: #ff9a9a url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='5'%3E%3Cpath d='M0 0l4 5 4-5z' fill='%23fff'/%3E%3C/svg%3E") no-repeat right 12px center;
            color: #fff;
            border: none;
            outline: none;
            border-radius: 6px;
            padding: 9px 30px 9px 14px;
            font-family: inherit;
            font-size: 11px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .pilih-bulan option {
            background: #fff;
            color: #111;
        }

        .panel {
            background: #fff;
            border-radius: 10px;
            padding: 20px 18px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .panel-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .judul-panel {
            font-size: 16px;
        }

        .table-wrap {
            border: 1px solid #888;
            border-radius: 7px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 8px 12px;
            text-align: center;
        }

        thead th {
            font-weight: 600;
            padding: 11px 12px;
        }

        tr > :first-child { border-left: none; }
        tr > :last-child { border-right: none; }
        thead tr:first-child th { border-top: none; }
        tbody tr:last-child td { border-bottom: none; }

        tbody tr:hover {
            background: #fff6f6;
        }

        .kosong {
            color: #999;
            padding: 20px;
        }

        .pagination {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 16px;
        }

        .pagination a {
            min-width: 30px;
            height: 30px;
            padding: 0 7px;
            border: 1px solid #bbb;
            border-radius: 7px;
            background: #fff;
            color: #888;
            font-size: 11px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .pagination a:hover,
        .pagination a.active {
            background: #ff9a9a;
            border-color: #ff9a9a;
            color: #fff;
        }


        .kartu-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 18px;
        }

        .kartu {
            background: #fff;
            border-radius: 10px;
            padding: 16px 18px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .kartu-judul {
            font-size: 13px;
            margin-bottom: 10px;
        }

        .kartu-isi {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .kartu-ikon {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: #ff9a9a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .kartu-nilai {
            font-size: 17px;
            font-weight: 600;
        }

        .kartu-nilai.merah {
            color: #d40000;
        }

        .kartu-ket {
            font-size: 11px;
            margin-top: 12px;
        }

        .kartu-ket .hijau {
            color: #1fa34d;
        }

        .target {
            display: grid;
            grid-template-columns: 1fr auto 1px 230px;
            align-items: center;
            gap: 20px;
            background: #fff;
            border-radius: 10px;
            padding: 18px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .target-judul {
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .target-angka {
            font-size: 11px;
            margin-bottom: 10px;
        }

        .bar {
            height: 14px;
            background: #eee;
            border-radius: 10px;
            overflow: hidden;
        }

        .bar-isi {
            height: 100%;
            background: #ff8a8a;
            border-radius: 10px;
        }

        .persen {
            text-align: left;
            padding-top: 18px;
        }

        .persen strong {
            display: block;
            font-size: 15px;
            margin-bottom: 6px;
        }

        .persen span {
            font-size: 11px;
        }

        .garis {
            align-self: stretch;
            background: #bbb;
        }

        .bonus-judul {
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .bonus-nilai {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .bonus-status {
            font-size: 12px;
        }

        .bonus-status.tercapai {
            color: #1fa34d;
        }
    </style>
</head>
<body>

    @php
        $targetOmset = 60000000;
        $bonusKaryawan = 1500000;

        $daftarCabang = \App\Models\Cabang::orderBy('id_cabang')->get();
        $bulanDipilih = request('bulan', now()->format('Y-m'));
        $cabangAktif = request('cabang', Auth::user()->id_cabang ?? ($daftarCabang->first()->id_cabang ?? ''));

        $transaksi = \Illuminate\Support\Facades\DB::table('riwayat')
            ->where('id_cabang', $cabangAktif)
            ->whereYear('tanggal', substr($bulanDipilih, 0, 4))
            ->whereMonth('tanggal', substr($bulanDipilih, 5, 2));

        $omsetKotor = (clone $transaksi)->sum('total');
        $jamDiskon = (clone $transaksi)->whereTime('created_at', '>=', '11:00:00')->whereTime('created_at', '<', '13:00:00');
        $totalDiskon = (clone $jamDiskon)->sum('total') * 10 / 100;

        $omsetBersih = $omsetKotor - $totalDiskon;
        $jumlahTransaksi = (clone $transaksi)->distinct()->count('kode_transaksi');
        $persenDiskon = $omsetKotor > 0 ? $totalDiskon / $omsetKotor * 100 : 0;

        $persen = $targetOmset > 0 ? min(100, round($omsetBersih / $targetOmset * 100)) : 0;
        $kurang = max(0, $targetOmset - $omsetBersih);
        $tercapai = $omsetBersih >= $targetOmset;
    @endphp

    <div class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>Yusukekun<br>Resutoran</span>
        </div>

        <nav>
            <a href="{{ route('dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.6 19.5a9 9 0 1 1 12.8 0z"/><path d="M12 14l3.5-3.5"/><path d="M7.5 12h.5M12 7.5V8M16.5 12H16M8.8 8.8l.4.4"/></svg> Dashboard</a>
            <a href="{{ route('kasir.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h2.5l2.3 11.5h11.4L20.5 6H5.2"/><path d="M8 19.5h1.5M15.5 19.5H17"/></svg> Kasir</a>
            <a href="{{ route('data-bahan.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.7l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.7l7 4a2 2 0 0 0 2 0l7-4a2 2 0 0 0 1-1.7z"/><path d="M3.3 7L12 12l8.7-5M12 22V12"/></svg> Stok Bahan</a>
            <a href="{{ route('riwayat.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l3.5 3.5"/></svg> Riwayat Transaksi</a>
            <a href="{{ route('omset-harian.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="19" rx="2"/><path d="M10 3h4v2h-4z"/><path d="M8 11l1.2 1.2L11 10.4M13.5 11.5H16M8 16.5h2M13.5 16.5H16"/></svg> Omset Harian</a>
            <a href="{{ route('omset-bulanan.index') }}" class="active"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 9.5h18M3 7.5h18M7.5 3v4M12 3v4M16.5 3v4"/><path d="M7 13.5h.01M10.3 13.5h.01M13.7 13.5h.01M17 13.5h.01M7 17h.01M10.3 17h.01M13.7 17h.01M17 17h.01" stroke-width="2.5"/></svg> Omset Bulanan</a>
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
        <div class="content">
            <h1>Omset Bulanan</h1>

            <div class="tabs-row">
                <div class="tabs">
                    @foreach ($daftarCabang as $cabang)
                        <a href="{{ route('omset-bulanan.index', ['cabang' => $cabang->id_cabang, 'bulan' => $bulanDipilih]) }}"
                           class="tab {{ $cabang->id_cabang == $cabangAktif ? 'active' : '' }}">{{ $cabang->nama_cabang }}</a>
                    @endforeach
                </div>

                <form method="GET" action="{{ route('omset-bulanan.index') }}">
                    <input type="hidden" name="cabang" value="{{ $cabangAktif }}">
                    <select name="bulan" class="pilih-bulan" onchange="this.form.submit()">
                        @for ($i = 0; $i < 12; $i++)
                            @php $pilihan = now()->startOfMonth()->subMonths($i); @endphp
                            <option value="{{ $pilihan->format('Y-m') }}" {{ $pilihan->format('Y-m') == $bulanDipilih ? 'selected' : '' }}>
                                {{ $pilihan->locale('id')->translatedFormat('F Y') }}
                            </option>
                        @endfor
                    </select>
                </form>
            </div>

            <div class="kartu-row">
                <div class="kartu">
                    <div class="kartu-judul">Omset Kotor</div>
                    <div class="kartu-isi">
                        <div class="kartu-ikon"><i class="ti ti-moneybag"></i></div>
                        <div class="kartu-nilai">Rp{{ number_format($omsetKotor, 0, ',', '.') }}</div>
                    </div>
                    <div class="kartu-ket">Sebelum potongan diskon</div>
                </div>

                <div class="kartu">
                    <div class="kartu-judul">Total Diskon</div>
                    <div class="kartu-isi">
                        <div class="kartu-ikon"><i class="ti ti-percentage"></i></div>
                        <div class="kartu-nilai merah">-Rp{{ number_format($totalDiskon, 0, ',', '.') }}</div>
                    </div>
                    <div class="kartu-ket">{{ number_format($persenDiskon, 2, ',', '.') }}% dari omset kotor</div>
                </div>

                <div class="kartu">
                    <div class="kartu-judul">Omset Bersih</div>
                    <div class="kartu-isi">
                        <div class="kartu-ikon"><i class="ti ti-check"></i></div>
                        <div class="kartu-nilai">Rp{{ number_format($omsetBersih, 0, ',', '.') }}</div>
                    </div>
                    <div class="kartu-ket"><span class="hijau">{{ $jumlahTransaksi }}</span> Transaksi</div>
                </div>
            </div>

            <div class="target">
                <div>
                    <div class="target-judul">Target Omset Bersih</div>
                    <div class="target-angka">Rp{{ number_format($omsetBersih, 0, ',', '.') }} dari Rp{{ number_format($targetOmset, 0, ',', '.') }}</div>
                    <div class="bar">
                        <div class="bar-isi" style="width: {{ $persen }}%;"></div>
                    </div>
                </div>

                <div class="persen">
                    <strong>{{ $persen }}%</strong>
                    <span>Kurang Rp{{ number_format($kurang, 0, ',', '.') }}</span>
                </div>

                <div class="garis"></div>

                <div>
                    <div class="bonus-judul">Bonus Karyawan</div>
                    <div class="bonus-nilai">Rp{{ number_format($bonusKaryawan, 0, ',', '.') }}</div>
                    <div class="bonus-status {{ $tercapai ? 'tercapai' : '' }}">{{ $tercapai ? 'Target Tercapai' : 'Target Belum Tercapai' }}</div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
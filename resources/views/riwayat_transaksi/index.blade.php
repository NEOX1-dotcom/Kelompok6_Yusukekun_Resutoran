<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
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
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 16px;
        }

        /* ===== TAB CABANG ===== */
        .tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 24px;
        }

        .tab {
            min-width: 135px;
            padding: 8px 26px;
            border: 1px solid #aaa;
            border-radius: 6px;
            background: transparent;
            color: #999;
            font-family: inherit;
            font-size: 12px;
            cursor: pointer;
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

        /* ===== PANEL ===== */
        .panel {
            background: #fff;
            border-radius: 10px;
            padding: 20px 18px 30px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.18);
        }

        .panel-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .periode {
            font-size: 16px;
        }

        /* ===== PAGINATION ===== */
        .pagination {
            display: flex;
            gap: 8px;
        }

        .pagination button {
            min-width: 30px;
            height: 30px;
            padding: 0 7px;
            border: 1px solid #bbb;
            border-radius: 7px;
            background: #fff;
            color: #888;
            font-family: inherit;
            font-size: 11px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease, border-color 0.2s ease, color 0.2s ease;
        }

        .pagination button:hover,
        .pagination button.active {
            background: #ff9a9a;
            border-color: #ff9a9a;
            color: #fff;
        }

        /* ===== TABEL ===== */
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
            padding: 9px 12px;
            text-align: center;
        }

        thead th {
            font-weight: 600;
            padding: 11px 12px;
        }

        tr > :first-child { border-left: none; }
        tr > :last-child  { border-right: none; }
        thead tr:first-child th { border-top: none; }
        tbody tr:last-child td { border-bottom: none; }

        tbody tr.data-row:hover {
            background: #fff6f6;
        }

        .btn-detail {
            border: none;
            background: #ff9a9a;
            color: #fff;
            font-family: inherit;
            font-size: 11px;
            padding: 5px 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-detail:hover {
            background: #f98585;
        }

        .empty-text {
            color: #999;
            padding: 20px;
        }

        /* ===== POPUP DETAIL ===== */
        .detail-info {
            text-align: left;
            font-size: 13px;
            margin-bottom: 12px;
            line-height: 1.7;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .detail-table th,
        .detail-table td {
            border: none;
            border-bottom: 1px solid #ddd;
            padding: 8px 6px;
            background: transparent;
        }

        .detail-table th:first-child,
        .detail-table td:first-child {
            text-align: left;
        }

        .detail-table .kanan {
            text-align: right;
        }

        .detail-table tfoot td {
            font-weight: 600;
            border-bottom: none;
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; border-right: none; border-bottom: 2px solid #ddd; }
            .sidebar nav { display: flex; flex-wrap: wrap; }
            .logout-box { margin: 0 12px; }
            .tabs { gap: 10px; }
            .tab { min-width: 0; flex: 1; padding: 8px 12px; }
        }
    </style>
</head>
<body>

    @php
        // Link aman: kalau route belum dibuat, otomatis jadi "#" (tidak error)
        $link = fn ($nama, $param = null) => \Illuminate\Support\Facades\Route::has($nama)
            ? route($nama, $param)
            : '#';

        // Data transaksi dari route / controller
        $items = $transaksi ?? $riwayat ?? $data ?? collect();
        $daftarCabang = $cabang ?? ['Cabang 1', 'Cabang 2', 'Cabang 3'];

        $formatTanggal = fn ($tgl) => !empty($tgl)
            ? rescue(fn () => \Carbon\Carbon::parse($tgl)->format('d/m/Y  H:i'), $tgl)
            : '-';

        // Rincian setiap transaksi untuk popup "Lihat Detail"
        $detailMap = collect($items)->mapWithKeys(fn ($t) => [
            (string) $t->id => [
                'kode'    => $t->kode ?? $t->id_transaksi ?? '-',
                'cabang'  => $t->cabang ?? '-',
                'tanggal' => $formatTanggal($t->tanggal ?? $t->created_at ?? null),
                'total'   => (int) ($t->total ?? 0),
                'items'   => collect($t->items ?? $t->detail ?? [])->map(fn ($i) => [
                    'nama'  => data_get($i, 'nama') ?? data_get($i, 'nama_menu', '-'),
                    'qty'   => (int) data_get($i, 'qty', data_get($i, 'jumlah', 1)),
                    'harga' => (int) data_get($i, 'harga', 0),
                ])->values(),
            ],
        ]);
    @endphp

    <div class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>Yusukekun<br>Resutoran</span>
        </div>

        <nav>
            <a href="{{ $link('dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="{{ $link('bahan-masuk.index') }}"><i class="fa-solid fa-box"></i> Stok Bahan</a>
            <a href="{{ $link('kasir.index') }}"><i class="fa-solid fa-cart-shopping"></i> Kasir</a>
            <a href="{{ $link('riwayat.index') }}" class="active"><i class="fa-regular fa-clock"></i> Riwayat Transaksi</a>
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
            <h1>Riwayat Transaksi</h1>

            <div class="tabs">
                @foreach ($daftarCabang as $c)
                    <button type="button" class="tab {{ $loop->first ? 'active' : '' }}" data-cabang="{{ $c }}">{{ $c }}</button>
                @endforeach
            </div>

            <div class="panel">
                <div class="panel-top">
                    <div class="periode">
                        {{ $periode ?? \Carbon\Carbon::now()->locale('id')->translatedFormat('F Y') }}
                    </div>

                    {{-- Pagination: 1 2 3 ... (tombol "..." = halaman berikutnya) --}}
                    <div class="pagination" id="pagination"></div>
                </div>

                <div class="table-wrap">
                    <table id="tabelTransaksi">
                        <thead>
                            <tr>
                                <th style="width: 80px;">No</th>
                                <th>ID Transaksi</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $t)
                                <tr class="data-row" data-cabang="{{ $t->cabang ?? '' }}">
                                    <td class="no">{{ $loop->iteration }}</td>
                                    <td>{{ $t->kode ?? $t->id_transaksi ?? '-' }}</td>
                                    <td>{{ $formatTanggal($t->tanggal ?? $t->created_at ?? null) }}</td>
                                    <td>Rp{{ number_format($t->total ?? 0, 0, ',', '.') }}</td>
                                    <td>
                                        <button type="button" class="btn-detail" data-id="{{ $t->id }}">Lihat Detail</button>
                                    </td>
                                </tr>
                            @endforeach

                            <tr id="barisKosong" style="display: none;">
                                <td colspan="5" class="empty-text">Belum ada transaksi di cabang ini.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const detailMap = @json($detailMap);
        const rupiah = (n) => 'Rp' + Math.round(n).toLocaleString('id-ID');
        const esc = (s) => String(s).replace(/[&<>"']/g, (c) => ({
            '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
        }[c]));

        // ===== FILTER CABANG + PAGINATION =====
        const perPage = 7;
        const rows = [...document.querySelectorAll('#tabelTransaksi tbody tr.data-row')];
        const box = document.getElementById('pagination');
        const barisKosong = document.getElementById('barisKosong');
        const tabs = [...document.querySelectorAll('.tab')];

        let cabangAktif = tabs.length ? tabs[0].dataset.cabang : '';
        let current = 1;

        function tombol(label, page, aktif, title) {
            const b = document.createElement('button');
            b.type = 'button';
            b.textContent = label;
            if (aktif) b.className = 'active';
            if (title) b.title = title;
            b.onclick = () => { current = page; render(); };
            box.appendChild(b);
        }

        function render() {
            const terfilter = rows.filter((tr) => tr.dataset.cabang === cabangAktif);
            const last = Math.max(1, Math.ceil(terfilter.length / perPage));
            if (current > last) current = last;

            rows.forEach((tr) => tr.style.display = 'none');

            terfilter.forEach((tr, i) => {
                const visible = i >= (current - 1) * perPage && i < current * perPage;
                tr.style.display = visible ? '' : 'none';
                tr.querySelector('.no').textContent = i + 1;
            });

            barisKosong.style.display = terfilter.length === 0 ? '' : 'none';

            box.innerHTML = '';
            const start = Math.floor((current - 1) / 3) * 3 + 1;

            if (start > 1) tombol('...', start - 1, false, 'Halaman sebelumnya');
            for (let p = start; p <= start + 2; p++) tombol(p, p, p === current);
            tombol('...', current < last ? current + 1 : current, false, 'Halaman berikutnya');
        }

        tabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                tabs.forEach((t) => t.classList.remove('active'));
                tab.classList.add('active');
                cabangAktif = tab.dataset.cabang;
                current = 1;
                render();
            });
        });

        // ===== POPUP LIHAT DETAIL =====
        document.querySelectorAll('.btn-detail').forEach((btn) => {
            btn.addEventListener('click', () => {
                const d = detailMap[btn.dataset.id];
                if (!d) return;

                let isiItem = '';
                if (d.items.length === 0) {
                    isiItem = '<tr><td colspan="4" style="text-align:center;color:#999;">Rincian item belum tersedia.</td></tr>';
                } else {
                    d.items.forEach((it) => {
                        isiItem += `
                            <tr>
                                <td>${esc(it.nama)}</td>
                                <td>${it.qty}</td>
                                <td class="kanan">${rupiah(it.harga)}</td>
                                <td class="kanan">${rupiah(it.harga * it.qty)}</td>
                            </tr>`;
                    });
                }

                Swal.fire({
                    title: 'Detail Transaksi',
                    width: 600,
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#ff8a8a',
                    html: `
                        <div class="detail-info">
                            <div><b>ID Transaksi:</b> ${esc(d.kode)}</div>
                            <div><b>Cabang:</b> ${esc(d.cabang)}</div>
                            <div><b>Tanggal:</b> ${esc(d.tanggal)}</div>
                        </div>
                        <table class="detail-table">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Qty</th>
                                    <th class="kanan">Harga</th>
                                    <th class="kanan">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>${isiItem}</tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">Total</td>
                                    <td class="kanan">${rupiah(d.total)}</td>
                                </tr>
                            </tfoot>
                        </table>`
                });
            });
        });

        render();
    </script>
</body>
</html>
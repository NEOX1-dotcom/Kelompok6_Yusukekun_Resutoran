<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Bahan - Bahan Keluar</title>
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

        /* ===== TAB ===== */
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
            align-items: flex-end;
            gap: 12px;
            margin-bottom: 10px;
        }

        .btn-tambah {
            background: #ff9a9a;
            color: #fff;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            padding: 9px 20px;
            border-radius: 6px;
            display: inline-block;
            transition: background 0.2s ease;
        }

        .btn-tambah:hover {
            background: #f98585;
        }

        .periode {
            font-size: 16px;
            margin-bottom: 12px;
        }

        /* ===== PAGINATION ===== */
        .pagination {
            display: flex;
            gap: 8px;
        }

        .pagination a,
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
            text-decoration: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease, border-color 0.2s ease, color 0.2s ease;
        }

        .pagination a:hover,
        .pagination button:hover,
        .pagination a.active,
        .pagination button.active {
            background: #ff9a9a;
            border-color: #ff9a9a;
            color: #fff;
        }

        .pagination a.active:hover,
        .pagination button.active:hover {
            background: #f98585;
            border-color: #f98585;
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

        .aksi {
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .aksi form {
            margin: 0;
        }

        .btn {
            border: none;
            color: #fff;
            font-family: inherit;
            font-size: 11px;
            padding: 5px 18px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit { background: #9aa5b8; }
        .btn-edit:hover { background: #8893a8; }
        .btn-hapus { background: #ff9a9a; }
        .btn-hapus:hover { background: #f98585; }

        .empty-text {
            color: #999;
            padding: 20px;
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; border-right: none; border-bottom: 2px solid #ddd; }
            .sidebar nav { display: flex; flex-wrap: wrap; }
            .logout-box { margin: 0 12px; }
            .panel-top { flex-direction: column; align-items: flex-start; }
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

        // Data dari controller: mencoba beberapa kemungkinan nama variabel
        $items = $bahanKeluar ?? $bahan_keluar ?? $bahan ?? $data ?? $items ?? collect();
        $isPaginator = $items instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
            <h1>Stok Bahan</h1>

            <div class="tabs">
                <a href="{{ $link('bahan-masuk.index') }}" class="tab">Bahan Masuk</a>
                <a href="{{ $link('bahan-keluar.index') }}" class="tab active">Bahan Keluar</a>
                <a href="{{ $link('sisa-bahan.index') }}" class="tab">Sisa Bahan Akhir Bulan</a>
            </div>

            <div class="panel">
                <div class="panel-top">
                    <a href="{{ $link('bahan-keluar.create') }}" class="btn-tambah">+ Tambah data</a>

                    {{-- Pagination: 1 2 3 ... (tombol "..." = halaman berikutnya) --}}
                    <div class="pagination" id="pagination">
                        @if ($isPaginator)
                            @php
                                $current = $items->currentPage();
                                $last    = max(1, $items->lastPage());
                                $start   = (int) (floor(($current - 1) / 3) * 3) + 1;
                                $next    = $current < $last ? $current + 1 : $current;
                            @endphp

                            @if ($start > 1)
                                <a href="{{ $items->url($start - 1) }}" title="Halaman sebelumnya">...</a>
                            @endif

                            @for ($p = $start; $p <= $start + 2; $p++)
                                <a href="{{ $items->url($p) }}" class="{{ $p == $current ? 'active' : '' }}">{{ $p }}</a>
                            @endfor

                            <a href="{{ $items->url($next) }}" title="Halaman berikutnya">...</a>
                        @endif
                    </div>
                </div>

                <div class="periode">
                    {{ $periode ?? \Carbon\Carbon::now()->locale('id')->translatedFormat('F Y') }}
                </div>

                <div class="table-wrap">
                    <table id="tabelBahan">
                        <thead>
                            <tr>
                                <th style="width: 70px;">No</th>
                                <th>Nama Bahan</th>
                                <th style="width: 70px;">Jumlah</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                @php
                                    $tgl = $item->tanggal ?? $item->tanggal_keluar ?? $item->created_at ?? null;
                                @endphp
                                <tr class="data-row">
                                    <td class="no">
                                        {{ $isPaginator ? $items->firstItem() + $loop->index : $loop->iteration }}
                                    </td>
                                    <td>{{ $item->nama_bahan ?? $item->nama ?? '-' }}</td>
                                    <td>{{ $item->jumlah ?? $item->stok ?? '-' }}</td>
                                    <td>
                                        {{ !empty($tgl)
                                            ? rescue(fn () => \Carbon\Carbon::parse($tgl)->format('d/m/Y'), $tgl)
                                            : '-' }}
                                    </td>
                                    <td>
                                        <div class="aksi">
                                            <a href="{{ $link('bahan-keluar.edit', $item->id ?? null) }}" class="btn btn-edit">Edit</a>

                                            <form action="{{ $link('bahan-keluar.destroy', $item->id ?? null) }}" method="POST" class="form-hapus">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-hapus" onclick="konfirmasiHapus(this)">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="empty-text">
                                        {{ $isPaginator && $items->currentPage() > 1 ? 'Tidak ada data di halaman ini.' : 'Belum ada data bahan keluar.' }}
                                    </td>
                                </tr>
                            @endforelse

                            {{-- Muncul kalau halaman yang dibuka tidak punya data (mode pagination di browser) --}}
                            <tr id="barisKosongHalaman" style="display: none;">
                                <td colspan="5" class="empty-text">Tidak ada data di halaman ini.</td>
                            </tr>
                        </tbody>
                    </table>
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

    <script>
        // Konfirmasi sebelum menghapus
        function konfirmasiHapus(btn) {
            Swal.fire({
                title: 'Hapus data ini?',
                text: 'Data yang dihapus tidak bisa dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff6b6b',
                cancelButtonColor: '#9aa5b8',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('form').submit();
                }
            });
        }

        // Pagination di browser, hanya dipakai kalau data BUKAN paginator dari controller
        const serverPaginated = @json($isPaginator);

        if (!serverPaginated) {
            const perPage = 7;
            const rows = [...document.querySelectorAll('#tabelBahan tbody tr.data-row')];
            const box = document.getElementById('pagination');
            const barisKosong = document.getElementById('barisKosongHalaman');
            const last = Math.max(1, Math.ceil(rows.length / perPage));
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
                let tampil = 0;

                rows.forEach((tr, i) => {
                    const visible = i >= (current - 1) * perPage && i < current * perPage;
                    tr.style.display = visible ? '' : 'none';
                    tr.querySelector('.no').textContent = i + 1;
                    if (visible) tampil++;
                });

                // Pesan kalau halaman yang dibuka tidak ada datanya
                barisKosong.style.display = (rows.length > 0 && tampil === 0) ? '' : 'none';

                box.innerHTML = '';

                const start = Math.floor((current - 1) / 3) * 3 + 1;

                if (start > 1) tombol('...', start - 1, false, 'Halaman sebelumnya');
                for (let p = start; p <= start + 2; p++) tombol(p, p, p === current);
                tombol('...', current < last ? current + 1 : current, false, 'Halaman berikutnya');
            }

            render();
        }
    </script>
</body>
</html>
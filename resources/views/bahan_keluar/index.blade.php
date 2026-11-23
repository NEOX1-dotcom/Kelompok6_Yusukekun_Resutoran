<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Bahan - Bahan Keluar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.19.0/dist/tabler-icons.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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

        .periode {
            font-size: 16px;
        }

        .btn-tambah {
            background: #ff9a9a;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 9px 18px;
            font-family: inherit;
            font-size: 12px;
            cursor: pointer;
        }

        .btn-tambah:hover {
            background: #f98585;
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

        .aksi {
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .aksi form {
            margin: 0;
        }

        .btn-ikon {
            width: 26px;
            height: 26px;
            border: none;
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-ikon .material-icons {
            font-size: 16px;
        }

        .btn-edit {
            background: #1565c0;
        }

        .btn-edit:hover {
            background: #0d4f9c;
        }

        .btn-hapus {
            background: #d50000;
        }

        .btn-hapus:hover {
            background: #b00000;
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

        .modal {
            display: flex;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            align-items: center;
            justify-content: center;
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease, visibility 0.25s ease;
        }

        .modal.tampil {
            opacity: 1;
            visibility: visible;
        }

        .modal-box {
            width: 400px;
            background: #fff;
            border-radius: 10px;
            padding: 28px 22px 26px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
            transform: scale(0.9) translateY(10px);
            transition: transform 0.25s ease;
        }

        .modal.tampil .modal-box {
            transform: scale(1) translateY(0);
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-row label {
            font-size: 15px;
        }

        .form-row input,
        .form-row select {
            width: 200px;
            height: 32px;
            padding: 0 10px;
            border: 1px solid #333;
            border-radius: 6px;
            background: #fff;
            font-family: inherit;
            font-size: 12px;
            color: #111;
            outline: none;
        }

        .form-row select {
            appearance: none;
            -webkit-appearance: none;
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='5'%3E%3Cpath d='M0 0l4 5 4-5z' fill='%23333'/%3E%3C/svg%3E") no-repeat right 10px center;
            padding-right: 26px;
            cursor: pointer;
        }

        .form-row input[type="number"] {
            -moz-appearance: textfield;
        }

        .form-row input[type="number"]::-webkit-outer-spin-button,
        .form-row input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .form-row input::-webkit-calendar-picker-indicator {
            cursor: pointer;
        }

        .form-row input:focus,
        .form-row select:focus {
            border-color: #ff9a9a;
            box-shadow: 0 0 0 2px #ffe3e3;
        }

        .error-text {
            color: #d40000;
            font-size: 11px;
            margin: -14px 0 14px;
            text-align: right;
        }

        .modal-aksi {
            display: flex;
            gap: 18px;
            margin-top: 26px;
        }

        .modal-aksi button {
            flex: 1;
            height: 36px;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-family: inherit;
            font-size: 12px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .btn-simpan {
            background: #ff9a9a;
        }

        .btn-simpan:hover {
            background: #f98585;
        }

        .btn-kembali {
            background: #9aa5b8;
        }

        .btn-kembali:hover {
            background: #8893a8;
        }
    </style>
</head>
<body>

    @php
        $bulanDipilih = request('bulan', now()->format('Y-m'));
        $daftarBahan = $daftarBahan ?? \App\Models\Bahan::orderBy('nama_bahan')->get();

        $bahanKeluar = \App\Models\BahanKeluar::with('bahan')
            ->whereYear('tanggal', substr($bulanDipilih, 0, 4))
            ->whereMonth('tanggal', substr($bulanDipilih, 5, 2))
            ->latest('tanggal')
            ->paginate(10)
            ->withQueryString();
    @endphp

    <div class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>Yusukekun<br>Resutoran</span>
        </div>

        <nav>
            <a href="{{ route('dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.6 19.5a9 9 0 1 1 12.8 0z"/><path d="M12 14l3.5-3.5"/><path d="M7.5 12h.5M12 7.5V8M16.5 12H16M8.8 8.8l.4.4"/></svg> Dashboard</a>
            <a href="{{ route('kasir.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h2.5l2.3 11.5h11.4L20.5 6H5.2"/><path d="M8 19.5h1.5M15.5 19.5H17"/></svg> Kasir</a>
            <a href="{{ route('data-bahan.index') }}" class="active"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.7l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.7l7 4a2 2 0 0 0 2 0l7-4a2 2 0 0 0 1-1.7z"/><path d="M3.3 7L12 12l8.7-5M12 22V12"/></svg> Stok Bahan</a>
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

        <div class="content">
            <h1>Stok Bahan</h1>

            <div class="tabs-row">
                <div class="tabs">
                    <a href="{{ route('data-bahan.index') }}" class="tab">Data Bahan</a>
                    <a href="{{ route('bahan-masuk.index') }}" class="tab">Bahan Masuk</a>
                    <a href="{{ route('bahan-keluar.index') }}" class="tab active">Bahan Keluar</a>
                    <a href="{{ route('sisa-bahan.index') }}" class="tab">Sisa Bahan Akhir Bulan</a>
                </div>

                <form method="GET" action="{{ route('bahan-keluar.index') }}">
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

            <div class="panel">

                <div class="panel-top">
                    <div class="periode">
                        {{ \Carbon\Carbon::parse($bulanDipilih . '-01')->locale('id')->translatedFormat('F Y') }}
                    </div>
                    <button type="button" class="btn-tambah" onclick="bukaTambah()">+ Tambah data</button>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 70px;">No</th>
                                <th>Nama Bahan</th>
                                <th style="width: 110px;">Jumlah</th>
                                <th>Tanggal</th>
                                <th style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bahanKeluar as $item)
                                <tr>
                                    <td>{{ $bahanKeluar->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->bahan->nama_bahan ?? '-' }}</td>
                                    <td>{{ $item->jumlah + 0 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="aksi">
                                            <button type="button" class="btn-ikon btn-edit" title="Edit"
                                                    data-url="{{ route('bahan-keluar.update', $item->getKey()) }}"
                                                    data-bahan="{{ $item->id_bahan }}"
                                                    data-jumlah="{{ $item->jumlah + 0 }}"
                                                    data-tanggal="{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}"
                                                    onclick="bukaEdit(this)">
                                                <span class="material-icons">edit</span>
                                            </button>

                                            <form action="{{ route('bahan-keluar.destroy', $item->getKey()) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-ikon btn-hapus" title="Hapus">
                                                    <span class="material-icons">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="kosong">Belum ada data bahan keluar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($bahanKeluar->lastPage() > 1)
                    @php
                        $mulai = max(1, min($bahanKeluar->currentPage() - 1, $bahanKeluar->lastPage() - 2));
                        $akhir = min($bahanKeluar->lastPage(), $mulai + 2);
                    @endphp

                    <div class="pagination">
                        @if ($mulai > 1)
                            <a href="{{ $bahanKeluar->url($mulai - 1) }}">...</a>
                        @endif

                        @foreach ($bahanKeluar->getUrlRange($mulai, $akhir) as $halaman => $url)
                            <a href="{{ $url }}" class="{{ $halaman == $bahanKeluar->currentPage() ? 'active' : '' }}">{{ $halaman }}</a>
                        @endforeach

                        @if ($akhir < $bahanKeluar->lastPage())
                            <a href="{{ $bahanKeluar->url($akhir + 1) }}">...</a>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </div>

    <div class="modal {{ $errors->any() ? 'tampil' : '' }}" id="modalBahan">
        <div class="modal-box">
            <form id="formBahan" action="{{ old('form_url', route('bahan-keluar.store')) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="{{ old('_method', 'POST') }}">
                <input type="hidden" name="form_url" id="formUrl" value="{{ old('form_url', route('bahan-keluar.store')) }}">

                <div class="form-row">
                    <label for="id_bahan">Nama Bahan</label>
                    <select id="id_bahan" name="id_bahan" required>
                        <option value=""></option>
                        @foreach ($daftarBahan as $bahan)
                            <option value="{{ $bahan->getKey() }}" {{ old('id_bahan') == $bahan->getKey() ? 'selected' : '' }}>{{ $bahan->nama_bahan }}</option>
                        @endforeach
                    </select>
                </div>
                @error('id_bahan') <div class="error-text">{{ $message }}</div> @enderror

                <div class="form-row">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah" min="0.01" step="0.01" value="{{ old('jumlah') }}" required>
                </div>
                @error('jumlah') <div class="error-text">{{ $message }}</div> @enderror

                <div class="form-row">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                </div>
                @error('tanggal') <div class="error-text">{{ $message }}</div> @enderror

                <div class="modal-aksi">
                    <button type="submit" class="btn-simpan">Simpan</button>
                    <button type="button" class="btn-kembali" onclick="tutupModal()">Kembali</button>
                </div>
            </form>
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
        const modal = document.getElementById('modalBahan');
        const form = document.getElementById('formBahan');
        const urlTambah = "{{ route('bahan-keluar.store') }}";

        function bukaTambah() {
            form.action = urlTambah;
            document.getElementById('formUrl').value = urlTambah;
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('id_bahan').value = '';
            document.getElementById('jumlah').value = '';
            document.getElementById('tanggal').value = '';
            modal.classList.add('tampil');
        }

        function bukaEdit(tombol) {
            form.action = tombol.dataset.url;
            document.getElementById('formUrl').value = tombol.dataset.url;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('id_bahan').value = tombol.dataset.bahan;
            document.getElementById('jumlah').value = tombol.dataset.jumlah;
            document.getElementById('tanggal').value = tombol.dataset.tanggal;
            modal.classList.add('tampil');
        }

        function tutupModal() {
            modal.classList.remove('tampil');
        }

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                tutupModal();
            }
        });
    </script>
</body>
</html>
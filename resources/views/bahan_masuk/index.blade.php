<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Bahan - Bahan Masuk</title>
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
            margin-bottom: 16px;
        }

        .tabs {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
        }

        .tab {
            min-width: 125px;
            padding: 8px 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            color: #999;
            font-size: 11px;
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

        .panel {
            background: #fff;
            border-radius: 10px;
            padding: 20px 16px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .panel-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .btn-tambah {
            background: #ff9a9a;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-family: inherit;
            font-size: 11px;
            cursor: pointer;
        }

        .btn-tambah:hover {
            background: #f98585;
        }

        .pilih-bulan {
            appearance: none;
            -webkit-appearance: none;
            background: #ff9a9a url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='5'%3E%3Cpath d='M0 0l4 5 4-5z' fill='%23fff'/%3E%3C/svg%3E") no-repeat right 10px center;
            color: #fff;
            border: none;
            outline: none;
            border-radius: 6px;
            padding: 8px 26px 8px 12px;
            font-family: inherit;
            font-size: 10px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .pilih-bulan option {
            background: #fff;
            color: #111;
        }

        .periode {
            font-size: 15px;
            margin-bottom: 8px;
        }

        .table-wrap {
            border: 1px solid #888;
            border-radius: 6px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 6px 10px;
            text-align: center;
        }

        thead th {
            font-weight: 600;
            padding: 10px;
        }

        tr > :first-child { border-left: none; }
        tr > :last-child { border-right: none; }
        thead tr:first-child th { border-top: none; }
        tbody tr:last-child td { border-bottom: none; }

        .aksi {
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .btn-ikon {
            width: 22px;
            height: 22px;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-size: 11px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
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
            margin-top: 14px;
        }

        .pagination a {
            min-width: 28px;
            height: 28px;
            padding: 0 6px;
            border: 1px solid #bbb;
            border-radius: 6px;
            background: #fff;
            color: #888;
            font-size: 10px;
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
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            align-items: center;
            justify-content: center;
            z-index: 100;
        }

        .modal.tampil {
            display: flex;
        }

        .modal-box {
            width: 380px;
            background: #fff;
            border-radius: 10px;
            padding: 28px 22px 30px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-row label {
            font-size: 16px;
        }

        .form-row input {
            width: 170px;
            height: 30px;
            padding: 0 8px;
            border: 1px solid #333;
            border-radius: 4px;
            background: #fff;
            font-family: inherit;
            font-size: 12px;
            color: #111;
            outline: none;
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

        .form-row input:focus {
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
            margin-top: 30px;
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
    @endphp

    <div class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>Yusukekun<br>Resutoran</span>
        </div>

        <nav>
            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="{{ route('kasir.index') }}"><i class="ti ti-shopping-cart"></i> Kasir</a>
            <a href="{{ route('bahan-masuk.index') }}" class="active"><i class="ti ti-box"></i> Stok Bahan</a>
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
            <h1>Stok Bahan</h1>

            <div class="tabs">
                <a href="{{ route('bahan-masuk.index') }}" class="tab active">Bahan Masuk</a>
                <a href="{{ route('bahan-keluar.index') }}" class="tab">Bahan Keluar</a>
                <a href="{{ route('sisa-bahan.index') }}" class="tab">Sisa Bahan Akhir Bulan</a>
            </div>

            <div class="panel">

                <div class="panel-top">
                    <button type="button" class="btn-tambah" onclick="bukaTambah()">+ Tambah data</button>

                    <form method="GET" action="{{ route('bahan-masuk.index') }}">
                        <select name="bulan" class="pilih-bulan" onchange="this.form.submit()">
                            @for ($i = 0; $i < 12; $i++)
                                @php $bulan = now()->startOfMonth()->subMonths($i); @endphp
                                <option value="{{ $bulan->format('Y-m') }}" {{ $bulan->format('Y-m') == $bulanDipilih ? 'selected' : '' }}>
                                    {{ $bulan->locale('id')->translatedFormat('F Y') }}
                                </option>
                            @endfor
                        </select>
                    </form>
                </div>

                <div class="periode">
                    {{ \Carbon\Carbon::parse($bulanDipilih . '-01')->locale('id')->translatedFormat('F Y') }}
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Nama Bahan</th>
                                <th style="width: 90px;">Jumlah</th>
                                <th>Tanggal</th>
                                <th style="width: 110px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bahanMasuk as $item)
                                <tr>
                                    <td>{{ $bahanMasuk->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->bahan->nama_bahan ?? '-' }}</td>
                                    <td>{{ $item->jumlah + 0 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="aksi">
                                            <button type="button" class="btn-ikon btn-edit" title="Edit"
                                                    data-url="{{ route('bahan-masuk.update', $item->getKey()) }}"
                                                    data-nama="{{ $item->bahan->nama_bahan ?? '' }}"
                                                    data-jumlah="{{ $item->jumlah + 0 }}"
                                                    data-tanggal="{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}"
                                                    onclick="bukaEdit(this)">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>

                                            <form action="{{ route('bahan-masuk.destroy', $item->getKey()) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-ikon btn-hapus" title="Hapus">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="kosong">Belum ada data bahan masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($bahanMasuk->lastPage() > 1)
                    <div class="pagination">
                        @foreach ($bahanMasuk->getUrlRange(1, $bahanMasuk->lastPage()) as $halaman => $url)
                            <a href="{{ $url }}" class="{{ $halaman == $bahanMasuk->currentPage() ? 'active' : '' }}">{{ $halaman }}</a>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>

    <div class="modal {{ $errors->any() ? 'tampil' : '' }}" id="modalBahan">
        <div class="modal-box">
            <form id="formBahan" action="{{ old('form_url', route('bahan-masuk.store')) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="{{ old('_method', 'POST') }}">
                <input type="hidden" name="form_url" id="formUrl" value="{{ old('form_url', route('bahan-masuk.store')) }}">
                <input type="hidden" name="id_bahan" id="id_bahan" value="{{ old('id_bahan') }}">

                <div class="form-row">
                    <label for="nama_bahan">Nama Bahan</label>
                    <input type="text" id="nama_bahan" name="nama_bahan" list="listBahan" autocomplete="off" value="{{ old('nama_bahan') }}" required>
                </div>
                @error('id_bahan') <div class="error-text">{{ $message }}</div> @enderror

                <datalist id="listBahan">
                    @foreach ($daftarBahan as $bahan)
                        <option value="{{ $bahan->nama_bahan }}">
                    @endforeach
                </datalist>

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
        const urlTambah = "{{ route('bahan-masuk.store') }}";

        const daftarBahan = @json($daftarBahan->map(fn ($b) => ['id' => $b->getKey(), 'nama' => $b->nama_bahan])->values());

        function bukaTambah() {
            form.action = urlTambah;
            document.getElementById('formUrl').value = urlTambah;
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('nama_bahan').value = '';
            document.getElementById('id_bahan').value = '';
            document.getElementById('jumlah').value = '';
            document.getElementById('tanggal').value = '';
            modal.classList.add('tampil');
        }

        function bukaEdit(tombol) {
            form.action = tombol.dataset.url;
            document.getElementById('formUrl').value = tombol.dataset.url;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('nama_bahan').value = tombol.dataset.nama;
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

        form.addEventListener('submit', function (e) {
            const namaDiketik = document.getElementById('nama_bahan').value.trim().toLowerCase();
            const bahanCocok = daftarBahan.find(b => b.nama.toLowerCase() === namaDiketik);

            if (!bahanCocok) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Nama bahan tidak ditemukan',
                    text: 'Ketik nama bahan yang sudah terdaftar.',
                    confirmButtonColor: '#ff9a9a'
                });
                return;
            }

            document.getElementById('id_bahan').value = bahanCocok.id;
        });
    </script>
</body>
</html>
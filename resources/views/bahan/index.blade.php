<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Bahan - Data Bahan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.19.0/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 16px;
        }

        .tabs {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
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

        .panel {
            background: #fff;
            border-radius: 10px;
            padding: 20px 18px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .panel-top {
            margin-bottom: 18px;
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

        .input-wrap {
            position: relative;
            width: 200px;
        }

        .input-wrap input {
            width: 100%;
            height: 32px;
            padding: 0 10px;
            border: 1px solid #333;
            border-radius: 8px;
            background: #fff;
            font-family: inherit;
            font-size: 12px;
            color: #111;
            outline: none;
        }

        .input-wrap input:focus {
            border-color: #ff9a9a;
            box-shadow: 0 0 0 2px #ffe3e3;
        }

        .input-wrap input.sudah-ada {
            border-color: #d40000;
            box-shadow: 0 0 0 2px #fde2e2;
        }

        .list-saran {
            display: none;
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            max-height: 150px;
            overflow-y: auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            list-style: none;
            z-index: 10;
        }

        .list-saran.tampil {
            display: block;
        }

        .judul-saran {
            padding: 6px 10px 4px;
            font-size: 10px;
            color: #999;
        }

        .list-saran li {
            padding: 7px 10px;
            font-size: 12px;
            border-top: 1px solid #f1f1f1;
        }

        .list-saran li.sama {
            color: #d40000;
            font-weight: 500;
        }

        .info-bahan {
            display: none;
            color: #d40000;
            font-size: 11px;
            margin: -14px 0 14px;
            text-align: right;
        }

        .info-bahan.tampil {
            display: block;
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
            margin-top: 10px;
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

        .btn-simpan:disabled {
            background: #f3c6c6;
            cursor: not-allowed;
            box-shadow: none;
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
        $dataBahan = $bahan ?? \App\Models\Bahan::orderBy('nama_bahan')->paginate(10);
        $semuaNamaBahan = \App\Models\Bahan::orderBy('nama_bahan')->pluck('nama_bahan');
    @endphp

    <div class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>Yusukekun<br>Resutoran</span>
        </div>

        <nav>
            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="{{ route('kasir.index') }}"><i class="ti ti-shopping-cart"></i> Kasir</a>
            <a href="{{ route('bahan.index') }}" class="active"><i class="ti ti-box"></i> Stok Bahan</a>
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
                <a href="{{ route('bahan.index') }}" class="tab active">Data Bahan</a>
                <a href="{{ route('bahan-masuk.index') }}" class="tab">Bahan Masuk</a>
                <a href="{{ route('bahan-keluar.index') }}" class="tab">Bahan Keluar</a>
                <a href="{{ route('sisa-bahan.index') }}" class="tab">Sisa Bahan Akhir Bulan</a>
            </div>

            <div class="panel">

                <div class="panel-top">
                    <button type="button" class="btn-tambah" onclick="bukaTambah()">+ Tambah data</button>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 80px;">No</th>
                                <th>Nama Bahan</th>
                                <th style="width: 170px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataBahan as $item)
                                <tr>
                                    <td>{{ $dataBahan->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->nama_bahan }}</td>
                                    <td>
                                        <div class="aksi">
                                            <button type="button" class="btn-ikon btn-edit" title="Edit"
                                                    data-url="{{ route('bahan.update', $item->getKey()) }}"
                                                    data-nama="{{ $item->nama_bahan }}"
                                                    onclick="bukaEdit(this)">
                                                <span class="material-icons">edit</span>
                                            </button>

                                            <form action="{{ route('bahan.destroy', $item->getKey()) }}" method="POST"
                                                  onsubmit="return confirm('Hapus bahan ini? Data bahan masuk, bahan keluar, dan sisa bahan yang memakai bahan ini juga akan ikut terhapus.')">
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
                                    <td colspan="3" class="kosong">Belum ada data bahan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($dataBahan->lastPage() > 1)
                    <div class="pagination">
                        @foreach ($dataBahan->getUrlRange(1, $dataBahan->lastPage()) as $halaman => $url)
                            <a href="{{ $url }}" class="{{ $halaman == $dataBahan->currentPage() ? 'active' : '' }}">{{ $halaman }}</a>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>

    <div class="modal {{ $errors->any() ? 'tampil' : '' }}" id="modalBahan">
        <div class="modal-box">
            <form id="formBahan" action="{{ old('form_url', route('bahan.store')) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="{{ old('_method', 'POST') }}">
                <input type="hidden" name="form_url" id="formUrl" value="{{ old('form_url', route('bahan.store')) }}">

                <div class="form-row">
                    <label for="nama_bahan">Nama Bahan</label>
                    <div class="input-wrap">
                        <input type="text" id="nama_bahan" name="nama_bahan" autocomplete="off" value="{{ old('nama_bahan') }}" required>
                        <ul class="list-saran" id="listSaran"></ul>
                    </div>
                </div>
                <div class="info-bahan" id="infoBahan"></div>
                @error('nama_bahan') <div class="error-text">{{ $message }}</div> @enderror

                <div class="modal-aksi">
                    <button type="submit" class="btn-simpan" id="tombolSimpan">Simpan</button>
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
        const urlTambah = "{{ route('bahan.store') }}";

        const namaBahanTerdaftar = @json($semuaNamaBahan->values());

        const inputNama = document.getElementById('nama_bahan');
        const listSaran = document.getElementById('listSaran');
        const infoBahan = document.getElementById('infoBahan');
        const tombolSimpan = document.getElementById('tombolSimpan');

        let namaAwal = '';

        function rapikan(teks) {
            return teks.trim().toLowerCase().replace(/\s+/g, ' ');
        }

        function cekNamaBahan() {
            const ketikan = rapikan(inputNama.value);
            listSaran.innerHTML = '';

            if (ketikan === '') {
                listSaran.classList.remove('tampil');
                infoBahan.classList.remove('tampil');
                inputNama.classList.remove('sudah-ada');
                tombolSimpan.disabled = false;
                return;
            }

            const kataKetikan = ketikan.split(' ').filter(kata => kata.length >= 2);
            const namaMirip = namaBahanTerdaftar.filter(nama =>
                rapikan(nama) !== rapikan(namaAwal) &&
                kataKetikan.some(kata => rapikan(nama).includes(kata))
            );

            if (namaMirip.length > 0) {
                const judul = document.createElement('div');
                judul.className = 'judul-saran';
                judul.textContent = 'Bahan yang sudah ada:';
                listSaran.appendChild(judul);

                namaMirip.forEach(nama => {
                    const baris = document.createElement('li');
                    baris.textContent = nama;
                    if (rapikan(nama) === ketikan) {
                        baris.classList.add('sama');
                    }
                    listSaran.appendChild(baris);
                });

                listSaran.classList.add('tampil');
            } else {
                listSaran.classList.remove('tampil');
            }

            const sudahAda = namaBahanTerdaftar.some(nama => rapikan(nama) === ketikan);

            if (sudahAda && ketikan !== rapikan(namaAwal)) {
                infoBahan.textContent = 'Bahan "' + inputNama.value.trim() + '" sudah ada.';
                infoBahan.classList.add('tampil');
                inputNama.classList.add('sudah-ada');
                tombolSimpan.disabled = true;
            } else {
                infoBahan.classList.remove('tampil');
                inputNama.classList.remove('sudah-ada');
                tombolSimpan.disabled = false;
            }
        }

        inputNama.addEventListener('input', cekNamaBahan);
        inputNama.addEventListener('focus', cekNamaBahan);
        inputNama.addEventListener('blur', function () {
            setTimeout(() => listSaran.classList.remove('tampil'), 150);
        });

        function bukaTambah() {
            namaAwal = '';
            form.action = urlTambah;
            document.getElementById('formUrl').value = urlTambah;
            document.getElementById('formMethod').value = 'POST';
            inputNama.value = '';
            cekNamaBahan();
            modal.classList.add('tampil');
            setTimeout(() => inputNama.focus(), 250);
        }

        function bukaEdit(tombol) {
            namaAwal = tombol.dataset.nama;
            form.action = tombol.dataset.url;
            document.getElementById('formUrl').value = tombol.dataset.url;
            document.getElementById('formMethod').value = 'PUT';
            inputNama.value = tombol.dataset.nama;
            cekNamaBahan();
            listSaran.classList.remove('tampil');
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
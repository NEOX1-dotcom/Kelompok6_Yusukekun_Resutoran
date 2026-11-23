<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            margin-bottom: 16px;
        }

        /* ===== LAYOUT KASIR ===== */
        .kasir-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 400px;
            gap: 16px;
            align-items: start;
        }

        /* ===== PENCARIAN ===== */
        .search-box {
            position: relative;
            margin-bottom: 16px;
        }

        .search-box i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 13px;
        }

        .search-box input {
            width: 100%;
            padding: 8px 12px 8px 30px;
            border: 1px solid #aaa;
            border-radius: 6px;
            background: #f4f4f4;
            font-family: inherit;
            font-size: 11px;
            outline: none;
        }

        .search-box input:focus {
            border-color: #ff9a9a;
            background: #fff;
        }

        /* ===== TAB KATEGORI ===== */
        .kategori-tabs {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 16px;
        }

        .kategori-tab {
            padding: 7px 0;
            border: 1px solid #aaa;
            border-radius: 6px;
            background: #f4f4f4;
            color: #999;
            font-family: inherit;
            font-size: 11px;
            cursor: pointer;
        }

        .kategori-tab:hover {
            background: #ececec;
        }

        .kategori-tab.active {
            background: #ff9a9a;
            border-color: #ff9a9a;
            color: #fff;
            font-weight: 500;
        }

        /* ===== PANEL ===== */
        .panel {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.18);
        }

        .menu-panel {
            padding: 26px 18px;
            max-height: calc(100vh - 290px);
            min-height: 320px;
            overflow-y: auto;
        }

        /* Kartu mengisi lebar panel, minimal 190px */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
            gap: 18px;
        }

        /* ===== KARTU MENU ===== */
        .menu-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        /* Tinggi foto ikut lebar kartu */
        .menu-foto {
            aspect-ratio: 16 / 9;
            background: #d9d9d9;
        }

        .menu-foto img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .menu-body {
            flex: 1;
            padding: 12px 12px 10px;
            display: flex;
            flex-direction: column;
        }

        .menu-nama {
            font-size: 13px;
            font-weight: 500;
            line-height: 1.4;
        }

        .menu-kategori {
            font-size: 10px;
            color: #555;
            margin-top: 2px;
        }

        .menu-bawah {
            margin-top: auto;
            padding-top: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-harga {
            font-size: 13px;
            font-weight: 500;
        }

        .btn-add {
            width: 26px;
            height: 24px;
            border: none;
            border-radius: 6px;
            background: #ff8a8a;
            color: #fff;
            font-size: 13px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-add:hover {
            background: #f86f6f;
        }

        .menu-kosong {
            display: none;
            text-align: center;
            color: #999;
            font-size: 11px;
            padding: 30px 0;
        }

        /* ===== PANEL ITEM DIPILIH ===== */
        .cart-panel {
            padding: 20px 22px 26px;
        }

        .cart-title {
            font-size: 15px;
            font-weight: 600;
            padding: 2px 0 10px;
            border-bottom: 1px solid #ccc;
        }

        .cart-item {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto 90px;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #ccc;
        }

        .ci-nama {
            font-size: 13px;
            font-weight: 500;
            line-height: 1.4;
        }

        .ci-harga {
            font-size: 12px;
            color: #555;
            margin-top: 4px;
        }

        .ci-total {
            font-size: 13px;
            font-weight: 500;
            text-align: right;
        }

        .qty {
            display: flex;
            border: 1px solid #999;
            border-radius: 6px;
            overflow: hidden;
            height: 30px;
        }

        .qty button {
            width: 30px;
            border: none;
            background: #fff;
            color: #555;
            font-size: 18px;
            font-weight: 300;
            line-height: 1;
            cursor: pointer;
        }

        .qty button:hover {
            background: #ffe3e3;
        }

        .qty input {
            width: 42px;
            border: none;
            border-left: 1px solid #999;
            border-right: 1px solid #999;
            text-align: center;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            -moz-appearance: textfield;
        }

        .qty input::-webkit-outer-spin-button,
        .qty input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .cart-kosong {
            font-size: 13px;
            color: #999;
            text-align: center;
            padding: 26px 0;
            border-bottom: 1px solid #ccc;
        }

        /* ===== RINGKASAN ===== */
        .ringkasan {
            padding: 16px 0 18px;
            border-bottom: 1px solid #ccc;
        }

        .ringkasan-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .ringkasan-row:last-child {
            margin-bottom: 0;
        }

        .ringkasan-row.tebal {
            font-weight: 600;
        }

        .ringkasan-row:last-child.tebal {
            font-size: 15px;
        }

        .ringkasan-row input {
            width: 90px;
            border: 1px solid transparent;
            border-radius: 4px;
            background: transparent;
            text-align: right;
            font-family: inherit;
            font-size: 13px;
            padding: 2px 4px;
            outline: none;
            -moz-appearance: textfield;
        }

        .ringkasan-row input::-webkit-outer-spin-button,
        .ringkasan-row input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .ringkasan-row input:hover,
        .ringkasan-row input:focus {
            border-color: #ccc;
            background: #fff;
        }

        .input-diskon {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .input-diskon-value {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        /* ===== METODE PEMBAYARAN ===== */
        .metode-bayar {
            display: flex;
            gap: 10px;
            margin-top: 16px;
        }

        .metode-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            color: #111;
            font-family: inherit;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
            transition: background 0.2s ease, border-color 0.2s ease;
        }

        .metode-btn i {
            font-size: 16px;
        }

        .metode-btn:hover {
            background: #fff4f4;
        }

        .metode-btn.active {
            border-color: #ff8a8a;
            background: #ffe3e3;
            color: #d40000;
        }

        .btn-bayar {
            width: 100%;
            margin-top: 22px;
            padding: 13px 0;
            border: none;
            border-radius: 8px;
            background: #ff8a8a;
            color: #fff;
            font-family: inherit;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .btn-bayar:hover {
            background: #f86f6f;
        }

        @media (max-width: 1100px) {
            .kasir-layout { grid-template-columns: 1fr; }
            .menu-panel { max-height: none; }
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; border-right: none; border-bottom: 2px solid #ddd; }
            .sidebar nav { display: flex; flex-wrap: wrap; }
            .logout-box { margin: 0 12px; }
            .menu-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .kategori-tabs { gap: 10px; }
        }
    </style>
</head>
<body>

    @php
        // Link aman: kalau route belum dibuat, otomatis jadi "#" (tidak error)
        $link = fn ($nama, $param = null) => \Illuminate\Support\Facades\Route::has($nama)
            ? route($nama, $param)
            : '#';

        // Data menu dari route / controller
        $menus = $menus ?? $menu ?? $data ?? collect();
    @endphp

    <div class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>Yusukekun<br>Resutoran</span>
        </div>

        <nav>
            <a href="{{ $link('dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="{{ $link('bahan-masuk.index') }}"><i class="fa-solid fa-box"></i> Stok Bahan</a>
            <a href="{{ $link('kasir.index') }}" class="active"><i class="fa-solid fa-cart-shopping"></i> Kasir</a>
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
            <h1>Kasir</h1>

            <div class="kasir-layout">

                {{-- ===== KOLOM KIRI: DAFTAR MENU ===== --}}
                <div>
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="cariMenu" placeholder="Cari ...">
                    </div>

                    <div class="kategori-tabs">
                        <button type="button" class="kategori-tab active" data-kategori="semua">Semua</button>
                        <button type="button" class="kategori-tab" data-kategori="makanan">Makanan</button>
                        <button type="button" class="kategori-tab" data-kategori="minuman">Minuman</button>
                    </div>

                    <div class="panel menu-panel">
                        <div class="menu-grid">
                            @foreach ($menus as $item)
                                @php
                                    $nama     = $item->nama_menu ?? $item->nama ?? '-';
                                    $kategori = $item->kategori ?? 'Makanan';
                                    $harga    = (int) ($item->harga ?? 0);
                                    $foto     = $item->foto ?? null;
                                @endphp

                                <div class="menu-card"
                                     data-id="{{ $item->id }}"
                                     data-nama="{{ $nama }}"
                                     data-kategori="{{ strtolower($kategori) }}"
                                     data-harga="{{ $harga }}">

                                    <div class="menu-foto">
                                        {{-- Foto belum ada: tampil kotak abu-abu --}}
                                        @if (!empty($foto))
                                            <img src="{{ asset('images/menu/' . $foto) }}" alt="{{ $nama }}">
                                        @endif
                                    </div>

                                    <div class="menu-body">
                                        <div class="menu-nama">{{ $nama }}</div>
                                        <div class="menu-kategori">{{ $kategori }}</div>

                                        <div class="menu-bawah">
                                            <span class="menu-harga">Rp{{ number_format($harga, 0, ',', '.') }}</span>
                                            <button type="button" class="btn-add" title="Tambah ke pesanan">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="menu-kosong" id="menuKosong">Menu tidak ditemukan.</div>
                    </div>
                </div>

                {{-- ===== KOLOM KANAN: ITEM DIPILIH ===== --}}
                <div class="panel cart-panel">
                    <div class="cart-title">Item Dipilih</div>

                    <div id="cartList"></div>

                    <div class="ringkasan">
                        <div class="ringkasan-row tebal">
                            <span>Sub total</span>
                            <span id="subTotal">Rp0</span>
                        </div>
                        <div class="ringkasan-row">
                            <span>Diskon</span>
                            <span class="input-diskon">
                                <span class="input-diskon-value">
                                    <input type="number" id="diskon" value="0" min="0" max="100">%
                                </span>
                            </span>
                        </div>
                        <div class="ringkasan-row">
                            <span>Penyesuaian</span>
                            <input type="number" id="penyesuaian" value="0">
                        </div>
                        <div class="ringkasan-row tebal">
                            <span>Total</span>
                            <span id="total">Rp0</span>
                        </div>
                    </div>

                    {{-- ===== METODE PEMBAYARAN ===== --}}
                    <div class="metode-bayar">
                        <button type="button" class="metode-btn" data-metode="QRIS">
                            <i class="fa-solid fa-qrcode"></i> QRIS
                        </button>
                        <button type="button" class="metode-btn" data-metode="Cash">
                            <i class="fa-regular fa-money-bill-1"></i> Cash
                        </button>
                    </div>

                    <button type="button" class="btn-bayar" id="btnBayar">Bayar</button>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const rupiah = (n) => (n < 0 ? '-Rp' : 'Rp') + Math.abs(Math.round(n)).toLocaleString('id-ID');

        // Keranjang: id => { nama, harga, qty }
        const cart = new Map();

        const cartList         = document.getElementById('cartList');
        const inputDiskon      = document.getElementById('diskon');
        const inputPenyesuaian = document.getElementById('penyesuaian');
        let diskonManual       = inputDiskon.value;
        let diskonOtomatisAktif = false;

        // ===== FILTER KATEGORI & PENCARIAN MENU =====
        let kategoriAktif = 'semua';
        const cards = [...document.querySelectorAll('.menu-card')];

        function filterMenu() {
            const kata = document.getElementById('cariMenu').value.trim().toLowerCase();
            let tampil = 0;

            cards.forEach((card) => {
                const cocokKategori = kategoriAktif === 'semua' || card.dataset.kategori === kategoriAktif;
                const cocokNama = card.dataset.nama.toLowerCase().includes(kata);
                const visible = cocokKategori && cocokNama;
                card.style.display = visible ? '' : 'none';
                if (visible) tampil++;
            });

            document.getElementById('menuKosong').style.display = tampil === 0 ? 'block' : 'none';
        }

        document.getElementById('cariMenu').addEventListener('input', filterMenu);

        document.querySelectorAll('.kategori-tab').forEach((tab) => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.kategori-tab').forEach((t) => t.classList.remove('active'));
                tab.classList.add('active');
                kategoriAktif = tab.dataset.kategori;
                filterMenu();
            });
        });

        // ===== TAMBAH MENU KE KERANJANG =====
        document.querySelectorAll('.btn-add').forEach((btn) => {
            btn.addEventListener('click', () => {
                const card = btn.closest('.menu-card');
                const id = card.dataset.id;

                if (cart.has(id)) {
                    cart.get(id).qty++;
                } else {
                    cart.set(id, {
                        nama: card.dataset.nama,
                        harga: Number(card.dataset.harga),
                        qty: 1
                    });
                }
                renderCart();
            });
        });

        function ubahQty(id, qty) {
            if (!cart.has(id)) return;
            if (qty <= 0 || isNaN(qty)) {
                cart.delete(id);
            } else {
                cart.get(id).qty = qty;
            }
            renderCart();
        }

        // ===== TAMPILKAN KERANJANG =====
        function renderCart() {
            cartList.innerHTML = '';

            if (cart.size === 0) {
                const kosong = document.createElement('div');
                kosong.className = 'cart-kosong';
                kosong.textContent = 'Belum ada item. Klik + pada menu untuk menambahkan.';
                cartList.appendChild(kosong);
            }

            cart.forEach((item, id) => {
                const row = document.createElement('div');
                row.className = 'cart-item';
                row.innerHTML = `
                    <div>
                        <div class="ci-nama"></div>
                        <div class="ci-harga"></div>
                    </div>
                    <div class="qty">
                        <button type="button" class="kurang">&minus;</button>
                        <input type="number" min="0">
                        <button type="button" class="tambah">+</button>
                    </div>
                    <div class="ci-total"></div>
                `;

                row.querySelector('.ci-nama').textContent  = item.nama;
                row.querySelector('.ci-harga').textContent = rupiah(item.harga);
                row.querySelector('.ci-total').textContent = rupiah(item.harga * item.qty);

                const input = row.querySelector('input');
                input.value = item.qty;

                row.querySelector('.kurang').onclick = () => ubahQty(id, item.qty - 1);
                row.querySelector('.tambah').onclick = () => ubahQty(id, item.qty + 1);
                input.onchange = () => ubahQty(id, parseInt(input.value, 10));

                cartList.appendChild(row);
            });

            hitungTotal();
        }

        // ===== HITUNG TOTAL =====
        function perbaruiModeDiskon() {
            const waktu = new Date();
            const menitSekarang = waktu.getHours() * 60 + waktu.getMinutes();
            const promoAktif = menitSekarang >= 11 * 60 && menitSekarang < 13 * 60;

            if (promoAktif !== diskonOtomatisAktif) {
                if (promoAktif) {
                    diskonManual = inputDiskon.value;
                    inputDiskon.value = 10;
                } else {
                    inputDiskon.value = diskonManual;
                }
                diskonOtomatisAktif = promoAktif;
            }

            inputDiskon.readOnly = promoAktif;
        }

        function hitungTotal() {
            perbaruiModeDiskon();

            let subTotal = 0;
            cart.forEach((item) => subTotal += item.harga * item.qty);

            let diskon = Number(inputDiskon.value) || 0;
            diskon = Math.min(Math.max(diskon, 0), 100);

            const penyesuaian = Number(inputPenyesuaian.value) || 0;
            const total = subTotal - (subTotal * diskon / 100) + penyesuaian;

            document.getElementById('subTotal').textContent = rupiah(subTotal);
            document.getElementById('total').textContent = rupiah(total);

            return { subTotal, diskon, penyesuaian, total };
        }

        inputDiskon.addEventListener('input', () => {
            if (!diskonOtomatisAktif) {
                diskonManual = inputDiskon.value;
            }
            hitungTotal();
        });
        inputPenyesuaian.addEventListener('input', hitungTotal);
        setInterval(hitungTotal, 30000);

        // ===== PILIH METODE PEMBAYARAN =====
        let metodeAktif = null;
        const metodeBtns = document.querySelectorAll('.metode-btn');

        metodeBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                metodeBtns.forEach((b) => b.classList.remove('active'));
                btn.classList.add('active');
                metodeAktif = btn.dataset.metode;
            });
        });

        function resetKasir() {
            cart.clear();
            inputDiskon.value = 0;
            diskonManual = 0;
            diskonOtomatisAktif = false;
            inputPenyesuaian.value = 0;
            metodeAktif = null;
            metodeBtns.forEach((b) => b.classList.remove('active'));
            renderCart();
        }

        function pembayaranBerhasil(teks) {
            // Nanti di sini kirim data keranjang + metode pembayaran ke backend (controller)
            Swal.fire({
                icon: 'success',
                title: 'Pembayaran berhasil',
                html: teks,
                confirmButtonColor: '#ff8a8a',
                confirmButtonText: 'Selesai'
            });
            resetKasir();
        }

        function totalMasihSama(totalSebelumnya) {
            const totalTerbaru = hitungTotal().total;
            if (totalTerbaru === totalSebelumnya) return true;

            Swal.fire({
                icon: 'warning',
                title: 'Total berubah',
                text: 'Waktu promo berubah. Total terbaru ' + rupiah(totalTerbaru) + '. Silakan ulangi pembayaran.',
                confirmButtonColor: '#ff8a8a'
            });
            return false;
        }

        // ===== BAYAR (sementara simulasi, belum ke backend) =====
        document.getElementById('btnBayar').addEventListener('click', () => {
            if (cart.size === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Belum ada item',
                    text: 'Pilih menu terlebih dahulu.',
                    confirmButtonColor: '#ff8a8a'
                });
                return;
            }

            if (!metodeAktif) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih metode pembayaran',
                    text: 'Klik QRIS atau Cash terlebih dahulu.',
                    confirmButtonColor: '#ff8a8a'
                });
                return;
            }

            const { total } = hitungTotal();

            // ----- CASH: masukkan uang yang diterima, hitung kembalian -----
            if (metodeAktif === 'Cash') {
                Swal.fire({
                    title: 'Pembayaran Cash',
                    html: 'Total yang harus dibayar <b>' + rupiah(total) + '</b>',
                    input: 'number',
                    inputLabel: 'Uang yang diterima',
                    inputPlaceholder: 'Contoh: 100000',
                    inputAttributes: { min: 0 },
                    showCancelButton: true,
                    confirmButtonColor: '#ff8a8a',
                    cancelButtonColor: '#9aa5b8',
                    confirmButtonText: 'Bayar',
                    cancelButtonText: 'Batal',
                    inputValidator: (value) => {
                        if (!value) return 'Masukkan jumlah uang yang diterima.';
                        if (Number(value) < total) return 'Uang yang diterima kurang dari total.';
                    }
                }).then((result) => {
                    if (!result.isConfirmed) return;
                    if (!totalMasihSama(total)) return;

                    const kembalian = Number(result.value) - total;
                    pembayaranBerhasil(
                        'Metode: <b>Cash</b><br>' +
                        'Total: <b>' + rupiah(total) + '</b><br>' +
                        'Diterima: <b>' + rupiah(Number(result.value)) + '</b><br>' +
                        'Kembalian: <b>' + rupiah(kembalian) + '</b>'
                    );
                });
                return;
            }

            // ----- QRIS: konfirmasi pembayaran sudah diterima -----
            Swal.fire({
                title: 'Pembayaran QRIS',
                html: 'Minta pelanggan scan QRIS dan bayar <b>' + rupiah(total) + '</b>.<br>' +
                      'Klik <b>Sudah dibayar</b> setelah pembayaran berhasil.',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#ff8a8a',
                cancelButtonColor: '#9aa5b8',
                confirmButtonText: 'Sudah dibayar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (!result.isConfirmed) return;
                if (!totalMasihSama(total)) return;

                pembayaranBerhasil(
                    'Metode: <b>QRIS</b><br>' +
                    'Total: <b>' + rupiah(total) + '</b>'
                );
            });
        });

        renderCart();
    </script>
</body>
</html>
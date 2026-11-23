<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Yusukekun Resutoran</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fff;
            color: #111;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
        }

        .login-left {
            flex: 1;
            background: #e50112;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
        }

        .login-left img {
            width: 100%;
            max-width: 420px;
            height: auto;
            object-fit: contain;
        }

        .login-right {
            flex: 1;
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 50px 80px;
            text-align: center;
        }

        .login-right h1 {
            font-size: 34px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .subtitle {
            font-size: 13px;
            margin-bottom: 40px;
        }

        .form-login {
            width: 100%;
            max-width: 400px;
            text-align: left;
        }

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            line-height: 1.4;
        }

        .alert i {
            font-size: 15px;
            margin-top: 2px;
        }

        .alert-error {
            background: #fdecea;
            color: #b3261e;
            border: 1px solid #f5c2be;
        }

        .alert-success {
            background: #eafaf1;
            color: #1e7e34;
            border: 1px solid #c3e6cb;
        }

        .alert-info {
            background: #e8f4fd;
            color: #0c5460;
            border: 1px solid #b8daff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper input {
            width: 100%;
            height: 38px;
            padding: 0 40px 0 10px;
            border: 1px solid #bbb;
            border-radius: 6px;
            background: #fff;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-wrapper input::placeholder {
            color: #888;
        }

        .input-wrapper input:focus {
            border-color: #e00000;
            box-shadow: 0 0 0 3px rgba(224, 0, 0, 0.12);
        }

        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

        .ikon-input {
            position: absolute;
            right: 12px;
            font-size: 15px;
            color: #111;
            pointer-events: none;
        }

        .btn-toggle-pw {
            position: absolute;
            right: 8px;
            background: none;
            border: none;
            padding: 4px;
            font-size: 15px;
            color: #111;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .btn-masuk {
            width: 100%;
            height: 40px;
            margin-top: 10px;
            border: none;
            border-radius: 6px;
            background: #e00000;
            color: #fff;
            font-family: inherit;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-masuk:hover {
            background: #b80000;
        }

        .modal {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.45);
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
            width: 360px;
            max-height: 90vh;
            overflow-y: auto;
            background: #fff;
            border-radius: 10px;
            padding: 26px 22px 24px;
            text-align: left;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            transform: scale(0.9) translateY(10px);
            transition: transform 0.25s ease;
        }

        .modal.tampil .modal-box {
            transform: scale(1) translateY(0);
        }

        .modal-box h2 {
            font-size: 20px;
            font-weight: 500;
            text-align: center;
            line-height: 1.4;
            margin-bottom: 22px;
        }

        .karyawan-group {
            margin-bottom: 18px;
        }

        .karyawan-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }

        .karyawan-label label {
            font-size: 15px;
        }

        .karyawan-label span {
            font-size: 11px;
            color: #e00000;
        }

        .karyawan-group input {
            width: 100%;
            height: 38px;
            padding: 0 10px;
            border: 1px solid #bbb;
            border-radius: 6px;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .karyawan-group input::placeholder {
            color: #888;
        }

        .karyawan-group input:focus {
            border-color: #e00000;
            box-shadow: 0 0 0 3px rgba(224, 0, 0, 0.12);
        }

        .karyawan-baru {
            animation: muncul 0.25s ease;
        }

        @keyframes muncul {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-tambah-karyawan {
            display: inline-block;
            margin-top: 4px;
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            background: #f8d3d3;
            color: #e00000;
            font-family: inherit;
            font-size: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-tambah-karyawan:hover {
            background: #f3bcbc;
        }

        .btn-tambah-karyawan:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .modal-aksi {
            display: flex;
            gap: 12px;
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
            transition: background 0.2s;
        }

        .btn-kembali {
            background: #9aa5b8;
        }

        .btn-kembali:hover {
            background: #8893a8;
        }

        .btn-masuk-modal {
            background: #e00000;
        }

        .btn-masuk-modal:hover {
            background: #b80000;
        }

        @media (max-width: 900px) {
            .login-left {
                display: none;
            }

            .login-right {
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">

        <div class="login-left">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Yusukekun Resutoran">
        </div>

        <div class="login-right">
            <h1>SELAMAT DATANG</h1>
            <p class="subtitle">Gunakan Akun cabang dan kata sandi</p>

            <form method="POST" action="{{ route('login.submit') }}" class="form-login" id="formLogin">
                @csrf

                @if (session('error'))
                    <div class="alert alert-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                @elseif ($errors->any())
                    <div class="alert alert-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <div>{{ $errors->first() }}</div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @if (session('info'))
                    <div class="alert alert-info">
                        <i class="fa-solid fa-circle-info"></i>
                        <div>{{ session('info') }}</div>
                    </div>
                @endif

                <div class="form-group">
                    <label for="username">Akun Cabang</label>
                    <div class="input-wrapper">
                        <input type="text" id="username" name="username" placeholder="Cabang 1"
                               value="{{ old('username') }}" autocomplete="username" required autofocus>
                        <i class="fa-solid fa-circle-user ikon-input"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">kata Sandi</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="123456"
                               autocomplete="current-password" required>
                        <button type="button" class="btn-toggle-pw" onclick="lihatPassword()" title="Lihat kata sandi">
                            <i id="ikonPassword" class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="button" class="btn-masuk" onclick="bukaKaryawan()">Masuk</button>

                <div class="modal" id="modalKaryawan">
                    <div class="modal-box">
                        <h2>KARYAWAN YANG<br>BERTUGAS</h2>

                        <div id="daftarKaryawan">
                            <div class="karyawan-group">
                                <div class="karyawan-label">
                                    <label for="karyawan1">Karyawan 1</label>
                                </div>
                                <input type="text" id="karyawan1" name="karyawan[]" placeholder="Masukkan nama">
                            </div>

                            <div class="karyawan-group">
                                <div class="karyawan-label">
                                    <label for="karyawan2">Karyawan 2</label>
                                    <span>Opsional</span>
                                </div>
                                <input type="text" id="karyawan2" name="karyawan[]" placeholder="Masukkan nama">
                            </div>
                        </div>

                        <button type="button" class="btn-tambah-karyawan" id="btnTambahKaryawan" onclick="tambahKaryawan()">
                            + Tambah Kolom Karyawan
                        </button>

                        <div class="modal-aksi">
                            <button type="button" class="btn-kembali" onclick="tutupKaryawan()">Kembali</button>
                            <button type="button" class="btn-masuk-modal" onclick="kirimLogin()">Masuk</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const formLogin = document.getElementById('formLogin');
        const modalKaryawan = document.getElementById('modalKaryawan');
        const daftarKaryawan = document.getElementById('daftarKaryawan');
        const btnTambahKaryawan = document.getElementById('btnTambahKaryawan');
        const maksimalKaryawan = 5;

        function lihatPassword() {
            const inputPassword = document.getElementById('password');
            const ikon = document.getElementById('ikonPassword');

            if (inputPassword.type === 'password') {
                inputPassword.type = 'text';
                ikon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                inputPassword.type = 'password';
                ikon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        function bukaKaryawan() {
            if (!formLogin.reportValidity()) {
                return;
            }

            modalKaryawan.classList.add('tampil');
            setTimeout(() => document.getElementById('karyawan1').focus(), 250);
        }

        function tutupKaryawan() {
            modalKaryawan.classList.remove('tampil');
        }

        function tambahKaryawan() {
            const jumlah = daftarKaryawan.querySelectorAll('.karyawan-group').length;

            if (jumlah >= maksimalKaryawan) {
                return;
            }

            const nomor = jumlah + 1;
            const grup = document.createElement('div');
            grup.className = 'karyawan-group karyawan-baru';
            grup.innerHTML = `
                <div class="karyawan-label">
                    <label for="karyawan${nomor}">Karyawan ${nomor}</label>
                    <span>Opsional</span>
                </div>
                <input type="text" id="karyawan${nomor}" name="karyawan[]" placeholder="Masukkan nama">
            `;
            daftarKaryawan.appendChild(grup);
            document.getElementById('karyawan' + nomor).focus();

            if (nomor >= maksimalKaryawan) {
                btnTambahKaryawan.disabled = true;
            }
        }

        function kirimLogin() {
            const karyawan1 = document.getElementById('karyawan1');

            if (karyawan1.value.trim() === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Nama karyawan wajib diisi',
                    text: 'Isi minimal nama Karyawan 1.',
                    confirmButtonColor: '#e00000'
                });
                return;
            }

            formLogin.submit();
        }

        modalKaryawan.addEventListener('click', function (e) {
            if (e.target === modalKaryawan) {
                tutupKaryawan();
            }
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: @json(session('success')),
                confirmButtonColor: '#e00000',
                timer: 3000,
                timerProgressBar: true
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Perhatian',
                text: @json(session('info')),
                confirmButtonColor: '#e00000',
                confirmButtonText: 'Mengerti'
            });
        </script>
    @endif

</body>
</html>
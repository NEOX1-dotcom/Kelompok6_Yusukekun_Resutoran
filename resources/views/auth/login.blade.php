<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Yusukekun Resutoran</title>
    <!-- Font Awesome Icons -->
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
            background: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            min-height: 100vh;
        }

        .login-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .login-left {
            background: #E50112;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 50px;
            color: #fff;
            text-align: center;
        }

        .login-left img {
            width: 100%;
            max-width: 420px;
            height: auto;
            object-fit: contain;
            margin-bottom: 20px;
        }

        .login-right {
            flex: 1;
            padding: 50px 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: #fafafa;
        }

        .login-right h1 {
            font-size: 32px;
            margin-bottom: 6px;
            color: #1a1a1a;
            font-weight: 700;
        }

        .subtitle {
            color: #777;
            margin-bottom: 28px;
            font-size: 14px;
        }

        form {
            width: 100%;
            max-width: 400px;
            text-align: left;
        }

        /* Notifikasi Alert Banners */
        .alert {
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.4;
        }

        .alert i {
            font-size: 16px;
            margin-top: 2px;
            flex-shrink: 0;
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
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 13px;
            color: #333;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i.input-suffix {
            position: absolute;
            right: 12px;
            color: #999;
            font-size: 14px;
            pointer-events: none;
        }

        .form-group input {
            display: block;
            width: 100%;
            padding: 12px 36px 12px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #e0201a;
            box-shadow: 0 0 0 3px rgba(224, 32, 26, 0.15);
        }

        .form-group input.is-invalid {
            border-color: #dc2626;
            background-color: #fff8f8;
        }

        .btn-toggle-pw {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: #888;
            cursor: pointer;
            padding: 4px;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-toggle-pw:hover {
            color: #333;
        }

        .field-error {
            display: block;
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
            font-weight: 500;
        }

        button.btn-submit {
            margin-top: 8px;
            display: block;
            width: 100%;
            background: #e0201a;
            color: #fff;
            padding: 13px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }

        button.btn-submit:hover {
            background: #b8180f;
        }

        button.btn-submit:active {
            transform: scale(0.99);
        }

        #staff-dialog {
            width: min(92vw, 480px);
            max-height: 85vh;
            margin: auto;
            padding: 24px;
            border: 0;
            border-radius: 12px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        #staff-dialog::backdrop {
            background: rgba(17, 24, 39, 0.55);
        }

        #staff-dialog h2 {
            margin-bottom: 6px;
            color: #1a1a1a;
            font-size: 20px;
        }

        #staff-dialog p {
            margin-bottom: 18px;
            color: #777;
            font-size: 13px;
        }

        .staff-row {
            display: flex;
            gap: 8px;
            margin-bottom: 10px;
        }

        .staff-row input {
            flex: 1;
            min-width: 0;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
        }

        .staff-row button,
        .staff-dialog-actions button,
        #add-staff {
            padding: 9px 12px;
            border: 0;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
        }

        .staff-row button {
            background: #fee2e2;
            color: #b91c1c;
        }

        #add-staff {
            background: #f3f4f6;
            color: #374151;
        }

        .staff-dialog-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 20px;
        }

        .staff-dialog-actions .btn-cancel {
            background: #f3f4f6;
            color: #374151;
        }

        .staff-dialog-actions .btn-confirm {
            background: #e0201a;
            color: #fff;
        }

        @media (max-width: 900px) {
            .login-container {
                flex-direction: column;
            }
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

        <!-- Panel Kiri -->
        <div class="login-left">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Yusukekun Resutoran">
        </div>

        <!-- Panel Kanan -->
        <div class="login-right">
            <h1>WELCOME BACK</h1>
            <p class="subtitle">use your email and password</p>

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                
                <!-- Notifikasi Error (Password atau Nama Salah / Akun Belum Ada) -->
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

                <!-- Notifikasi Berhasil (Register/Logout) -->
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                <!-- Notifikasi Info (Akses Halaman Membutuhkan Akun) -->
                @if (session('info'))
                    <div class="alert alert-info">
                        <i class="fa-solid fa-circle-info"></i>
                        <div>{{ session('info') }}</div>
                    </div>
                @endif

                <!-- Input Nama / Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder="Enter username"
                            value="{{ old('username') }}"
                            required
                            autofocus
                        >
                        <i class="fa-regular fa-envelope input-suffix" aria-hidden="true"></i>
                    </div>
                </div>

                <!-- Input Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter password"
                            required
                        >
                        <button type="button" class="btn-toggle-pw" onclick="togglePasswordVisibility()" title="Lihat password">
                            <i id="pw-icon" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>


                <button type="submit" class="btn-submit">
                    <i></i> Sign In
                </button>

                <dialog id="staff-dialog" aria-labelledby="staff-dialog-title">
                    <h2 id="staff-dialog-title">Karyawan yang Bertugas</h2>
                    <p>Isi nama karyawan yang bertugas hari ini. Kolom yang kosong akan dilewati.</p>
                    <div id="staff-list"></div>
                    <button type="button" id="add-staff">Tambah nama</button>
                    <div class="staff-dialog-actions">
                        <button type="button" class="btn-cancel" id="cancel-staff">Batal</button>
                        <button type="button" class="btn-confirm" id="confirm-login">Lanjutkan login</button>
                    </div>
                </dialog>
            </form>
        </div>
    </div>

    <!-- Toggle Password Visibility Script -->
    <script>
        const loginForm = document.querySelector('form[action="{{ route('login.submit') }}"]');
        const loginButton = loginForm.querySelector('button[type="submit"]');
        const staffDialog = document.getElementById('staff-dialog');
        const staffList = document.getElementById('staff-list');
        let loginConfirmed = false;

        function addStaffInput(value = '') {
            const row = document.createElement('div');
            row.className = 'staff-row';

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'karyawan[]';
            input.maxLength = 100;
            input.placeholder = 'Nama karyawan';
            input.value = value;
            input.autocomplete = 'off';
            input.setAttribute('aria-label', 'Nama karyawan');

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.textContent = 'Hapus';
            removeButton.setAttribute('aria-label', 'Hapus nama karyawan');
            removeButton.addEventListener('click', () => {
                row.remove();
                if (staffList.children.length === 0) {
                    addStaffInput();
                }
            });

            row.append(input, removeButton);
            staffList.appendChild(row);
        }

        const oldStaffNames = @json(old('karyawan', []));
        if (Array.isArray(oldStaffNames) && oldStaffNames.length > 0) {
            oldStaffNames.forEach((name) => addStaffInput(name ?? ''));
        } else {
            addStaffInput();
            addStaffInput();
            addStaffInput();
        }

        loginForm.addEventListener('submit', (event) => {
            if (!loginConfirmed) {
                event.preventDefault();
                if (!staffDialog.open) {
                    staffDialog.showModal();
                }
            }
        });

        document.getElementById('add-staff').addEventListener('click', () => addStaffInput());
        document.getElementById('cancel-staff').addEventListener('click', () => staffDialog.close());
        document.getElementById('confirm-login').addEventListener('click', () => {
            loginConfirmed = true;
            loginForm.requestSubmit(loginButton);
        });

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const pwIcon = document.getElementById('pw-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                pwIcon.classList.remove('fa-eye');
                pwIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                pwIcon.classList.remove('fa-eye-slash');
                pwIcon.classList.add('fa-eye');
            }
        }
    </script>

    <!-- SweetAlert2 Notification Popup -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: @json(session('success')),
                confirmButtonColor: '#e0201a',
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
                confirmButtonColor: '#e0201a',
                confirmButtonText: 'Mengerti'
            });
        </script>
    @endif

</body>
</html>
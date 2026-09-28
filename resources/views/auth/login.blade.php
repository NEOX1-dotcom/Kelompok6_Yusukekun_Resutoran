<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
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
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            min-height: 100vh;
        }

        .login-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .login-left {
            background: #e0201a;
            flex: 1;
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
            padding: 60px 100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .login-right h1 {
            font-size: 32px;
            margin-bottom: 6px;
        }

        .subtitle {
            color: #777;
            margin-bottom: 30px;
        }

        form {
            width: 100%;
            max-width: 380px;
            text-align: left;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .form-group input {
            display: block;
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            display: block;
            width: 100%;
            background: #e0201a;
            color: #fff;
            padding: 14px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 28px;
        }

        button:hover {
            background: #b8180f;
        }
    </style>
</head>
<body>

    <div class="login-container">

        <div class="login-left">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Yusukekun Resutoran">
        </div>

        <div class="login-right">
            <h1>WELCOME BACK</h1>
            <p class="subtitle">Use your email and password</p>

            <form action="#" onsubmit="return false;">

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter username">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password">
                </div>

                <button type="submit">Sign in</button>
            </form>
        </div>

    </div>

</body>
</html>
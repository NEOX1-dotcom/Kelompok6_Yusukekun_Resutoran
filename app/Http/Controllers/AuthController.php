<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Tampilkan formulir login.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Proses autentikasi login pengguna.
     */
    public function login(Request $request): RedirectResponse
    {
        // 1. Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Nama atau username wajib diisi!',
            'password.required' => 'Password wajib diisi!',
        ]);

        $loginInput = trim($request->input('username'));
        $password = $request->input('password');

        // 2. Cari akun admin berdasarkan username, nama_admin, atau email
        $admin = Admin::where('username', $loginInput)
            ->orWhere('nama_admin', $loginInput)
            ->orWhere('email', $loginInput)
            ->first();

        // 3. Jika akun belum terdaftar / nama atau username salah
        if (!$admin) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors([
                    'username' => 'Akun tidak ditemukan! Nama atau username salah atau belum terdaftar.',
                ])
                ->with('error_type', 'nama_salah')
                ->with('error', 'Akun tidak ditemukan! Nama atau username salah. Anda harus memiliki akun terlebih dahulu.');
        }

        // 4. Jika akun ditemukan tetapi password salah
        if (!Hash::check($password, $admin->password)) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors([
                    'password' => 'Password yang Anda masukkan salah!',
                ])
                ->with('error_type', 'password_salah')
                ->with('error', 'Password yang Anda masukkan salah!');
        }

        // 5. Autentikasi berhasil: login dan buat sesi baru
        Auth::login($admin, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'))
            ->with('success', 'Selamat datang, ' . $admin->nama_admin . '! Berhasil masuk.');
    }



    /**
     * Proses keluar (logout).
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

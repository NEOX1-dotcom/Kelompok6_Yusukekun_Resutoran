<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * Memastikan halaman dashboard tidak bisa diakses tanpa akun/login (guest dialihkan ke login).
     */
    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
        $response->assertSessionHas('info');
    }

    /**
     * Memastikan login gagal dan menampilkan notifikasi jika nama / username salah atau akun belum ada.
     */
    public function test_login_fails_with_invalid_username_or_name(): void
    {
        $response = $this->post('/login', [
            'username' => 'akun_tidak_ada',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors(['username']);
        $response->assertSessionHas('error_type', 'nama_salah');
        $response->assertSessionHas('error');
        $this->assertGuest();
    }

    /**
     * Memastikan login gagal dan menampilkan notifikasi jika password salah.
     */
    public function test_login_fails_with_wrong_password(): void
    {
        $admin = Admin::where('username', 'admin')->first();
        if (!$admin) {
            $admin = Admin::create([
                'nama_admin' => 'Administrator Yusukekun',
                'username' => 'admin',
                'email' => 'admin@yusukekun.com',
                'password' => Hash::make('password123'),
            ]);
        }

        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'password_salah',
        ]);

        $response->assertSessionHasErrors(['password']);
        $response->assertSessionHas('error_type', 'password_salah');
        $response->assertSessionHas('error', 'Password yang Anda masukkan salah!');
        $this->assertGuest();
    }

    /**
     * Memastikan login berhasil dengan username dan password yang benar.
     */
    public function test_login_success_with_valid_credentials(): void
    {
        $admin = Admin::where('username', 'admin')->first();
        if (!$admin) {
            $admin = Admin::create([
                'nama_admin' => 'Administrator Yusukekun',
                'username' => 'admin',
                'email' => 'admin@yusukekun.com',
                'password' => Hash::make('password123'),
            ]);
        }

        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('success');
        $this->assertAuthenticatedAs($admin);
    }

    /**
     * Memastikan login berhasil juga dengan nama_admin.
     */
    public function test_login_success_with_nama_admin(): void
    {
        $admin = Admin::where('username', 'admin')->first();
        if (!$admin) {
            $admin = Admin::create([
                'nama_admin' => 'Administrator Yusukekun',
                'username' => 'admin',
                'email' => 'admin@yusukekun.com',
                'password' => Hash::make('password123'),
            ]);
        }

        $response = $this->post('/login', [
            'username' => 'Administrator Yusukekun',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($admin);
    }



    /**
     * Memastikan logout berhasil mengeluarkan user.
     */
    public function test_user_can_logout(): void
    {
        $admin = Admin::where('username', 'admin')->first();
        if (!$admin) {
            $admin = Admin::create([
                'nama_admin' => 'Administrator Yusukekun',
                'username' => 'admin',
                'email' => 'admin@yusukekun.com',
                'password' => Hash::make('password123'),
            ]);
        }

        $response = $this->actingAs($admin)->post('/logout');

        $response->assertRedirect('/login');
        $response->assertSessionMissing('success');
        $this->assertGuest();
    }
}

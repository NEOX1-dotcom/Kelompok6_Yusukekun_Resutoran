<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Cabang;
use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class KaryawanTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_records_non_empty_staff_names_for_the_admin_branch(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-11-23 09:15:30'));

        try {
            $cabang = Cabang::create(['nama_cabang' => 'Cabang Utama', 'anggota1' => 'Anggota']);
            $admin = $this->createAdmin($cabang);

            $this->post('/login', [
                'username' => $admin->username,
                'password' => 'password123',
                'karyawan' => ['Ani', ' ', 'Budi'],
            ])->assertRedirect('/dashboard');

            $this->assertDatabaseCount('karyawan', 2);
            $this->assertDatabaseHas('karyawan', [
                'id_cabang' => $cabang->id_cabang,
                'nama_karyawan' => 'Ani',
                'tanggal' => '2026-11-23',
            ]);
            $this->assertDatabaseHas('karyawan', [
                'id_cabang' => $cabang->id_cabang,
                'nama_karyawan' => 'Budi',
                'tanggal' => '2026-11-23',
            ]);
        } finally {
            Carbon::setTestNow();
        }
    }

    public function test_staff_names_require_an_admin_branch(): void
    {
        $admin = $this->createAdmin();

        $this->from('/login')->post('/login', [
            'username' => $admin->username,
            'password' => 'password123',
            'karyawan' => ['Ani'],
        ])->assertRedirect('/login')
            ->assertSessionHasErrors('karyawan');

        $this->assertDatabaseCount('karyawan', 0);
        $this->assertGuest();
    }

    public function test_login_assigns_unlinked_admin_to_first_branch(): void
    {
        $cabang = Cabang::create(['nama_cabang' => 'Cabang Pertama', 'anggota1' => 'Anggota']);
        $admin = $this->createAdmin();

        $this->post('/login', [
            'username' => $admin->username,
            'password' => 'password123',
            'karyawan' => ['Ani'],
        ])->assertRedirect('/dashboard');

        $this->assertDatabaseHas('admins', [
            'id_admin' => $admin->id_admin,
            'id_cabang' => $cabang->id_cabang,
        ]);
        $this->assertDatabaseHas('karyawan', [
            'id_cabang' => $cabang->id_cabang,
            'nama_karyawan' => 'Ani',
        ]);
    }

    public function test_karyawan_index_filters_by_date_and_branch(): void
    {
        $cabangA = Cabang::create(['nama_cabang' => 'Cabang A', 'anggota1' => 'Anggota']);
        $cabangB = Cabang::create(['nama_cabang' => 'Cabang B', 'anggota1' => 'Anggota']);
        $admin = $this->createAdmin($cabangA);

        Karyawan::create([
            'id_cabang' => $cabangA->id_cabang,
            'nama_karyawan' => 'Ani',
            'tanggal' => '2026-11-23',
        ]);
        Karyawan::create([
            'id_cabang' => $cabangB->id_cabang,
            'nama_karyawan' => 'Budi',
            'tanggal' => '2026-11-23',
        ]);
        Karyawan::create([
            'id_cabang' => $cabangA->id_cabang,
            'nama_karyawan' => 'Cici',
            'tanggal' => '2026-11-22',
        ]);

        $this->actingAs($admin)
            ->get(route('karyawan.index', [
                'tanggal' => '2026-11-23',
                'cabang' => $cabangA->id_cabang,
            ]))
            ->assertOk()
            ->assertSee('Ani')
            ->assertDontSee('Budi')
            ->assertDontSee('Cici');
    }

    private function createAdmin(?Cabang $cabang = null): Admin
    {
        return Admin::create([
            'nama_admin' => 'Admin Cabang',
            'username' => 'admin'.($cabang?->id_cabang ?? 'tanpa-cabang'),
            'email' => 'admin'.($cabang?->id_cabang ?? 'tanpa-cabang').'@example.com',
            'password' => Hash::make('password123'),
            'id_cabang' => $cabang?->id_cabang,
        ]);
    }
}

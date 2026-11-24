<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Cabang;
use Database\Seeders\AdminSeeder;
use Database\Seeders\CabangSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_seeder_assigns_a_unique_account_to_each_branch(): void
    {
        $this->seed([CabangSeeder::class, AdminSeeder::class]);

        $akunPerCabang = [
            'Cabang 1' => 'admin',
            'Cabang 2' => 'admin-cabang-2',
            'Cabang 3' => 'admin-cabang-3',
        ];

        foreach ($akunPerCabang as $namaCabang => $username) {
            $cabang = Cabang::query()->where('nama_cabang', $namaCabang)->firstOrFail();
            $admin = Admin::query()->where('username', $username)->firstOrFail();

            $this->assertSame($cabang->id_cabang, $admin->id_cabang);
        }

        $this->assertDatabaseCount('admins', count($akunPerCabang));
    }
}

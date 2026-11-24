<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Cabang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $akunPerCabang = [
            [
                'nama_cabang' => 'Cabang 1',
                'username' => 'admin',
                'nama_admin' => 'Admin Cabang 1',
                'email' => 'admin@yusukekun.com',
                'no_telp' => '08123456789',
            ],
            [
                'nama_cabang' => 'Cabang 2',
                'username' => 'admin-cabang-2',
                'nama_admin' => 'Admin Cabang 2',
                'email' => 'admin.cabang2@yusukekun.com',
                'no_telp' => null,
            ],
            [
                'nama_cabang' => 'Cabang 3',
                'username' => 'admin-cabang-3',
                'nama_admin' => 'Admin Cabang 3',
                'email' => 'admin.cabang3@yusukekun.com',
                'no_telp' => null,
            ],
        ];

        $password = Hash::make('password123');

        foreach ($akunPerCabang as $akun) {
            $cabang = Cabang::query()
                ->where('nama_cabang', $akun['nama_cabang'])
                ->firstOrFail();

            Admin::updateOrCreate(
                ['username' => $akun['username']],
                [
                    'nama_admin' => $akun['nama_admin'],
                    'email' => $akun['email'],
                    'password' => $password,
                    'no_telp' => $akun['no_telp'],
                    'id_cabang' => $cabang->id_cabang,
                ]
            );
        }
    }
}

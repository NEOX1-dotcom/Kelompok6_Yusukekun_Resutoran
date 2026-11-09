<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate(['username' => 'admin'], [
            'nama_admin' => 'admin',
            'email' => 'admin@yusukekun.com',
            'password' => Hash::make('password123'),
            'no_telp' => '08123456789',
        ]);
    }
}

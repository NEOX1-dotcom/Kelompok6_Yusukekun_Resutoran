<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Admin::truncate();
        Schema::enableForeignKeyConstraints();

        Admin::create([
            'nama_admin' => 'Administrator Yusukekun',
            'username' => 'admin',
            'email' => 'admin@yusukekun.com',
            'password' => Hash::make('password123'),
            'no_telp' => '08123456789',
        ]);
    }
}

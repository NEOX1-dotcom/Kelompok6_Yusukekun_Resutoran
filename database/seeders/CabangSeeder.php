<?php

namespace Database\Seeders;

use App\Models\Cabang;
use Illuminate\Database\Seeder;

class CabangSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Cabang 1', 'Cabang 2', 'Cabang 3'] as $namaCabang) {
            Cabang::firstOrCreate(
                ['nama_cabang' => $namaCabang],
                ['anggota1' => 'Belum ditentukan']
            );
        }
    }
}

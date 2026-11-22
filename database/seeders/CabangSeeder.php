<?php

namespace Database\Seeders;

use App\Models\Cabang;
use Illuminate\Database\Seeder;

class CabangSeeder extends Seeder
{
    public function run(): void
    {
        Cabang::firstOrCreate(
            ['nama_cabang' => 'Yusukekun Resutoran'],
            ['anggota1' => 'rizki', 'anggota2' => 'naufal', 'anggota3' => 'fikri', 'alamat' => 'Jl. Raya No. 123, Kota Contoh']
        );
    }
}

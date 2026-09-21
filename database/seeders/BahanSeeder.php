<?php

namespace Database\Seeders;

use App\Models\Bahan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class BahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Bahan::truncate();
        Schema::enableForeignKeyConstraints();

        $bahanList = [
            [
                'nama_bahan' => 'Chuka sushi',
                'kategori' => 'Makanan',
                'satuan' => 'porsi',
            ],
            [
                'nama_bahan' => 'Beef enoki',
                'kategori' => 'Makanan',
                'satuan' => 'porsi',
            ],
            [
                'nama_bahan' => 'Jeruk lemon',
                'kategori' => 'Buah & Sayur',
                'satuan' => 'kg',
            ],
            [
                'nama_bahan' => 'Sirup',
                'kategori' => 'Minuman',
                'satuan' => 'botol',
            ],
            [
                'nama_bahan' => 'Gula cair',
                'kategori' => 'Minuman',
                'satuan' => 'liter',
            ],
            [
                'nama_bahan' => 'Ebi katsu',
                'kategori' => 'Makanan',
                'satuan' => 'pcs',
            ],
            [
                'nama_bahan' => 'Chicken katsu',
                'kategori' => 'Makanan',
                'satuan' => 'pcs',
            ],
            [
                'nama_bahan' => 'Minyak cabai',
                'kategori' => 'Bumbu & Saus',
                'satuan' => 'botol',
            ],
            [
                'nama_bahan' => 'Timun',
                'kategori' => 'Sayuran',
                'satuan' => 'kg',
            ],
            [
                'nama_bahan' => 'Ogawa dressing',
                'kategori' => 'Bumbu & Saus',
                'satuan' => 'botol',
            ],
            [
                'nama_bahan' => 'Pakcoy',
                'kategori' => 'Sayuran',
                'satuan' => 'kg',
            ],
            [
                'nama_bahan' => 'Es batu',
                'kategori' => 'Minuman',
                'satuan' => 'kg',
            ],
            [
                'nama_bahan' => 'Ogawa tofu',
                'kategori' => 'Makanan',
                'satuan' => 'pack',
            ],
        ];

        foreach ($bahanList as $item) {
            Bahan::create($item);
        }
    }
}

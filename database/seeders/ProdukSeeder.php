<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Produk::truncate();
        Schema::enableForeignKeyConstraints();

        $produkList = [
            [
                'nama_produk' => 'Chuka Sushi Roll',
                'kategori' => 'Sushi',
                'harga' => 28000.00,
                'stok' => 50,
            ],
            [
                'nama_produk' => 'Beef Enoki Roll',
                'kategori' => 'Main Course',
                'harga' => 35000.00,
                'stok' => 40,
            ],
            [
                'nama_produk' => 'Chicken Katsu Bento',
                'kategori' => 'Bento',
                'harga' => 32000.00,
                'stok' => 35,
            ],
            [
                'nama_produk' => 'Ebi Katsu Don',
                'kategori' => 'Donburi',
                'harga' => 38000.00,
                'stok' => 30,
            ],
            [
                'nama_produk' => 'Lemon Tea Ice',
                'kategori' => 'Minuman',
                'harga' => 12000.00,
                'stok' => 100,
            ],
            [
                'nama_produk' => 'Ogawa Tofu Salad',
                'kategori' => 'Appetizer',
                'harga' => 22000.00,
                'stok' => 25,
            ],
        ];

        foreach ($produkList as $item) {
            Produk::create($item);
        }
    }
}

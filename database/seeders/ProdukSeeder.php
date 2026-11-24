<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produkList = [
            ['nama_produk' => 'Sakana Dango Soyu Ramen', 'kategori' => 'Makanan', 'harga' => 22000, 'stok' => 50],
            ['nama_produk' => 'Ebi Katsu Soyu Ramen', 'kategori' => 'Makanan', 'harga' => 37000, 'stok' => 50],
            ['nama_produk' => 'Chicken Katsu Soyu Ramen', 'kategori' => 'Makanan', 'harga' => 34000, 'stok' => 50],
            ['nama_produk' => 'Sakana Dango Miso Ramen', 'kategori' => 'Makanan', 'harga' => 24000, 'stok' => 50],
            ['nama_produk' => 'Ebi Katsu Miso Ramen', 'kategori' => 'Makanan', 'harga' => 38000, 'stok' => 50],
            ['nama_produk' => 'Chicken Katsu Miso Ramen', 'kategori' => 'Makanan', 'harga' => 35000, 'stok' => 50],
            ['nama_produk' => 'Sakana Dango Kare Ramen', 'kategori' => 'Makanan', 'harga' => 25000, 'stok' => 50],
            ['nama_produk' => 'Ebi Katsu Kare Ramen', 'kategori' => 'Makanan', 'harga' => 38000, 'stok' => 50],
            ['nama_produk' => 'Chicken Katsu Kare Ramen', 'kategori' => 'Makanan', 'harga' => 36000, 'stok' => 50],
            ['nama_produk' => 'Beef Chasu Ramen', 'kategori' => 'Makanan', 'harga' => 49000, 'stok' => 50],
            ['nama_produk' => 'Chicken Chasu Ramen', 'kategori' => 'Makanan', 'harga' => 46000, 'stok' => 50],
            ['nama_produk' => 'Beef Teriyaki Ramen', 'kategori' => 'Makanan', 'harga' => 48000, 'stok' => 50],
            ['nama_produk' => 'Chicken Teriyaki', 'kategori' => 'Makanan', 'harga' => 35000, 'stok' => 50],
            ['nama_produk' => 'Beef Tantanmen', 'kategori' => 'Makanan', 'harga' => 45000, 'stok' => 50],
            ['nama_produk' => 'Chicken Tantanmen', 'kategori' => 'Makanan', 'harga' => 35000, 'stok' => 50],
            ['nama_produk' => 'Gyudon', 'kategori' => 'Makanan', 'harga' => 46000, 'stok' => 50],
            ['nama_produk' => 'Beef Teriyaki Don', 'kategori' => 'Makanan', 'harga' => 46000, 'stok' => 50],
            ['nama_produk' => 'Tofu Don', 'kategori' => 'Makanan', 'harga' => 25000, 'stok' => 50],
            ['nama_produk' => 'Ebi Katsu Don', 'kategori' => 'Makanan', 'harga' => 37000, 'stok' => 50],
            ['nama_produk' => 'Chicken Katsu Don', 'kategori' => 'Makanan', 'harga' => 34000, 'stok' => 50],
            ['nama_produk' => 'Oyakodon', 'kategori' => 'Makanan', 'harga' => 34000, 'stok' => 50],
            ['nama_produk' => 'Sushi Kebab Beef', 'kategori' => 'Makanan', 'harga' => 42000, 'stok' => 50],
            ['nama_produk' => 'Sushi Kebab Chicken', 'kategori' => 'Makanan', 'harga' => 36000, 'stok' => 50],
            ['nama_produk' => 'Sushi Kebab Sosis', 'kategori' => 'Makanan', 'harga' => 36000, 'stok' => 50],
            ['nama_produk' => 'Sushi Ebi Katsu', 'kategori' => 'Makanan', 'harga' => 37000, 'stok' => 50],
            ['nama_produk' => 'Sushi Chicken Katsu', 'kategori' => 'Makanan', 'harga' => 34000, 'stok' => 50],
            ['nama_produk' => 'Sushi Tuna Mayo', 'kategori' => 'Makanan', 'harga' => 34000, 'stok' => 50],
            ['nama_produk' => 'Sushi Kani Mayo', 'kategori' => 'Makanan', 'harga' => 30000, 'stok' => 50],
            ['nama_produk' => 'Sushi Furaisu', 'kategori' => 'Makanan', 'harga' => 28000, 'stok' => 50],
            ['nama_produk' => 'Sushi Beef Teriyaki', 'kategori' => 'Makanan', 'harga' => 37000, 'stok' => 50],
            ['nama_produk' => 'Sushi Sosis', 'kategori' => 'Makanan', 'harga' => 32000, 'stok' => 50],
            ['nama_produk' => 'Beef Yakisoba', 'kategori' => 'Makanan', 'harga' => 32000, 'stok' => 50],
            ['nama_produk' => 'Chicken Yakisoba', 'kategori' => 'Makanan', 'harga' => 24000, 'stok' => 50],
            ['nama_produk' => 'Beef Chahan', 'kategori' => 'Makanan', 'harga' => 37000, 'stok' => 50],
            ['nama_produk' => 'Chicken Chahan', 'kategori' => 'Makanan', 'harga' => 28000, 'stok' => 50],
            ['nama_produk' => 'Ebi Chahan', 'kategori' => 'Makanan', 'harga' => 37000, 'stok' => 50],
            ['nama_produk' => 'Yakitori', 'kategori' => 'Makanan', 'harga' => 32000, 'stok' => 50],
            ['nama_produk' => 'Chicken Curry Rice', 'kategori' => 'Makanan', 'harga' => 35000, 'stok' => 50],
            ['nama_produk' => 'Gohan', 'kategori' => 'Makanan', 'harga' => 5000, 'stok' => 50],
            ['nama_produk' => 'Kaniyaki', 'kategori' => 'Makanan', 'harga' => 18000, 'stok' => 50],
            ['nama_produk' => 'Beef Sosis Yaki', 'kategori' => 'Makanan', 'harga' => 18000, 'stok' => 50],
            ['nama_produk' => 'Tunayaki', 'kategori' => 'Makanan', 'harga' => 18000, 'stok' => 50],
            ['nama_produk' => 'Ebiyaki', 'kategori' => 'Makanan', 'harga' => 18000, 'stok' => 50],
            ['nama_produk' => 'Ikoyaki', 'kategori' => 'Makanan', 'harga' => 20000, 'stok' => 50],
            ['nama_produk' => 'Takoyaki Octopus', 'kategori' => 'Makanan', 'harga' => 25000, 'stok' => 50],
            ['nama_produk' => 'Takoyaki Flavors', 'kategori' => 'Makanan', 'harga' => 18000, 'stok' => 50],
            ['nama_produk' => 'Mix Yaki', 'kategori' => 'Makanan', 'harga' => 18000, 'stok' => 50],
            ['nama_produk' => 'Chicken Katsu Small', 'kategori' => 'Makanan', 'harga' => 10000, 'stok' => 50],
            ['nama_produk' => 'Chicken Katsu Big', 'kategori' => 'Makanan', 'harga' => 20000, 'stok' => 50],
            ['nama_produk' => 'Chawan Mushi', 'kategori' => 'Makanan', 'harga' => 10000, 'stok' => 50],
            ['nama_produk' => 'Miso Shiru', 'kategori' => 'Makanan', 'harga' => 3000, 'stok' => 50],
            ['nama_produk' => 'French Fries', 'kategori' => 'Makanan', 'harga' => 16000, 'stok' => 50],
            ['nama_produk' => 'Edamame', 'kategori' => 'Makanan', 'harga' => 16000, 'stok' => 50],
            ['nama_produk' => 'Tsunetai Kocha (Es Teh)', 'kategori' => 'Minuman', 'harga' => 7000, 'stok' => 50],
            ['nama_produk' => 'Tsunetai Shiroppu (Es Sirup)', 'kategori' => 'Minuman', 'harga' => 7000, 'stok' => 50],
            ['nama_produk' => 'Tsunetai Ocha (Es Green Tea)', 'kategori' => 'Minuman', 'harga' => 10000, 'stok' => 50],
            ['nama_produk' => 'Tsunetai Lemon (Es Lemon)', 'kategori' => 'Minuman', 'harga' => 10000, 'stok' => 50],
            ['nama_produk' => 'Tsunetai Ko-hi (Es Kopi)', 'kategori' => 'Minuman', 'harga' => 10000, 'stok' => 50],
            ['nama_produk' => 'Omizu (Air Putih)', 'kategori' => 'Minuman', 'harga' => 2000, 'stok' => 50],
            ['nama_produk' => 'Mineral Water (Air Mineral Kemasan)', 'kategori' => 'Minuman', 'harga' => 5000, 'stok' => 50],
            ['nama_produk' => 'Wadang Jahe', 'kategori' => 'Minuman', 'harga' => 12000, 'stok' => 50],
            ['nama_produk' => 'Teh Jahe', 'kategori' => 'Minuman', 'harga' => 13000, 'stok' => 50],
            ['nama_produk' => 'Kopi Jahe', 'kategori' => 'Minuman', 'harga' => 15000, 'stok' => 50],
        ];

        foreach ($produkList as $item) {
            Produk::updateOrCreate(['nama_produk' => $item['nama_produk']], $item);
        }

        Produk::whereNotIn(
            'nama_produk',
            array_column($produkList, 'nama_produk')
        )->delete();
    }
}

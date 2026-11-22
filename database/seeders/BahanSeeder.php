<?php

namespace Database\Seeders;

use App\Models\Bahan;
use Illuminate\Database\Seeder;

class BahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
            Bahan::firstOrCreate(['nama_bahan' => $item['nama_bahan']], $item);
        }

        $namaBahanOktober = [
            'Abon',
            'Bawang Putih',
            'Beef',
            'Beef Teriyaki Don/ Ramen',
            'Beef Teriyaki Sushi',
            'Beras',
            'Bombai',
            'Box Sushi',
            'Box Takoyaki',
            'Bubuk Cabe',
            'Buku Nota',
            'Bumbu A',
            'Bumbu Jamur',
            'Bumbu S',
            'Bumbu Shusi',
            'Bumbu Teriyaki',
            'Chashu Bifu',
            'Chashu Chicken',
            'Chicken katsu',
            'Chicken Sushi',
            'Dango',
            'Daun Bawang',
            'Ebi katsu',
            'Ebi Yaki',
            'Edamame',
            'Es Kristal',
            'Galon Air',
            'Gas 3kg',
            'Gelas Plastik',
            'Gula cair',
            'Gula Pasir',
            'Gyudonm',
            'Ika Yaki',
            'Jahe',
            'Jeruk lemon',
            'Kaldu',
            'Kani Sushi',
            'Kani Yaki',
            'Kare',
            'Katshu Bushi',
            'Kecap Manis Botol',
            'Keju Balok',
            'Kentang',
            'Kol',
            'Kopi Bubuk',
            'Kopi cair',
            'Mayones',
            'Merica',
            'Mie Ramen',
            'Mie Yakisoba',
            'Mineral Botol',
            'Minyak cabai',
            'Minyak Goreng',
            'Minyak Wijen',
            'Misou Shiru',
            'Mix Vegetable',
            'Mix Yaki',
            'Musume',
            'Nori Sushi',
            'Nori Tabur',
            'Oktopus',
            'Oyakodon',
            'Pakcoy',
            'Paper Bowl',
            'Pedas Lv 10',
            'Pedas Lv 100',
            'Pedas Lv 20',
            'Pedas Lv 30',
            'Pedas Lv 50',
            'Plastik 2kg Kharisma',
            'Plastik Kilat 2kg',
            'Plastik Klip 3x5',
            'Plastik Kresek Besar',
            'Plastik Kresek Kecil',
            'Plastik Kresek Sampah',
            'Plastik Minuman',
            'Poteto',
            'Pulpen',
            'Sabun Cuci Piring',
            'Saos Botol',
            'Saos Mentai',
            'Saos Saset',
            'Saos Takoyaki',
            'Saos Tomat',
            'Sarung Tangan',
            'Sedotan',
            'Selada',
            'Sendok Plastik',
            'Shoyu Saji',
            'Sirup',
            'Sosis Sushi',
            'Sosis Yaki',
            'Soyu Saset',
            'Spons',
            'Sumpit',
            'Sushi Gary',
            'Susu',
            'Tahu',
            'Teh Celup',
            'Teh Hijau',
            'Telur',
            'Tepung Takoyaki',
            'Timun',
            'Tisu',
            'Transportasi',
            'Tuna Sushi',
            'Tuna Yaki',
            'Tusuk Sate',
            'Wakame',
            'Wasabi',
            'Cabe Rawit',
            'Bumbu Neri',
        ];

        foreach ($namaBahanOktober as $namaBahan) {
            Bahan::firstOrCreate(
                ['nama_bahan' => $namaBahan],
                ['kategori' => null, 'satuan' => '-']
            );
        }
    }
}

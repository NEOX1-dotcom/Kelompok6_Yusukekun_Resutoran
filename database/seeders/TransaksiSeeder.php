<?php

namespace Database\Seeders;

use App\Models\Bahan;
use App\Models\BahanKeluar;
use App\Models\BahanMasuk;
use App\Models\OmsetBulanan;
use App\Models\OmsetHarian;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\SisaBahanAkhirBulan;
use App\Models\StokAwalBulan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        BahanMasuk::truncate();
        BahanKeluar::truncate();
        StokAwalBulan::truncate();
        SisaBahanAkhirBulan::truncate();
        Penjualan::truncate();
        OmsetHarian::truncate();
        OmsetBulanan::truncate();
        Schema::enableForeignKeyConstraints();

        $bulanSekarang = Carbon::now()->format('Y-m'); // e.g. 2026-09
        $bahanList = Bahan::all();
        $produkList = Produk::all();

        if ($bahanList->isEmpty() || $produkList->isEmpty()) {
            return;
        }

        // 1. Stok Awal Bulan untuk setiap bahan
        foreach ($bahanList as $bahan) {
            $stokAwal = match ($bahan->nama_bahan) {
                'Chuka sushi' => 50,
                'Beef enoki' => 40,
                'Chicken katsu' => 60,
                'Ebi katsu' => 45,
                'Jeruk lemon' => 15,
                'Sirup' => 20,
                'Gula cair' => 25,
                'Es batu' => 100,
                'Pakcoy' => 30,
                'Timun' => 20,
                'Ogawa dressing' => 15,
                'Ogawa tofu' => 35,
                default => 25,
            };

            StokAwalBulan::create([
                'bulan' => $bulanSekarang,
                'id_bahan' => $bahan->id_bahan,
                'stok_awal' => $stokAwal,
            ]);
        }

        // 2. Bahan Masuk (Pengadaan / Restock Gudang)
        $sampleBahanMasuk = [
            [
                'tanggal' => Carbon::now()->subDays(15)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Chuka sushi')->first()?->id_bahan ?? 1,
                'jumlah' => 30,
                'harga_satuan' => 15000,
                'total_harga' => 450000,
                'keterangan' => 'Pengadaan bahan baku segar gelombang 1',
            ],
            [
                'tanggal' => Carbon::now()->subDays(12)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Beef enoki')->first()?->id_bahan ?? 2,
                'jumlah' => 25,
                'harga_satuan' => 22000,
                'total_harga' => 550000,
                'keterangan' => 'Daging sapi impor & enoki segar',
            ],
            [
                'tanggal' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Chicken katsu')->first()?->id_bahan ?? 7,
                'jumlah' => 40,
                'harga_satuan' => 18000,
                'total_harga' => 720000,
                'keterangan' => 'Restock persediaan ayam fillet katsu',
            ],
            [
                'tanggal' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Jeruk lemon')->first()?->id_bahan ?? 3,
                'jumlah' => 10,
                'harga_satuan' => 25000,
                'total_harga' => 250000,
                'keterangan' => 'Restock lemon segar untuk minuman',
            ],
            [
                'tanggal' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Es batu')->first()?->id_bahan ?? 12,
                'jumlah' => 50,
                'harga_satuan' => 5000,
                'total_harga' => 250000,
                'keterangan' => 'Pengiriman es kristal higienis',
            ],
        ];

        foreach ($sampleBahanMasuk as $bm) {
            BahanMasuk::create($bm);
        }

        // 3. Bahan Keluar (Pemakaian Dapur Operasional)
        $sampleBahanKeluar = [
            [
                'tanggal' => Carbon::now()->subDays(14)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Chuka sushi')->first()?->id_bahan ?? 1,
                'jumlah' => 18,
                'digunakan_untuk' => 'Dapur Sushi Bar',
                'keterangan' => 'Pemakaian porsi makan siang & malam',
            ],
            [
                'tanggal' => Carbon::now()->subDays(11)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Beef enoki')->first()?->id_bahan ?? 2,
                'jumlah' => 15,
                'digunakan_untuk' => 'Dapur Utama (Hot Kitchen)',
                'keterangan' => 'Menu grill beef enoki roll',
            ],
            [
                'tanggal' => Carbon::now()->subDays(8)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Chicken katsu')->first()?->id_bahan ?? 7,
                'jumlah' => 22,
                'digunakan_untuk' => 'Dapur Utama Bento',
                'keterangan' => 'Pemakaian pesanan katsu bento',
            ],
            [
                'tanggal' => Carbon::now()->subDays(4)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Jeruk lemon')->first()?->id_bahan ?? 3,
                'jumlah' => 6,
                'digunakan_untuk' => 'Bar Minuman',
                'keterangan' => 'Racikan Ice Lemon Tea',
            ],
            [
                'tanggal' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Es batu')->first()?->id_bahan ?? 12,
                'jumlah' => 35,
                'digunakan_untuk' => 'Bar Minuman',
                'keterangan' => 'Pemakaian es harian',
            ],
        ];

        foreach ($sampleBahanKeluar as $bk) {
            BahanKeluar::create($bk);
        }

        // 4. Hitung & Simpan Sisa Bahan Akhir Bulan
        SisaBahanAkhirBulan::syncForMonth($bulanSekarang);

        // 5. Penjualan Restoran
        $p1 = $produkList->where('nama_produk', 'Chuka Sushi Roll')->first() ?? $produkList[0];
        $p2 = $produkList->where('nama_produk', 'Beef Enoki Roll')->first() ?? $produkList[1];
        $p3 = $produkList->where('nama_produk', 'Chicken Katsu Bento')->first() ?? $produkList[2];
        $p4 = $produkList->where('nama_produk', 'Lemon Tea Ice')->first() ?? $produkList[4];

        $samplePenjualan = [
            // Hari ini
            [
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'id_produk' => $p1->id_produk,
                'jumlah_terjual' => 6,
                'harga_satuan' => $p1->harga,
                'total' => 6 * $p1->harga,
                'metode_pembayaran' => 'QRIS',
                'keterangan' => 'Order Meja 02',
            ],
            [
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'id_produk' => $p3->id_produk,
                'jumlah_terjual' => 8,
                'harga_satuan' => $p3->harga,
                'total' => 8 * $p3->harga,
                'metode_pembayaran' => 'Tunai',
                'keterangan' => 'Order Meja 05 & Takeaway',
            ],
            [
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'id_produk' => $p4->id_produk,
                'jumlah_terjual' => 12,
                'harga_satuan' => $p4->harga,
                'total' => 12 * $p4->harga,
                'metode_pembayaran' => 'QRIS',
                'keterangan' => 'Minuman paket makan siang',
            ],
            // Kemarin
            [
                'tanggal' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'id_produk' => $p2->id_produk,
                'jumlah_terjual' => 10,
                'harga_satuan' => $p2->harga,
                'total' => 10 * $p2->harga,
                'metode_pembayaran' => 'Tunai',
                'keterangan' => 'Order Meja 07',
            ],
            [
                'tanggal' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'id_produk' => $p4->id_produk,
                'jumlah_terjual' => 15,
                'harga_satuan' => $p4->harga,
                'total' => 15 * $p4->harga,
                'metode_pembayaran' => 'Transfer',
                'keterangan' => 'Pesanan katering kantor',
            ],
            // 2 hari lalu
            [
                'tanggal' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'id_produk' => $p1->id_produk,
                'jumlah_terjual' => 12,
                'harga_satuan' => $p1->harga,
                'total' => 12 * $p1->harga,
                'metode_pembayaran' => 'QRIS',
                'keterangan' => 'Makan malam rombongan',
            ],
            [
                'tanggal' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'id_produk' => $p3->id_produk,
                'jumlah_terjual' => 14,
                'harga_satuan' => $p3->harga,
                'total' => 14 * $p3->harga,
                'metode_pembayaran' => 'Kartu Debit/Kredit',
                'keterangan' => 'Pembayaran EDC Mandiri',
            ],
        ];

        foreach ($samplePenjualan as $penjualanData) {
            Penjualan::create($penjualanData);
        }

        // 6. Sinkronisasi Omset Harian & Bulanan untuk semua tanggal transaksi
        $dates = Penjualan::select('tanggal')->distinct()->pluck('tanggal');
        foreach ($dates as $tgl) {
            $formattedDate = Carbon::parse($tgl)->format('Y-m-d');
            OmsetHarian::syncForDate($formattedDate);
        }

        OmsetBulanan::syncForMonth($bulanSekarang);
    }
}

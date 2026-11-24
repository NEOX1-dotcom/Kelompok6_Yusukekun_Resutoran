<?php

namespace Database\Seeders;

use App\Models\Bahan;
use App\Models\BahanKeluar;
use App\Models\BahanMasuk;
use App\Models\Cabang;
use App\Models\Omset;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\SisaBahanAkhirBulan;
use App\Models\StokAwalBulan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bulanSekarang = Carbon::now()->format('Y-m'); // e.g. 2026-09
        $bahanList = Bahan::all();
        $produkList = Produk::all();
        $idCabang = Cabang::query()->orderBy('id_cabang')->value('id_cabang');

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

            StokAwalBulan::firstOrCreate([
                'bulan' => $bulanSekarang,
                'id_bahan' => $bahan->id_bahan,
            ], [
                'stok_awal' => $stokAwal,
            ]);
        }

        // 2. Bahan Masuk (Pengadaan / Restock Gudang)
        $sampleBahanMasuk = [
            [
                'tanggal' => Carbon::now()->subDays(15)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Chuka sushi')->first()?->id_bahan ?? 1,
                'jumlah' => 30,
                'keterangan' => 'Pengadaan bahan baku segar gelombang 1',
            ],
            [
                'tanggal' => Carbon::now()->subDays(12)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Beef enoki')->first()?->id_bahan ?? 2,
                'jumlah' => 25,
                'keterangan' => 'Daging sapi impor & enoki segar',
            ],
            [
                'tanggal' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Chicken katsu')->first()?->id_bahan ?? 7,
                'jumlah' => 40,
                'keterangan' => 'Restock persediaan ayam fillet katsu',
            ],
            [
                'tanggal' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Jeruk lemon')->first()?->id_bahan ?? 3,
                'jumlah' => 10,
                'keterangan' => 'Restock lemon segar untuk minuman',
            ],
            [
                'tanggal' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Es batu')->first()?->id_bahan ?? 12,
                'jumlah' => 50,
                'keterangan' => 'Pengiriman es kristal higienis',
            ],
        ];

        foreach ($sampleBahanMasuk as $bm) {
            BahanMasuk::firstOrCreate([
                'tanggal' => $bm['tanggal'],
                'id_bahan' => $bm['id_bahan'],
                'keterangan' => $bm['keterangan'],
            ], $bm);
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
            [
                'tanggal' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'id_bahan' => $bahanList->where('nama_bahan', 'Timun')->first()?->id_bahan ?? 9,
                'jumlah' => 15,
                'digunakan_untuk' => 'Dapur Sushi Bar',
                'keterangan' => 'Pemakaian timun untuk menu sushi',
            ],
        ];

        foreach ($sampleBahanKeluar as $bk) {
            BahanKeluar::firstOrCreate([
                'tanggal' => $bk['tanggal'],
                'id_bahan' => $bk['id_bahan'],
                'keterangan' => $bk['keterangan'],
            ], $bk);
        }

        // 4. Simpan contoh stok akhir bulan tanpa mengubah catatan stok yang sudah ada
        foreach ($bahanList as $bahan) {
            $stokAwal = (float) StokAwalBulan::where('bulan', $bulanSekarang)
                ->where('id_bahan', $bahan->id_bahan)
                ->value('stok_awal');
            $totalMasuk = (float) BahanMasuk::where('id_bahan', $bahan->id_bahan)
                ->whereYear('tanggal', Carbon::now()->year)
                ->whereMonth('tanggal', Carbon::now()->month)
                ->sum('jumlah');
            $totalKeluar = (float) BahanKeluar::where('id_bahan', $bahan->id_bahan)
                ->whereYear('tanggal', Carbon::now()->year)
                ->whereMonth('tanggal', Carbon::now()->month)
                ->sum('jumlah');

            SisaBahanAkhirBulan::firstOrCreate([
                'bulan' => $bulanSekarang,
                'id_bahan' => $bahan->id_bahan,
            ], [
                'stok_awal' => $stokAwal,
                'total_masuk' => $totalMasuk,
                'total_keluar' => $totalKeluar,
                'sisa_akhir' => $stokAwal + $totalMasuk - $totalKeluar,
            ]);
        }

        // 5. Pesanan penjualan; setiap pesanan dapat memiliki beberapa produk.
        $sampleTransaksi = [
            [
                'tanggal' => Carbon::today(),
                'metode_pembayaran' => 'QRIS',
                'keterangan' => 'Pesanan meja 02',
                'items' => [
                    ['nama_produk' => 'Tofu Don', 'jumlah' => 2],
                    ['nama_produk' => 'Chicken Katsu Don', 'jumlah' => 1],
                    ['nama_produk' => 'Tsunetai Kocha (Es Teh)', 'jumlah' => 2],
                ],
            ],
            [
                'tanggal' => Carbon::today(),
                'metode_pembayaran' => 'Tunai',
                'keterangan' => 'Pesanan meja 05',
                'items' => [
                    ['nama_produk' => 'Gyudon', 'jumlah' => 1],
                    ['nama_produk' => 'Edamame', 'jumlah' => 1],
                ],
            ],
            [
                'tanggal' => Carbon::today()->subDay(),
                'metode_pembayaran' => 'Transfer',
                'keterangan' => 'Pesanan takeaway',
                'items' => [
                    ['nama_produk' => 'Beef Teriyaki Don', 'jumlah' => 2],
                    ['nama_produk' => 'Wadang Jahe', 'jumlah' => 2],
                ],
            ],
            [
                'tanggal' => Carbon::today()->subDays(2),
                'metode_pembayaran' => 'QRIS',
                'keterangan' => 'Pesanan makan malam',
                'items' => [
                    ['nama_produk' => 'Ebi Katsu Soyu Ramen', 'jumlah' => 1],
                    ['nama_produk' => 'Mineral Water (Air Mineral Kemasan)', 'jumlah' => 2],
                ],
            ],
        ];

        for ($monthsAgo = 1; $monthsAgo <= 5; $monthsAgo++) {
            $tanggalHistoris = Carbon::now()
                ->subMonthsNoOverflow($monthsAgo)
                ->startOfMonth()
                ->addDays(6);

            $sampleTransaksi[] = [
                'tanggal' => $tanggalHistoris,
                'metode_pembayaran' => $monthsAgo % 2 === 0 ? 'Tunai' : 'QRIS',
                'keterangan' => 'Pesanan contoh ' . $tanggalHistoris->format('Y-m'),
                'items' => [
                    ['nama_produk' => 'Chicken Katsu Don', 'jumlah' => 3],
                    ['nama_produk' => 'Tsunetai Ocha (Es Green Tea)', 'jumlah' => 2],
                ],
            ];
        }

        $tanggalSeed = [];
        foreach ($sampleTransaksi as $index => $transaksi) {
            $tanggal = $transaksi['tanggal']->format('Y-m-d');
            $kodeTransaksi = 'SEED' . $transaksi['tanggal']->format('Ymd') . str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);

            foreach ($transaksi['items'] as $item) {
                $produk = $produkList->firstWhere('nama_produk', $item['nama_produk']);

                if (!$produk) {
                    throw new \RuntimeException("Produk {$item['nama_produk']} belum tersedia. Jalankan ProdukSeeder terlebih dahulu.");
                }

                $hargaSatuan = (float) $produk->harga;
                Penjualan::updateOrCreate(
                    [
                        'kode_transaksi' => $kodeTransaksi,
                        'id_produk' => $produk->id_produk,
                        'id_cabang' => $idCabang,
                    ],
                    [
                        'tanggal' => $tanggal,
                        'jumlah_terjual' => $item['jumlah'],
                        'harga_satuan' => $hargaSatuan,
                        'total' => $item['jumlah'] * $hargaSatuan,
                        'metode_pembayaran' => $transaksi['metode_pembayaran'],
                        'keterangan' => $transaksi['keterangan'],
                    ]
                );
            }

            $tanggalSeed[] = $tanggal;
        }

        // 6. Sinkronisasi omset untuk tanggal contoh
        foreach (array_unique($tanggalSeed) as $tanggal) {
            Omset::syncForDate($tanggal);
        }
    }
}

<?php

namespace Tests\Feature;

use App\Models\Cabang;
use App\Models\Produk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KasirRiwayatTest extends TestCase
{
    use RefreshDatabase;

    public function test_kasir_transactions_are_saved_and_displayed_as_one_history_entry(): void
    {
        $cabang = Cabang::create([
            'nama_cabang' => 'Cabang Test',
            'anggota1' => 'Test',
        ]);
        $produkPertama = Produk::create([
            'nama_produk' => 'Menu Pertama',
            'kategori' => 'Makanan',
            'harga' => 12000,
            'stok' => 10,
        ]);
        $produkKedua = Produk::create([
            'nama_produk' => 'Menu Kedua',
            'kategori' => 'Minuman',
            'harga' => 10000,
            'stok' => 10,
        ]);
        $tanggal = now()->toDateString();
        $kodeTransaksi = 'TESTTX1234';

        foreach ([[$produkPertama, 2], [$produkKedua, 1]] as [$produk, $jumlah]) {
            $this->post(route('kasir.store'), [
                'tanggal' => $tanggal,
                'id_produk' => $produk->id_produk,
                'jumlah_terjual' => $jumlah,
                'metode_pembayaran' => 'QRIS',
                'kode_transaksi' => $kodeTransaksi,
                'id_cabang' => $cabang->id_cabang,
            ])->assertRedirect(route('kasir.index'));
        }

        $this->assertDatabaseCount('riwayat', 2);

        $this->get(route('riwayat.index', ['bulan' => now()->format('Y-m')]))
            ->assertOk()
            ->assertSee($kodeTransaksi)
            ->assertSee('Rp34.000');
    }

    public function test_kasir_menu_uses_products_from_the_database(): void
    {
        Produk::create([
            'nama_produk' => 'Produk Database',
            'kategori' => 'Makanan',
            'harga' => 12000,
            'stok' => 10,
        ]);

        $this->get(route('kasir.index'))
            ->assertOk()
            ->assertSee('Produk Database');
    }
}

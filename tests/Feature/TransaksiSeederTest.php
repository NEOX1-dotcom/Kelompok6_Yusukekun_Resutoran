<?php

namespace Tests\Feature;

use App\Models\Penjualan;
use Database\Seeders\BahanSeeder;
use Database\Seeders\CabangSeeder;
use Database\Seeders\ProdukSeeder;
use Database\Seeders\TransaksiSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransaksiSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_transaksi_seeder_creates_grouped_orders_and_is_idempotent(): void
    {
        $this->seed([
            CabangSeeder::class,
            BahanSeeder::class,
            ProdukSeeder::class,
            TransaksiSeeder::class,
        ]);

        $kodeTransaksiHariIni = 'SEED' . now()->format('Ymd') . '01';
        $this->assertSame(
            3,
            Penjualan::where('kode_transaksi', $kodeTransaksiHariIni)->count()
        );

        $jumlahTransaksiAwal = Penjualan::count();
        $this->seed(TransaksiSeeder::class);

        $this->assertSame($jumlahTransaksiAwal, Penjualan::count());
    }
}

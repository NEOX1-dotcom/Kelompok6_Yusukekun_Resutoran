<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Bahan;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\SisaBahanAkhirBulan;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_sales_stock_and_six_month_summary(): void
    {
        $admin = Admin::create([
            'nama_admin' => 'Admin Test',
            'username' => 'admin-test',
            'email' => 'admin-test@example.com',
            'password' => Hash::make('password'),
        ]);
        $produk = Produk::create([
            'nama_produk' => 'Menu Dummy',
            'kategori' => 'Makanan',
            'harga' => 50000,
            'stok' => 10,
        ]);
        $tanggalHariIni = Carbon::today();

        foreach ([
            [$tanggalHariIni, 100000, 'Demo transaksi pagi'],
            [$tanggalHariIni, 50000, 'Demo transaksi siang'],
            [$tanggalHariIni->copy()->subDay(), 100000, 'Demo transaksi kemarin'],
            [$tanggalHariIni->copy()->subMonthNoOverflow(), 50000, 'Demo transaksi bulan lalu'],
        ] as [$tanggal, $total, $keterangan]) {
            Penjualan::create([
                'tanggal' => $tanggal->toDateString(),
                'id_produk' => $produk->id_produk,
                'jumlah_terjual' => 1,
                'harga_satuan' => $total,
                'total' => $total,
                'metode_pembayaran' => 'Tunai',
                'keterangan' => $keterangan,
            ]);
        }

        $bahan = Bahan::create([
            'nama_bahan' => 'Bahan Dummy',
            'kategori' => 'Makanan',
            'satuan' => 'kg',
        ]);
        SisaBahanAkhirBulan::create([
            'bulan' => $tanggalHariIni->format('Y-m'),
            'id_bahan' => $bahan->id_bahan,
            'stok_awal' => 10,
            'total_masuk' => 0,
            'total_keluar' => 5,
            'sisa_akhir' => 5,
        ]);

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertOk()
            ->assertHeader('Pragma', 'no-cache')
            ->assertSee('Rp150.000')
            ->assertSee('Demo transaksi siang')
            ->assertSee('disabled aria-disabled="true"', false)
            ->assertSee('Bahan Masuk')
            ->assertDontSee('href="'.route('bahan-masuk.index').'"', false)
            ->assertViewHas('omsetHariIni', 150000.0)
            ->assertViewHas('totalPenjualan', 2)
            ->assertViewHas('sisaBahanMenipis', 1)
            ->assertViewHas('totalOmset6Bulan', 300000.0);

        $this->assertStringContainsString('no-store', $response->headers->get('Cache-Control'));
    }

    public function test_database_seeder_can_be_run_more_than_once(): void
    {
        $this->seed();
        $jumlahPenjualan = Penjualan::count();
        $jumlahBahan = Bahan::count();

        $this->seed();

        $this->assertGreaterThan(0, $jumlahPenjualan);
        $this->assertSame($jumlahPenjualan, Penjualan::count());
        $this->assertSame($jumlahBahan, Bahan::count());
    }
}

<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Bahan;
use App\Models\Cabang;
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

    public function test_dashboard_displays_branch_sales_and_stock(): void
    {
        $cabang = Cabang::create([
            'nama_cabang' => 'Cabang Test',
            'anggota1' => 'Test',
        ]);
        $cabangLain = Cabang::create([
            'nama_cabang' => 'Cabang Lain',
            'anggota1' => 'Test Lain',
        ]);
        $admin = Admin::create([
            'nama_admin' => 'Admin Test',
            'username' => 'admin-test',
            'email' => 'admin-test@example.com',
            'password' => Hash::make('password'),
            'id_cabang' => $cabang->id_cabang,
        ]);
        $produk = Produk::create([
            'nama_produk' => 'Menu Dummy',
            'kategori' => 'Makanan',
            'harga' => 50000,
            'stok' => 10,
        ]);
        $tanggalHariIni = Carbon::today();

        foreach ([
            [$tanggalHariIni, 100000, 'Demo transaksi pagi', 'DASH-TODAY-01', $cabang],
            [$tanggalHariIni, 50000, 'Demo transaksi siang', 'DASH-TODAY-01', $cabang],
            [$tanggalHariIni->copy()->subDay(), 100000, 'Demo transaksi kemarin', 'DASH-YESTERDAY-01', $cabang],
            [$tanggalHariIni->copy()->subMonthNoOverflow(), 50000, 'Demo transaksi bulan lalu', 'DASH-LASTMONTH-01', $cabang],
            [$tanggalHariIni, 250000, 'Penjualan cabang lain', 'DASH-OTHER-01', $cabangLain],
        ] as [$tanggal, $total, $keterangan, $kodeTransaksi, $cabangPenjualan]) {
            Penjualan::create([
                'tanggal' => $tanggal->toDateString(),
                'kode_transaksi' => $kodeTransaksi,
                'id_cabang' => $cabangPenjualan->id_cabang,
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

        $omsetPerBulan = array_fill(0, 12, 0);
        foreach ([
            [$tanggalHariIni, 150000.0],
            [$tanggalHariIni->copy()->subDay(), 100000.0],
            [$tanggalHariIni->copy()->subMonthNoOverflow(), 50000.0],
        ] as [$tanggal, $omset]) {
            if ($tanggal->year === $tanggalHariIni->year) {
                $omsetPerBulan[$tanggal->month - 1] += $omset;
            }
        }

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertOk()
            ->assertHeader('Pragma', 'no-cache')
            ->assertSee('Rp150.000')
            ->assertSee('DASH-TODAY-01')
            ->assertDontSee('DASH-OTHER-01')
            ->assertViewHas('omsetHariIni', 150000.0)
            ->assertViewHas('totalPenjualan', 1)
            ->assertViewHas('selisihPenjualan', 0)
            ->assertViewHas('sisaBahanMenipis', 1)
            ->assertViewHas('omsetPerBulan', $omsetPerBulan)
            ->assertViewHas('tahun', $tanggalHariIni->year)
            ->assertViewMissing('omset6Bulan')
            ->assertViewMissing('totalOmset6Bulan');

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

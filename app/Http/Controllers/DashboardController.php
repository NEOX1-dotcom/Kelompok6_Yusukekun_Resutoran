<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\SisaBahanAkhirBulan;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = Carbon::today();
        $yesterday = $today->copy()->subDay();
        $thisMonthStart = $today->copy()->startOfMonth();
        $lastMonthStart = $thisMonthStart->copy()->subMonthNoOverflow();
        $lastMonthEnd = $thisMonthStart->copy()->subDay();

        $omsetHariIni = (float) Penjualan::whereDate('tanggal', $today)->sum('total');
        $omsetKemarin = (float) Penjualan::whereDate('tanggal', $yesterday)->sum('total');
        $totalPenjualan = (int) Penjualan::whereDate('tanggal', $today)->count();
        $penjualanKemarin = (int) Penjualan::whereDate('tanggal', $yesterday)->count();
        $omsetBulanIni = (float) Penjualan::whereBetween('tanggal', [
            $thisMonthStart->toDateString(),
            $today->copy()->endOfMonth()->toDateString(),
        ])->sum('total');
        $omsetBulanLalu = (float) Penjualan::whereBetween('tanggal', [
            $lastMonthStart->toDateString(),
            $lastMonthEnd->toDateString(),
        ])->sum('total');

        $persentasePerubahan = static function (float $current, float $previous): float {
            if ($previous <= 0) {
                return $current > 0 ? 100 : 0;
            }

            return round((($current - $previous) / $previous) * 100, 1);
        };

        $omset6Bulan = collect();
        $bulanPertama = $today->copy()->startOfMonth()->subMonthsNoOverflow(5);

        for ($offset = 0; $offset < 6; $offset++) {
            $bulan = $bulanPertama->copy()->addMonthsNoOverflow($offset);
            $omset6Bulan->push((object) [
                'periode' => $bulan->format('m/Y'),
                'total' => (float) Penjualan::whereBetween('tanggal', [
                    $bulan->copy()->startOfMonth()->toDateString(),
                    $bulan->copy()->endOfMonth()->toDateString(),
                ])->sum('total'),
            ]);
        }

        $totalOmset6Bulan = (float) $omset6Bulan->sum('total');
        $transaksiTerbaru = Penjualan::with('produk')
            ->orderByDesc('tanggal')
            ->orderByDesc('id_penjualan')
            ->limit(5)
            ->get();

        $sisaBahanMenipis = SisaBahanAkhirBulan::where('bulan', $today->format('Y-m'))
            ->where('sisa_akhir', '<=', 10)
            ->count();

        return view('dashboard', [
            'omsetHariIni' => $omsetHariIni,
            'persenOmsetHarian' => $persentasePerubahan($omsetHariIni, $omsetKemarin),
            'totalPenjualan' => $totalPenjualan,
            'selisihPenjualan' => $totalPenjualan - $penjualanKemarin,
            'sisaBahanMenipis' => $sisaBahanMenipis,
            'omsetBulanIni' => $omsetBulanIni,
            'persenOmsetBulanan' => $persentasePerubahan($omsetBulanIni, $omsetBulanLalu),
            'transaksiTerbaru' => $transaksiTerbaru,
            'omset6Bulan' => $omset6Bulan,
            'totalOmset6Bulan' => $totalOmset6Bulan,
        ]);
    }
}

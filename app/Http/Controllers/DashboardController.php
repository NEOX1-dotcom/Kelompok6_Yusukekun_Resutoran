<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\SisaBahanAkhirBulan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $today = Carbon::today();
        $yesterday = $today->copy()->subDay();
        $thisMonthStart = $today->copy()->startOfMonth();
        $lastMonthStart = $thisMonthStart->copy()->subMonthNoOverflow();
        $lastMonthEnd = $thisMonthStart->copy()->subDay();
        $idCabang = Auth::user()->id_cabang;
        $penjualanCabang = Penjualan::where('id_cabang', $idCabang);
        $daftarTahun = range($today->year, $today->year - 4);
        $tahun = (int) ($request->validate([
            'tahun' => ['nullable', 'integer', Rule::in($daftarTahun)],
        ])['tahun'] ?? $today->year);

        $omsetHariIni = (float) (clone $penjualanCabang)->whereDate('tanggal', $today)->sum('total');
        $omsetKemarin = (float) (clone $penjualanCabang)->whereDate('tanggal', $yesterday)->sum('total');
        $hitungTransaksi = static function (Carbon $tanggal) use ($penjualanCabang): int {
            return (int) (clone $penjualanCabang)
                ->whereDate('tanggal', $tanggal)
                ->distinct()
                ->count(DB::raw('COALESCE(kode_transaksi, CAST(id_riwayat AS CHAR))'));
        };
        $totalPenjualan = $hitungTransaksi($today);
        $penjualanKemarin = $hitungTransaksi($yesterday);
        $omsetBulanIni = (float) (clone $penjualanCabang)->whereBetween('tanggal', [
            $thisMonthStart->toDateString(),
            $today->copy()->endOfMonth()->toDateString(),
        ])->sum('total');
        $omsetBulanLalu = (float) (clone $penjualanCabang)->whereBetween('tanggal', [
            $lastMonthStart->toDateString(),
            $lastMonthEnd->toDateString(),
        ])->sum('total');
        $omsetPerBulan = array_fill(0, 12, 0);

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $awalBulan = Carbon::create($tahun, $bulan, 1)->startOfMonth();
            $omsetPerBulan[$bulan - 1] = (float) Penjualan::where('id_cabang', $idCabang)
                ->whereBetween('tanggal', [
                    $awalBulan->toDateString(),
                    $awalBulan->copy()->endOfMonth()->toDateString(),
                ])
                ->sum('total');
        }

        $persentasePerubahan = static function (float $current, float $previous): float {
            if ($previous <= 0) {
                return $current > 0 ? 100 : 0;
            }

            return round((($current - $previous) / $previous) * 100, 1);
        };

        $kodeTransaksi = 'COALESCE(riwayat.kode_transaksi, CAST(riwayat.id_riwayat AS CHAR))';
        $transaksiTerbaru = DB::table('riwayat')
            ->join('cabang', 'riwayat.id_cabang', '=', 'cabang.id_cabang')
            ->where('riwayat.id_cabang', $idCabang)
            ->selectRaw("$kodeTransaksi as kode_transaksi, cabang.nama_cabang as nama_cabang")
            ->selectRaw('MAX(riwayat.created_at) as waktu, SUM(riwayat.total) as total')
            ->groupByRaw("$kodeTransaksi, riwayat.id_cabang, cabang.nama_cabang")
            ->orderByDesc('waktu')
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
            'omsetPerBulan' => $omsetPerBulan,
            'tahun' => $tahun,
            'daftarTahun' => $daftarTahun,
        ]);
    }
}

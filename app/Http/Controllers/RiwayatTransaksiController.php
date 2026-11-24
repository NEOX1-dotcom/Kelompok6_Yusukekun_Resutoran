<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiwayatTransaksiController extends Controller
{
    public function index(Request $request): View
    {
        $daftarCabang = Cabang::orderBy('id_cabang')->get();
        $bulanDipilih = $request->validate([
            'bulan' => ['nullable', 'date_format:Y-m'],
        ])['bulan'] ?? now()->format('Y-m');

        $pengguna = $request->user();
        $cabangAktif = $request->input('cabang');
        if (!$cabangAktif && $pengguna) {
            $cabangAktif = $pengguna->id_cabang;
        }
        if (!$cabangAktif) {
            $cabangAktif = $daftarCabang->first()->id_cabang ?? null;
        }

        $kodeTransaksi = 'COALESCE(kode_transaksi, CAST(id_riwayat AS CHAR))';
        $riwayatQuery = DB::table('riwayat')
            ->selectRaw("$kodeTransaksi as kode_transaksi, metode_pembayaran")
            ->selectRaw('MIN(tanggal) as tanggal, MAX(created_at) as waktu, SUM(total) as total')
            ->whereYear('tanggal', substr($bulanDipilih, 0, 4))
            ->whereMonth('tanggal', substr($bulanDipilih, 5, 2));

        if ($cabangAktif) {
            $riwayatQuery->where('id_cabang', $cabangAktif);
        } else {
            $riwayatQuery->whereRaw('1 = 0');
        }

        $riwayat = $riwayatQuery
            ->groupByRaw("$kodeTransaksi, metode_pembayaran")
            ->orderByDesc('waktu')
            ->paginate(15)
            ->withQueryString();

        return view('riwayat_transaksi.index', compact(
            'daftarCabang',
            'bulanDipilih',
            'cabangAktif',
            'riwayat'
        ));
    }
}

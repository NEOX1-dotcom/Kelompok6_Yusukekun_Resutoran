<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\SisaBahanAkhirBulan;
use App\Models\StokAwalBulan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StokAwalBulanController extends Controller
{
    public function index(Request $request): View
    {
        $bulan = $request->validate(['bulan' => ['nullable', 'date_format:Y-m']])['bulan'] ?? now()->format('Y-m');
        $stokAwal = StokAwalBulan::with('bahan')->where('bulan', $bulan)->orderBy('id_bahan')->paginate(10)->withQueryString();
        $bahan = Bahan::orderBy('nama_bahan')->get();

        return view('stok_awal.index', compact('stokAwal', 'bulan', 'bahan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'bulan' => ['required', 'date_format:Y-m'],
            'id_bahan' => ['required', 'integer', 'exists:bahan,id_bahan'],
            'stok_awal' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($validated) {
            StokAwalBulan::updateOrCreate(
                ['bulan' => $validated['bulan'], 'id_bahan' => $validated['id_bahan']],
                ['stok_awal' => $validated['stok_awal']]
            );
            SisaBahanAkhirBulan::syncForMonthAndBahan($validated['bulan'], (int) $validated['id_bahan']);
        });

        return back()->with('success', 'Stok awal bulan berhasil disimpan.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $stokAwal = StokAwalBulan::findOrFail($id);
        $bulan = $stokAwal->bulan;
        $idBahan = (int) $stokAwal->id_bahan;

        DB::transaction(function () use ($stokAwal, $bulan, $idBahan) {
            $stokAwal->delete();
            SisaBahanAkhirBulan::syncForMonthAndBahan($bulan, $idBahan);
        });

        return back()->with('success', 'Stok awal bulan berhasil dihapus.');
    }
}

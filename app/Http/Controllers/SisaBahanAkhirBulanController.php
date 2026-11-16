<?php

namespace App\Http\Controllers;

use App\Models\SisaBahanAkhirBulan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SisaBahanAkhirBulanController extends Controller
{
    /**
     * Menampilkan ringkasan sisa bahan akhir bulan.
     */
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'bulan' => ['nullable', 'date_format:Y-m'],
        ]);

        $bulan = $validated['bulan'] ?? now()->format('Y-m');
        $sisaBahan = SisaBahanAkhirBulan::with('bahan')
            ->where('bulan', $bulan)
            ->orderBy('id_bahan')
            ->paginate(10)
            ->withQueryString();

        return view('sisa_bahan.index', compact('sisaBahan', 'bulan'));
    }

    /**
     * Menampilkan rincian sisa bahan akhir bulan.
     */
    public function show(string $id): View
    {
        $sisaBahan = SisaBahanAkhirBulan::with('bahan')->findOrFail($id);

        return view('sisa_bahan.show', compact('sisaBahan'));
    }

    /**
     * Menghitung ulang sisa bahan untuk bulan yang dipilih.
     */
    public function sync(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'bulan' => ['required', 'date_format:Y-m'],
        ]);

        SisaBahanAkhirBulan::syncForMonth($validated['bulan']);

        return redirect()->route('sisa-bahan.index', ['bulan' => $validated['bulan']])
            ->with('success', 'Sisa bahan akhir bulan berhasil diperbarui.');
    }
}

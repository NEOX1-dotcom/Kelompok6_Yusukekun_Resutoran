<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\BahanKeluar;
use App\Models\SisaBahanAkhirBulan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BahanKeluarController extends Controller
{
    /**
     * Menampilkan daftar transaksi bahan keluar.
     */
    public function index(Request $request): View
    {
        $query = BahanKeluar::with('bahan')->latest('tanggal');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('keterangan', 'like', "%{$search}%")
                    ->orWhere('digunakan_untuk', 'like', "%{$search}%")
                    ->orWhereHas('bahan', function ($bahanQuery) use ($search) {
                        $bahanQuery->where('nama_bahan', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->input('tanggal'));
        }

        $totalTransaksi = (clone $query)->count();
        $totalJumlah = (clone $query)->sum('jumlah');
        $bahanKeluar = $query->paginate(10)->withQueryString();

        return view('bahan_keluar.index', compact(
            'bahanKeluar',
            'totalTransaksi',
            'totalJumlah'
        ));
    }

    /**
     * Menampilkan form transaksi bahan keluar.
     */
    public function create(): View
    {
        $bahan = Bahan::orderBy('nama_bahan')->get();

        return view('bahan_keluar.create', compact('bahan'));
    }

    /**
     * Menyimpan transaksi bahan keluar.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'id_bahan' => ['required', 'integer', 'exists:bahan,id_bahan'],
            'jumlah' => ['required', 'numeric', 'min:0.01'],
            'digunakan_untuk' => ['nullable', 'string', 'max:100'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ], [
            'tanggal.required' => 'Tanggal transaksi wajib diisi.',
            'id_bahan.required' => 'Pilihan bahan baku wajib dipilih.',
            'id_bahan.exists' => 'Bahan baku yang dipilih tidak ditemukan.',
            'jumlah.required' => 'Jumlah kuantitas keluar wajib diisi.',
            'jumlah.min' => 'Jumlah minimal 0.01.',
        ]);

        DB::transaction(function () use ($validated) {
            BahanKeluar::create($validated);

            SisaBahanAkhirBulan::syncForMonthAndBahan(
                date('Y-m', strtotime($validated['tanggal'])),
                (int) $validated['id_bahan']
            );
        });

        return redirect()->route('bahan-keluar.index')
            ->with('success', 'Transaksi bahan keluar berhasil dicatat.');
    }

    /**
     * Menampilkan rincian transaksi bahan keluar.
     */
    public function show(string $id): View
    {
        $bahanKeluar = BahanKeluar::with('bahan')->findOrFail($id);

        return view('bahan_keluar.show', compact('bahanKeluar'));
    }

    /**
     * Menampilkan form edit transaksi bahan keluar.
     */
    public function edit(string $id): View
    {
        $bahanKeluar = BahanKeluar::findOrFail($id);
        $bahan = Bahan::orderBy('nama_bahan')->get();

        return view('bahan_keluar.edit', compact('bahanKeluar', 'bahan'));
    }

    /**
     * Memperbarui transaksi bahan keluar.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $bahanKeluar = BahanKeluar::findOrFail($id);
        $oldMonth = $bahanKeluar->tanggal->format('Y-m');
        $oldBahanId = (int) $bahanKeluar->id_bahan;

        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'id_bahan' => ['required', 'integer', 'exists:bahan,id_bahan'],
            'jumlah' => ['required', 'numeric', 'min:0.01'],
            'digunakan_untuk' => ['nullable', 'string', 'max:100'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ], [
            'tanggal.required' => 'Tanggal transaksi wajib diisi.',
            'id_bahan.required' => 'Pilihan bahan baku wajib dipilih.',
            'id_bahan.exists' => 'Bahan baku yang dipilih tidak ditemukan.',
            'jumlah.required' => 'Jumlah kuantitas keluar wajib diisi.',
            'jumlah.min' => 'Jumlah minimal 0.01.',
        ]);

        DB::transaction(function () use ($bahanKeluar, $validated, $oldMonth, $oldBahanId) {
            $bahanKeluar->update($validated);

            SisaBahanAkhirBulan::syncForMonthAndBahan($oldMonth, $oldBahanId);
            SisaBahanAkhirBulan::syncForMonthAndBahan(
                date('Y-m', strtotime($validated['tanggal'])),
                (int) $validated['id_bahan']
            );
        });

        return redirect()->route('bahan-keluar.index')
            ->with('success', 'Transaksi bahan keluar berhasil diperbarui.');
    }

    /**
     * Menghapus transaksi bahan keluar.
     */
    public function destroy(string $id): RedirectResponse
    {
        $bahanKeluar = BahanKeluar::findOrFail($id);
        $bulan = $bahanKeluar->tanggal->format('Y-m');
        $idBahan = (int) $bahanKeluar->id_bahan;

        DB::transaction(function () use ($bahanKeluar, $bulan, $idBahan) {
            $bahanKeluar->delete();
            SisaBahanAkhirBulan::syncForMonthAndBahan($bulan, $idBahan);
        });

        return redirect()->route('bahan-keluar.index')
            ->with('success', 'Transaksi bahan keluar berhasil dihapus.');
    }
}

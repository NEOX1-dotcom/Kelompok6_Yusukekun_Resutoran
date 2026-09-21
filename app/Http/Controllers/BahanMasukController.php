<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\BahanMasuk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class BahanMasukController extends Controller
{
    /**
     * Menampilkan daftar data transaksi bahan masuk.
     */
    public function index(Request $request): View
    {
        $query = BahanMasuk::with(['bahan'])->latest('tanggal');

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('keterangan', 'like', "%{$search}%")
                  ->orWhereHas('bahan', function ($qb) use ($search) {
                      $qb->where('nama_bahan', 'like', "%{$search}%");
                  });
            });
        }

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Statistik ringkasan
        $totalTransaksi = (clone $query)->count();
        $totalJumlah = (clone $query)->sum('jumlah');
        $bahanMasuk = $query->paginate(10)->withQueryString();

        return view('bahan_masuk.index', compact(
            'bahanMasuk',
            'totalTransaksi',
            'totalJumlah'
        ));
    }

    /**
     * Menampilkan form untuk menambah bahan masuk.
     */
    public function create(): View
    {
        $bahan = Schema::hasTable('bahan') ? Bahan::orderBy('nama_bahan')->get() : collect();

        return view('bahan_masuk.create', compact('bahan'));
    }

    /**
     * Menyimpan transaksi bahan masuk baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'id_bahan' => 'required|integer',
            'jumlah' => 'required|numeric|min:0.01',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'tanggal.required' => 'Tanggal transaksi wajib diisi.',
            'id_bahan.required' => 'Pilihan bahan baku wajib dipilih.',
            'jumlah.required' => 'Jumlah kuantitas masuk wajib diisi.',
            'jumlah.min' => 'Jumlah minimal 0.01.',
        ]);

        BahanMasuk::create($validated);

        return redirect()->route('bahan-masuk.index')->with('success', 'Transaksi bahan masuk berhasil dicatat.');
    }

    /**
     * Menampilkan rincian transaksi bahan masuk.
     */
    public function show(string $id): View
    {
        $bahanMasuk = BahanMasuk::with(['bahan'])->findOrFail($id);

        return view('bahan_masuk.show', compact('bahanMasuk'));
    }

    /**
     * Menampilkan form edit transaksi bahan masuk.
     */
    public function edit(string $id): View
    {
        $bahanMasuk = BahanMasuk::findOrFail($id);
        $bahan = Schema::hasTable('bahan') ? Bahan::orderBy('nama_bahan')->get() : collect();

        return view('bahan_masuk.edit', compact('bahanMasuk', 'bahan'));
    }

    /**
     * Memperbarui transaksi bahan masuk.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $bahanMasuk = BahanMasuk::findOrFail($id);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'id_bahan' => 'required|integer',
            'jumlah' => 'required|numeric|min:0.01',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'tanggal.required' => 'Tanggal transaksi wajib diisi.',
            'id_bahan.required' => 'Pilihan bahan baku wajib dipilih.',
            'jumlah.required' => 'Jumlah kuantitas masuk wajib diisi.',
            'jumlah.min' => 'Jumlah minimal 0.01.',
        ]);

        $bahanMasuk->update($validated);

        return redirect()->route('bahan-masuk.index')->with('success', 'Transaksi bahan masuk berhasil diperbarui.');
    }

    /**
     * Menghapus transaksi bahan masuk.
     */
    public function destroy(string $id): RedirectResponse
    {
        $bahanMasuk = BahanMasuk::findOrFail($id);
        $bahanMasuk->delete();

        return redirect()->route('bahan-masuk.index')->with('success', 'Transaksi bahan masuk berhasil dihapus.');
    }
}
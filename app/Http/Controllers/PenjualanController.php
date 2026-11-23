<?php

namespace App\Http\Controllers;

use App\Models\Omset;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PenjualanController extends Controller
{
    public function index(Request $request): View
    {
        $query = Penjualan::with('produk')->latest('tanggal');
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $penjualan = $query->paginate(10)->withQueryString();
        $produk = Produk::orderBy('nama_produk')->get();

        return view('penjualan.index', compact('penjualan', 'produk'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'id_produk' => ['required', 'integer', 'exists:produk,id_produk'],
            'jumlah_terjual' => ['required', 'numeric', 'min:0.01'],
            'metode_pembayaran' => ['required', 'in:Tunai,QRIS,Transfer,Kartu Debit/Kredit,Lainnya'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);
        DB::transaction(function () use ($validated) {
            $produk = Produk::findOrFail($validated['id_produk']);
            $hargaSatuan = (float) $produk->harga;
            $penjualan = Penjualan::create([
                ...$validated,
                'harga_satuan' => $hargaSatuan,
                'total' => $hargaSatuan * (float) $validated['jumlah_terjual'],
            ]);

            Omset::syncForDate($penjualan->tanggal->format('Y-m-d'));
        });

        return back()->with('success', 'Penjualan berhasil dicatat.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $penjualan = Penjualan::findOrFail($id);
        $tanggal = $penjualan->tanggal->format('Y-m-d');

        DB::transaction(function () use ($penjualan, $tanggal) {
            $penjualan->delete();
            Omset::syncForDate($tanggal);
        });

        return back()->with('success', 'Penjualan berhasil dihapus.');
    }
}

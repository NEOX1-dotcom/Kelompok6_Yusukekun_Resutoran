<?php

namespace App\Http\Controllers;

use App\Models\Omset;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function index(): JsonResponse
    {
        $produk = Produk::orderBy('nama_produk')
            ->get(['id_produk', 'nama_produk', 'kategori', 'harga', 'stok']);

        return response()->json(['data' => $produk]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'id_produk' => ['required', 'integer', 'exists:produk,id_produk'],
            'jumlah_terjual' => ['required', 'numeric', 'min:0.01'],
            'metode_pembayaran' => ['required', 'in:Tunai,QRIS,Transfer,Kartu Debit/Kredit,Lainnya'],
            'keterangan' => ['nullable', 'string', 'max:255'],'kode_transaksi' => ['nullable', 'string', 'max:20'],
            'id_cabang' => ['nullable', 'integer', 'exists:cabang,id_cabang'],
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

        return redirect()->route('kasir.index')->with('success', 'Transaksi berhasil disimpan.');
    }
}

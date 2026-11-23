<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiwayatController extends Controller
{
    public function index(Request $request): View
    {
        $query = Penjualan::with('produk');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('keterangan', 'like', "%{$search}%")
                    ->orWhere('metode_pembayaran', 'like', "%{$search}%")
                    ->orWhereHas('produk', function ($productQuery) use ($search) {
                        $productQuery->where('nama_produk', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('metode_pembayaran')) {
            $query->where('metode_pembayaran', $request->metode_pembayaran);
        }

        $totalTransaksi = (clone $query)->count();
        $totalPenjualan = (clone $query)->sum('total');
        $transaksi = $query
            ->orderByDesc('tanggal')
            ->orderByDesc('id_riwayat')
            ->paginate(15)
            ->withQueryString();

        $metodePembayaran = [
            'Tunai',
            'QRIS',
            'Transfer',
            'Kartu Debit/Kredit',
            'Lainnya',
        ];

        return view('riwayat.index', compact(
            'transaksi',
            'totalTransaksi',
            'totalPenjualan',
            'metodePembayaran'
        ));
    }
}

@extends('layouts.app')

@section('title', 'Detail Transaksi Bahan Masuk #' . $bahanMasuk->id_masuk)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header & Breadcrumb -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                <a href="{{ route('bahan-masuk.index') }}" class="hover:text-orange-600 transition">Bahan Masuk</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">Detail Transaksi #{{ $bahanMasuk->id_masuk }}</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Detail Bahan Masuk</h1>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 shadow-sm transition">
                <i class="fa-solid fa-print text-xs"></i> Cetak
            </button>
            <a href="{{ route('bahan-masuk.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 shadow-sm transition">
                <i class="fa-solid fa-arrow-left text-xs"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <!-- Top Status Banner -->
        <div class="bg-gradient-to-r from-orange-500 to-amber-500 p-6 text-white flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="text-xs uppercase tracking-wider font-semibold opacity-80">ID Transaksi Masuk</span>
                <h2 class="text-2xl font-extrabold tracking-tight">#BM-{{ str_pad($bahanMasuk->id_masuk, 5, '0', STR_PAD_LEFT) }}</h2>
            </div>
            <div class="sm:text-right">
                <span class="text-xs uppercase tracking-wider font-semibold opacity-80">Tanggal Masuk</span>
                <p class="text-lg font-bold">{{ \Carbon\Carbon::parse($bahanMasuk->tanggal)->translatedFormat('d F Y') }}</p>
            </div>
        </div>

        <!-- Info Grid -->
        <div class="p-6 sm:p-8 space-y-6">
            <div>
                <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Bahan Baku</span>
                    <span class="text-lg font-bold text-gray-900 block mt-1">
                        {{ $bahanMasuk->bahan->nama_bahan ?? 'Bahan #' . $bahanMasuk->id_bahan }}
                    </span>
                    <span class="text-xs text-gray-500">
                        Kategori: {{ $bahanMasuk->bahan->kategori ?? '-' }} &bull; Satuan: {{ $bahanMasuk->bahan->satuan ?? '-' }}
                    </span>
                </div>
            </div>

            <!-- Financial Table Summary -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600 font-semibold border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left">Rincian</th>
                            <th class="px-4 py-3 text-right">Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        <tr>
                            <td class="px-4 py-3 font-medium">Jumlah Masuk</td>
                            <td class="px-4 py-3 text-right font-semibold text-gray-900">
                                {{ number_format($bahanMasuk->jumlah, 2, ',', '.') }} {{ $bahanMasuk->bahan->satuan ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Keterangan -->
            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Catatan / Keterangan</span>
                <p class="text-sm text-gray-700 mt-1">
                    {{ $bahanMasuk->keterangan ?: 'Tidak ada keterangan tambahan.' }}
                </p>
            </div>

            <!-- Timestamps -->
            <div class="flex items-center justify-between text-xs text-gray-400 pt-2 border-t border-gray-100">
                <span>Dibuat: {{ $bahanMasuk->created_at ? $bahanMasuk->created_at->format('d-m-Y H:i') : '-' }}</span>
                <span>Terakhir diperbarui: {{ $bahanMasuk->updated_at ? $bahanMasuk->updated_at->format('d-m-Y H:i') : '-' }}</span>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('bahan-masuk.edit', $bahanMasuk->id_masuk) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold rounded-xl transition">
                    <i class="fa-solid fa-pen-to-square text-xs"></i> Edit Data
                </a>
                <form action="{{ route('bahan-masuk.destroy', $bahanMasuk->id_masuk) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl transition">
                        <i class="fa-regular fa-trash-can text-xs"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

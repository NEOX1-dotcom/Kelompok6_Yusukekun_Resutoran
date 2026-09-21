@extends('layouts.app')

@section('title', 'Daftar Bahan Masuk')

@section('content')
<div class="space-y-6">

    <!-- Page Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
                <span class="p-2 rounded-lg bg-orange-100 text-orange-600">
                    <i class="fa-solid fa-boxes-packing text-xl"></i>
                </span>
                Transaksi Bahan Masuk
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Catatan riwayat penerimaan bahan baku ke gudang.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('bahan-masuk.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-orange-600 hover:bg-orange-700 text-white text-sm font-semibold rounded-xl shadow-sm transition gap-2">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Bahan Masuk</span>
            </a>
        </div>
    </div>

    <!-- Summary Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Transaksi</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalTransaksi ?? $bahanMasuk->total() ?? 0) }}</h3>
                <span class="text-xs text-gray-500">Pencatatan masuk</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-receipt"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Kuantitas</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalJumlah ?? 0, 2, ',', '.') }}</h3>
                <span class="text-xs text-gray-500">Unit bahan diterima</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-scale-balanced"></i>
            </div>
        </div>

    </div>

    <!-- Filter & Search Toolbar -->
    <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
        <form method="GET" action="{{ route('bahan-masuk.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-3">
            <div class="md:col-span-2 relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari keterangan atau bahan..." class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
            </div>

            <div>
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none text-gray-600">
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-xl transition gap-1.5">
                    <i class="fa-solid fa-filter text-xs"></i> Filter
                </button>
                @if(request()->hasAny(['search', 'tanggal']))
                    <a href="{{ route('bahan-masuk.index') }}" class="inline-flex items-center justify-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-medium rounded-xl transition" title="Reset Filter">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Data Table Card -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs uppercase bg-gray-50 text-gray-700 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-5 py-3.5 text-center w-12">No</th>
                        <th scope="col" class="px-5 py-3.5">Tanggal</th>
                        <th scope="col" class="px-5 py-3.5">Bahan Baku</th>
                        <th scope="col" class="px-5 py-3.5 text-right">Jumlah</th>
                        <th scope="col" class="px-5 py-3.5">Keterangan</th>
                        <th scope="col" class="px-5 py-3.5 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($bahanMasuk as $item)
                        <tr class="hover:bg-orange-50/40 transition">
                            <td class="px-5 py-4 text-center font-medium text-gray-500">
                                {{ $loop->iteration + ($bahanMasuk instanceof \Illuminate\Pagination\LengthAwarePaginator ? $bahanMasuk->firstItem() - 1 : 0) }}
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                </div>
                                <span class="text-xs text-gray-400">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('l') }}
                                </span>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="font-semibold text-gray-900">
                                    {{ $item->bahan->nama_bahan ?? 'Bahan #' . $item->id_bahan }}
                                </div>
                                @if(isset($item->bahan->satuan))
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700">
                                        Satuan: {{ $item->bahan->satuan }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap font-medium text-gray-900">
                                {{ number_format($item->jumlah, 2, ',', '.') }}
                                <span class="text-xs text-gray-500">{{ $item->bahan->satuan ?? '' }}</span>
                            </td>
                            <td class="px-5 py-4 text-gray-600 max-w-xs truncate" title="{{ $item->keterangan }}">
                                {{ $item->keterangan ?: '-' }}
                            </td>
                            <td class="px-5 py-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1.5">
                                    <!-- Detail -->
                                    <a href="{{ route('bahan-masuk.show', $item->id_masuk) }}" class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 flex items-center justify-center transition" title="Lihat Detail">
                                        <i class="fa-regular fa-eye text-xs"></i>
                                    </a>
                                    <!-- Edit -->
                                    <a href="{{ route('bahan-masuk.edit', $item->id_masuk) }}" class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 flex items-center justify-center transition" title="Edit Transaksi">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>
                                    <!-- Hapus -->
                                    <form action="{{ route('bahan-masuk.destroy', $item->id_masuk) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data transaksi bahan masuk ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 flex items-center justify-center transition" title="Hapus Data">
                                            <i class="fa-regular fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 text-2xl">
                                        <i class="fa-regular fa-folder-open"></i>
                                    </div>
                                    <p class="font-medium text-gray-500">Belum ada transaksi bahan masuk</p>
                                    <a href="{{ route('bahan-masuk.create') }}" class="inline-flex items-center gap-2 text-sm text-orange-600 hover:text-orange-700 font-semibold">
                                        <i class="fa-solid fa-plus"></i> Catat transaksi pertama sekarang
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($bahanMasuk instanceof \Illuminate\Pagination\LengthAwarePaginator && $bahanMasuk->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $bahanMasuk->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

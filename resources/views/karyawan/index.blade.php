@extends('layouts.app')

@section('title', 'Karyawan Bertugas')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Karyawan yang Bertugas</h1>
        <p class="mt-1 text-sm text-gray-500">Daftar karyawan berdasarkan tanggal dan cabang.</p>
    </div>

    <form method="GET" action="{{ route('karyawan.index') }}" class="mb-6 rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
        <div class="grid grid-cols-1 items-end gap-4 sm:grid-cols-3">
            <div>
                <label for="tanggal" class="mb-1 block text-sm font-medium text-gray-700">Tanggal</label>
                <input
                    type="date"
                    id="tanggal"
                    name="tanggal"
                    value="{{ $tanggal }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100"
                >
            </div>
            <div>
                <label for="cabang" class="mb-1 block text-sm font-medium text-gray-700">Cabang</label>
                <select
                    id="cabang"
                    name="cabang"
                    class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100"
                >
                    <option value="">Semua cabang</option>
                    @foreach ($daftarCabang as $itemCabang)
                        <option value="{{ $itemCabang->id_cabang }}" @selected((string) $cabangDipilih === (string) $itemCabang->id_cabang)>
                            {{ $itemCabang->nama_cabang }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="rounded-lg bg-orange-600 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-700">
                    <i class="fa-solid fa-filter mr-1"></i> Filter
                </button>
                <a href="{{ route('karyawan.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No.</th>
                        <th scope="col" class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Nama Karyawan</th>
                        <th scope="col" class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Cabang</th>
                        <th scope="col" class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($karyawan as $index => $item)
                        <tr>
                            <td class="whitespace-nowrap px-5 py-3 text-sm text-gray-500">{{ $karyawan->firstItem() + $index }}</td>
                            <td class="whitespace-nowrap px-5 py-3 text-sm font-medium text-gray-900">{{ $item->nama_karyawan }}</td>
                            <td class="whitespace-nowrap px-5 py-3 text-sm text-gray-600">{{ $item->cabang->nama_cabang }}</td>
                            <td class="whitespace-nowrap px-5 py-3 text-sm text-gray-600">{{ $item->tanggal->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-10 text-center text-sm text-gray-500">
                                Belum ada data karyawan untuk filter yang dipilih.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($karyawan->hasPages())
            <div class="border-t border-gray-200 px-5 py-4">
                {{ $karyawan->links() }}
            </div>
        @endif
    </div>
@endsection

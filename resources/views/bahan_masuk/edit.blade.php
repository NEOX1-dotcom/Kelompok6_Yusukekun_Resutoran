@extends('layouts.app')

@section('title', 'Edit Transaksi Bahan Masuk #' . $bahanMasuk->id_masuk)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header & Breadcrumb -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                <a href="{{ route('bahan-masuk.index') }}" class="hover:text-orange-600 transition">Bahan Masuk</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">Edit Transaksi #{{ $bahanMasuk->id_masuk }}</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Edit Transaksi Bahan Masuk</h1>
        </div>
        <a href="{{ route('bahan-masuk.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 shadow-sm transition">
            <i class="fa-solid fa-arrow-left text-xs"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8">
        <form action="{{ route('bahan-masuk.update', $bahanMasuk->id_masuk) }}" method="POST" class="space-y-6" id="formBahanMasukEdit">
            @csrf
            @method('PUT')

            <!-- Tanggal Transaksi -->
            <div>
                <label for="tanggal" class="block text-sm font-semibold text-gray-800 mb-1.5">
                    Tanggal Transaksi <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($bahanMasuk->tanggal)->format('Y-m-d')) }}" required class="w-full px-4 py-2.5 text-sm border @error('tanggal') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
                </div>
                @error('tanggal')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bahan Baku -->
            <div>
                <div>
                    <label for="id_bahan" class="block text-sm font-semibold text-gray-800 mb-1.5">
                        Bahan Baku <span class="text-red-500">*</span>
                    </label>
                    <select name="id_bahan" id="id_bahan" required class="w-full px-4 py-2.5 text-sm border @error('id_bahan') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none bg-white">
                        <option value="">-- Pilih Bahan Baku --</option>
                        @foreach($bahan as $b)
                            <option value="{{ $b->id_bahan }}" data-satuan="{{ $b->satuan }}" {{ old('id_bahan', $bahanMasuk->id_bahan) == $b->id_bahan ? 'selected' : '' }}>
                                {{ $b->nama_bahan }} ({{ $b->satuan }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_bahan')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Jumlah Kuantitas -->
            <div>
                <div>
                    <label for="jumlah" class="block text-sm font-semibold text-gray-800 mb-1.5">
                        Jumlah Masuk <span class="text-red-500">*</span>
                        <span id="labelSatuan" class="text-xs text-orange-600 font-normal"></span>
                    </label>
                    <div class="relative">
                        <input type="number" step="0.01" min="0.01" name="jumlah" id="jumlah" value="{{ old('jumlah', $bahanMasuk->jumlah) }}" placeholder="Contoh: 10 atau 2.5" required class="w-full px-4 py-2.5 text-sm border @error('jumlah') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
                    </div>
                    @error('jumlah')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Keterangan / Catatan -->
            <div>
                <label for="keterangan" class="block text-sm font-semibold text-gray-800 mb-1.5">
                    Keterangan / Catatan <span class="text-xs text-gray-400 font-normal">(Opsional)</span>
                </label>
                <textarea name="keterangan" id="keterangan" rows="3" placeholder="Contoh: No Nota #INV-8891, kualitas bahan bagus, dll." class="w-full px-4 py-2.5 text-sm border @error('keterangan') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">{{ old('keterangan', $bahanMasuk->keterangan) }}</textarea>
                @error('keterangan')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('bahan-masuk.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-orange-600 hover:bg-orange-700 text-white text-sm font-semibold rounded-xl shadow-md shadow-orange-200 transition">
                    <i class="fa-solid fa-arrows-rotate"></i> Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectBahan = document.getElementById('id_bahan');
        const labelSatuan = document.getElementById('labelSatuan');

        function updateSatuan() {
            const selectedOption = selectBahan.options[selectBahan.selectedIndex];
            const satuan = selectedOption ? selectedOption.getAttribute('data-satuan') : '';
            if (satuan) {
                labelSatuan.textContent = `(Satuan: ${satuan})`;
            } else {
                labelSatuan.textContent = '';
            }
        }

        selectBahan.addEventListener('change', updateSatuan);

        updateSatuan();
    });
</script>
@endpush

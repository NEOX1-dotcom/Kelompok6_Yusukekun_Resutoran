<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataBahanController extends Controller
{
    public function index(): View
    {
        $dataBahan = Bahan::orderBy('nama_bahan')->paginate(10);
        $semuaNamaBahan = Bahan::orderBy('nama_bahan')->pluck('nama_bahan');

        return view('data_bahan.index', compact('dataBahan', 'semuaNamaBahan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_bahan' => ['required', 'string', 'max:100', 'unique:bahan,nama_bahan'],
            'kategori' => ['nullable', 'string', 'max:50'],
        ]);

        Bahan::create($validated);

        return back()->with('success', 'Bahan baku berhasil ditambahkan.');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $bahan = Bahan::findOrFail($id);
        $validated = $request->validate([
            'nama_bahan' => ['required', 'string', 'max:100', 'unique:bahan,nama_bahan,' . $id . ',id_bahan'],
            'kategori' => ['nullable', 'string', 'max:50'],
        ]);

        $bahan->update($validated);

        return back()->with('success', 'Bahan baku berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Bahan::findOrFail($id)->delete();

        return back()->with('success', 'Bahan baku berhasil dihapus.');
    }
}

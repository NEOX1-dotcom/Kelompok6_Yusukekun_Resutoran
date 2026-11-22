<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BahanController extends Controller
{
    public function index(): View
    {
        $bahan = Bahan::orderBy('nama_bahan')->paginate(10);

        return view('bahan.index', compact('bahan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_bahan' => ['required', 'string', 'max:100', 'unique:bahan,nama_bahan'],
            'kategori' => ['nullable', 'string', 'max:50'],
            'satuan' => ['required', 'string', 'max:20'],
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
            'satuan' => ['required', 'string', 'max:20'],
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

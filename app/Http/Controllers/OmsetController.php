<?php

namespace App\Http\Controllers;

use App\Models\Omset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OmsetController extends Controller
{
    public function index(Request $request): View
    {
        $query = Omset::latest('tanggal');
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $omset = $query->paginate(10)->withQueryString();

        return view('omset.index', compact('omset'));
    }

    public function sync(Request $request): RedirectResponse
    {
        $validated = $request->validate(['tanggal' => ['required', 'date']]);
        Omset::syncForDate($validated['tanggal']);

        return back()->with('success', 'Omset berhasil dihitung ulang.');
    }
}

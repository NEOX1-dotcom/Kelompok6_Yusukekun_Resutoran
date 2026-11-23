<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KaryawanController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'tanggal' => ['nullable', 'date'],
            'cabang' => ['nullable', 'integer', 'exists:cabang,id_cabang'],
        ]);

        $tanggal = $validated['tanggal'] ?? '';
        $cabangDipilih = $validated['cabang'] ?? '';

        $query = Karyawan::with('cabang')
            ->orderByDesc('tanggal')
            ->orderByDesc('id_karyawan');

        if ($tanggal !== '') {
            $query->whereDate('tanggal', $tanggal);
        }

        if ($cabangDipilih !== '') {
            $query->where('id_cabang', $cabangDipilih);
        }

        $karyawan = $query->paginate(15)->withQueryString();
        $daftarCabang = Cabang::orderBy('nama_cabang')->get();

        return view('karyawan.index', compact(
            'karyawan',
            'daftarCabang',
            'tanggal',
            'cabangDipilih'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $admins = Admin::orderBy('nama_admin')->paginate(10);

        return view('admin.index', compact('admins'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_admin' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50', 'unique:admins,username'],
            'email' => ['required', 'email', 'max:50', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:6'],
            'no_telp' => ['nullable', 'string', 'max:15'],
        ]);
        $validated['password'] = Hash::make($validated['password']);

        Admin::create($validated);

        return back()->with('success', 'Admin berhasil ditambahkan.');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $admin = Admin::findOrFail($id);
        $validated = $request->validate([
            'nama_admin' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50', 'unique:admins,username,' . $id . ',id_admin'],
            'email' => ['required', 'email', 'max:50', 'unique:admins,email,' . $id . ',id_admin'],
            'password' => ['nullable', 'string', 'min:6'],
            'no_telp' => ['nullable', 'string', 'max:15'],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $admin->update($validated);

        return back()->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Admin::findOrFail($id)->delete();

        return back()->with('success', 'Admin berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use Illuminate\Http\Request;

class JenisSampahController extends Controller
{
    public function index()
    {
        $jenisSampah = JenisSampah::all();
        return view('admin.jenis-sampah.index', compact('jenisSampah'));
    }

    public function create()
    {
        return view('admin.jenis-sampah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga_per_kg' => 'required|numeric|min:0',
        ]);

        JenisSampah::create($request->only('nama', 'harga_per_kg'));

        return redirect()->route('admin.jenis-sampah.index')->with('success', 'Jenis sampah berhasil ditambahkan.');
    }

    public function edit(JenisSampah $jenisSampah)
    {
        return view('admin.jenis-sampah.edit', compact('jenisSampah'));
    }

    public function update(Request $request, JenisSampah $jenisSampah)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga_per_kg' => 'required|numeric|min:0',
        ]);

        $jenisSampah->update($request->only('nama', 'harga_per_kg'));

        return redirect()->route('admin.jenis-sampah.index')->with('success', 'Jenis sampah berhasil diperbarui.');
    }

    public function destroy(JenisSampah $jenisSampah)
    {
        $jenisSampah->delete();

        return redirect()->route('admin.jenis-sampah.index')->with('success', 'Jenis sampah berhasil dihapus.');
    }
}

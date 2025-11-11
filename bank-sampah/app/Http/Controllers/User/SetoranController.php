<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SetoranSampah;
use App\Models\JenisSampah;
use Illuminate\Support\Facades\Auth;


class SetoranController extends Controller
{
    public function create()
    {
        $jenisSampah = JenisSampah::all();
        return view('user.setoran.create', compact('jenisSampah'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'jenis_sampah_id' => 'required|exists:jenis_sampahs,id',
            'berat' => 'required|numeric|min:0.1',
        ]);
        // calculate total price
        $jenis = JenisSampah::findOrFail($request->jenis_sampah_id);
        $total = $jenis->harga_per_kg * $request->berat;
        // create setoran record
        SetoranSampah::create([
            'user_id' => Auth::user()->id,
            'jenis_sampah_id' => $jenis->id,
            'berat' => $request->berat,
            'total_harga' => $total,
            'status' => 'pending',
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'Setoran berhasil dikirim! Menunggu validasi admin.');
    }

}

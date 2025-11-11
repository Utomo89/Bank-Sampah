<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SetoranSampah;
use Illuminate\Http\Request;

class ValidasiSetoranController extends Controller
{
    //
    public function index(){
        $setoranSampah = SetoranSampah::with(['user', 'jenisSampah'])->orderBy('created_at', 'desc')->get();
        return view('admin.validasi-setoran.index', compact('setoranSampah'));
    }

    public function approve($id){
        $setoranSampah = SetoranSampah::findorfail($id);
        $setoranSampah->status = 'disetujui';
        $setoranSampah->save();

        // tambah saldo user berdasar total harga setoran sampah
        $user = $setoranSampah->user;
        $user->saldo += $setoranSampah->total_harga;
        $user->save();

        return redirect()->route('admin.validasi-setoran.index')->with('success', 'Setoran sampah berhasil diapprove');
    }

    // function untuk menolak
    public function reject($id){
        $setoranSampah = SetoranSampah::findorfail($id);
        $setoranSampah->status = 'ditolak';
        $setoranSampah->save();

        return redirect()->route('admin.validasi-setoran.index')->with('success', 'Setoran sampah berhasil ditolak');
    }
    public function updateStatus(Request $request, $id)
{
    $setoran = SetoranSampah::findOrFail($id);
    $setoran->status = $request->status;
    $setoran->save();

    // Jika disetujui, tambahkan ke saldo user
    if ($request->status === 'disetujui') {
        $user = $setoran->user;
        if (isset($user->balance)) {
            $user->saldo += $setoran->total;
            $user->save();
        }
    }

    return back()->with('success', 'Status setoran diperbarui.');
}

}

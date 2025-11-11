<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SetoranSampah;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = SetoranSampah::with(['user', 'jenisSampah'])
            ->where('status', 'disetujui')
            ->orderBy('created_at', 'desc');

        // Filter tanggal
        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // ✅ Ganti get() -> paginate()
        $setorans = $query->paginate(10)->withQueryString();

        // Hitung total saldo & transaksi
        $totalSaldo = $query->sum('total_harga');
        $totalTransaksi = $query->count();

        return view('admin.laporan.index', compact('setorans', 'totalSaldo', 'totalTransaksi'));
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SetoranSampah;
use App\Models\Withdraw;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Hitung total saldo berdasarkan setoran disetujui dikurangi withdraw disetujui
        $totalSetoranDisetujui = SetoranSampah::where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->sum('total_harga');

        $totalWithdrawDisetujui = Withdraw::where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->sum('amount');

        $saldo = $totalSetoranDisetujui - $totalWithdrawDisetujui;

        // Statistik setoran
        $totalSetoran = SetoranSampah::where('user_id', $user->id)->count();
        $setoranDiterima = SetoranSampah::where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->count();
        $setoranDitolak = SetoranSampah::where('user_id', $user->id)
            ->where('status', 'ditolak')
            ->count();

        // Riwayat setoran terakhir
        $riwayat = SetoranSampah::with('jenisSampah')
            ->where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        // Riwayat withdraw terakhir
        $riwayatWithdraw = Withdraw::where('user_id', $user->id)
            ->latest()
            ->get();


        // Kirim semua data ke view
        return view('user.dashboard', compact(
            'user',
            'saldo',
            'totalSetoran',
            'setoranDiterima',
            'setoranDitolak',
            'riwayat',
            'totalWithdrawDisetujui',
            'riwayatWithdraw'
        ));
    }
}

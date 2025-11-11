<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SetoranSampah;

class DashboardController extends Controller
{
    public function index(){
        // Total nasabah (user biasa)
        $totalNasabah = User::where('role', 'user')->count();

        // Total transaksi yang sudah disetujui admin
        $totalTransaksi = SetoranSampah::where('status', 'disetujui')->count();

        // Total saldo (akumulasi total_harga dari transaksi yang disetujui)
        $totalSaldo = SetoranSampah::where('status', 'disetujui')->sum('total_harga');
        
        // Total setoran pending (belum divalidasi)
        $totalPending = SetoranSampah::where('status', 'pending')->count();

        // data grafik atau transaksi terbaru
        $recentSetoran = SetoranSampah::with(['user', 'jenisSampah'])
        ->latest()
        ->take(5)
        ->get();

        return view('admin.dashboard', compact('totalNasabah', 'totalTransaksi', 'totalSaldo', 'totalPending', 'recentSetoran'));
    }
    
}

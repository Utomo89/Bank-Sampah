<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Models\SetoranSampah;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    /**
     * Halaman form pengajuan withdraw (untuk user)
     */
    public function create()
    {
        return view('user.withdraw.create');
    }

    /**
     * Proses pengajuan withdraw oleh user
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
        ]);

        $user = Auth::user();

        // Hitung total saldo user dari setoran yang sudah disetujui
        $totalSaldo = SetoranSampah::where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->sum('total_harga');

        // Hitung total penarikan yang sedang diproses atau sudah disetujui
        $withdrawn = Withdraw::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'disetujui'])
            ->sum('amount');

        $available = $totalSaldo - $withdrawn;

        // Validasi saldo cukup
        if ($request->amount > $available) {
            return back()->with('error', 'Saldo tidak mencukupi untuk melakukan penarikan.');
        }

        // Simpan pengajuan withdraw
        Withdraw::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'Penarikan berhasil diajukan dan menunggu persetujuan admin.');
    }

    /**
     * Halaman daftar withdraw (untuk admin) + fitur search
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $withdraws = Withdraw::with('user')
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]); // menjaga agar parameter search tetap ada saat berpindah halaman

        return view('admin.withdraw.index', compact('withdraws', 'search'));
    }

    /**
     * Update status withdraw (oleh admin)
     */
    public function updateStatus(Request $request, $id)
    {
        $withdraw = Withdraw::findOrFail($id);

        // Pastikan belum diproses
        if ($withdraw->status !== 'pending') {
            return back()->with('error', 'Permintaan ini sudah diproses sebelumnya.');
        }

        $withdraw->status = $request->status;
        $withdraw->save();

        // Jika disetujui, kurangi saldo user
        if ($request->status === 'disetujui') {
            $user = $withdraw->user;

            // Pastikan field saldo ada di tabel users
            if ($user->saldo >= $withdraw->amount) {
                $user->saldo -= $withdraw->amount;
                $user->save();
            } else {
                // Jika saldo tidak cukup, rollback status
                $withdraw->status = 'pending';
                $withdraw->save();

                return back()->with('error', 'Saldo user tidak mencukupi untuk withdraw ini.');
            }
        }

        return back()->with('success', 'Status withdraw berhasil diperbarui.');
    }
}

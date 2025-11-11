<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JenisSampahController;
use App\Http\Controllers\Admin\ValidasiSetoranController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\SetoranController;
use App\Http\Controllers\User\WithdrawController;


Route::get('/', function () {
    return view('auth.login');
});

// route for admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

// route for user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});


// route for admin jenis sampah
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('jenis-sampah', JenisSampahController::class);
});

// route for laporan
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

// route for admin validasi setoran
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('validasi-setoran', [ValidasiSetoranController::class, 'index'])->name('validasi-setoran.index');
    Route::post('validasi-setoran/{id}/approve', [ValidasiSetoranController::class, 'approve'])->name('validasi-setoran.approve');
    Route::post('validasi-setoran/{id}/reject', [ValidasiSetoranController::class, 'reject'])->name('validasi-setoran.reject');
});

// Admin withdraw routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/withdraw', [WithdrawController::class, 'index'])->name('admin.withdraw.index');
    Route::post('/admin/withdraw/{id}/update', [WithdrawController::class, 'updateStatus'])->name('admin.withdraw.update');
});

// route user setoran sampah
Route::middleware(['auth', 'role:user'])->prefix('user')->name('User.')->group(function () {
    Route::get('setoran/create', [SetoranController::class, 'create'])->name('setoran.create');
    Route::post('setoran', [SetoranController::class, 'store'])->name('setoran.store');
});

// User withdraw routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/withdraw', [WithdrawController::class, 'create'])->name('User.withdraw.create');
    Route::post('/withdraw', [WithdrawController::class, 'store'])->name('User.withdraw.store');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = request()->user();
        if ($user && $user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

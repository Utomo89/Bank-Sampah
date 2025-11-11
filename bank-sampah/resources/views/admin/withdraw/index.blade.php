<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Daftar Penarikan Saldo</h1>
                        <p class="text-gray-600 mt-2">Kelola permintaan penarikan saldo dari nasabah</p>
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $withdraws->total() }} permintaan ditemukan
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-green-700 font-medium">{{ session('success') }}</span>
                </div>
            @endif
            {{-- 🔍 Form Pencarian --}}
    <form action="{{ route('admin.withdraw.index') }}" method="GET" class="mb-4 flex items-center gap-2">
        <input 
            type="text" 
            name="search" 
            value="{{ $search ?? '' }}" 
            placeholder="Cari nama atau email user..." 
            class="border rounded-lg px-3 py-2 w-64"
        />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
            Cari
        </button>
        @if(!empty($search))
            <a href="{{ route('admin.withdraw.index') }}" class="text-gray-500 underline">
                Reset
            </a>
        @endif
    </form>

            <!-- Withdrawals Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Permintaan Penarikan</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="text-xs font-medium text-gray-600 uppercase bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4">Nasabah</th>
                                <th class="px-6 py-4">Jumlah</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($withdraws as $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <!-- User Info -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $item->user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $item->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Amount -->
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-green-600 text-lg">
                                            Rp{{ number_format($item->amount, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    <!-- Date -->
                                    <td class="px-6 py-4 text-gray-500">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-medium">{{ $item->created_at->format('d M Y') }}</span>
                                            <span class="text-xs">{{ $item->created_at->format('H:i') }}</span>
                                        </div>
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4">
                                        @if($item->status == 'disetujui')
                                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 text-xs font-medium px-3 py-1.5 rounded-full">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Disetujui
                                            </span>
                                        @elseif($item->status == 'ditolak')
                                            <span class="inline-flex items-center gap-1 bg-red-100 text-red-800 text-xs font-medium px-3 py-1.5 rounded-full">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-800 text-xs font-medium px-3 py-1.5 rounded-full">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Menunggu
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4">
                                        @if ($item->status == 'pending')
                                            <form action="{{ route('admin.withdraw.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                                @csrf
                                                <select name="status" class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
                                                    <option value="disetujui">Setujui</option>
                                                    <option value="ditolak">Tolak</option>
                                                </select>
                                                <button type="submit" class="inline-flex items-center gap-1 bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    Update
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 text-sm italic text-center block">Telah diproses</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                @if($withdraws->isEmpty())
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada permintaan penarikan</h3>
                        <p class="text-gray-500">Semua permintaan penarikan telah diproses.</p>
                    </div>
                @endif

                <!-- Pagination -->
                @if($withdraws->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $withdraws->links() }}
                </div>
                @endif
            </div>

            <!-- Info Card -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-blue-900">Panduan Verifikasi</h4>
                        <ul class="text-blue-700 text-sm mt-2 space-y-1">
                            <li>• Pastikan saldo nasabah mencukupi sebelum menyetujui penarikan</li>
                            <li>• Verifikasi data nasabah sebelum memproses penarikan</li>
                            <li>• Penarikan yang disetujui akan mengurangi saldo nasabah</li>
                            <li>• Berikan alasan jelas jika menolak penarikan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

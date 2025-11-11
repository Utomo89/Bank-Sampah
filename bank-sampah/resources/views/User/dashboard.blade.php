<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    Selamat Datang di Dashboard {{ Auth::user()->name }}
                </h1>
                <p class="text-gray-600 mt-2">Berikut ringkasan saldo dan riwayat transaksi Anda</p>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Saldo Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Saldo Anda</p>
                            <p class="text-3xl font-bold text-green-600">
                                Rp {{ number_format($saldo, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="p-3 bg-green-50 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <span>Saldo tersedia</span>
                    </div>
                </div>

                <!-- Total Setoran -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Setoran</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $totalSetoran }}</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-blue-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <span>Semua setoran</span>
                    </div>
                </div>

                <!-- Setoran Diterima -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Setoran Diterima</p>
                            <p class="text-3xl font-bold text-green-600">{{ $setoranDiterima }}</p>
                        </div>
                        <div class="p-3 bg-green-50 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Berhasil diverifikasi</span>
                    </div>
                </div>

                <!-- Setoran Ditolak -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Setoran Ditolak</p>
                            <p class="text-3xl font-bold text-red-600">{{ $setoranDitolak }}</p>
                        </div>
                        <div class="p-3 bg-red-50 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-red-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span>Tidak disetujui</span>
                    </div>
                </div>
            </div>

            <!-- Riwayat Setoran -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-800">Riwayat Setoran</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="text-xs font-medium text-gray-600 uppercase bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4">#</th>
                                <th class="px-6 py-4">Jenis Sampah</th>
                                <th class="px-6 py-4">Berat</th>
                                <th class="px-6 py-4">Total Harga</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($riwayat as $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">{{ $item->jenisSampah->nama }}</td>
                                    <td class="px-6 py-4">{{ $item->berat }} kg</td>
                                    <td class="px-6 py-4 text-green-600 font-semibold">
                                        Rp{{ number_format($item->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($item->status == 'pending')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs px-3 py-1.5 rounded-full">Menunggu</span>
                                        @elseif($item->status == 'disetujui')
                                            <span class="bg-green-100 text-green-800 text-xs px-3 py-1.5 rounded-full">Diterima</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs px-3 py-1.5 rounded-full">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">
                                        {{ $item->created_at->format('d M Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Riwayat Withdraw -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-800">Riwayat Penarikan Saldo</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="text-xs font-medium text-gray-600 uppercase bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Jumlah</th>
                                <th class="px-6 py-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @if($riwayatWithdraw->isEmpty())
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada riwayat penarikan.
                                    </td>
                                </tr>
                            @else
                                @foreach($riwayatWithdraw as $item)
                                    <tr>
                                        <td class="px-6 py-4">{{ $item->created_at->format('d M Y H:i') }}</td>
                                        <td class="px-6 py-4 font-semibold text-green-600">
                                            Rp {{ number_format($item->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium
                                                {{ $item->status == 'disetujui' ? 'bg-green-100 text-green-800' :
                                                   ($item->status == 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

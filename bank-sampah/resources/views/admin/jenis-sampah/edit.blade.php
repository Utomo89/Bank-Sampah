<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('admin.jenis-sampah.index') }}" 
                       class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Edit Jenis Sampah</h1>
                        <p class="text-gray-600 mt-2">Perbarui informasi jenis sampah</p>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <form action="{{ route('admin.jenis-sampah.update', $jenisSampah->id) }}" method="POST">
                    @csrf 
                    @method('PUT')
                    
                    <!-- Nama Sampah Field -->
                    <div class="mb-6">
                        <label for="nama" class="block text-sm font-semibold text-gray-800 mb-3">
                            Nama Jenis Sampah
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <input
                                type="text"
                                name="nama"
                                id="nama"
                                class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200"
                                placeholder="Contoh: Plastik PET, Kertas Koran, Kaleng Aluminium"
                                required
                                value="{{ old('nama', $jenisSampah->nama) }}"
                            >
                        </div>
                        @error('nama')
                            <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Harga per Kg Field -->
                    <div class="mb-8">
                        <label for="harga_per_kg" class="block text-sm font-semibold text-gray-800 mb-3">
                            Harga per Kilogram
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                            <input
                                type="number"
                                name="harga_per_kg"
                                id="harga_per_kg"
                                class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200"
                                placeholder="0.00"
                                required
                                step="0.01"
                                min="0"
                                value="{{ old('harga_per_kg', $jenisSampah->harga_per_kg) }}"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">/kg</span>
                            </div>
                        </div>
                        @error('harga_per_kg')
                            <div class="mt-2 flex items-center gap-2 text-sm text-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Current Information -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <h4 class="font-semibold text-gray-800 mb-2">Informasi Saat Ini</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-600">Nama:</span>
                                <p class="font-medium text-gray-900">{{ $jenisSampah->nama }}</p>
                            </div>
                            <div>
                                <span class="text-gray-600">Harga:</span>
                                <p class="font-medium text-green-600">Rp{{ number_format($jenisSampah->harga_per_kg, 0, ',', '.') }}/kg</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-100">
                        <button type="submit" 
                                class="flex-1 inline-flex items-center justify-center gap-2 bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 hover:shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Perbarui Data
                        </button>
                        <a href="{{ route('admin.jenis-sampah.index') }}" 
                           class="flex-1 inline-flex items-center justify-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl font-semibold transition-colors duration-200 text-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </a>
                    </div>
                </form>
            </div>

            <!-- Info Card -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-blue-900">Perhatian</h4>
                        <ul class="text-blue-700 text-sm mt-2 space-y-1">
                            <li>• Perubahan harga akan mempengaruhi setoran sampah yang baru</li>
                            <li>• Setoran yang sudah diproses tidak akan terpengaruh</li>
                            <li>• Pastikan harga sesuai dengan harga pasar terkini</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
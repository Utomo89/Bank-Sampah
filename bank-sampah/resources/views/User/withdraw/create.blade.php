<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Tarik Saldo</h1>
                <p class="text-gray-600 mt-2">Ajukan penarikan saldo dari tabungan sampah Anda</p>
            </div>

            <!-- Alert Messages -->
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-red-700 font-medium">{{ session('error') }}</span>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-green-700 font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Current Balance Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Saldo Tersedia</p>
                        <p class="text-3xl font-bold text-green-600">
                            Rp {{ number_format(auth()->user()->saldo ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="p-3 bg-green-50 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Withdrawal Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <form action="{{ route('User.withdraw.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Amount Input -->
                    <div>
                        <label for="amount" class="block text-sm font-semibold text-gray-800 mb-3">
                            Jumlah Penarikan
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
                                name="amount" 
                                id="amount"
                                class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200"
                                placeholder="10000"
                                min="1000"
                                required
                                step="1000"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">IDR</span>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">
                            Minimum penarikan: Rp 1.000
                        </p>
                        @if(auth()->user()->saldo < 1000)
                            <p class="mt-1 text-sm text-red-600">
                                Saldo tidak mencukupi untuk melakukan penarikan
                            </p>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-100">
                        <button 
                            type="submit" 
                            class="flex-1 inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                            @if(auth()->user()->saldo < 1000) disabled @endif
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10.5h4m-2 2.5v-5"/>
                            </svg>
                            Ajukan Penarikan
                        </button>
                        <a 
                            href="{{ route('dashboard') }}" 
                            class="flex-1 inline-flex items-center justify-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl font-semibold transition-colors duration-200 text-center"
                        >
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
                        <h4 class="font-semibold text-blue-900">Informasi Penarikan</h4>
                        <ul class="text-blue-700 text-sm mt-2 space-y-1">
                            <li>• Penarikan akan diproses dalam 1-2 hari kerja</li>
                            <li>• Pastikan saldo mencukupi untuk penarikan</li>
                            <li>• Minimum penarikan adalah Rp 1.000</li>
                            <li>• Penarikan akan dikirim ke rekening yang terdaftar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
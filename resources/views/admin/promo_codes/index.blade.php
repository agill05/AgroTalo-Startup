@extends('layouts.app')

@section('title', 'Manajemen Kode Promo - Admin AgroTalo')

@section('content')
<!-- Hero Section Mini -->
<section class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-12 px-4">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center gap-3 mb-3">
            <h1 class="text-3xl md:text-4xl font-bold">Manajemen Kode Promo</h1>
        </div>
        <p class="text-green-100">Kelola dan pantau semua kode promo untuk pelanggan</p>
    </div>
</section>

<main class="max-w-6xl mx-auto px-4 py-10">
    <!-- Action Button & Stats -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div class="flex items-center gap-2 text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <span class="font-semibold">Total: {{ $promoCodes->count() }} Kode Promo</span>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.promo_codes.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                Tambah Kode Promo
            </a>
            <a href="{{ route('admin.produk.index') }}" class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold transition-all duration-200">
                Kembali ke Produk
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 border-2 border-green-200 rounded-xl p-4 mb-6 flex items-start gap-3">
        <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="text-green-800 font-semibold">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Promo Codes Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <!-- Table Header -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                Daftar Kode Promo
            </h2>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Kode Promo</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Diskon</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Tanggal Dibuat</th>
                        <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($promoCodes as $promo)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <!-- Promo Code -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="bg-gradient-to-r from-green-100 to-emerald-100 px-4 py-2 rounded-lg border-2 border-green-200">
                                    <span class="font-mono font-bold text-green-700 text-lg">{{ $promo->code }}</span>
                                </div>
                            </div>
                        </td>

                        <!-- Discount -->
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-bold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $promo->discount }}%
                            </span>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4">
                            @if($promo->active)
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Aktif
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-bold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Tidak Aktif
                            </span>
                            @endif
                        </td>

                        <!-- Created Date -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="font-semibold">{{ $promo->created_at->format('d M Y') }}</span>
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.promo_codes.edit', $promo) }}"
                                    class="inline-flex items-center gap-1 bg-yellow-100 hover:bg-yellow-400 text-yellow-700 hover:text-white px-4 py-2 rounded-lg font-semibold transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.promo_codes.destroy', $promo) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kode promo ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 bg-red-100 hover:bg-red-500 text-red-700 hover:text-white px-4 py-2 rounded-lg font-semibold transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12">
                            <div class="text-center">
                                <div class="inline-block bg-gray-100 rounded-full p-6 mb-4">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Kode Promo</h3>
                                <p class="text-gray-600 mb-6">Buat kode promo pertama untuk menarik lebih banyak pelanggan</p>
                                <a href="{{ route('admin.promo_codes.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                    Buat Kode Promo Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Statistics Cards -->
    @if($promoCodes->count() > 0)
    <div class="grid md:grid-cols-3 gap-6 mt-8">
        <!-- Active Promos -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-200 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-3">
                <div class="bg-green-100 rounded-lg p-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-3xl font-bold text-green-700">{{ $promoCodes->where('active', true)->count() }}</span>
            </div>
            <h3 class="text-sm font-semibold text-gray-700">Promo Aktif</h3>
            <p class="text-xs text-gray-600 mt-1">Kode yang dapat digunakan</p>
        </div>

        <!-- Inactive Promos -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 border-2 border-gray-200 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-3">
                <div class="bg-gray-200 rounded-lg p-3">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                </div>
                <span class="text-3xl font-bold text-gray-700">{{ $promoCodes->where('active', false)->count() }}</span>
            </div>
            <h3 class="text-sm font-semibold text-gray-700">Promo Tidak Aktif</h3>
            <p class="text-xs text-gray-600 mt-1">Kode yang dinonaktifkan</p>
        </div>

        <!-- Average Discount -->
        <div class="bg-gradient-to-br from-orange-50 to-yellow-50 border-2 border-orange-200 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-3">
                <div class="bg-orange-100 rounded-lg p-3">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-3xl font-bold text-orange-700">{{ number_format($promoCodes->avg('discount'), 0) }}%</span>
            </div>
            <h3 class="text-sm font-semibold text-gray-700">Rata-rata Diskon</h3>
            <p class="text-xs text-gray-600 mt-1">Dari semua kode promo</p>
        </div>
    </div>
    @endif
</main>
@endsection
@extends('layouts.app')

@section('title', 'Kelola Produk - Admin AgroTalo')

@section('content')
<!-- Hero Section Mini -->
<section class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-3 mb-3">
            <h1 class="text-3xl md:text-4xl font-bold">Kelola Produk</h1>
        </div>
        <p class="text-green-100">Tambah, edit, dan kelola semua produk di AgroTalo</p>
    </div>
</section>

<main class="max-w-7xl mx-auto px-4 py-10">
    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div class="flex items-center gap-2 text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <span class="font-semibold">Total: {{ $products->count() }} Produk</span>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.produk.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                Tambah Produk
            </a>
            <a href="{{ route('admin.promo_codes.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                Kelola Kode Promo
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

    <!-- Products Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <!-- Table Header -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                Daftar Produk
            </h2>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Gambar</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Nama Produk</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Harga</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Diskon</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Stok</th>
                        <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($products as $produk)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <!-- Image -->
                        <td class="px-6 py-4">
                            <div class="relative group">
                                <div class="absolute inset-0 bg-green-500 rounded-xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
                                <img src="{{ asset('storage/produk_images/' . $produk->image) }}"
                                    alt="{{ $produk->name }}"
                                    class="w-20 h-20 object-contain bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-2 border-2 border-gray-100">
                            </div>
                        </td>

                        <!-- Product Name -->
                        <td class="px-6 py-4">
                            <p class="font-bold text-gray-800">{{ $produk->name }}</p>
                        </td>

                        <!-- Price -->
                        <td class="px-6 py-4">
                            <p class="text-green-600 font-bold text-lg">
                                Rp{{ number_format($produk->price, 0, ',', '.') }}
                            </p>
                        </td>

                        <!-- Discount -->
                        <td class="px-6 py-4">
                            @if($produk->discount && $produk->discount > 0)
                            <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold">
                                {{ $produk->discount }}%
                            </span>
                            @else
                            <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>

                        <!-- Stock -->
                        <td class="px-6 py-4">
                            @if($produk->stock > 0)
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ $produk->stock }}
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Habis
                            </span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.produk.edit', $produk) }}"
                                    class="inline-flex items-center gap-1 bg-blue-100 hover:bg-blue-500 text-blue-700 hover:text-white px-4 py-2 rounded-lg font-semibold transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.produk.destroy', $produk) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="inline">
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
                        <td colspan="6" class="px-6 py-12">
                            <div class="text-center">
                                <div class="inline-block bg-gray-100 rounded-full p-6 mb-4">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Produk</h3>
                                <p class="text-gray-600 mb-6">Mulai tambahkan produk pertama Anda sekarang</p>
                                <a href="{{ route('admin.produk.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                    Tambah Produk Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
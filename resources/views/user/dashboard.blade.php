@extends('layouts.app')

@section('title', 'Dashboard - AgroTalo')

@section('content')
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<!-- Hero Section untuk Dashboard -->
<section class="bg-green-600 text-white py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">
            Selamat Datang, {{ $user->name }}!
        </h1>
        <p class="text-lg mb-6">
            Kelola akun Anda dengan mudah
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('produk') }}" class="bg-orange-500 px-6 py-3 rounded text-white font-semibold">
                Belanja Sekarang
            </a>
            <a href="#stats" class="bg-white text-green-600 px-6 py-3 rounded font-semibold">
                Lihat Statistik
            </a>
        </div>
    </div>
</section>

<!-- Stats Cards dengan Design Modern -->
<section id="stats" class="py-16 md:py-20 bg-gradient-to-b from-gray-50 to-white px-4">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Ringkasan Aktivitas</span>
            <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-800">Statistik Anda</h2>
            <p class="text-gray-600 mt-3 max-w-2xl mx-auto">Pantau performa belanja dan pesanan Anda</p>
        </div>

        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <!-- Total Pesanan -->
            <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-500 hover:-translate-y-2">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-600 mb-2">Total Pesanan</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</p>
            </div>

            <!-- Total Belanja -->
            <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-green-500 hover:-translate-y-2">
                <div class="bg-gradient-to-br from-green-500 to-green-600 w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-600 mb-2">Total Belanja</p>
                <p class="text-3xl font-bold text-gray-900">Rp{{ number_format($totalSpent, 0, ',', '.') }}</p>
            </div>

            <!-- Pesanan Pending -->
            <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-yellow-500 hover:-translate-y-2">
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-600 mb-2">Pesanan Pending</p>
                <p class="text-3xl font-bold text-gray-900">{{ $pendingOrders }}</p>
            </div>

            <!-- Pesanan Selesai -->
            <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-purple-500 hover:-translate-y-2">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-600 mb-2">Pesanan Selesai</p>
                <p class="text-3xl font-bold text-gray-900">{{ $completedOrders }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Quick Actions dengan Design Modern -->
<section class="py-16 md:py-20 bg-white px-4">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Aksi Cepat</span>
            <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-800">Navigasi Utama</h2>
            <p class="text-gray-600 mt-3">Akses cepat ke fitur-fitur penting</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 md:gap-8">
            <!-- Belanja Sekarang -->
            <a href="{{ route('produk') }}" class="group bg-gradient-to-br from-green-50 to-emerald-50 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-green-200 hover:border-green-400 hover:-translate-y-2 block">
                <div class="bg-gradient-to-br from-green-500 to-green-600 w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-800">Belanja Sekarang</h3>
                <p class="text-gray-600 leading-relaxed">Jelajahi produk terbaru dan mulai berbelanja</p>
            </a>

            <!-- Keranjang Saya -->
            <a href="{{ route('cart') }}" class="group bg-gradient-to-br from-blue-50 to-cyan-50 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-blue-200 hover:border-blue-400 hover:-translate-y-2 block">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M7 13l-1.1 5M7 13l2.5-2.5M17 18v2a2 2 0 01-2 2H9a2 2 0 01-2-2v-2m10 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v9m10 0h-4m-6 0h4"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-800">Keranjang Saya</h3>
                <p class="text-gray-600 leading-relaxed">Lihat dan kelola item di keranjang belanja</p>
            </a>

            <!-- Edit Profil -->
            <a href="{{ route('profile.edit') }}" class="group bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-purple-200 hover:border-purple-400 hover:-translate-y-2 block">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-800">Edit Profil</h3>
                <p class="text-gray-600 leading-relaxed">Perbarui informasi dan pengaturan akun</p>
            </a>
        </div>
    </div>
</section>

<!-- Recent Orders & Frequent Products dengan Design Modern -->
<section class="py-16 md:py-20 bg-gradient-to-b from-gray-50 to-white px-4">
    <div class="max-w-6xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Recent Orders -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Pesanan Terbaru</h2>
                    <a href="{{ route('orders') }}" class="text-green-600 hover:text-green-700 font-semibold transition-colors">Lihat Semua →</a>
                </div>

                @if($recentOrders->count() > 0)
                <div class="space-y-4">
                    @foreach($recentOrders as $order)
                    <div class="group flex items-center justify-between p-6 border rounded-xl hover:shadow-lg transition-all duration-300 hover:border-green-300">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Pesanan #{{ $order->id }}</h3>
                                <p class="text-sm text-gray-600">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900 text-lg">Rp{{ number_format($order->total, 0, ',', '.') }}</p>
                            <span class="px-3 py-1 text-xs rounded-full font-semibold
                                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                            @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                                            @else bg-green-100 text-green-800
                                            @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Belum ada pesanan</h3>
                    <p class="text-gray-600 mb-6">Mulai berbelanja untuk melihat pesanan Anda di sini</p>
                    <a href="{{ route('produk') }}" class="bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-3 rounded-xl font-bold hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 inline-block">
                        Mulai Belanja
                    </a>
                </div>
                @endif
            </div>

            <!-- Frequent Products -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Produk Favorit</h2>

                @if($frequentProducts->count() > 0)
                <div class="space-y-4">
                    @foreach($frequentProducts as $product => $quantity)
                    <div class="group flex items-center justify-between p-6 border rounded-xl hover:shadow-lg transition-all duration-300 hover:border-green-300">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-emerald-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $product }}</h3>
                                <p class="text-sm text-gray-600">{{ $quantity }}x dibeli</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                                Favorit
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Belum ada produk favorit</h3>
                    <p class="text-gray-600 mb-6">Produk yang sering Anda beli akan muncul di sini</p>
                    <a href="{{ route('produk') }}" class="bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-3 rounded-xl font-bold hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 inline-block">
                        Jelajahi Produk
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
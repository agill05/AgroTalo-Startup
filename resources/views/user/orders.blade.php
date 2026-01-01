@extends('layouts.app')

@section('title', 'Riwayat Pesanan - AgroTalo')

@section('content')
@php
$statusTranslations = [
    'waiting_for_payment' => 'Menunggu Pembayaran',
    'pending' => 'Menunggu',
    'processing' => 'Diproses',
    'shipped' => 'Dikirim',
    'completed' => 'Selesai'
];
@endphp
<!-- Hero Section Mini -->
<section class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-12 px-4">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center gap-3 mb-3">
            <h1 class="text-3xl md:text-4xl font-bold">Riwayat Pesanan</h1>
        </div>
        <p class="text-green-100">Lihat semua pesanan yang pernah Anda buat</p>
    </div>
</section>

<main class="max-w-6xl mx-auto px-4 py-10">
    @if($orders->count() > 0)
    <!-- Order Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 border-2 border-yellow-200 rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-yellow-800 uppercase">Menunggu</p>
                    <p class="text-2xl font-bold text-yellow-900">{{ $orders->where('status', 'pending')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-200 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200 rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-blue-800 uppercase">Diproses</p>
                    <p class="text-2xl font-bold text-blue-900">{{ $orders->where('status', 'processing')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-700 animate-spin" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-purple-100 border-2 border-purple-200 rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-purple-800 uppercase">Dikirim</p>
                    <p class="text-2xl font-bold text-purple-900">{{ $orders->where('status', 'shipped')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-700" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-50 to-green-100 border-2 border-green-200 rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-green-800 uppercase">Selesai</p>
                    <p class="text-2xl font-bold text-green-900">{{ $orders->where('status', 'completed')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Order List -->
    <div class="space-y-6">
        @foreach($orders as $order)
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <!-- Order Header -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Pesanan #{{ $order->id }}</h3>
                            <p class="text-sm text-gray-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex flex-col gap-2">
                            <span class="inline-flex items-center px-4 py-2 text-sm font-bold rounded-full
                                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-300
                                        @elseif($order->status === 'processing') bg-blue-100 text-blue-800 border border-blue-300
                                        @elseif($order->status === 'shipped') bg-purple-100 text-purple-800 border border-purple-300
                                        @else bg-green-100 text-green-800 border border-green-300
                                        @endif">
                                @if($order->status === 'pending')
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                @elseif($order->status === 'processing')
                                <svg class="w-4 h-4 mr-1 animate-spin" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                </svg>
                                @elseif($order->status === 'shipped')
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                                </svg>
                                @else
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                @endif
                                {{ $statusTranslations[$order->status] ?? ucfirst($order->status) }}
                            </span>
                            @if($order->courier)
                            <div class="bg-blue-50 border border-blue-200 rounded-lg px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                    </svg>
                                    <div>
                                        <p class="text-xs font-semibold text-blue-900">Kurir: {{ $order->courier->name }}</p>
                                        <p class="text-xs text-blue-700">{{ $order->courier->phone }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-600 font-medium">Total Pembayaran</p>
                            <p class="text-xl font-bold text-green-600">Rp{{ number_format($order->total, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Body -->
            <div class="p-6">
                <!-- Product List -->
                <div class="mb-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Produk yang Dipesan
                    </h4>
                    <div class="space-y-3">
                        @foreach($order->items as $item)
                        <div class="flex items-center justify-between bg-gradient-to-r from-gray-50 to-green-50 p-4 rounded-xl border border-gray-100 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center gap-4">
                                <img src="{{ file_exists(public_path('storage/produk_images/' . $item['image'])) ? asset('storage/produk_images/' . $item['image']) : asset('storage/images/' . $item['image']) }}"
                                    alt="{{ $item['name'] }}"
                                    class="w-16 h-16 object-contain bg-white rounded-lg p-2 border-2 border-gray-100">
                                <div>
                                    <h5 class="font-bold text-gray-900">{{ $item['name'] }}</h5>
                                    <p class="text-sm text-gray-600 mt-1">
                                        <span class="font-semibold">Jumlah:</span> {{ $item['quantity'] }} ×
                                        Rp{{ number_format($item['price'], 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <p class="font-bold text-green-600 text-lg">Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Details -->
                <div class="grid md:grid-cols-2 gap-4 mb-6 pt-6 border-t border-gray-200">
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-bold text-blue-900 mb-1">Alamat Pengiriman</h5>
                                <p class="text-sm text-blue-800 leading-relaxed">{{ $order->shipping_address }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-bold text-green-900 mb-1">Metode Pembayaran</h5>
                                <p class="text-sm text-green-800 flex items-center gap-2">
                                    @if($order->payment_method === 'cod')
                                    <span class="text-xl">💵</span>
                                    Cash on Delivery (COD)
                                    @else
                                    <span class="text-xl">🏦</span>
                                    Transfer Bank
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="flex justify-end">
                    <a href="{{ route('order.confirmation', $order->id) }}"
                        class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $orders->links() }}
    </div>

    @else
    <!-- Empty State -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-12 text-center">
        <div class="max-w-md mx-auto">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum Ada Pesanan</h3>
            <p class="text-gray-600 mb-8 text-lg">Anda belum melakukan pemesanan apapun. Mulai belanja sekarang dan temukan produk pertanian terbaik!</p>
            <a href="{{ route('produk') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Mulai Belanja
            </a>
        </div>
    </div>
    @endif
</main>
@endsection
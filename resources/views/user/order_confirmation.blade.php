@extends('layouts.app')

@section('title', 'Konfirmasi Pesanan - AgroTalo')

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

<section class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-6 md:py-12 px-4">
    <div class="max-w-6xl mx-auto text-center md:text-left">
        <div class="flex flex-col md:flex-row items-center gap-3 mb-2">
            <h1 class="text-2xl md:text-4xl font-bold">Pesanan Berhasil</h1>
        </div>
        <p class="text-green-100 text-sm md:text-base">Terima kasih telah berbelanja di AgroTalo</p>
    </div>
</section>

<section class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-6xl mx-auto px-4 py-4 md:py-6">
        <div class="flex items-center justify-center gap-2 md:gap-4">
            <div class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 md:w-10 md:h-10 rounded-full bg-green-600 text-white font-bold shadow-lg text-sm">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span class="ml-2 font-semibold text-green-600 text-xs md:text-base hidden sm:block">Keranjang</span>
            </div>
            <div class="w-8 md:w-16 h-1 bg-green-600"></div>

            <div class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 md:w-10 md:h-10 rounded-full bg-green-600 text-white font-bold shadow-lg text-sm">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span class="ml-2 font-semibold text-green-600 text-xs md:text-base hidden sm:block">Checkout</span>
            </div>
            <div class="w-8 md:w-16 h-1 bg-green-600"></div>

            <div class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 md:w-10 md:h-10 rounded-full bg-green-600 text-white font-bold shadow-lg text-sm">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span class="ml-2 font-semibold text-green-600 text-xs md:text-base">Selesai</span>
            </div>
        </div>
    </div>
</section>

<main class="max-w-6xl mx-auto px-4 py-6 md:py-10 mb-24 lg:mb-0">
    @if(session('success'))
    <div class="mb-6 md:mb-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-6 text-center shadow-sm">
        <div class="inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-green-600 rounded-full mb-4 shadow-lg ring-4 ring-green-100">
            <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <h2 class="text-xl md:text-3xl font-bold text-gray-900 mb-2">Pesanan Diterima!</h2>
        <p class="text-gray-600 text-sm md:text-lg mb-2">{{ session('success') }}</p>
        <div class="inline-block bg-white px-4 py-1 rounded-full border border-green-200">
            <p class="text-xs md:text-sm text-gray-500">ID Pesanan: <span class="font-bold text-green-600 text-base">#{{ $order->id }}</span></p>
        </div>
    </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-6 lg:gap-8">
        <div class="lg:col-span-2 space-y-4 md:space-y-6">
            
            @if($order->payment_method === 'transfer' && $order->status === 'pending')
             <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-blue-900 text-sm mb-1">Menunggu Pembayaran</p>
                        <p class="text-blue-800 text-xs mb-3">Silakan transfer ke rekening berikut:</p>
                        <div class="bg-white rounded-lg p-3 border border-blue-200 flex justify-between items-center">
                            <div>
                                <p class="text-blue-900 font-semibold text-xs">Bank BRI</p>
                                <p class="text-gray-800 font-bold text-lg tracking-wide" id="rekNum">1234567890</p>
                                <p class="text-gray-500 text-[10px]">a/n PT AgroTalo Indonesia</p>
                            </div>
                            <button onclick="copyToClipboard('1234567890')" class="text-blue-600 text-xs font-bold hover:bg-blue-50 px-3 py-1 rounded transition-colors">
                                SALIN
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2 text-sm md:text-base">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Informasi Pengiriman
                    </h3>
                </div>

                <div class="p-4 md:p-6 space-y-6 divide-y divide-gray-100 md:divide-y-0">
                    <div class="grid md:grid-cols-3 gap-2 md:gap-4 pt-4 md:pt-0">
                        <div class="text-gray-500 text-xs md:text-sm font-medium">Alamat Penerima</div>
                        <div class="md:col-span-2">
                            <p class="text-gray-900 font-medium text-sm md:text-base">{{ auth()->user()->name }}</p>
                            <p class="text-gray-600 text-sm mt-1 leading-relaxed">{{ $order->shipping_address }}</p>
                            <p class="text-gray-600 text-sm mt-1">{{ auth()->user()->phone }}</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-2 md:gap-4 pt-4 md:pt-0">
                        <div class="text-gray-500 text-xs md:text-sm font-medium">Metode Pembayaran</div>
                        <div class="md:col-span-2 flex items-center gap-2">
                            @if($order->payment_method === 'cod')
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded font-bold">COD (Cash on Delivery)</span>
                            @else
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded font-bold">Transfer Bank</span>
                            @endif
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-2 md:gap-4 pt-4 md:pt-0">
                        <div class="text-gray-500 text-xs md:text-sm font-medium">Status Pesanan</div>
                        <div class="md:col-span-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                @if($order->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                @elseif($order->status === 'processing') bg-blue-100 text-blue-800 border border-blue-200
                                @elseif($order->status === 'shipped') bg-purple-100 text-purple-800 border border-purple-200
                                @else bg-green-100 text-green-800 border border-green-200
                                @endif">
                                {{ $statusTranslations[$order->status] ?? ucfirst($order->status) }}
                            </span>
                            @if($order->courier)
                            <div class="mt-2 flex items-center gap-2 text-sm text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                                Dikirim oleh: <span class="font-semibold">{{ $order->courier->name }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2 text-sm md:text-base">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Rincian Produk
                    </h3>
                </div>
                <div class="p-4 md:p-6 space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex items-start gap-3">
                        <img src="{{ file_exists(public_path('storage/produk_images/' . $item['image'])) ? asset('storage/produk_images/' . $item['image']) : asset('storage/images/' . $item['image']) }}"
                            alt="{{ $item['name'] }}"
                            class="w-16 h-16 md:w-20 md:h-20 object-contain bg-gray-50 rounded-lg border border-gray-200 p-1 flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-900 text-sm md:text-base line-clamp-2">{{ $item['name'] }}</h4>
                            <div class="flex justify-between items-end mt-1">
                                <p class="text-xs text-gray-500">{{ $item['quantity'] }} x Rp{{ number_format($item['price'], 0, ',', '.') }}</p>
                                <p class="font-bold text-green-600 text-sm md:text-base">Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    @if(!$loop->last) <hr class="border-gray-100"> @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 lg:sticky lg:top-24">
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800 text-sm md:text-base">Ringkasan Pembayaran</h3>
                </div>
                <div class="p-4 md:p-6">
                    <div class="space-y-2 mb-4 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($order->total + ($order->discount_amount ?? 0), 0, ',', '.') }}</span>
                        </div>
                        @if($order->discount_amount && $order->discount_amount > 0)
                        <div class="flex justify-between text-green-600 font-medium">
                            <span>Diskon</span>
                            <span>- Rp{{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkir</span>
                            <span class="text-green-600 font-semibold">Gratis</span>
                        </div>
                        <div class="border-t border-gray-100 pt-2 mt-2 flex justify-between items-center">
                            <span class="font-bold text-gray-800">Total</span>
                            <span class="text-xl font-bold text-green-600">Rp{{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="hidden lg:block space-y-3">
                        <a href="{{ route('produk') }}" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-bold transition-all shadow-md hover:shadow-lg">
                            Lanjut Belanja
                        </a>
                        <a href="{{ route('home') }}" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold transition-all">
                            Ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-4 lg:hidden z-50 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)]">
    <div class="grid grid-cols-2 gap-3 max-w-6xl mx-auto">
        <a href="{{ route('home') }}" class="flex items-center justify-center bg-white border border-gray-300 text-gray-700 py-3 rounded-xl font-bold text-sm">
            Ke Beranda
        </a>
        <a href="{{ route('produk') }}" class="flex items-center justify-center bg-gradient-to-r from-green-600 to-emerald-600 text-white py-3 rounded-xl font-bold text-sm shadow-md">
            Lanjut Belanja
        </a>
    </div>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Nomor rekening berhasil disalin!');
        }, function(err) {
            console.error('Gagal menyalin: ', err);
        });
    }
</script>
@endsection
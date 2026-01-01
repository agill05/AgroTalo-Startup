@extends('layouts.app')

@section('title', 'Keranjang Belanja - AgroTalo')

@section('content')
<style>
    /* ===== MOBILE RESPONSIVE STYLES ===== */
    
    /* Hero Section Responsive */
    .hero-cart {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
    }

    @media (max-width: 768px) {
        .hero-cart {
            padding: 2rem 1rem;
        }
        
        .hero-cart h1 {
            font-size: 1.75rem;
            line-height: 1.2;
        }
        
        .hero-cart p {
            font-size: 0.875rem;
        }
    }

    @media (max-width: 480px) {
        .hero-cart {
            padding: 1.5rem 1rem;
        }
        
        .hero-cart h1 {
            font-size: 1.5rem;
        }
    }

    /* Cart Item Card Responsive */
    @media (max-width: 768px) {
        .cart-item-card {
            padding: 1rem;
        }
        
        .product-image-wrapper {
            width: 80px;
            height: 80px;
        }
        
        .product-info h3 {
            font-size: 0.9375rem;
            line-height: 1.3;
        }
        
        .product-price {
            font-size: 1rem;
        }
        
        .quantity-controls {
            flex-direction: row;
            width: 100%;
            justify-content: space-between;
            margin-top: 0.75rem;
        }
        
        .quantity-buttons {
            order: 1;
        }
        
        .subtotal-remove {
            order: 2;
            flex-direction: row;
            gap: 0.5rem;
        }
    }

    @media (max-width: 480px) {
        .cart-item-card {
            padding: 0.875rem;
        }
        
        .product-image-wrapper {
            width: 70px;
            height: 70px;
        }
        
        .product-info h3 {
            font-size: 0.875rem;
        }
        
        .product-price {
            font-size: 0.9375rem;
        }
        
        .quantity-button {
            width: 32px;
            height: 32px;
        }
        
        .quantity-display {
            min-width: 2.5rem;
            font-size: 0.875rem;
        }
    }

    /* Order Summary Responsive */
    @media (max-width: 1024px) {
        .order-summary {
            position: static;
            margin-top: 2rem;
        }
    }

    @media (max-width: 768px) {
        .order-summary {
            padding: 1.25rem;
        }
        
        .order-summary h2 {
            font-size: 1.125rem;
        }
        
        .summary-row {
            font-size: 0.875rem;
        }
        
        .total-price {
            font-size: 1.5rem;
        }
        
        .promo-input {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .promo-input input,
        .promo-input button {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .order-summary {
            padding: 1rem;
            border-radius: 1rem;
        }
        
        .checkout-button {
            padding: 0.875rem 1.25rem;
            font-size: 0.9375rem;
        }
    }

    /* Empty Cart Responsive */
    @media (max-width: 768px) {
        .empty-cart-container {
            padding: 2rem 1.5rem;
        }
        
        .empty-cart-icon {
            width: 80px;
            height: 80px;
            padding: 1.5rem;
        }
        
        .empty-cart-title {
            font-size: 1.75rem;
        }
        
        .empty-cart-text {
            font-size: 0.9375rem;
        }
        
        .benefits-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-top: 2rem;
        }
    }

    @media (max-width: 480px) {
        .empty-cart-container {
            padding: 1.5rem 1rem;
            border-radius: 1.5rem;
        }
        
        .empty-cart-icon {
            width: 64px;
            height: 64px;
            padding: 1.25rem;
        }
        
        .empty-cart-title {
            font-size: 1.5rem;
        }
        
        .shop-now-button {
            padding: 0.875rem 1.5rem;
            font-size: 0.9375rem;
        }
    }

    /* Utility Classes for Mobile */
    @media (max-width: 768px) {
        .mobile-hide {
            display: none !important;
        }
        
        .mobile-full-width {
            width: 100% !important;
        }
        
        .mobile-text-sm {
            font-size: 0.875rem !important;
        }
        
        .mobile-p-2 {
            padding: 0.5rem !important;
        }
    }
</style>

<!-- Hero Section Mini -->
<section class="hero-cart bg-gradient-to-r from-green-600 to-emerald-600 text-white py-12 px-4">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center gap-3 mb-3">
            <h1 class="text-3xl md:text-4xl font-bold">Keranjang Belanja</h1>
        </div>
        <p class="text-green-100">Periksa dan kelola produk yang ingin Anda beli</p>
    </div>
</section>

<main class="max-w-6xl mx-auto px-4 py-10">
    @if(session('cart') && count(session('cart')) > 0)
    <div class="grid lg:grid-cols-3 gap-6 lg:gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-4 md:px-6 py-3 md:py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-base md:text-lg font-bold text-gray-800 flex items-center gap-2">
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span class="hidden sm:inline">Produk</span>
                            <span class="sm:hidden">Item</span>
                            ({{ count(session('cart')) }})
                        </h2>
                        <span class="text-xs md:text-sm text-gray-500 hidden md:inline">Subtotal</span>
                    </div>
                </div>

                <!-- Cart Items List -->
                <div class="divide-y divide-gray-200">
                    @foreach(session('cart') as $index => $item)
                    <div class="cart-item-card p-4 md:p-6 hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4">
                            <!-- Product Image -->
                            <div class="flex-shrink-0">
                                <div class="relative group">
                                    <div class="absolute inset-0 bg-green-500 rounded-xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
                                    <img src="{{ file_exists(public_path('storage/produk_images/' . $item['image'])) ? asset('storage/produk_images/' . $item['image']) : asset('storage/images/' . $item['image']) }}"
                                        alt="{{ $item['name'] }}"
                                        class="product-image-wrapper w-20 h-20 md:w-24 md:h-24 object-contain bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-2 border-2 border-gray-100">
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="flex-1 min-w-0">
                                <h3 class="product-info font-bold text-gray-800 text-sm md:text-base mb-1 line-clamp-2">{{ $item['name'] }}</h3>
                                <p class="product-price text-green-600 font-bold text-base md:text-lg">
                                    Rp{{ number_format($item['price'], 0, ',', '.') }}
                                </p>
                                <span class="inline-block mt-2 text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full font-semibold">
                                    ✓ Stok Tersedia
                                </span>
                            </div>

                            <!-- Quantity Controls - Mobile Optimized -->
                            <div class="quantity-controls flex flex-col md:items-end gap-3 w-full md:w-auto">
                                <div class="quantity-buttons flex items-center gap-2 bg-gray-100 rounded-xl p-1 w-full md:w-auto justify-center md:justify-start">
                                    <form action="{{ route('cart.update', ['index' => $index, 'action' => 'decrement']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="quantity-button bg-white hover:bg-green-500 hover:text-white text-gray-700 w-8 h-8 md:w-8 md:h-8 rounded-lg transition-all duration-200 flex items-center justify-center font-bold shadow-sm">
                                            <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                            </svg>
                                        </button>
                                    </form>
                                    <span class="quantity-display px-3 md:px-4 py-1 font-bold text-gray-800 min-w-[3rem] text-center text-sm md:text-base">{{ $item['quantity'] }}</span>
                                    <form action="{{ route('cart.update', ['index' => $index, 'action' => 'increment']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="quantity-button bg-white hover:bg-green-500 hover:text-white text-gray-700 w-8 h-8 md:w-8 md:h-8 rounded-lg transition-all duration-200 flex items-center justify-center font-bold shadow-sm">
                                            <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                <!-- Subtotal & Remove -->
                                <div class="subtotal-remove flex items-center justify-between md:justify-end gap-3 w-full md:w-auto">
                                    <p class="font-bold text-gray-800 text-base md:text-lg">
                                        Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                    </p>
                                    <form action="{{ route('cart.remove', $index) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-500 hover:text-white hover:bg-red-500 p-2 rounded-lg transition-all duration-200 group">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Continue Shopping -->
            <a href="{{ route('produk') }}" class="flex items-center justify-center gap-2 text-green-600 font-semibold hover:text-green-700 transition-colors py-3 text-sm md:text-base">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Lanjutkan Belanja
            </a>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="order-summary bg-white rounded-2xl shadow-lg border border-gray-100 p-4 md:p-6 lg:sticky lg:top-24">
                <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4 md:mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 md:w-6 md:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Ringkasan Pesanan
                </h2>

                <!-- Summary Details -->
                <div class="space-y-3 md:space-y-4 mb-4 md:mb-6">
                    <div class="summary-row flex justify-between text-gray-600 text-sm md:text-base">
                        <span>Subtotal ({{ count(session('cart')) }} item)</span>
                        <span class="font-semibold">Rp{{ number_format(collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity']), 0, ',', '.') }}</span>
                    </div>
                    @if(isset($promoCode) && $promoCode)
                    <div class="summary-row flex justify-between text-gray-600 text-sm md:text-base">
                        <span>Kode Promo</span>
                        <span class="font-semibold text-green-600 text-xs md:text-sm">{{ $promoCode }}</span>
                    </div>
                    @endif
                    @if(isset($discount) && $discount > 0)
                    <div class="summary-row flex justify-between text-green-700 font-semibold text-sm md:text-base">
                        <span>Diskon</span>
                        <span>- Rp{{ number_format($discount, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div class="summary-row flex justify-between text-gray-600 text-sm md:text-base">
                        <span>Ongkos Kirim</span>
                        <span class="font-semibold text-green-600">Gratis</span>
                    </div>
                    <div class="border-t border-gray-200 pt-3 md:pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-base md:text-lg font-bold text-gray-800">Total</span>
                            <span class="total-price text-xl md:text-2xl font-bold text-green-600">
                                Rp{{ number_format(collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity']) - ($discount ?? 0), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Promo Code -->
                <div class="mb-4 md:mb-6">
                    <label for="promo_code" class="block text-sm font-semibold text-gray-700 mb-2">Kode Promo</label>
                    <form action="{{ route('cart.applyPromo') }}" method="POST" class="promo-input flex flex-col sm:flex-row gap-2">
                        @csrf
                        <input id="promo_code" name="promo_code" type="text" placeholder="Masukkan kode" value="{{ old('promo_code', $promoCode ?? '') }}" class="flex-1 px-3 md:px-4 py-2 md:py-2.5 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-100 outline-none transition-all text-sm md:text-base" required>
                        <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2 md:py-2.5 rounded-xl transition-all text-sm md:text-base whitespace-nowrap">
                            Terapkan
                        </button>
                    </form>
                    @if(session('error'))
                        <p class="text-red-500 text-xs md:text-sm mt-1">{{ session('error') }}</p>
                    @endif
                    @if(session('success'))
                        <p class="text-green-500 text-xs md:text-sm mt-1">{{ session('success') }}</p>
                    @endif
                </div>

                @if(isset($discount) && $discount > 0)
                <div class="mb-4 md:mb-6 p-3 md:p-4 bg-green-100 rounded-xl text-green-700 font-semibold text-sm md:text-base">
                    Diskon dari kode promo: Rp{{ number_format($discount, 0, ',', '.') }}
                </div>
                @endif

                <!-- Checkout Button -->
                <a href="{{ route('checkout') }}" class="checkout-button block w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white text-center px-4 md:px-6 py-3 md:py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 text-sm md:text-base">
                    <span>Lanjut ke Pembayaran</span>
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>

                <!-- Security Info -->
                <div class="mt-4 md:mt-6 bg-green-50 border border-green-200 rounded-xl p-3 md:p-4">
                    <div class="flex items-start gap-2 md:gap-3">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <div class="text-xs md:text-sm text-gray-700">
                            <p class="font-semibold text-green-800">Transaksi Aman</p>
                            <p class="text-xs text-gray-600 mt-1">Data Anda dilindungi dengan enkripsi SSL</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Empty Cart State -->
    <div class="max-w-2xl mx-auto">
        <div class="empty-cart-container bg-white rounded-3xl shadow-xl p-8 md:p-12 text-center border border-gray-100">
            <!-- Empty Cart Icon -->
            <div class="empty-cart-icon inline-block bg-gray-100 rounded-full p-6 md:p-8 mb-4 md:mb-6">
                <svg class="w-16 h-16 md:w-24 md:h-24 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>

            <h2 class="empty-cart-title text-2xl md:text-3xl font-bold text-gray-800 mb-2 md:mb-3">Keranjang Masih Kosong</h2>
            <p class="empty-cart-text text-gray-600 mb-6 md:mb-8 text-base md:text-lg px-4">Yuk, mulai belanja dan temukan produk pertanian terbaik untuk kebutuhan Anda!</p>

            <a href="{{ route('produk') }}" class="shop-now-button inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 md:px-8 py-3 md:py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 text-sm md:text-base">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Mulai Belanja
            </a>

            <!-- Benefits -->
            <div class="benefits-grid grid md:grid-cols-3 gap-4 md:gap-6 mt-8 md:mt-12 text-left">
                <div class="flex items-start gap-2 md:gap-3">
                    <div class="bg-green-100 rounded-lg p-2 flex-shrink-0">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 mb-1 text-sm md:text-base">Produk Berkualitas</h3>
                        <p class="text-xs md:text-sm text-gray-600">Terjamin kualitas terbaik</p>
                    </div>
                </div>
                <div class="flex items-start gap-2 md:gap-3">
                    <div class="bg-blue-100 rounded-lg p-2 flex-shrink-0">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 mb-1 text-sm md:text-base">Harga Terjangkau</h3>
                        <p class="text-xs md:text-sm text-gray-600">Harga bersaing & transparan</p>
                    </div>
                </div>
                <div class="flex items-start gap-2 md:gap-3">
                    <div class="bg-orange-100 rounded-lg p-2 flex-shrink-0">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 mb-1 text-sm md:text-base">Pengiriman Cepat</h3>
                        <p class="text-xs md:text-sm text-gray-600">Sampai ke lokasi Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</main>
@endsection
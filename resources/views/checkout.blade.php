@extends('layouts.app')

@section('title', 'Checkout - AgroTalo')

@section('content')
<style>
    .summary-transition {
        transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
    }
</style>

<section class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-6 md:py-12 px-4">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center gap-3 mb-2 md:mb-3">
            <h1 class="text-2xl md:text-4xl font-bold">Checkout</h1>
        </div>
        <p class="text-green-100 text-sm md:text-base">Lengkapi data pengiriman dan pembayaran Anda</p>
    </div>
</section>

<section class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-30">
    <div class="max-w-6xl mx-auto px-4 py-4 md:py-6">
        <div class="flex items-center justify-center gap-2 md:gap-4">
            <div class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 md:w-10 md:h-10 rounded-full bg-green-600 text-white font-bold shadow-lg text-sm md:text-base">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span class="ml-2 md:ml-3 font-semibold text-green-600 text-xs md:text-base hidden sm:block">Keranjang</span>
            </div>
            <div class="w-8 md:w-16 h-1 bg-green-600"></div>

            <div class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 md:w-10 md:h-10 rounded-full bg-green-600 text-white font-bold shadow-lg text-sm md:text-base">
                    2
                </div>
                <span class="ml-2 md:ml-3 font-semibold text-green-600 text-xs md:text-base">Checkout</span>
            </div>
            <div class="w-8 md:w-16 h-1 bg-gray-300"></div>

            <div class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 md:w-10 md:h-10 rounded-full bg-gray-300 text-gray-600 font-bold text-sm md:text-base">
                    3
                </div>
                <span class="ml-2 md:ml-3 font-semibold text-gray-400 text-xs md:text-base hidden sm:block">Selesai</span>
            </div>
        </div>
    </div>
</section>

<main class="max-w-6xl mx-auto px-4 py-6 md:py-10 mb-24 lg:mb-0">

    <div class="lg:hidden mb-6">
        <button type="button" id="toggleSummaryBtn" class="w-full flex items-center justify-between bg-green-50 border border-green-200 p-4 rounded-xl text-green-800 font-semibold">
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Lihat Ringkasan Pesanan
            </span>
            <span class="flex items-center gap-2">
                Rp{{ number_format($totalAfterDiscount, 0, ',', '.') }}
                <svg id="summaryArrow" class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </span>
        </button>

        <div id="mobileSummaryContent" class="hidden bg-white border border-gray-200 border-t-0 rounded-b-xl p-4 shadow-sm">
            @foreach($cart as $item)
            <div class="flex items-start gap-3 pb-3 mb-3 border-b border-gray-100 last:border-0 last:mb-0">
                <img src="{{ file_exists(public_path('storage/produk_images/' . $item['image'])) ? asset('storage/produk_images/' . $item['image']) : asset('storage/images/' . $item['image']) }}"
                    alt="{{ $item['name'] }}"
                    class="w-12 h-12 object-contain bg-gray-50 rounded-lg p-1 border border-gray-200">
                <div class="flex-1">
                    <h4 class="font-medium text-gray-800 text-xs">{{ $item['name'] }}</h4>
                    <div class="flex justify-between mt-1">
                        <span class="text-xs text-gray-500">x{{ $item['quantity'] }}</span>
                        <span class="text-xs font-bold text-gray-700">Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="pt-3 border-t border-gray-200 text-sm">
                <div class="flex justify-between mb-1"><span>Subtotal</span><span>Rp{{ number_format($total, 0, ',', '.') }}</span></div>
                <div class="flex justify-between mb-1 text-green-600"><span>Ongkir</span><span>Gratis</span></div>
                @if(isset($discount) && $discount > 0)
                <div class="flex justify-between mb-1 text-green-600"><span>Diskon</span><span>-Rp{{ number_format($discount, 0, ',', '.') }}</span></div>
                @endif
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6 lg:gap-8">
        <div class="lg:col-span-2 space-y-4 md:space-y-6">
            <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
                @csrf

                <div class="bg-white rounded-xl md:rounded-2xl shadow-sm md:shadow-lg border border-gray-200 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-4 md:px-6 py-3 md:py-4 border-b border-gray-200">
                        <h3 class="text-base md:text-lg font-bold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Alamat Pengiriman
                        </h3>
                    </div>

                    <div class="p-4 md:p-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 md:p-4 mb-4 md:mb-6 flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <div class="text-xs md:text-sm">
                                <p class="font-semibold text-blue-800">Penerima</p>
                                <p class="text-blue-700 mt-1">{{ auth()->user()->name }} <span class="mx-1">•</span> {{ auth()->user()->phone }}</p>
                            </div>
                        </div>

                        <div>
                            <label for="shipping_address" class="block text-sm font-bold text-gray-700 mb-2">
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                id="shipping_address"
                                name="shipping_address"
                                rows="3"
                                class="w-full px-3 py-3 md:px-4 md:py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-100 outline-none transition-all duration-300 resize-none text-sm md:text-base"
                                placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kota, Kode Pos"
                                required>{{ old('shipping_address', auth()->user()->address ?? '') }}</textarea>
                            @error('shipping_address')
                            <p class="text-red-500 text-xs md:text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl md:rounded-2xl shadow-sm md:shadow-lg border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-4 md:px-6 py-3 md:py-4 border-b border-gray-200">
                        <h3 class="text-base md:text-lg font-bold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Pembayaran
                        </h3>
                    </div>

                    <div class="p-4 md:p-6 space-y-3 md:space-y-4">
                        <label class="relative flex items-center p-3 md:p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-green-500 transition-all duration-200 active:bg-green-50">
                            <input id="cod" name="payment_method" type="radio" value="cod" class="h-4 w-4 md:h-5 md:w-5 text-green-600 focus:ring-green-500 border-gray-300" {{ old('payment_method', 'cod') == 'cod' ? 'checked' : '' }} required>
                            <div class="ml-3 md:ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm md:text-base">Cash on Delivery (COD)</p>
                                        <p class="text-xs text-gray-600">Bayar ditempat</p>
                                    </div>
                                    <span class="text-xl md:text-2xl">💵</span>
                                </div>
                            </div>
                        </label>

                        <label class="relative flex flex-col p-3 md:p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-green-500 transition-all duration-200 active:bg-green-50">
                            <div class="flex items-center w-full">
                                <input id="transfer" name="payment_method" type="radio" value="transfer" class="h-4 w-4 md:h-5 md:w-5 text-green-600 focus:ring-green-500 border-gray-300" {{ old('payment_method') == 'transfer' ? 'checked' : '' }}>
                                <div class="ml-3 md:ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="font-bold text-gray-800 text-sm md:text-base">Transfer Bank</p>
                                            <p class="text-xs text-gray-600">Transfer Manual</p>
                                        </div>
                                        <span class="text-xl md:text-2xl">🏦</span>
                                    </div>
                                </div>
                            </div>
                            <div id="bankDetails" class="hidden mt-3 ml-8 md:ml-9 p-3 bg-gray-50 rounded-lg text-xs md:text-sm border border-gray-200">
                                <p class="text-gray-600">Bank BRI: <b class="text-gray-900">1234567890</b></p>
                                <p class="text-gray-600">a/n PT AgroTalo Indonesia</p>
                            </div>
                        </label>
                        @error('payment_method')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </form>
        </div>

        <div class="hidden lg:block lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 sticky top-24">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Ringkasan Pesanan
                    </h3>
                </div>

                <div class="p-6">
                    <div class="space-y-4 mb-6 max-h-80 overflow-y-auto pr-1 custom-scrollbar">
                        @foreach($cart as $item)
                        <div class="flex items-start gap-3 pb-4 border-b border-gray-100">
                            <img src="{{ file_exists(public_path('storage/produk_images/' . $item['image'])) ? asset('storage/produk_images/' . $item['image']) : asset('storage/images/' . $item['image']) }}"
                                alt="{{ $item['name'] }}"
                                class="w-16 h-16 object-contain bg-gray-50 rounded-lg p-2 border border-gray-100 flex-shrink-0">
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-900 text-sm line-clamp-2">{{ $item['name'] }}</h4>
                                <p class="text-xs text-gray-500 mt-1">{{ $item['quantity'] }} x Rp{{ number_format($item['price'], 0, ',', '.') }}</p>
                                <p class="font-bold text-green-600 mt-1">Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600 text-sm">
                            <span>Subtotal</span>
                            <span class="font-semibold">Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        @if(isset($discount) && $discount > 0)
                        <div class="flex justify-between text-green-700 font-semibold text-sm">
                            <span>Diskon</span>
                            <span>- Rp{{ number_format($discount, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between text-gray-600 text-sm">
                            <span>Ongkos Kirim</span>
                            <span class="font-semibold text-green-600">Gratis</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-800">Total</span>
                                <span class="text-2xl font-bold text-green-600">Rp{{ number_format($totalAfterDiscount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" form="checkoutForm" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        Buat Pesanan
                    </button>

                    <div class="mt-4 flex items-center justify-center gap-2 text-gray-500 text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Transaksi Aman
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] p-4 lg:hidden z-50">
    <div class="max-w-6xl mx-auto flex items-center justify-between gap-4">
        <div class="flex flex-col">
            <span class="text-xs text-gray-500">Total Pembayaran</span>
            <span class="text-lg font-bold text-green-600">Rp{{ number_format($totalAfterDiscount, 0, ',', '.') }}</span>
        </div>
        <button type="submit" form="checkoutForm" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-xl font-bold shadow-lg text-sm flex-1 max-w-[200px]">
            Buat Pesanan
        </button>
    </div>
</div>

<script>
    // Toggle Mobile Summary
    const toggleBtn = document.getElementById('toggleSummaryBtn');
    const summaryContent = document.getElementById('mobileSummaryContent');
    const arrow = document.getElementById('summaryArrow');

    toggleBtn.addEventListener('click', () => {
        summaryContent.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    });

    // Bank Details Logic
    const transferRadio = document.getElementById('transfer');
    const codRadio = document.getElementById('cod');
    const bankDetails = document.getElementById('bankDetails');

    function toggleBankDetails() {
        if (transferRadio.checked) {
            bankDetails.classList.remove('hidden');
        } else {
            bankDetails.classList.add('hidden');
        }
    }

    transferRadio.addEventListener('change', toggleBankDetails);
    codRadio.addEventListener('change', toggleBankDetails);

    // Run on load in case of validation error return
    toggleBankDetails();
</script>
@endsection
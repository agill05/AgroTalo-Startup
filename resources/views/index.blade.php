@extends('layouts.app')

@section('title', 'AgroTalo - Beranda')

@section('content')
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    /* Toast Notification Styles */
    #toast {
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
    }

    #toast.show {
        transform: translateX(0);
    }
</style>
    <!-- Hero Section dengan Gradient Modern -->
    <section class="relative bg-gradient-to-br from-green-600 via-green-500 to-emerald-600 text-white py-20 md:py-28 px-4 overflow-hidden">
        <div class="max-w-6xl mx-auto text-center relative z-10">
            <div class="inline-block bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                <span class="text-sm font-semibold">Platform Pertanian Terpercaya di Gorontalo</span>
            </div>
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                Temukan Alat & Bahan<br>
                <span class="text-yellow-300">Pertanian Terbaik</span>
            </h1>
            <p class="text-lg md:text-xl mb-8 text-green-50 max-w-2xl mx-auto">
                Dukung petani lokal dengan produk berkualitas tinggi dan layanan terpercaya
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('produk') }}" class="bg-orange-500 px-8 py-4 rounded-xl text-white font-bold text-lg hover:bg-orange-600 hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl inline-block">
                    Jelajahi Produk
                </a>
                <a href="#fitur" class="bg-white/20 backdrop-blur-sm px-8 py-4 rounded-xl text-white font-bold text-lg hover:bg-white/30 transition-all duration-300 border-2 border-white/50 inline-block">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    <!-- Fitur Unggulan dengan Card Modern -->
    <section id="fitur" class="py-16 md:py-20 bg-gradient-to-b from-gray-50 to-white px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Kenapa Pilih Kami</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-800">Fitur Unggulan</h2>
                <p class="text-gray-600 mt-3 max-w-2xl mx-auto">Kami menyediakan layanan terbaik untuk mendukung produktivitas pertanian Anda</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                <!-- Fitur 1 -->
                <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-green-500 hover:-translate-y-2">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <img src="https://cdn-icons-png.flaticon.com/512/6356/6356633.png" class="w-8 h-8 brightness-0 invert">
                    </div>
                    <h3 class="font-bold text-xl mb-3 text-gray-800">Stok Real-Time</h3>
                    <p class="text-gray-600 leading-relaxed">Pantau ketersediaan produk secara langsung dan pastikan barang yang Anda butuhkan selalu tersedia</p>
                </div>

                <!-- Fitur 2 -->
                <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-green-500 hover:-translate-y-2">
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <img src="https://cdn-icons-png.flaticon.com/512/3594/3594302.png" class="w-8 h-8 brightness-0 invert">
                    </div>
                    <h3 class="font-bold text-xl mb-3 text-gray-800">Multi-Toko</h3>
                    <p class="text-gray-600 leading-relaxed">Belanja dari berbagai toko mitra terpercaya dalam satu platform yang mudah digunakan</p>
                </div>

                <!-- Fitur 3 -->
                <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-green-500 hover:-translate-y-2">
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <img src="https://cdn-icons-png.flaticon.com/512/3845/3845824.png" class="w-8 h-8 brightness-0 invert">
                    </div>
                    <h3 class="font-bold text-xl mb-3 text-gray-800">Pengiriman Cepat</h3>
                    <p class="text-gray-600 leading-relaxed">Layanan antar ke seluruh Gorontalo dengan cepat dan aman hingga ke lokasi Anda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Populer dengan Design Premium -->
    <section class="py-16 md:py-20 bg-white px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Pilihan Terbaik</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-800">Produk Populer</h2>
                <p class="text-gray-600 mt-3">Produk pilihan yang paling banyak dicari oleh petani</p>
            </div>

            @if($popularProducts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                    @php
                        $colors = [
                            ['bg' => 'from-green-50 to-emerald-50', 'border' => 'border-green-200 hover:border-green-400', 'btn' => 'from-green-500 to-green-600 hover:from-green-600 hover:to-green-700', 'text' => 'text-green-600'],
                            ['bg' => 'from-blue-50 to-cyan-50', 'border' => 'border-blue-200 hover:border-blue-400', 'btn' => 'from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700', 'text' => 'text-blue-600'],
                            ['bg' => 'from-orange-50 to-yellow-50', 'border' => 'border-orange-200 hover:border-orange-400', 'btn' => 'from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700', 'text' => 'text-orange-600'],
                        ];
                    @endphp
                    @foreach($popularProducts as $index => $product)
                        @php
                            $colorIndex = $index % count($colors);
                            $color = $colors[$colorIndex];
                            $finalPrice = $product->discount > 0 ? $product->price - ($product->price * $product->discount / 100) : $product->price;
                        @endphp
                        <div class="group bg-gradient-to-br {{ $color['bg'] }} p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 {{ $color['border'] }}">
                            <div class="bg-white rounded-xl p-4 mb-4 flex justify-center items-center h-48 group-hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('storage/produk_images/' . $product->image) }}" alt="{{ $product->name }}" class="h-40 object-contain">
                            </div>
                            <div class="space-y-2">
                                <span class="inline-block bg-green-600 text-white text-xs px-3 py-1 rounded-full font-semibold">🔥 Populer</span>
                                <h3 class="font-bold text-xl text-gray-800">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm">Produk berkualitas tinggi untuk kebutuhan pertanian Anda</p>
                                <div class="flex items-center justify-between pt-3">
                                    @if($product->discount > 0)
                                        <div>
                                            <span class="text-lg font-bold {{ $color['text'] }} line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            <span class="text-2xl font-bold {{ $color['text'] }} block">Rp {{ number_format($finalPrice, 0, ',', '.') }}</span>
                                        </div>
                                    @else
                                        <span class="text-2xl font-bold {{ $color['text'] }}">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                @if(Auth::check())
                                <button class="add-to-cart bg-gradient-to-r {{ $color['btn'] }} text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 w-full shadow-lg hover:shadow-xl hover:scale-105 flex items-center justify-center gap-2"
                                    data-name="{{ $product->name }}"
                                    data-price="{{ $finalPrice }}"
                                    data-image="{{ $product->image }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Beli Sekarang
                                </button>
                                @else
                                <a href="{{ route('login') }}"
                                    class="bg-gradient-to-r {{ $color['btn'] }} text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 w-full shadow-lg hover:shadow-xl hover:scale-105 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Login untuk Beli
                                </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="bg-gray-100 rounded-full w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada produk populer</h3>
                    <p class="text-gray-500">Admin sedang menyiapkan produk-produk terbaik untuk Anda</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Tips dan Edukasi dengan Scrolling Horizontal Modern -->
    <section class="py-16 md:py-20 bg-gradient-to-b from-green-50 to-white px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Tingkatkan Pengetahuan</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-800">Tips & Edukasi Pertanian</h2>
                <p class="text-gray-600 mt-3">Panduan praktis untuk meningkatkan hasil panen Anda</p>
            </div>
        </div>
        
        <div class="relative">
            <div class="overflow-x-auto scrollbar-hide pb-6">
                <div class="flex space-x-6 px-4 md:px-8 lg:px-12">
                    <!-- Tips 1 -->
                    <div class="group min-w-[280px] md:min-w-[320px] bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-green-400 flex-shrink-0">
                        <div class="bg-gradient-to-br from-green-400 to-emerald-500 p-6 text-white">
                            <div class="bg-white/20 backdrop-blur-sm w-16 h-16 rounded-xl flex items-center justify-center mb-4">
                                <img src="{{ asset('storage/images/tips-1.png') }}" class="w-10 h-10" alt="Tips 1">
                            </div>
                            <h3 class="font-bold text-lg mb-2">Cara Mengolah Tanah Sebelum Tanam</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 leading-relaxed mb-4">Ketahui langkah dasar menyiapkan lahan agar nutrisi tanah tetap terjaga dan optimal untuk tanaman</p>
                            <a href="{{ route('tips.show', 1) }}" class="inline-flex items-center text-green-600 font-bold hover:text-green-700 transition-colors group-hover:translate-x-2 duration-300">
                                Lihat Tips Lengkap →
                            </a>
                        </div>
                    </div>

                    <!-- Tips 2 -->
                    <div class="group min-w-[280px] md:min-w-[320px] bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-blue-400 flex-shrink-0">
                        <div class="bg-gradient-to-br from-blue-400 to-cyan-500 p-6 text-white">
                            <div class="bg-white/20 backdrop-blur-sm w-16 h-16 rounded-xl flex items-center justify-center mb-4">
                                <img src="{{ asset('storage/images/tips-2.png') }}" class="w-10 h-10" alt="Tips 2">
                            </div>
                            <h3 class="font-bold text-lg mb-2">Gunakan Pupuk Organik dengan Tepat</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 leading-relaxed mb-4">Pelajari dosis dan waktu pemupukan yang tepat agar tanaman tumbuh optimal dan hasil panen maksimal</p>
                            <a href="{{ route('tips.show', 2) }}" class="inline-flex items-center text-blue-600 font-bold hover:text-blue-700 transition-colors group-hover:translate-x-2 duration-300">
                                Lihat Tips Lengkap →
                            </a>
                        </div>
                    </div>

                    <!-- Tips 3 -->
                    <div class="group min-w-[280px] md:min-w-[320px] bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-orange-400 flex-shrink-0">
                        <div class="bg-gradient-to-br from-orange-400 to-yellow-500 p-6 text-white">
                            <div class="bg-white/20 backdrop-blur-sm w-16 h-16 rounded-xl flex items-center justify-center mb-4">
                                <img src="{{ asset('storage/images/tips-3.png') }}" class="w-10 h-10" alt="Tips 3">
                            </div>
                            <h3 class="font-bold text-lg mb-2">Hemat Air Saat Musim Kemarau</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 leading-relaxed mb-4">Gunakan sistem irigasi tetes untuk efisiensi air dan tenaga, hemat biaya operasional pertanian</p>
                            <a href="{{ route('tips.show', 3) }}" class="inline-flex items-center text-orange-600 font-bold hover:text-orange-700 transition-colors group-hover:translate-x-2 duration-300">
                                Lihat Tips Lengkap →
                            </a>
                        </div>
                    </div>

                    <!-- Tips 4 (Duplikat untuk scrolling) -->
                    <div class="group min-w-[280px] md:min-w-[320px] bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-purple-400 flex-shrink-0">
                        <div class="bg-gradient-to-br from-purple-400 to-pink-500 p-6 text-white">
                            <div class="bg-white/20 backdrop-blur-sm w-16 h-16 rounded-xl flex items-center justify-center mb-4">
                                <img src="{{ asset('storage/images/tips-1.png') }}" class="w-10 h-10" alt="Tips 1">
                            </div>
                            <h3 class="font-bold text-lg mb-2">Cara Mengolah Tanah Sebelum Tanam</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 leading-relaxed mb-4">Ketahui langkah dasar menyiapkan lahan agar nutrisi tanah tetap terjaga dan optimal untuk tanaman</p>
                            <a href="{{ route('tips.show', 1) }}" class="inline-flex items-center text-purple-600 font-bold hover:text-purple-700 transition-colors group-hover:translate-x-2 duration-300">
                                Lihat Tips Lengkap →
                            </a>
                        </div>
                    </div>

                    <!-- Tips 5 -->
                    <div class="group min-w-[280px] md:min-w-[320px] bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-red-400 flex-shrink-0">
                        <div class="bg-gradient-to-br from-red-400 to-rose-500 p-6 text-white">
                            <div class="bg-white/20 backdrop-blur-sm w-16 h-16 rounded-xl flex items-center justify-center mb-4">
                                <img src="{{ asset('storage/images/tips-2.png') }}" class="w-10 h-10" alt="Tips 2">
                            </div>
                            <h3 class="font-bold text-lg mb-2">Gunakan Pupuk Organik dengan Tepat</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 leading-relaxed mb-4">Pelajari dosis dan waktu pemupukan yang tepat agar tanaman tumbuh optimal dan hasil panen maksimal</p>
                            <a href="{{ route('tips.show', 2) }}" class="inline-flex items-center text-red-600 font-bold hover:text-red-700 transition-colors group-hover:translate-x-2 duration-300">
                                Lihat Tips Lengkap →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="pt-16 md:pt-20 pb-0 bg-gradient-to-r from-green-600 to-emerald-600 px-4">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Tingkatkan Produktivitas Pertanian?</h2>
            <p class="text-lg md:text-xl mb-8 text-green-50">Bergabunglah dengan ribuan petani yang telah mempercayai AgroTalo</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('produk') }}" class="bg-white text-green-600 px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105 inline-block">
                    Mulai Belanja Sekarang
                </a>
                <a href="{{ route('chat') }}" class="bg-orange-500 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-orange-600 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105 inline-block">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Small Green Spacer -->
    <section class="bg-gradient-to-r from-green-600 to-emerald-600 py-8"></section>

    <script>
        // Add to Cart Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const name = this.getAttribute('data-name');
                    const price = this.getAttribute('data-price');
                    const image = this.getAttribute('data-image');
                    const originalHTML = this.innerHTML;

                    // Disable button temporarily
                    this.disabled = true;
                    this.innerHTML = '<svg class="animate-spin w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>';

                    fetch('/cart/add', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                name: name,
                                price: parseInt(price),
                                image: image
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Show toast notification
                            toastMessage.textContent = 'Produk berhasil ditambahkan ke keranjang!';
                            toast.classList.add('show');

                            setTimeout(() => {
                                toast.classList.remove('show');
                            }, 3000);

                            // Reload to update cart count
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            toastMessage.textContent = 'Terjadi kesalahan!';
                            toast.classList.add('show');

                            setTimeout(() => {
                                toast.classList.remove('show');
                            }, 3000);

                            // Re-enable button
                            this.disabled = false;
                            this.innerHTML = originalHTML;
                        });
                });
            });
        });
    </script>
@endsection

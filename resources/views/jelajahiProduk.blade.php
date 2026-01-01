@extends('layouts.app')

@section('title', 'AgroTalo - Jelajahi Produk')

@section('content')
<!-- Hero Section Mini -->
<section class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-12 px-4">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-3">Jelajahi Produk</h1>
        <p class="text-green-100 text-lg">Temukan produk pertanian berkualitas untuk kebutuhan Anda</p>
    </div>
</section>

<!-- Filter & Search Section -->
<section class="bg-white border-b border-gray-200 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <!-- Search Bar -->
            <div class="w-full md:flex-1 md:max-w-2xl">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari produk..."
                        class="w-full pl-11 pr-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-100 outline-none transition-all duration-300">
                    <svg class="w-5 h-5 absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Sort Options -->
            <select id="sortSelect" class="px-4 py-2.5 rounded-lg border-2 border-gray-200 focus:border-green-500 outline-none text-sm font-semibold w-full md:w-auto">
                <option value="default">Urutkan</option>
                <option value="price-low">Harga Terendah</option>
                <option value="price-high">Harga Tertinggi</option>
                <option value="name">Nama A-Z</option>
            </select>
        </div>
    </div>
</section>

<!-- Products Grid -->
<main class="max-w-7xl mx-auto px-4 py-10">
    <!-- Products Count -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">
            <span id="productCount">{{ count($products) }}</span> Produk Tersedia
        </h2>
        <div class="flex gap-2">
            <button id="gridView" class="p-2 rounded-lg bg-green-600 text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
            </button>
            <button id="listView" class="p-2 rounded-lg bg-gray-200 text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Grid Produk -->
    <div id="productsGrid" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
        @foreach($products as $product)
        <div class="product-card bg-white shadow-lg rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100"
            data-name="{{ strtolower($product['name']) }}"
            data-price="{{ $product['price'] }}">

            <!-- Image Container -->
            <div class="relative overflow-hidden bg-gradient-to-br from-green-50 to-emerald-50 group">
                <img src="{{ asset('storage/produk_images/' . $product['image']) }}"
                    alt="{{ $product['name'] }}"
                    class="w-full h-48 object-contain p-4 group-hover:scale-110 transition-transform duration-300">

                <!-- Badge Stock -->
                @if (($product['stock'] ?? 0) > 0)
                <div class="absolute top-3 left-3 bg-green-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                    ✓ Stok Tersedia
                </div>
                @else
                <div class="absolute top-3 left-3 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                    ✕ Stok Habis
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="p-4">
                <h3 class="font-bold text-gray-800 text-sm md:text-base mb-2 line-clamp-2 min-h-[2.5rem]">
                    {{ $product['name'] }}
                </h3>

                <!-- Rating (Optional) -->
                <div class="flex items-center gap-1 mb-2">
                    <div class="flex text-yellow-400 text-xs">
                        ⭐⭐⭐⭐⭐
                    </div>
                    <span class="text-xs text-gray-500">(4.8)</span>
                </div>

                <!-- Price -->
                <div class="flex items-center justify-between mb-3">
                    <div>
                        @php
                            $discountedPrice = $product['price'] - ($product['price'] * ($product['discount'] ?? 0) / 100);
                            $discountPercentage = $product['discount'] ?? 0;
                        @endphp
                        <p class="text-green-600 font-bold text-lg">
                            Rp{{ number_format($discountedPrice, 0, ',', '.') }}
                        </p>
                        @if($discountPercentage > 0)
                        <p class="text-xs text-gray-400 line-through">
                            Rp{{ number_format($product['price'], 0, ',', '.') }}
                        </p>
                        @endif
                    </div>
                    @if($discountPercentage > 0)
                    <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded-full">
                        -{{ $discountPercentage }}%
                    </span>
                    @endif
                </div>

                <!-- Add to Cart Button -->
                @if(Auth::check())
                <button class="add-to-cart w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white text-sm font-bold py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center gap-2"
                    data-name="{{ $product['name'] }}"
                    data-price="{{ $product['price'] }}"
                    data-image="{{ $product['image'] }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Tambah
                </button>
                @else
                <a href="{{ route('login') }}"
                    class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white text-sm font-bold py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
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

    <!-- Empty State -->
    <div id="emptyState" class="hidden text-center py-16">
        <div class="inline-block bg-gray-100 rounded-full p-8 mb-4">
            <svg class="w-24 h-24 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-700 mb-2">Produk Tidak Ditemukan</h3>
        <p class="text-gray-500 mb-6">Coba gunakan kata kunci lain atau ubah filter pencarian</p>
        <button onclick="resetFilters()" class="bg-green-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-green-700 transition-all">
            Reset Filter
        </button>
    </div>
</main>

<!-- Toast Notification -->
<div id="toast" class="fixed bottom-6 right-6 bg-green-600 text-white px-6 py-4 rounded-xl shadow-2xl transform translate-y-32 transition-transform duration-300 flex items-center gap-3 z-50">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    <span id="toastMessage" class="font-semibold"></span>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    #toast.show {
        transform: translateY(0);
    }
</style>

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
                        toastMessage.textContent = data.message;
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
                        this.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg> Tambah';
                    });
            });
        });

        // Search Functionality
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', filterProducts);

        // Sort Functionality
        const sortSelect = document.getElementById('sortSelect');
        sortSelect.addEventListener('change', sortProducts);

        // View Toggle
        const gridView = document.getElementById('gridView');
        const listView = document.getElementById('listView');
        const productsGrid = document.getElementById('productsGrid');

        gridView.addEventListener('click', function() {
            productsGrid.className = 'grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6';
            this.classList.add('bg-green-600', 'text-white');
            this.classList.remove('bg-gray-200', 'text-gray-600');
            listView.classList.remove('bg-green-600', 'text-white');
            listView.classList.add('bg-gray-200', 'text-gray-600');
        });

        listView.addEventListener('click', function() {
            productsGrid.className = 'grid grid-cols-1 gap-4';
            this.classList.add('bg-green-600', 'text-white');
            this.classList.remove('bg-gray-200', 'text-gray-600');
            gridView.classList.remove('bg-green-600', 'text-white');
            gridView.classList.add('bg-gray-200', 'text-gray-600');
        });
    });

    function filterProducts() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
        const productCards = document.querySelectorAll('.product-card');
        const emptyState = document.getElementById('emptyState');
        const productsGrid = document.getElementById('productsGrid');
        let visibleCount = 0;

        productCards.forEach(card => {
            const name = card.getAttribute('data-name');

            // Jika search kosong, tampilkan semua
            if (searchTerm === '' || name.includes(searchTerm)) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update count
        document.getElementById('productCount').textContent = visibleCount;

        // Show/hide empty state
        if (visibleCount === 0) {
            productsGrid.style.display = 'none';
            emptyState.style.display = 'block';
        } else {
            productsGrid.style.display = 'grid';
            emptyState.style.display = 'none';
        }
    }

    function sortProducts() {
        const sortValue = document.getElementById('sortSelect').value;
        const productsGrid = document.getElementById('productsGrid');
        const productCards = Array.from(document.querySelectorAll('.product-card'));

        if (sortValue === 'default') return;

        productCards.sort((a, b) => {
            switch (sortValue) {
                case 'price-low':
                    return parseInt(a.getAttribute('data-price')) - parseInt(b.getAttribute('data-price'));
                case 'price-high':
                    return parseInt(b.getAttribute('data-price')) - parseInt(a.getAttribute('data-price'));
                case 'name':
                    return a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'));
                default:
                    return 0;
            }
        });

        // Clear and re-append sorted cards
        productsGrid.innerHTML = '';
        productCards.forEach(card => productsGrid.appendChild(card));
    }

    function resetFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('sortSelect').value = 'default';
        filterProducts();
    }
</script>
@endsection
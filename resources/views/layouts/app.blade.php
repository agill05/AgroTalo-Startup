<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AgroTalo')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Mobile Navigation Animation */
        #nav {
            opacity: 0;
            transform: translateY(-10px);
            pointer-events: none;
            transition: all 0.3s ease-in-out;
        }

        @media (min-width: 768px) {
            #nav {
                opacity: 1;
                transform: none;
                pointer-events: auto;
            }
        }

        #nav.open {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        /* Smooth Scrollbar */
        * {
            scrollbar-width: thin;
            scrollbar-color: #10b981 #f3f4f6;
        }

        *::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        *::-webkit-scrollbar-track {
            background: #f3f4f6;
        }

        *::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 4px;
        }

        *::-webkit-scrollbar-thumb:hover {
            background: #059669;
        }

        /* User Menu Animation */
        #user-menu {
            animation: slideDown 0.2s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Cart Badge Pulse */
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        .cart-badge {
            animation: pulse 2s infinite;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    <!-- Header dengan Design Modern -->
    <header class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-4 px-4 md:px-8 shadow-xl">
        <div class="max-w-7xl mx-auto flex items-center justify-between">

            <!-- Logo dan Navigation di Kiri -->
            <div class="flex items-center space-x-6">
                <!-- Logo dengan Badge -->
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <img src="{{ asset('storage/images/AgroTalo.png') }}" alt="AgroTalo" class="h-10 md:h-12 bg-white rounded-xl p-2 shadow-lg hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="hidden md:block">
                        <h1 class="font-bold text-xl">AgroTalo</h1>
                        <p class="text-xs text-green-100">Pertanian Modern</p>
                    </div>
                </div>

                    <!-- Navigation Desktop -->
                    <nav class="hidden md:flex items-center space-x-1" id="nav-desktop">
                        @if(!Auth::check() || (Auth::check() && Auth::user()->role !== 'admin'))
                            <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg hover:bg-white/20 transition-all duration-300 font-medium {{ request()->routeIs('home') ? 'bg-white/30' : '' }}">
                                Beranda
                            </a>
                            <a href="{{ route('produk') }}" class="px-4 py-2 rounded-lg hover:bg-white/20 transition-all duration-300 font-medium {{ request()->routeIs('produk') ? 'bg-white/30' : '' }}">
                                Produk
                            </a>
                            <a href="{{ route('tips') }}" class="px-4 py-2 rounded-lg hover:bg-white/20 transition-all duration-300 font-medium {{ request()->routeIs('tips') ? 'bg-white/30' : '' }}">
                                Tips
                            </a>
                            @if(Auth::check())
                                <a href="{{ route('cart') }}" class="px-4 py-2 rounded-lg hover:bg-white/20 transition-all duration-300 font-medium relative {{ request()->routeIs('cart') ? 'bg-white/30' : '' }}">
                                    Keranjang
                                    @if(session('cart') && count(session('cart')) > 0)
                                        <span class="cart-badge absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center shadow-lg">
                                            {{ count(session('cart')) }}
                                        </span>
                                    @endif
                                </a>
                            @endif
                        @endif
                    </nav>
            </div>

            <!-- User Section -->
            @if(Auth::check())
            <div class="flex items-center space-x-3">
                <!-- User Menu -->
                <div class="relative">
                    <button id="user-menu-toggle" class="flex items-center space-x-2 bg-white/20 hover:bg-white/30 px-3 py-2 rounded-xl transition-all duration-300">
                        @if(Auth::user()->profile_image)
                            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Profile" class="h-9 w-9 rounded-full object-cover border-2 border-white shadow-lg">
                        @else
                            <div class="h-9 w-9 rounded-full bg-gradient-to-br from-orange-400 to-orange-500 flex items-center justify-center border-2 border-white shadow-lg">
                                <span class="font-bold text-white text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <span class="hidden md:block font-medium text-sm">{{ Auth::user()->name }}</span>
                        <svg class="hidden md:block w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div id="user-menu" class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-2xl z-50 hidden overflow-hidden border border-gray-100">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-500 px-4 py-3 text-white">
                            <p class="font-bold">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-green-100">{{ Auth::user()->email }}</p>
                        </div>
                        @php
                            $user = Auth::user();
                        @endphp
                        <a href="{{ $user->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-green-50 transition-colors duration-200">
                            Dashboard
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-green-50 transition-colors duration-200">
                            Edit Profil
                        </a>
                        @if($user->role !== 'admin')
                        <a href="{{ route('orders') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-green-50 transition-colors duration-200">
                            Pesanan Saya
                        </a>
                        @endif
                        <div class="border-t border-gray-100"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-3 text-red-600 hover:bg-red-50 transition-colors duration-200">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Mobile Menu Toggle -->
                <button class="md:hidden bg-white/20 hover:bg-white/30 p-2 rounded-lg transition-all duration-300" id="menu-toggle">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            @else
            <!-- Login & Register Buttons -->
            <div class="flex items-center space-x-2">
                <a href="{{ route('login') }}" class="bg-orange-500 hover:bg-orange-600 px-5 py-2.5 rounded-xl text-white font-bold text-sm shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="bg-white text-green-600 hover:bg-gray-100 px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    Daftar
                </a>
                <button class="md:hidden bg-white/20 hover:bg-white/30 p-2 rounded-lg transition-all duration-300" id="menu-toggle">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            @endif
        </div>

                    <!-- Mobile Navigation -->
                    <nav class="md:hidden mt-4 hidden bg-white/10 backdrop-blur-lg rounded-xl p-4 space-y-2" id="nav">
                        @if(!Auth::check() || (Auth::check() && Auth::user()->role !== 'admin'))
                            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg hover:bg-white/20 transition-all duration-300 font-medium {{ request()->routeIs('home') ? 'bg-white/30' : '' }}">
                                Beranda
                            </a>
                            <a href="{{ route('produk') }}" class="block px-4 py-3 rounded-lg hover:bg-white/20 transition-all duration-300 font-medium {{ request()->routeIs('produk') ? 'bg-white/30' : '' }}">
                                Produk
                            </a>
                            <a href="{{ route('tips') }}" class="block px-4 py-3 rounded-lg hover:bg-white/20 transition-all duration-300 font-medium {{ request()->routeIs('tips') ? 'bg-white/30' : '' }}">
                                Tips
                            </a>
                            @if(Auth::check())
                                <a href="{{ route('cart') }}" class="block px-4 py-3 rounded-lg hover:bg-white/20 transition-all duration-300 font-medium relative {{ request()->routeIs('cart') ? 'bg-white/30' : '' }}">
                                    Keranjang
                                    @if(session('cart') && count(session('cart')) > 0)
                                        <span class="cart-badge absolute top-2 right-4 bg-red-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center">
                                            {{ count(session('cart')) }}
                                        </span>
                                    @endif
                                </a>
                            @endif
                        @endif
                    </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Modern -->
    <footer class="bg-gradient-to-b from-gray-800 to-gray-900 text-white py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Footer Top -->
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- About Section -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('storage/images/AgroTalo.png') }}" alt="AgroTalo" class="h-10 bg-white rounded-lg p-2">
                        <div>
                            <h3 class="font-bold text-xl">AgroTalo</h3>
                            <p class="text-xs text-gray-400">Pertanian Modern Gorontalo</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-300 leading-relaxed mb-4">
                        AgroTalo adalah platform e-commerce yang menghubungkan petani dan pembeli di Gorontalo. Kami menyediakan produk pertanian berkualitas tinggi dengan harga terjangkau.
                    </p>
                    <div class="flex space-x-3">
                        <a href="https://www.facebook.com/share/1D5AdZ2kBz/" target="_blank" class="bg-blue-600 hover:bg-green-700 p-2 rounded-lg transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://x.com/mohammadagill_?t=46vwmQyuPE4fOboVNAbbjw&s=09" target="_blank" class="bg-black hover:bg-gray-800 p-2 rounded-lg transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="https://www.instagram.com/mohammadagill?igsh=MXg0MXVhajNyMmdi" target="_blank" class="bg-pink-600 hover:bg-pink-700 p-2 rounded-lg transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-green-400 font-bold mb-4 text-lg">Link Cepat</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-green-400 transition-colors duration-200 flex items-center"><span class="mr-2">→</span> Beranda</a></li>
                        <li><a href="{{ route('produk') }}" class="text-gray-300 hover:text-green-400 transition-colors duration-200 flex items-center"><span class="mr-2">→</span> Produk</a></li>
                        <li><a href="{{ route('tips') }}" class="text-gray-300 hover:text-green-400 transition-colors duration-200 flex items-center"><span class="mr-2">→</span> Tips Pertanian</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-green-400 transition-colors duration-200 flex items-center"><span class="mr-2">→</span> Tentang Kami</a></li>
                        <li><a href="https://wa.me/+6285166817952?text=Halo,%20saya%20ingin%20bertanya%20tentang%20produk%20AgroTalo" target="_blank" class="text-gray-300 hover:text-green-400 transition-colors duration-200 flex items-center"><span class="mr-2">→</span> Kontak</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="text-green-400 font-bold mb-4 text-lg">Newsletter</h4>
                    <p class="text-sm text-gray-300 mb-4">Dapatkan update produk dan tips pertanian terbaru</p>
                    <div class="space-y-3">
                        <input type="email" placeholder="Email Anda" class="w-full bg-gray-700 text-gray-200 px-4 py-2.5 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-300">
                        <button class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold text-sm px-6 py-2.5 rounded-lg w-full transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                            BERLANGGANAN
                        </button>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                <p>© 2025 AgroTalo. Semua hak dilindungi.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-green-400 transition-colors duration-200">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-green-400 transition-colors duration-200">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-green-400 transition-colors duration-200">Bantuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating Chat Button -->
    <div id="floating-chat-button" class="fixed bottom-6 right-6 z-40">
        <button id="start-chat-button" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white p-4 rounded-full shadow-2xl hover:shadow-3xl transition-all duration-300 hover:scale-110 group">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <div class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                💬
            </div>
        </button>
    </div>

    <script>
        // --- 1. Mobile Menu Logic (Tidak Berubah) ---
        const menuToggle = document.getElementById('menu-toggle');
        const nav = document.getElementById('nav');
        if (menuToggle && nav) {
            menuToggle.addEventListener('click', () => {
                nav.classList.toggle('hidden');
                nav.classList.toggle('open');
            });
        }

        const userMenuToggle = document.getElementById('user-menu-toggle');
        const userMenu = document.getElementById('user-menu');
        if (userMenuToggle && userMenu) {
            userMenuToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                userMenu.classList.toggle('hidden');
            });
            document.addEventListener('click', (e) => {
                if (!userMenuToggle.contains(e.target) && !userMenu.contains(e.target)) {
                    userMenu.classList.add('hidden');
                }
            });
        }

        // --- 2. Floating Chat Logic (DIPERBARUI) ---

        let isChatInitialized = false;

        const startChatButton = document.getElementById('start-chat-button');

        // Fungsi Membuka Chat dengan 1 Klik
        if (startChatButton) {
            startChatButton.addEventListener('click', () => {
                if (!isChatInitialized) {
                    initializeChat();
                    isChatInitialized = true;
                }
            });
        }

        // Fungsi Inisialisasi Chat
        async function initializeChat() {
            try {
                // Load n8n chat CSS jika belum dimuat
                if (!document.querySelector('link[href*="n8n/chat"]')) {
                    const link = document.createElement('link');
                    link.href = 'https://cdn.jsdelivr.net/npm/@n8n/chat/dist/style.css';
                    link.rel = 'stylesheet';
                    document.head.appendChild(link);
                }

                // Load n8n chat script dan buat chat
                const script = document.createElement('script');
                script.type = 'module';
                script.textContent = `
                    import { createChat } from 'https://cdn.jsdelivr.net/npm/@n8n/chat/dist/chat.bundle.es.js';

                    createChat({
                        webhookUrl: 'https://sorai.app.n8n.cloud/webhook/de9b8dbb-7b77-4c8c-a7e8-03f6ffbe217f/chat',
                        mode: 'window',
                        title: '',
                        subtitle: '',
                        showGetStarted: true,
                        initialMessages: [
                            'Halo! Selamat datang di AgroTalo. 🌱',
                            'Saya bisa bantu cek harga benih, pupuk, atau obat pertanian. Mau cari apa hari ini?'
                        ],
                        i18n: {
                            en: {
                                title: '',
                                subtitle: '',
                                inputPlaceholder: 'Ketik pertanyaan Anda...',
                            },
                        }
                    });
                `;
                document.body.appendChild(script);
            } catch (error) {
                console.error('Error initializing chat:', error);
            }
        }

    </script>
</body>

</html>
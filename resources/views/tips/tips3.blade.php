@extends('layouts.app')

@section('title', 'Tips 3 - AgroTalo')

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

    <!-- Hero Section untuk Tips 3 dengan Gradient Modern -->
    <section class="relative bg-gradient-to-br from-green-600 via-green-500 to-emerald-600 text-white py-20 md:py-28 px-4 overflow-hidden">
        <div class="max-w-6xl mx-auto text-center relative z-10">
            <div class="inline-block bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                <span class="text-sm font-semibold">Tips Pertanian AgroTalo</span>
            </div>
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                Tips 3<br>
                <span class="text-yellow-300">Hemat Air Saat Musim Kemarau</span>
            </h1>
            <p class="text-lg md:text-xl mb-8 text-green-50 max-w-2xl mx-auto">
                Teknik irigasi efisien untuk menghemat air dan tenaga
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#content" class="bg-orange-500 px-8 py-4 rounded-xl text-white font-bold text-lg hover:bg-orange-600 hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl inline-block">
                    Baca Tips Lengkap
                </a>
                <a href="{{ route('produk') }}" class="bg-white/20 backdrop-blur-sm px-8 py-4 rounded-xl text-white font-bold text-lg hover:bg-white/30 transition-all duration-300 border-2 border-white/50 inline-block">
                    Belanja Produk
                </a>
            </div>
        </div>
    </section>

    <!-- Konten Tips Section dengan Design Modern -->
    <section id="content" class="py-16 md:py-20 bg-gradient-to-b from-gray-50 to-white px-4">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 border border-gray-100">
                <!-- Tombol kembali -->
                <div class="mb-6">
                    <button onclick="history.back()"
                        class="text-2xl text-gray-600 hover:text-gray-800 transition-all duration-300 hover:scale-110">
                        ←
                    </button>
                </div>

                <!-- Konten Tips -->
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <!-- Gambar -->
                    <div class="flex-shrink-0">
                        <div class="bg-gradient-to-br from-green-100 to-emerald-200 w-40 h-40 rounded-full flex items-center justify-center shadow-lg hover:scale-105 transition-transform duration-300">
                            <img src="{{ asset('storage/images/tips-3.png') }}" alt="Ikon Irigasi Tetes"
                                class="w-32 h-32 rounded-full object-cover">
                        </div>
                    </div>

                    <!-- Teks -->
                    <div class="text-center md:text-left flex-1">
                        <h2 class="text-5xl md:text-6xl font-bold text-green-600 mb-4">TIPS 3</h2>
                        <h3 class="text-xl md:text-2xl font-semibold text-gray-700 mb-6">
                            Hemat Air Saat Musim Kemarau
                        </h3>
                        <div class="space-y-4 text-gray-700 text-base md:text-lg leading-relaxed text-justify">
                            <p>
                                Untuk meningkatkan efisiensi air dan tenaga, petani Gorontalo dapat menerapkan sistem irigasi tetes. Teknologi ini menyalurkan air langsung ke akar tanaman melalui selang dan sensor kelembapan tanah. Dengan cara ini, penggunaan air lebih hemat hingga 50%, dan penyiraman bisa dilakukan otomatis tanpa tenaga manual.
                            </p>
                            <p>
                                Sistem irigasi tetes juga membantu mengurangi pertumbuhan gulma dan mencegah penyakit tanaman karena air tidak menyentuh daun. Petani dapat mengintegrasikan sistem ini dengan aplikasi mobile untuk monitoring real-time, sehingga pengelolaan lahan menjadi lebih efisien dan produktif.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
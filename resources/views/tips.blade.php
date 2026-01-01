@extends('layouts.app')

@section('title', 'AgroTalo - Tips Pertanian')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-16 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <div class="inline-block bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-4">
                <span class="text-sm font-semibold">Edukasi Pertanian</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Tips & Panduan Pertanian</h1>
            <p class="text-green-100 text-lg max-w-3xl mx-auto">
                Tingkatkan hasil panen Anda dengan tips praktis dan terbukti dari para ahli pertanian
            </p>
        </div>
    </section>

    <!-- Tips Cards Section -->
    <section class="bg-gradient-to-b from-gray-50 to-white py-16 px-4">
        <div class="max-w-7xl mx-auto">
            
            <!-- Tips Counter -->
            <div class="text-center mb-12">
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Panduan Lengkap</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">3 Tips Penting Untuk Anda</h2>
            </div>

            <!-- TIPS 1 -->
            <div class="bg-white rounded-3xl shadow-xl p-8 md:p-10 mb-8 hover:shadow-2xl transition-all duration-300 border-l-8 border-green-500 group">
                <div class="flex flex-col md:flex-row items-start gap-8">
                    <!-- Icon Container -->
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <div class="absolute inset-0 bg-green-500 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                            <div class="relative bg-gradient-to-br from-green-100 to-emerald-100 rounded-2xl p-6 group-hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('storage/images/tips-1.png')}}" alt="Cara Mengolah Tanah" class="w-20 h-20 mx-auto">
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="bg-green-600 text-white text-sm font-bold px-4 py-1.5 rounded-full">TIPS #1</span>
                            <span class="text-gray-400 text-sm">⏱️ 5 menit baca</span>
                        </div>
                        
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 group-hover:text-green-600 transition-colors">
                            Cara Mengolah Tanah Sebelum Tanam
                        </h3>
                        
                        <div class="space-y-4 text-gray-600 leading-relaxed text-justify">
                            <p class="flex items-start gap-3">
                                <span>Provinsi Gorontalo dikenal sebagai daerah agraris dengan potensi pertanian yang besar. Untuk memperoleh hasil panen maksimal, pengolahan tanah sebelum tanam sangat penting dilakukan.</span>
                            </p>

                            <p class="flex items-start gap-3">
                                <span>Langkah awal adalah membersihkan lahan dari gulma dan sisa tanaman, lalu mencangkul atau membajak tanah agar gembur dan mudah menyerap air. Jika tanah terlalu asam, lakukan pengapuran untuk menetralkan pH. Setelah itu, tambahkan pupuk organik seperti kompos atau pupuk kandang guna meningkatkan kesuburan dan struktur tanah.</span>
                            </p>

                            <p class="flex items-start gap-3">
                                <span>Pastikan tanah memiliki drainase yang baik agar tidak tergenang air, terutama saat musim hujan. Dengan pengolahan tanah yang tepat, petani Gorontalo dapat meningkatkan kesuburan lahan dan hasil panen secara signifikan.</span>
                            </p>
                        </div>

                        <!-- Key Points -->
                        <div class="mt-6 bg-green-50 border-l-4 border-green-500 rounded-r-xl p-4">
                            <h4 class="font-bold text-green-800 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                                Poin Penting:
                            </h4>
                            <ul class="text-sm text-gray-700 space-y-1">
                                <li>✓ Bersihkan lahan dari gulma</li>
                                <li>✓ Cangkul atau bajak tanah hingga gembur</li>
                                <li>✓ Lakukan pengapuran jika pH terlalu asam</li>
                                <li>✓ Tambahkan pupuk organik</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TIPS 2 -->
            <div class="bg-white rounded-3xl shadow-xl p-8 md:p-10 mb-8 hover:shadow-2xl transition-all duration-300 border-l-8 border-blue-500 group">
                <div class="flex flex-col md:flex-row items-start gap-8">
                    <!-- Icon Container -->
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <div class="absolute inset-0 bg-blue-500 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                            <div class="relative bg-gradient-to-br from-blue-100 to-cyan-100 rounded-2xl p-6 group-hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('storage/images/tips-2.png')}}" alt="Gunakan Pupuk Organik" class="w-20 h-20 mx-auto">
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="bg-blue-600 text-white text-sm font-bold px-4 py-1.5 rounded-full">TIPS #2</span>
                            <span class="text-gray-400 text-sm">⏱️ 6 menit baca</span>
                        </div>
                        
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 group-hover:text-blue-600 transition-colors">
                            Gunakan Pupuk Organik dengan Tepat
                        </h3>
                        
                        <div class="space-y-4 text-gray-600 leading-relaxed text-justify">
                            <p class="flex items-start gap-3">
                                <span>Provinsi Gorontalo memiliki potensi pertanian yang besar, dan salah satu kunci keberhasilannya adalah penggunaan pupuk organik secara tepat. Pupuk organik membantu memperbaiki struktur tanah, menambah unsur hara alami, serta menjaga keseimbangan ekosistem tanah.</span>
                            </p>

                            <p class="flex items-start gap-3">
                                <span>Gunakan kompos atau pupuk kandang matang agar tidak merusak akar tanaman. Sebarkan pupuk secara merata di lahan, lalu aduk hingga tercampur dengan tanah. Untuk hasil lebih baik, lakukan pemupukan beberapa minggu sebelum tanam agar unsur hara terserap sempurna.</span>
                            </p>

                            <p class="flex items-start gap-3">
                                <span>Selain itu, petani dapat menambahkan pupuk hayati untuk meningkatkan aktivitas mikroorganisme yang bermanfaat bagi pertumbuhan tanaman. Dengan penggunaan pupuk organik yang tepat, petani Gorontalo dapat meningkatkan kesuburan tanah sekaligus menjaga kelestarian lingkungan.</span>
                            </p>
                        </div>

                        <!-- Key Points -->
                        <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 rounded-r-xl p-4">
                            <h4 class="font-bold text-blue-800 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                                Poin Penting:
                            </h4>
                            <ul class="text-sm text-gray-700 space-y-1">
                                <li>✓ Gunakan kompos atau pupuk kandang matang</li>
                                <li>✓ Sebarkan pupuk secara merata</li>
                                <li>✓ Pupuk beberapa minggu sebelum tanam</li>
                                <li>✓ Tambahkan pupuk hayati untuk mikroorganisme</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TIPS 3 -->
            <div class="bg-white rounded-3xl shadow-xl p-8 md:p-10 hover:shadow-2xl transition-all duration-300 border-l-8 border-orange-500 group">
                <div class="flex flex-col md:flex-row items-start gap-8">
                    <!-- Icon Container -->
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <div class="absolute inset-0 bg-orange-500 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                            <div class="relative bg-gradient-to-br from-orange-100 to-yellow-100 rounded-2xl p-6 group-hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('storage/images/tips-3.png')}}" alt="Sistem Irigasi Tetes" class="w-20 h-20 mx-auto">
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="bg-orange-600 text-white text-sm font-bold px-4 py-1.5 rounded-full">TIPS #3</span>
                            <span class="text-gray-400 text-sm">⏱️ 4 menit baca</span>
                        </div>
                        
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 group-hover:text-orange-600 transition-colors">
                            Hemat Air dengan Sistem Irigasi Tetes
                        </h3>
                        
                        <div class="space-y-4 text-gray-600 leading-relaxed text-justify">
                            <p class="flex items-start gap-3">
                                <span>Untuk meningkatkan efisiensi air dan tenaga, petani Gorontalo dapat menerapkan sistem irigasi tetes. Teknologi ini menyalurkan air langsung ke akar tanaman melalui selang dan sensor kelembapan tanah. Dengan cara ini, penggunaan air lebih hemat hingga 50%, dan penyiraman bisa dilakukan otomatis tanpa tenaga manual.</span>
                            </p>
                        </div>

                        <!-- Benefits -->
                        <div class="mt-6 grid md:grid-cols-3 gap-4">
                            <div class="bg-orange-50 rounded-xl p-4 text-center">
                                <div class="text-3xl font-bold text-orange-600 mb-1">50%</div>
                                <div class="text-sm text-gray-600">Hemat Air</div>
                            </div>
                            <div class="bg-orange-50 rounded-xl p-4 text-center">
                                <div class="text-3xl font-bold text-orange-600 mb-1">100%</div>
                                <div class="text-sm text-gray-600">Otomatis</div>
                            </div>
                            <div class="bg-orange-50 rounded-xl p-4 text-center">
                                <div class="text-3xl font-bold text-orange-600 mb-1">0%</div>
                                <div class="text-sm text-gray-600">Tenaga Manual</div>
                            </div>
                        </div>

                        <!-- Key Points -->
                        <div class="mt-6 bg-orange-50 border-l-4 border-orange-500 rounded-r-xl p-4">
                            <h4 class="font-bold text-orange-800 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                                Keuntungan:
                            </h4>
                            <ul class="text-sm text-gray-700 space-y-1">
                                <li>✓ Air langsung ke akar tanaman</li>
                                <li>✓ Hemat hingga 50% penggunaan air</li>
                                <li>✓ Sistem penyiraman otomatis</li>
                                <li>✓ Mengurangi tenaga manual</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
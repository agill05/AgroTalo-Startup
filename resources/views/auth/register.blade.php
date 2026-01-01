<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - AgroTalo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        .bg-pattern {
            background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%2310b981" fill-opacity="0.05"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
        }

        .password-strength {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .password-strength-bar {
            height: 100%;
            transition: all 0.3s;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-green-50 via-emerald-50 to-green-100 min-h-screen font-sans bg-pattern">

    <!-- Background Decoration -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-32 h-32 bg-green-200 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-40 h-40 bg-emerald-300 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-green-100 rounded-full opacity-10 blur-3xl"></div>
    </div>

    <div class="relative flex items-center justify-center min-h-screen px-4 py-12">
        <div class="w-full max-w-lg fade-in-up">
            
            <!-- Card Container -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                
                <!-- Header Section dengan Gradient -->
                <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-8 py-8 text-center relative">
                    <!-- Decorative circles -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-white opacity-10 rounded-full -mr-10 -mt-10"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white opacity-10 rounded-full -ml-8 -mb-8"></div>
                    
                    <div class="relative z-10">
                        <!-- Logo -->
                        <div class="flex justify-center mb-4">
                            <div class="bg-white p-3 rounded-2xl shadow-lg float-animation">
                                <img src="{{ asset('storage/images/AgroTalo.png') }}" alt="Logo AgroTalo" class="h-12">
                            </div>
                        </div>
                        <h1 class="text-3xl font-bold text-white mb-2">Bergabung Sekarang!</h1>
                        <p class="text-green-100 text-sm">Daftarkan akun AgroTalo Anda dan mulai berbelanja</p>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="px-8 py-8">
                    
                    <!-- Register Form -->
                    <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Nama Lengkap
                                </span>
                            </label>
                            <div class="relative">
                                <input type="text" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}"
                                    class="w-full p-3 pl-11 rounded-xl border-2 border-gray-200 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-4 focus:ring-green-100 outline-none transition-all duration-300">
                                <div class="absolute left-3.5 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Username
                                </span>
                            </label>
                            <div class="relative">
                                <input type="text" name="username" placeholder="Masukkan username" value="{{ old('username') }}"
                                    class="w-full p-3 pl-11 rounded-xl border-2 border-gray-200 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-4 focus:ring-green-100 outline-none transition-all duration-300">
                                <div class="absolute left-3.5 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('username')
                                <p class="text-red-500 text-xs mt-1 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    Alamat Email
                                </span>
                            </label>
                            <div class="relative">
                                <input type="email" name="email" placeholder="contoh@email.com" value="{{ old('email') }}"
                                    class="w-full p-3 pl-11 rounded-xl border-2 border-gray-200 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-4 focus:ring-green-100 outline-none transition-all duration-300">
                                <div class="absolute left-3.5 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('email') 
                                <p class="text-red-500 text-xs mt-1 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Nomor Telepon -->
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    Nomor Telepon (WhatsApp)
                                </span>
                            </label>
                            <div class="relative">
                                <input type="tel" name="phone" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}"
                                    class="w-full p-3 pl-11 rounded-xl border-2 border-gray-200 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-4 focus:ring-green-100 outline-none transition-all duration-300">
                                <div class="absolute left-3.5 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('phone') 
                                <p class="text-red-500 text-xs mt-1 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Alamat Lengkap
                                </span>
                            </label>
                            <div class="relative">
                                <textarea name="address" rows="2" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kota"
                                    class="w-full p-3 pl-11 rounded-xl border-2 border-gray-200 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-4 focus:ring-green-100 outline-none transition-all duration-300 resize-none">{{ old('address') }}</textarea>
                                <div class="absolute left-3.5 top-3 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('address')
                                <p class="text-red-500 text-xs mt-1 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Tanggal Lahir
                                </span>
                            </label>
                            <div class="relative">
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                    class="w-full p-3 pl-11 rounded-xl border-2 border-gray-200 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-4 focus:ring-green-100 outline-none transition-all duration-300">
                                <div class="absolute left-3.5 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('date_of_birth')
                                <p class="text-red-500 text-xs mt-1 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Jenis Kelamin
                                </span>
                            </label>
                            <div class="relative">
                                <select name="gender"
                                    class="w-full p-3 pl-11 rounded-xl border-2 border-gray-200 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-4 focus:ring-green-100 outline-none transition-all duration-300 appearance-none">
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <div class="absolute left-3.5 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div class="absolute right-3.5 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                            @error('gender')
                                <p class="text-red-500 text-xs mt-1 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    Password
                                </span>
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="password" placeholder="Minimal 8 karakter"
                                    class="w-full p-3 pl-11 pr-11 rounded-xl border-2 border-gray-200 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-4 focus:ring-green-100 outline-none transition-all duration-300">
                                <div class="absolute left-3.5 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <button type="button" id="togglePassword" class="absolute right-3.5 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            <!-- Password Strength Indicator -->
                            <div class="mt-2 password-strength">
                                <div id="strengthBar" class="password-strength-bar"></div>
                            </div>
                            <p id="strengthText" class="text-xs mt-1 text-gray-500"></p>
                            @error('password') 
                                <p class="text-red-500 text-xs mt-1 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Konfirmasi Password
                                </span>
                            </label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi password"
                                    class="w-full p-3 pl-11 pr-11 rounded-xl border-2 border-gray-200 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-4 focus:ring-green-100 outline-none transition-all duration-300">
                                <div class="absolute left-3.5 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <button type="button" id="togglePasswordConfirm" class="absolute right-3.5 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg id="eyeIconConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password_confirmation') 
                                <p class="text-red-500 text-xs mt-1 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                            <label class="flex items-start cursor-pointer">
                                <input type="checkbox" name="agree" id="agree" required class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500 focus:ring-2 mt-0.5">
                                <span class="ml-3 text-sm text-gray-700">
                                    Saya menyetujui <a href="#" class="text-green-600 font-semibold hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-green-600 font-semibold hover:underline">Kebijakan Privasi</a> AgroTalo
                                </span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                            DAFTAR SEKARANG
                        </button>
                    </form>

                    <!-- Login Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-green-600 font-bold hover:text-green-700 transition-colors hover:underline">
                                Masuk Sekarang
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-green-600 transition-colors">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
        function setupPasswordToggle(toggleId, passwordId, eyeIconId) {
            const toggle = document.getElementById(toggleId);
            const password = document.getElementById(passwordId);
            const eyeIcon = document.getElementById(eyeIconId);

            if (toggle && password && eyeIcon) {
                toggle.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    
                    if (type === 'password') {
                        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
                    } else {
                        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
                    }
                });
            }
        }

        setupPasswordToggle('togglePassword', 'password', 'eyeIcon');
        setupPasswordToggle('togglePasswordConfirm', 'password_confirmation', 'eyeIconConfirm');

        // Password Strength Checker
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');

        if (passwordInput && strengthBar && strengthText) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                
                if (password.length >= 8) strength++;
                if (password.match(/[a-z]+/)) strength++;
                if (password.match(/[A-Z]+/)) strength++;
                if (password.match(/[0-9]+/)) strength++;
                if (password.match(/[$@#&!]+/)) strength++;

                switch(strength) {
                    case 0:
                    case 1:
                        strengthBar.style.width = '20%';
                        strengthBar.style.backgroundColor = '#ef4444';
                        strengthText.textContent = 'Password sangat lemah';
                        strengthText.style.color = '#ef4444';
                        break;
                    case 2:
                        strengthBar.style.width = '40%';
                        strengthBar.style.backgroundColor = '#f97316';
                        strengthText.textContent = 'Password lemah';
                        strengthText.style.color = '#f97316';
                        break;
                    case 3:
                        strengthBar.style.width = '60%';
                        strengthBar.style.backgroundColor = '#eab308';
                        strengthText.textContent = 'Password cukup';
                        strengthText.style.color = '#eab308';
                        break;
                    case 4:
                        strengthBar.style.width = '80%';
                        strengthBar.style.backgroundColor = '#84cc16';
                        strengthText.textContent = 'Password kuat';
                        strengthText.style.color = '#84cc16';
                        break;
                    case 5:
                        strengthBar.style.width = '100%';
                        strengthBar.style.backgroundColor = '#10b981';
                        strengthText.textContent = 'Password sangat kuat';
                        strengthText.style.color = '#10b981';
                        break;
                }

                if (password.length === 0) {
                    strengthBar.style.width = '0%';
                    strengthText.textContent = '';
                }
            });
        }

        // Password Confirmation Match Checker
        const passwordConfirm = document.getElementById('password_confirmation');
        
        if (passwordInput && passwordConfirm) {
            passwordConfirm.addEventListener('input', function() {
                if (this.value && passwordInput.value) {
                    if (this.value === passwordInput.value) {
                        this.classList.remove('border-red-500');
                        this.classList.add('border-green-500');
                    } else {
                        this.classList.remove('border-green-500');
                        this.classList.add('border-red-500');
                    }
                } else {
                    this.classList.remove('border-red-500', 'border-green-500');
                }
            });
        }

        // Phone Number Formatting
        const phoneInput = document.querySelector('input[name="phone"]');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                
                // Ensure it starts with 0
                if (value.length > 0 && value[0] !== '0') {
                    value = '0' + value;
                }
                
                e.target.value = value;
            });
        }

        // Form Validation on Submit
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const agree = document.getElementById('agree');
                if (!agree.checked) {
                    e.preventDefault();
                    alert('Anda harus menyetujui Syarat & Ketentuan untuk melanjutkan');
                    agree.focus();
                }

                const password = document.getElementById('password').value;
                const passwordConfirm = document.getElementById('password_confirmation').value;
                
                if (password !== passwordConfirm) {
                    e.preventDefault();
                    alert('Password dan Konfirmasi Password tidak cocok');
                    passwordConfirm.focus();
                }
            });
        }

        // Smooth scroll to first error
        window.addEventListener('load', function() {
            const firstError = document.querySelector('.text-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    </script>
</body>

</html>
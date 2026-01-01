@extends('layouts.app')

@section('title', 'Instruksi Transfer - AgroTalo')

@section('content')
<section class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-12 px-4">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center gap-3 mb-3">
            <h1 class="text-3xl md:text-4xl font-bold">Instruksi Transfer</h1>
        </div>
        <p class="text-green-100">Silakan lakukan transfer ke rekening berikut untuk menyelesaikan pesanan Anda</p>
    </div>
</section>

<main class="max-w-4xl mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                Detail Pembayaran
            </h3>
        </div>

        <div class="p-6 space-y-6">
            <!-- Order Info -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                <h4 class="font-bold text-blue-800 mb-2">Informasi Pesanan</h4>
                <p class="text-blue-700"><strong>ID Pesanan:</strong> #{{ $order->id }}</p>
                <p class="text-blue-700"><strong>Total Pembayaran:</strong> Rp{{ number_format($order->total, 0, ',', '.') }}</p>
                <p class="text-blue-700"><strong>Status:</strong> Menunggu Pembayaran</p>
            </div>

            <!-- Bank Details -->
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Rekening Tujuan
                </h4>
                <div class="space-y-2">
                    <p class="text-lg font-semibold text-gray-900">Bank BRI</p>
                    <p class="text-lg font-mono text-gray-800">1234567890</p>
                    <p class="text-lg font-semibold text-gray-900">a/n PT AgroTalo Indonesia</p>
                </div>
            </div>

            <!-- Instructions -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                <h4 class="font-bold text-yellow-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    Instruksi Transfer
                </h4>
                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                    <li>Buka aplikasi mobile banking atau kunjungi ATM terdekat</li>
                    <li>Pilih menu transfer ke rekening bank lain</li>
                    <li>Masukkan nomor rekening: <strong>1234567890</strong> (Bank BRI)</li>
                    <li>Masukkan nominal: <strong>Rp{{ number_format($order->total, 0, ',', '.') }}</strong></li>
                    <li>Pastikan nama penerima: <strong>PT AgroTalo Indonesia</strong></li>
                    <li>Tambahkan catatan transfer dengan ID Pesanan: <strong>#{{ $order->id }}</strong></li>
                    <li>Lakukan transfer dan simpan bukti transfer</li>
                </ol>
            </div>

            <!-- Important Notes -->
            <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                <h4 class="font-bold text-red-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    Penting!
                </h4>
                <ul class="list-disc list-inside space-y-2 text-red-700">
                    <li>Pastikan nominal transfer sesuai dengan total pembayaran</li>
                    <li>Transfer harus dilakukan dalam waktu 24 jam setelah pesanan dibuat</li>
                    <li>Setelah transfer, admin akan memverifikasi dan mengubah status pesanan</li>
                    <li>Jika ada kesalahan transfer, hubungi customer service kami</li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('orders') }}" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-xl font-bold text-center transition-all duration-300">
                    Lihat Pesanan Saya
                </a>
                <a href="{{ route('home') }}" class="flex-1 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-bold text-center transition-all duration-300">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</main>
@endsection

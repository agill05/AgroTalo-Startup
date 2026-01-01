@extends('layouts.app')

@section('title', 'Detail Kurir - ' . $courier->name)

@section('content')
<section class="bg-green-600 text-white py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">
            Detail Kurir: {{ $courier->name }}
        </h1>
        <p class="text-lg mb-6">
            Laporan pengantaran dan gaji kurir
        </p>
    </div>
</section>

<section class="py-16 md:py-20 bg-gradient-to-b from-gray-50 to-white px-4">
    <div class="max-w-6xl mx-auto">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('admin.couriers.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar Kurir
            </a>
        </div>

        <!-- Courier Info -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kurir</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Nama Lengkap</h3>
                    <p class="text-gray-900">{{ $courier->name }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Nomor Telepon</h3>
                    <p class="text-gray-900">{{ $courier->phone }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Email</h3>
                    <p class="text-gray-900">{{ $courier->email ?: 'Tidak ada' }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Alamat</h3>
                    <p class="text-gray-900">{{ $courier->address ?: 'Tidak ada' }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Status</h3>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $courier->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $courier->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <!-- Total Deliveries -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200 rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-blue-800 uppercase">Total Pengantaran</p>
                        <p class="text-3xl font-bold text-blue-900">{{ $totalDeliveries }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Current Deliveries -->
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 border-2 border-yellow-200 rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-yellow-800 uppercase">Pengantaran Aktif</p>
                        <p class="text-3xl font-bold text-yellow-900">{{ $currentDeliveries }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Earnings -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 border-2 border-green-200 rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-green-800 uppercase">Total Pendapatan</p>
                        <p class="text-3xl font-bold text-green-900">Rp{{ number_format($totalEarnings, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Salary -->
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 border-2 border-purple-200 rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-purple-800 uppercase">Gaji (10% Komisi)</p>
                        <p class="text-3xl font-bold text-purple-900">Rp{{ number_format($salary, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Deliveries -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Riwayat Pengantaran Terbaru</h2>

            @if($recentDeliveries->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2">ID Pesanan</th>
                            <th class="border border-gray-300 px-4 py-2">Total Pesanan</th>
                            <th class="border border-gray-300 px-4 py-2">Komisi (10%)</th>
                            <th class="border border-gray-300 px-4 py-2">Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentDeliveries as $order)
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2">#{{ $order->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-4 py-2 font-semibold text-green-600">
                                Rp{{ number_format($order->total * 0.1, 0, ',', '.') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->updated_at->format('d M Y, H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-8">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <p class="text-gray-600 text-lg">Belum ada pengantaran yang selesai</p>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

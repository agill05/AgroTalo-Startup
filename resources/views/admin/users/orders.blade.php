@extends('layouts.app')

@section('title', 'Pesanan Pengguna - AgroTalo')

@section('content')
<section class="bg-green-600 text-white py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">
            Pesanan Pengguna: {{ $user->name }}
        </h1>
        <p class="text-lg mb-6">
            Lihat semua pesanan yang telah dibuat oleh {{ $user->name }}
        </p>
    </div>
</section>

<section class="py-16 md:py-20 bg-gradient-to-b from-gray-50 to-white px-4">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Pesanan</h2>
                <a href="{{ route('admin.users.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">
                    Kembali ke Daftar Pengguna
                </a>
            </div>

            @if($orders->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-blue-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2">ID Pesanan</th>
                            <th class="border border-gray-300 px-4 py-2">Total</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                            <th class="border border-gray-300 px-4 py-2">Metode Bayar</th>
                            <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2">{{ $order->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if($order->status === 'completed')
                                    <span class="text-green-600 font-semibold">Selesai</span>
                                @elseif($order->status === 'shipped')
                                    <span class="text-purple-600 font-semibold">Dikirim</span>
                                @elseif($order->status === 'processing')
                                    <span class="text-blue-600 font-semibold">Diproses</span>
                                @elseif($order->status === 'waiting_for_payment')
                                    <span class="text-orange-600 font-semibold">Menunggu Bayar</span>
                                @else
                                    <span class="text-yellow-600 font-semibold">Tertunda</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ ucfirst($order->payment_method) }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
            @else
            <p class="text-gray-600">Pengguna ini belum memiliki pesanan.</p>
            @endif
        </div>

        <div class="text-center">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</section>
@endsection

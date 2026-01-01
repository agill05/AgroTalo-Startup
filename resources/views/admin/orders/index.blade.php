@extends('layouts.app')

@section('title', 'Kelola Pesanan - AgroTalo')

@section('content')
<section class="bg-green-600 text-white py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">
            Kelola Pesanan
        </h1>
        <p class="text-lg mb-6">
            Lihat dan kelola semua pesanan yang ada di AgroTalo
        </p>
    </div>
</section>

<section class="py-16 md:py-20 bg-gradient-to-b from-gray-50 to-white px-4">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Semua Pesanan</h2>
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">
                    Kembali ke Dashboard
                </a>
            </div>

            @if($orders->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-green-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2">ID Pesanan</th>
                            <th class="border border-gray-300 px-4 py-2">User</th>
                            <th class="border border-gray-300 px-4 py-2">Total</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                            <th class="border border-gray-300 px-4 py-2">Kurir</th>
                            <th class="border border-gray-300 px-4 py-2">Metode Bayar</th>
                            <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                            <th class="border border-gray-300 px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2">{{ $order->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->user->name ?? 'N/A' }}</td>
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
                            <td class="border border-gray-300 px-4 py-2">{{ $order->courier->name ?? 'Belum dipilih' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ ucfirst($order->payment_method) }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if($order->status !== 'completed')
                                    <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" class="border rounded p-1 w-full mb-1">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : ''}}>Tertunda</option>
                                        <option value="waiting_for_payment" {{ $order->status === 'waiting_for_payment' ? 'selected' : ''}}>Menunggu Bayar</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : ''}}>Diproses</option>
                                        @php
                                            $hasActiveCouriers = \App\Models\Courier::where('is_active', true)->exists();
                                        @endphp
                                        @if($hasActiveCouriers)
                                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : ''}}>Dikirim</option>
                                        @else
                                            <option value="shipped" disabled {{ $order->status === 'shipped' ? 'selected' : ''}}>Dikirim (Kurir belum ada)</option>
                                        @endif
                                        @if($order->courier_id)
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : ''}}>Selesai</option>
                                        @else
                                            <option value="completed" disabled {{ $order->status === 'completed' ? 'selected' : ''}}>Selesai (Pilih kurir dulu)</option>
                                        @endif
                                    </select>
                                    @if($order->status === 'shipped' || $order->status === 'processing')
                                        <select name="courier_id" onchange="this.form.submit()" class="border rounded p-1 w-full">
                                            <option value="" selected disabled>Pilih Kurir</option>
                                            @php
                                                // Get couriers that are not assigned to other active orders
                                                $availableCouriers = \App\Models\Courier::where('is_active', true)
                                                    ->where(function($query) use ($order) {
                                                        $query->whereDoesntHave('orders', function($subQuery) {
                                                            $subQuery->whereIn('status', ['processing', 'shipped']);
                                                        })
                                                        ->orWhere('id', $order->courier_id); // Include current courier if assigned
                                                    })
                                                    ->get();
                                            @endphp
                                            @foreach($availableCouriers as $courier)
                                                <option value="{{ $courier->id }}" {{ $order->courier_id == $courier->id ? 'selected' : '' }}>{{ $courier->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </form>
                                @else
                                    <span class="text-green-600 font-semibold">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
            @else
            <p class="text-gray-600">Belum ada pesanan.</p>
            @endif
        </div>
    </div>
</section>
@endsection

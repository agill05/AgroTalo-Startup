@extends('layouts.app')

@section('title', 'Dashboard Admin - AgroTalo')

@section('content')
<section class="bg-green-600 text-white py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">
            Selamat Datang di Dashboard Admin, {{ $user->name }}!
        </h1>
        <p class="text-lg mb-6">
            Kelola toko dan pesanan Anda dengan mudah
        </p>
    </div>
</section>

<section class="py-16 md:py-20 bg-gradient-to-b from-gray-50 to-white px-4">
    <div class="max-w-6xl mx-auto">

        <div class="text-center mb-12">
            <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Ringkasan Aktivitas</span>
            <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-800">Statistik Pesanan</h2>
        </div>

        <div class="grid md:grid-cols-5 gap-6 mb-8">
            <!-- Total Pesanan -->
            <div class="group bg-white p-6 rounded-2xl shadow-md border border-gray-100 hover:shadow-lg transition-all duration-300">
                <h3 class="font-semibold text-lg text-gray-700 mb-1">Total Pesanan</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
            </div>

            <div class="group bg-yellow-100 p-6 rounded-2xl shadow-md border border-yellow-300 hover:shadow-lg transition-all duration-300">
                <h3 class="font-semibold text-lg text-yellow-800 mb-1">Tertunda</h3>
                <p class="text-2xl font-bold text-yellow-900">{{ $pendingOrders }}</p>
            </div>

            <div class="group bg-blue-100 p-6 rounded-2xl shadow-md border border-blue-300 hover:shadow-lg transition-all duration-300">
                <h3 class="font-semibold text-lg text-blue-800 mb-1">Diproses</h3>
                <p class="text-2xl font-bold text-blue-900">{{ $processingOrders }}</p>
            </div>

            <div class="group bg-purple-100 p-6 rounded-2xl shadow-md border border-purple-300 hover:shadow-lg transition-all duration-300">
                <h3 class="font-semibold text-lg text-purple-800 mb-1">Dikirim</h3>
                <p class="text-2xl font-bold text-purple-900">{{ $shippedOrders }}</p>
            </div>

            <div class="group bg-green-100 p-6 rounded-2xl shadow-md border border-green-300 hover:shadow-lg transition-all duration-300">
                <h3 class="font-semibold text-lg text-green-800 mb-1">Selesai</h3>
                <p class="text-2xl font-bold text-green-900">{{ $completedOrders }}</p>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Detail Toko Anda</h2>
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <div class="grid md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Toko</label>
                        <p class="text-gray-900">{{ $user->store_name ?? 'Belum diisi' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Toko</label>
                        <p class="text-gray-900">{{ $user->store_address ?? 'Belum diisi' }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button onclick="openEditStoreModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Detail Toko
                    </button>
                </div>
            </div>
        </div>

        <!-- Pesanan Menunggu Pembayaran -->
        @if($waitingForPaymentOrders->count() > 0)
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Pesanan Menunggu Pembayaran</h2>
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-orange-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2">ID Pesanan</th>
                            <th class="border border-gray-300 px-4 py-2">User</th>
                            <th class="border border-gray-300 px-4 py-2">Total</th>
                            <th class="border border-gray-300 px-4 py-2">Metode Bayar</th>
                            <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                            <th class="border border-gray-300 px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($waitingForPaymentOrders as $order)
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2">{{ $order->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="border border-gray-300 px-4 py-2">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ ucfirst($order->payment_method) }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="processing">
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-bold text-sm transition-all duration-300">
                                        Setujui & Proses
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Pesanan Terbaru</h2>
                <a href="{{ route('admin.orders.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    Lihat Semua Pesanan
                </a>
            </div>
            @if($recentOrders->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2">ID Pesanan</th>
                            <th class="border border-gray-300 px-4 py-2">User</th>
                            <th class="border border-gray-300 px-4 py-2">Total</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                            <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2">{{ $order->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="border border-gray-300 px-4 py-2">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if($order->status === 'completed')
                                <span class="text-green-600 font-semibold">Selesai</span>
                                @else
                                <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="border rounded p-1 w-full">
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
                                    <select name="courier_id" onchange="this.form.submit()" class="border rounded p-1 w-full mt-1">
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
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>Belum ada pesanan terbaru.</p>
            @endif
        </div>
    </div>

    <section class="max-w-6xl mx-auto px-4 py-10">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Fitur Admin</h2>
        <div class="flex gap-4">
            <a href="{{ route('admin.produk.index') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                Kelola Produk
            </a>
            <a href="{{ route('admin.couriers.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                Kelola Kurir
            </a>
            <a href="{{ route('admin.users.index') }}" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition">
                Kelola Pengguna
            </a>
        </div>
    </section>
</section>

<!-- Edit Store Modal -->
<div id="editStoreModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Edit Detail Toko</h3>
        </div>
        <form action="{{ route('admin.store.update') }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="store_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Toko</label>
                    <input type="text" id="store_name" name="store_name" value="{{ $user->store_name }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                </div>
                <div>
                    <label for="store_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Toko</label>
                    <textarea id="store_address" name="store_address" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>{{ $user->store_address }}</textarea>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeEditStoreModal()"
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditStoreModal() {
        document.getElementById('editStoreModal').classList.remove('hidden');
    }

    function closeEditStoreModal() {
        document.getElementById('editStoreModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('editStoreModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditStoreModal();
        }
    });
</script>
@endsection
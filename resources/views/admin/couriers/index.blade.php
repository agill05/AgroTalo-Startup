@extends('layouts.app')

@section('title', 'Kelola Kurir - Admin')

@section('content')
<section class="bg-green-600 text-white py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">
            Kelola Kurir
        </h1>
        <p class="text-lg mb-6">
            Tambah, edit, dan hapus kurir pengantar barang
        </p>
    </div>
</section>

<section class="py-16 md:py-20 bg-gradient-to-b from-gray-50 to-white px-4">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 flex flex-col md:flex-row gap-4">
            <a href="{{ route('admin.couriers.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition text-center">
                Tambah Kurir Baru
            </a>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition text-center">
                Kembali ke Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($couriers->count() > 0)
        <!-- Tabel untuk desktop -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2">Nama</th>
                        <th class="border border-gray-300 px-4 py-2">Telepon</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">Alamat</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($couriers as $courier)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $courier->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $courier->phone }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $courier->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $courier->address }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($courier->is_active)
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Aktif</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('admin.couriers.show', $courier) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 mr-2">Detail & Laporan</a>
                            <a href="{{ route('admin.couriers.edit', $courier) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 mr-2">Edit</a>
                            <form action="{{ route('admin.couriers.destroy', $courier) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus kurir ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Card layout untuk mobile -->
        <div class="block md:hidden">
            @foreach($couriers as $courier)
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <h3 class="text-lg font-bold mb-2">{{ $courier->name }}</h3>
                <p class="text-gray-600 mb-1"><strong>Telepon:</strong> {{ $courier->phone }}</p>
                <p class="text-gray-600 mb-1"><strong>Email:</strong> {{ $courier->email }}</p>
                <p class="text-gray-600 mb-1"><strong>Alamat:</strong> {{ $courier->address }}</p>
                <p class="text-gray-600 mb-3">
                    <strong>Status:</strong>
                    @if($courier->is_active)
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Aktif</span>
                    @else
                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded">Tidak Aktif</span>
                    @endif
                </p>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.couriers.show', $courier) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Detail & Laporan</a>
                    <a href="{{ route('admin.couriers.edit', $courier) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                    <form action="{{ route('admin.couriers.destroy', $courier) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus kurir ini?')">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-600">Belum ada kurir yang terdaftar.</p>
        @endif
    </div>
</section>
@endsection
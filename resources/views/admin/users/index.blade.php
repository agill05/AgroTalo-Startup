@extends('layouts.app')

@section('title', 'Kelola Pengguna - AgroTalo')

@section('content')
<section class="bg-green-600 text-white py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">
            Kelola Pengguna
        </h1>
        <p class="text-lg mb-6">
            Lihat dan kelola semua pengguna yang terdaftar di AgroTalo
        </p>
    </div>
</section>

<section class="py-16 md:py-20 bg-gradient-to-b from-gray-50 to-white px-4">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Daftar Pengguna</h2>

            @if($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-green-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Nama</th>
                            <th class="border border-gray-300 px-4 py-2">Email</th>
                            <th class="border border-gray-300 px-4 py-2">Username</th>
                            <th class="border border-gray-300 px-4 py-2">Tanggal Daftar</th>
                            <th class="border border-gray-300 px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->username ?? 'N/A' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('admin.users.orders', $user) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-bold text-sm transition-all duration-300">
                                    Lihat Pesanan
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
            @else
            <p class="text-gray-600">Belum ada pengguna terdaftar.</p>
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

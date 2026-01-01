@extends('layouts.app')

@section('title', 'Tambah Produk - Admin')

@section('content')
<section class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Tambah Produk Baru</h1>

    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block font-semibold mb-2">Nama Produk</label>
            <input type="text" id="name" name="name" required
                class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('name') }}">
        </div>

        <div>
            <label for="image" class="block font-semibold mb-2">Gambar Produk</label>
            <input type="file" id="image" name="image" required accept="image/*"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label for="price" class="block font-semibold mb-2">Harga Produk</label>
            <input type="number" id="price" name="price" required min="0"
                class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('price') }}">
        </div>

        <div>
            <label for="discount" class="block font-semibold mb-2">Diskon (%)</label>
            <input type="number" id="discount" name="discount" min="0" max="100"
                class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('discount', 0) }}">
        </div>

        <div>
            <label for="stock" class="block font-semibold mb-2">Stok Produk</label>
            <input type="number" id="stock" name="stock" required min="0"
                class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('stock', 0) }}">
        </div>

        <div>
            <label for="is_popular" class="block font-semibold mb-2">Produk Populer</label>
            <input type="checkbox" id="is_popular" name="is_popular" value="1"
                {{ old('is_popular') ? 'checked' : '' }}
                class="h-5 w-5 border border-gray-300 rounded">
            <p class="text-sm text-gray-600 mt-1">Centang untuk menampilkan produk di bagian populer</p>
        </div>

        <button type="submit"
            class="bg-green-600 text-white py-3 px-6 rounded hover:bg-green-700 transition">Simpan Produk</button>
    </form>
</section>
@endsection
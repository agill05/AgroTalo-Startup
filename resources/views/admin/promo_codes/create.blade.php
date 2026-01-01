@extends('layouts.app')

@section('title', 'Tambah Kode Promo Baru - Admin')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-6">Tambah Kode Promo Baru</h1>

    @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.promo_codes.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="code" class="block font-semibold mb-1">Kode Promo</label>
            <input type="text" name="code" id="code" value="{{ old('code') }}" required maxlength="255" class="w-full border-gray-300 rounded px-4 py-2">
        </div>

        <div>
            <label for="discount" class="block font-semibold mb-1">Diskon (%)</label>
            <input type="number" name="discount" id="discount" value="{{ old('discount') }}" required min="0" max="100" step="0.01" class="w-full border-gray-300 rounded px-4 py-2">
        </div>

        <div>
            <label for="active" class="block font-semibold mb-1">Status</label>
            <select name="active" id="active" class="w-full border-gray-300 rounded px-4 py-2">
                <option value="1" {{ old('active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded font-semibold">Tambah</button>
            <a href="{{ route('admin.promo_codes.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection

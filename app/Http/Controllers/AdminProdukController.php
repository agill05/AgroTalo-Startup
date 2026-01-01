<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProdukController extends Controller
{
    public function index()
    {
        $products = Produk::all();
        return view('admin.produk.index', compact('products'));
    }

    public function create()
    {
        return view('admin.produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'discount' => 'nullable|integer|min:0|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0',
            'is_popular' => 'nullable|boolean',
        ]);

        $path = $request->file('image')->store('produk_images', 'public');

        Produk::create([
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'stock' => $request->stock,
            'image' => basename($path),
            'is_popular' => $request->is_popular ?? false,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'discount' => 'nullable|integer|min:0|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0',
            'is_popular' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($produk->image) {
                Storage::disk('public')->delete('produk_images/' . $produk->image);
            }
            $path = $request->file('image')->store('produk_images', 'public');
            $produk->image = basename($path);
        }

        $produk->name = $request->name;
        $produk->price = $request->price;
        $produk->discount = $request->discount ?? 0;
        $produk->stock = $request->stock;
        $produk->is_popular = $request->is_popular ?? false;
        $produk->save();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->image) {
            Storage::disk('public')->delete('produk_images/' . $produk->image);
        }
        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}

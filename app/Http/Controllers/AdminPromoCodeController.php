<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromoCode;

class AdminPromoCodeController extends Controller
{
    public function index()
    {
        $promoCodes = PromoCode::all();
        return view('admin.promo_codes.index', compact('promoCodes'));
    }

    public function create()
    {
        return view('admin.promo_codes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:promo_codes,code',
            'discount' => 'required|numeric|min:0|max:100',
            'active' => 'required|boolean',
        ]);

        PromoCode::create([
            'code' => strtoupper($request->code),
            'discount' => $request->discount,
            'active' => $request->active,
        ]);

        return redirect()->route('admin.promo_codes.index')->with('success', 'Kode promo berhasil ditambahkan.');
    }

    public function edit(PromoCode $promoCode)
    {
        return view('admin.promo_codes.edit', compact('promoCode'));
    }

    public function update(Request $request, PromoCode $promoCode)
    {
        $request->validate([
            'code' => 'required|string|unique:promo_codes,code,' . $promoCode->id,
            'discount' => 'required|numeric|min:0|max:100',
            'active' => 'required|boolean',
        ]);

        $promoCode->update([
            'code' => strtoupper($request->code),
            'discount' => $request->discount,
            'active' => $request->active,
        ]);

        return redirect()->route('admin.promo_codes.index')->with('success', 'Kode promo berhasil diperbarui.');
    }

    public function destroy(PromoCode $promoCode)
    {
        $promoCode->delete();
        return redirect()->route('admin.promo_codes.index')->with('success', 'Kode promo berhasil dihapus.');
    }
}

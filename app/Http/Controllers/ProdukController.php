<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Produk;

use App\Models\PromoCode;

class ProdukController extends Controller
{
    public function index()
    {
        $products = Produk::all();

        return view('jelajahiProduk', compact('products'));
    }

    public function showStore($store)
    {
        $views = [
            'pertanianSejahtera' => 'produk_toko.pertanianSejahtera',
            'majuJaya' => 'produk_toko.majuJaya',
            'taniMakmur' => 'produk_toko.taniMakmur',
            'taniJayaMandiri' => 'produk_toko.taniJayaMandiri',
        ];

        if (!array_key_exists($store, $views)) {
            abort(404);
        }

        $products = [
            ['name' => 'Benih Timun', 'image' => 'benih-timun.png', 'price' => 21000],
            ['name' => 'Benih Kacang Panjang', 'image' => 'benih-kacang-panjang.png', 'price' => 21000],
            ['name' => 'Benih Bayam', 'image' => 'benih-bayam.png', 'price' => 21000],
            ['name' => 'Konektor Irigasi', 'image' => 'konektor-irigasi.png', 'price' => 25000],
            ['name' => 'Pupuk Kalsium', 'image' => 'pupuk-kalsium.png', 'price' => 25000],
            ['name' => 'Pupuk Urea', 'image' => 'pupuk-urea.png', 'price' => 25000],
            ['name' => 'Pestisida Nabati', 'image' => 'pestisida.png', 'price' => 30000],
            ['name' => 'Sekop', 'image' => 'sekop.png', 'price' => 45000],
            ['name' => 'Selang Air', 'image' => 'selang-air.png', 'price' => 25000],
            ['name' => 'Pot Tanaman', 'image' => 'pot-tanaman.png', 'price' => 15000],
        ];

        return view($views[$store], compact('products'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|string',
        ]);

        // Check product stock
        $product = Produk::where('name', $request->name)->first();
        if (!$product || $product->stock < 1) {
            return response()->json(['message' => 'Stok produk ini sudah habis dan tidak dapat ditambahkan ke keranjang.'], 400);
        }

        $cart = session()->get('cart', []);

        $cartItem = [
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
            'quantity' => 1,
        ];

        $found = false;
        foreach ($cart as &$item) {
            if ($item['name'] === $cartItem['name']) {
                // Check if adding 1 more exceeds stock
                if ($item['quantity'] + 1 > $product->stock) {
                    return response()->json(['message' => 'Anda tidak dapat menambahkan produk lebih dari stok yang tersedia.'], 400);
                }
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = $cartItem;
        }

        session()->put('cart', $cart);

        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang']);
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);
        $promoCode = session()->get('promo_code');
        $discount = 0;

        if ($promoCode) {
            $promo = PromoCode::where('code', $promoCode)->where('active', true)->first();
            if ($promo) {
                $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
                $discount = ($promo->discount / 100) * $total;
            } else {
                session()->forget('promo_code');
            }
        }

        return view('cart', compact('discount', 'promoCode'));
    }

    public function applyPromoCode(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|string'
        ]);

        $promoCode = PromoCode::where('code', $request->promo_code)->where('active', true)->first();

        if (!$promoCode) {
            return redirect()->route('cart')->with('error', 'Kode promo tidak valid atau sudah tidak aktif.');
        }

        session()->put('promo_code', $promoCode->code);

        return redirect()->route('cart')->with('success', 'Kode promo berhasil diterapkan.');
    }

    public function updateCart(Request $request, $index, $action)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$index])) {
            if ($action === 'increment') {
                $product = Produk::where('name', $cart[$index]['name'])->first();
                if ($product && $cart[$index]['quantity'] + 1 > $product->stock) {
                    return redirect()->back()->with('error', 'Jumlah produk tidak boleh melebihi stok yang tersedia.');
                }
                $cart[$index]['quantity'] += 1;
            } elseif ($action === 'decrement' && $cart[$index]['quantity'] > 1) {
                $cart[$index]['quantity'] -= 1;
            }

            session()->put('cart', $cart);
        }

        return redirect()->route('cart');
    }

    public function removeFromCart($index)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$index])) {
            unset($cart[$index]);
            $cart = array_values($cart);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart');
    }

    public function showCheckout()
    {
        $cart = session()->get('cart', []);
        $promoCode = session()->get('promo_code');
        $discount = 0;

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang Anda kosong.');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        if ($promoCode) {
            $promo = \App\Models\PromoCode::where('code', $promoCode)->where('active', true)->first();
            if ($promo) {
                $discount = ($promo->discount / 100) * $total;
            } else {
                session()->forget('promo_code');
            }
        }

        $totalAfterDiscount = $total - $discount;

        return view('checkout', compact('cart', 'total', 'discount', 'totalAfterDiscount', 'promoCode'));
    }

    public function processCheckout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|in:cod,transfer',
        ]);

        $cart = session()->get('cart', []);
        $promoCode = session()->get('promo_code');
        $discount = 0;

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang Anda kosong.');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        if ($promoCode) {
            $promo = \App\Models\PromoCode::where('code', $promoCode)->where('active', true)->first();
            if ($promo) {
                $discount = ($promo->discount / 100) * $total;
            } else {
                session()->forget('promo_code');
            }
        }

        $totalAfterDiscount = $total - $discount;

        $status = $request->payment_method === 'transfer' ? 'waiting_for_payment' : 'pending';

        $order = Order::create([
            'user_id' => $user->id,
            'items' => $cart,
            'total' => $totalAfterDiscount,
            'promo_code' => $promoCode,
            'discount_amount' => $discount,
            'status' => $status,
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
        ]);

        // Update stok produk sesuai quantity yang dibeli
        foreach ($cart as $cartItem) {
            $product = Produk::where('name', $cartItem['name'])->first();
            if ($product) {
                $product->stock -= $cartItem['quantity'];
                if ($product->stock < 0) {
                    $product->stock = 0;
                }
                $product->save();
            }
        }

        session()->forget(['cart', 'promo_code']);

        if ($request->payment_method === 'transfer') {
            return redirect()->route('transfer.instructions', $order->id)
                ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan transfer.');
        } else {
            return redirect()->route('order.confirmation', $order->id)
                ->with('success', 'Pesanan berhasil dibuat!');
        }
    }

    public function showOrderConfirmation(Order $order)
    {
        $userId = Auth::id();

        if ($order->user_id !== $userId) {
            abort(403);
        }

        return view('user.order_confirmation', compact('order'));
    }

    public function showTransferInstructions(Order $order)
    {
        $userId = Auth::id();

        if ($order->user_id !== $userId || $order->status !== 'waiting_for_payment') {
            abort(403);
        }

        return view('user.transfer_instructions', compact('order'));
    }

    public function showOrders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.orders', compact('orders'));
    }
}

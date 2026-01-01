<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Statistik dasar untuk admin
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $waitingForPaymentOrders = Order::where('status', 'waiting_for_payment')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $completedOrders = Order::where('status', 'completed')->count();

        // Pesanan terbaru (5 terakhir)
        $recentOrders = Order::orderBy('created_at', 'desc')->take(5)->get();

        // Pesanan menunggu pembayaran
        $waitingForPaymentOrders = Order::where('status', 'waiting_for_payment')->orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact(
            'user',
            'totalOrders',
            'pendingOrders',
            'waitingForPaymentOrders',
            'processingOrders',
            'shippedOrders',
            'completedOrders',
            'recentOrders'
        ));
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:pending,waiting_for_payment,processing,shipped,completed',
            'courier_id' => 'nullable|exists:couriers,id',
        ]);

        $order = Order::findOrFail($orderId);

        // Check if courier is already assigned to another active order
        if ($request->has('courier_id') && $request->courier_id) {
            $existingOrder = Order::where('courier_id', $request->courier_id)
                ->whereIn('status', ['processing', 'shipped'])
                ->where('id', '!=', $orderId)
                ->first();

            if ($existingOrder) {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'Kurir ini sudah ditugaskan untuk pesanan lain yang sedang aktif.');
            }
        }

        $order->status = $request->status;
        if ($request->has('courier_id')) {
            $order->courier_id = $request->courier_id;
        }
        $order->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function updateStoreDetails(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_address' => 'required|string|max:500',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->store_name = $request->store_name;
        $user->store_address = $request->store_address;
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Detail toko berhasil diperbarui.');
    }
}

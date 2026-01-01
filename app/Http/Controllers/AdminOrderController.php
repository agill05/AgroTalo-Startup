<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'courier')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $orderId)
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
                return redirect()->back()
                    ->with('error', 'Kurir ini sudah ditugaskan untuk pesanan lain yang sedang aktif.');
            }
        }

        $order->status = $request->status;
        if ($request->has('courier_id')) {
            $order->courier_id = $request->courier_id;
        }
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}

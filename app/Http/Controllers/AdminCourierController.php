<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
use App\Models\Order;

class AdminCourierController extends Controller
{
    public function index()
    {
        $couriers = Courier::all();
        return view('admin.couriers.index', compact('couriers'));
    }

    public function create()
    {
        return view('admin.couriers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Courier::create($request->all());

        return redirect()->route('admin.couriers.index')->with('success', 'Kurir berhasil ditambahkan.');
    }

    public function show(Courier $courier)
    {
        // Get courier statistics
        $totalDeliveries = Order::where('courier_id', $courier->id)
            ->where('status', 'completed')
            ->count();

        $currentDeliveries = Order::where('courier_id', $courier->id)
            ->whereIn('status', ['processing', 'shipped'])
            ->count();

        $totalEarnings = Order::where('courier_id', $courier->id)
            ->where('status', 'completed')
            ->sum('total');

        // Calculate salary (assuming 10% commission per delivery)
        $salary = $totalEarnings * 0.1;

        $recentDeliveries = Order::where('courier_id', $courier->id)
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.couriers.show', compact(
            'courier',
            'totalDeliveries',
            'currentDeliveries',
            'totalEarnings',
            'salary',
            'recentDeliveries'
        ));
    }

    public function edit(Courier $courier)
    {
        return view('admin.couriers.edit', compact('courier'));
    }

    public function update(Request $request, Courier $courier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $courier->update($request->all());

        return redirect()->route('admin.couriers.index')->with('success', 'Kurir berhasil diperbarui.');
    }

    public function destroy(Courier $courier)
    {
        $courier->delete();

        return redirect()->route('admin.couriers.index')->with('success', 'Kurir berhasil dihapus.');
    }
}

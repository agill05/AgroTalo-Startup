<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Statistik dasar
        $totalOrders = Order::where('user_id', $user->id)->count();
        $totalSpent = Order::where('user_id', $user->id)->sum('total');
        $pendingOrders = Order::where('user_id', $user->id)->where('status', 'pending')->count();
        $completedOrders = Order::where('user_id', $user->id)->where('status', 'completed')->count();

        // Pesanan terbaru (5 terakhir)
        $recentOrders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Produk yang sering dibeli (top 5)
        $frequentProducts = collect();
        $orders = Order::where('user_id', $user->id)->get();
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $productName = $item['name'];
                $quantity = $item['quantity'];
                if ($frequentProducts->has($productName)) {
                    $frequentProducts[$productName] += $quantity;
                } else {
                    $frequentProducts[$productName] = $quantity;
                }
            }
        }
        $frequentProducts = $frequentProducts->sortDesc()->take(5);

        return view('user.dashboard', compact(
            'user',
            'totalOrders',
            'totalSpent',
            'pendingOrders',
            'completedOrders',
            'recentOrders',
            'frequentProducts'
        ));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $message = 'Profil berhasil diperbarui!';

        // Hapus foto profil jika diminta
        if ($request->has('delete_profile_image') && $user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
            $user->profile_image = null;
            $message = 'Foto profil berhasil dihapus!';
        }

        // Upload foto profil jika ada
        if ($request->hasFile('profile_image')) {
            // Hapus foto lama jika ada
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
            $message = 'Foto profil berhasil diperbarui!';
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->date_of_birth = $request->date_of_birth;
        $user->gender = $request->gender;
        $user->save();

        return redirect()->route('profile.edit')->with('success', $message);
    }
}

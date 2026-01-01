<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $popularProducts = Produk::where('is_popular', true)->take(3)->get();
        return view('index', compact('popularProducts'));
    }

    public function chat()
    {
        return view('chat');
    }
}

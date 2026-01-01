<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipsController extends Controller
{
    public function index()
    {
        return view('tips');
    }

    public function show($id)
    {
        $views = [
            1 => 'tips.tips1',
            2 => 'tips.tips2',
            3 => 'tips.tips3',
        ];

        if (!array_key_exists($id, $views)) {
            abort(404);
        }

        return view($views[$id]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Collection;

class ShopController extends Controller
{
    public function index()
    {
        $collections = Collection::latest()->paginate(4);

        return view('shop', compact('collections'));
    }
}
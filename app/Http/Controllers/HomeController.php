<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $collections = \App\Models\Collection::latest()->paginate(4);

        return view('home',compact('collections'));
    }   
}
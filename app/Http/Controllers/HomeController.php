<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $collections =  Collection::latest()->paginate(4);

        return view('home',compact('collections'));
    }   
}
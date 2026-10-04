<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/collections', function () {
    return view('collections');
})->name('collections');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/shop', function () {
    return view('shop');
})->name('shop');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');
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

Route::get('/category/{slug}', function (string $slug) {

    $categories = [
        'rings' => [
            'name' => 'Rings',
            'image' => 'build/rings.avif',
        ],

        'ear-rings' => [
            'name' => 'Ear Rings',
            'image' => 'build/ear-rings.avif',
        ],

        'bracelets' => [
            'name' => 'Bracelets',
            'image' => 'build/bracelets.avif',
        ],

        'necklace' => [
            'name' => 'Necklace',
            'image' => 'build/necklace.avif',
        ],
    ];

    abort_unless(isset($categories[$slug]), 404);

    return view('category', [
        'category' => $categories[$slug],
        'slug' => $slug,
    ]);

})->name('category.show');

Route::get('/contact-us', function () {
    return view('contact-us');
})->name('contact-us');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/shop', function () {
    return view('shop');
})->name('shop');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');
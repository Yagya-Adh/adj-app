<?php

namespace App\Http\Controllers;

use App\Models\Collection;

class CollectionController extends Controller
{
    public function index()
    {
        //
    }

    public function show(string $slug)
    {
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

        $slug = strtolower($slug);

        abort_unless(isset($categories[$slug]), 404);

        $category = $categories[$slug];

        $collections = Collection::whereRaw(
            'LOWER(category) = ?',
            [strtolower($category['name'])]
        )->get();

        return view('category', [
            'category' => $category,
            'collections' => $collections,
            'slug' => $slug,
        ]);
    }

    public function only_read(string $slug, int $id)
    {
        $collection = Collection::findOrFail($id);

        return view('only-read', [
            'collection' => $collection,
            'slug' => $slug,
        ]);
    }
}
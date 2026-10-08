<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
     
public function show(string $slug)
{
    $categories = [
        'rings' => [
            'name' => 'Rings',
            'db' => ['rings'],
            'image' => 'build/rings.avif',
        ],
        'ear-rings' => [
            'name' => 'Ear Rings',
            'db' => ['earrings', 'ear rings', 'ear-rings'],
            'image' => 'build/ear-rings.avif',
        ],
        'bracelets' => [
            'name' => 'Bracelets',
            'db' => ['bracelets'],
            'image' => 'build/bracelets.avif',
        ],
        'necklace' => [
            'name' => 'Necklace',
            'db' => ['necklace', 'necklaces'],
            'image' => 'build/necklace.avif',
        ],
    ];

    $slug = strtolower(trim($slug));

    abort_unless(isset($categories[$slug]), 404);

    $category = $categories[$slug];

    $collections = Collection::whereIn(
        DB::raw('LOWER(TRIM(category))'),
        $category['db']
    )->get();

    return view('category', compact(
        'category',
        'collections',
        'slug'
    ));
}

    public function only_read(string $slug, int $id)
    {
        $collection = Collection::findOrFail($id);

        return view('only-read', compact(
            'collection',
            'slug'
        ));
    }
}
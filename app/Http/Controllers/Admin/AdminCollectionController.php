<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminCollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::latest()->paginate(10);

        return view('admin.collection.index', compact('collections'));
    }

    public function create()
    {
        return view('admin.collection.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:collections,sku',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'fullprice' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'is_sale' => 'nullable|boolean',
            'gold_karats' => 'nullable|numeric',
            'diamond_weight' => 'nullable|numeric',
            'gold_color' => 'nullable|string|max:255',
            'stock_status' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,avif,svg|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if (Collection::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] .= '-' . Str::lower(Str::random(6));
        }

        $validated['is_sale'] = $request->boolean('is_sale');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('collections', 'public');
        }

        Collection::create($validated);

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Collection created successfully.');
    }

    public function show(string $id)
    {
        $collection = Collection::findOrFail($id);

        return view('admin.collection.show', compact('collection'));
    }

    public function edit(string $id)
    {
        $collection = Collection::findOrFail($id);

        return view('admin.collection.edit', compact('collection'));
    }

    public function update(Request $request, string $id)
    {
        $collection = Collection::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:collections,sku,' . $collection->id,
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',

            'fullprice' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'price' => 'nullable|numeric',

            'is_sale' => 'nullable|boolean',

            'gold_karats' => 'nullable|numeric',
            'diamond_weight' => 'nullable|numeric',

            'gold_color' => 'nullable|string|max:255',
            'stock_status' => 'nullable|string|max:255',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,avif,svg|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if (
            Collection::where('slug', $validated['slug'])
                ->where('id', '!=', $collection->id)
                ->exists()
        ) {
            $validated['slug'] .= '-' . Str::lower(Str::random(6));
        }

        $validated['is_sale'] = $request->boolean('is_sale');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('collections', 'public');
        }

        $collection->update($validated);

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Collection updated successfully.');
    }

    public function destroy(string $id)
    {
        $collection = Collection::findOrFail($id);

        if ($collection->image) {
             Storage::disk('public')->delete($collection->image);
        }

        $collection->delete();

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Collection deleted successfully.');
    }
}
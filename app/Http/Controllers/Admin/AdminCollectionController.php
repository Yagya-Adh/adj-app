<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminCollectionController extends Controller
{
    /**
     * Display collections.
     */
    public function index()
    {
        $collections = Collection::latest()->paginate(10);

        return view('admin.collection.index', compact('collections'));
    }

    /**
     * Show the create form.
     */
    public function create()
    {
        return view('admin.collection.create');
    }

    /**
     * Store a new collection.
     */
    public function store(Request $request)
    {
        $validated = $this->validateCollection($request);

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['name']
        );

        $this->calculatePrice($request, $validated);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('collections', 'public');
        }

        Collection::create($validated);

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Collection created successfully.');
    }

    /**
     * Display a collection.
     */
    public function show(string $id)
    {
        $collection = Collection::findOrFail($id);

        return view('admin.collection.show', compact('collection'));
    }

    /**
     * Show the edit form.
     */
    public function edit(string $id)
    {
        $collection = Collection::findOrFail($id);

        return view('admin.collection.edit', compact('collection'));
    }

    /**
     * Update a collection.
     */
    public function update(Request $request, string $id)
    {
        $collection = Collection::findOrFail($id);

        $validated = $this->validateCollection(
            $request,
            $collection
        );

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['name'],
            $collection->id
        );

        $this->calculatePrice($request, $validated);

        $oldImage = $collection->image;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('collections', 'public');
        }

        $collection->update($validated);

        if (
            $request->hasFile('image') &&
            $oldImage
        ) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Collection updated successfully.');
    }

    /**
     * Delete a collection and its image.
     */
    public function destroy(string $id)
    {
        $collection = Collection::findOrFail($id);
        $image = $collection->image;

        $collection->delete();

        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Collection deleted successfully.');
    }

    /**
     * Validate collection data.
     */
    private function validateCollection(
        Request $request,
        ?Collection $collection = null
    ): array {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'sku' => [
                'required',
                'string',
                'max:255',
                Rule::unique('collections', 'sku')
                    ->ignore($collection?->id),
            ],

            'description' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:255'],

            'fullprice' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0', 'max:100'],
            'is_sale' => ['sometimes', 'boolean'],

            'jewelry_type' => [
                'required',
                Rule::in([
                    'gold',
                    'silver',
                    'diamond',
                    'platinum',
                    'other',
                ]),
            ],

            'jewelry_purity' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'jewelry_weight' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'weight_unit' => [
                'required',
                Rule::in(['g', 'mg', 'ct']),
            ],

            'gold_color' => [
                'nullable',
                Rule::in(['yellow', 'white', 'rose']),
                Rule::requiredIf(
                    $request->input('jewelry_type') === 'gold'
                ),
            ],

            'stock_status' => [
                'required',
                Rule::in([
                    'in_stock',
                    'out_of_stock',
                    'pre_order',
                ]),
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,gif,webp,avif',
                'max:2048',
            ],
        ]);
    }

    /**
     * Calculate the sale price on the server.
     */
    private function calculatePrice(
        Request $request,
        array &$validated
    ): void {
        $isSale = $request->boolean('is_sale');

        $fullPrice = (float) $validated['fullprice'];

        $discount = $isSale
            ? (float) $validated['discount']
            : 0;

        $validated['is_sale'] = $isSale;
        $validated['discount'] = $discount;
        $validated['price'] = round(
            $fullPrice - ($fullPrice * $discount / 100),
            2
        );
    }

    /**
     * Generate a unique slug.
     */
    private function generateUniqueSlug(
        string $name,
        ?int $ignoreId = null
    ): string {
        $baseSlug = Str::slug($name) ?: 'collection';
        $slug = $baseSlug;
        $counter = 1;

        while (
            Collection::where('slug', $slug)
                ->when(
                    $ignoreId !== null,
                    fn ($query) => $query->where(
                        'id',
                        '!=',
                        $ignoreId
                    )
                )
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug;
    }
}
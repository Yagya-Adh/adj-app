<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);

        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'customer' => 'nullable|string|max:255',
            'customer_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'media' => 'nullable|array',
            'media.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('blogs', 'public');
        }

        if ($request->hasFile('customer_image')) {
            $validated['customer_image'] = $request->file('customer_image')
                ->store('blogs/customers', 'public');
        }

        if ($request->hasFile('media')) {
            $validated['media'] = collect($request->file('media'))
                ->map(fn ($file) => $file->store('blogs/media', 'public'))
                ->values()
                ->toArray();
        }

        Blog::create($validated);

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog created successfully.');
    }

    public function show(Blog $blog)
    {
        return view('admin.blog.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'customer' => 'nullable|string|max:255',
            'customer_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'media' => 'nullable|array',
            'media.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'remove_media' => 'nullable|array',
            'remove_media.*' => 'string',
        ]);

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['title'],
            $blog->id
        );

        if ($request->hasFile('image')) {
            $this->deleteFile($blog->image);

            $validated['image'] = $request->file('image')
                ->store('blogs', 'public');
        }

        if ($request->hasFile('customer_image')) {
            $this->deleteFile($blog->customer_image);

            $validated['customer_image'] = $request->file('customer_image')
                ->store('blogs/customers', 'public');
        }

        $media = $blog->media ?? [];

        if ($request->filled('remove_media')) {
            foreach ($request->remove_media as $file) {
                if (in_array($file, $media)) {
                    $this->deleteFile($file);
                }
            }

            $media = array_values(
                array_diff($media, $request->remove_media)
            );
        }

        if ($request->hasFile('media')) {
            $newMedia = collect($request->file('media'))
                ->map(fn ($file) => $file->store('blogs/media', 'public'))
                ->values()
                ->toArray();

            $media = array_merge($media, $newMedia);
        }

        $validated['media'] = $media ?: null;

        $blog->update($validated);

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $this->deleteFile($blog->image);
        $this->deleteFile($blog->customer_image);

        foreach ($blog->media ?? [] as $file) {
            $this->deleteFile($file);
        }

        $blog->delete();

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog deleted successfully.');
    }

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (
            Blog::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
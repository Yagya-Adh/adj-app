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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'author' => ['nullable', 'string', 'max:255'],

            'author_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'media' => ['required', 'in:image,video'],

            'image' => [
                'nullable',
                'required_if:media,image',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'video' => [
                'nullable',
                'required_if:media,video',
                'file',
                'mimes:mp4,webm,mov,avi',
                'max:102400',
            ],
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['title']);

        if ($request->hasFile('author_image')) {
            $validated['author_image'] = $request
                ->file('author_image')
                ->store('blogs/authors', 'public');
        }

        if ($validated['media'] === 'image') {
            $validated['image'] = $request
                ->file('image')
                ->store('blogs', 'public');

            $validated['video'] = null;
        } else {
            $validated['video'] = $request
                ->file('video')
                ->store('blogs/videos', 'public');

            $validated['image'] = null;
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'author' => ['nullable', 'string', 'max:255'],

            'author_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'media' => ['required', 'in:image,video'],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'video' => [
                'nullable',
                'file',
                'mimes:mp4,webm,mov,avi',
                'max:102400',
            ],
        ]);

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['title'],
            $blog->id
        );

        if ($request->hasFile('author_image')) {
            $this->deleteFile($blog->author_image);

            $validated['author_image'] = $request
                ->file('author_image')
                ->store('blogs/authors', 'public');
        } else {
            $validated['author_image'] = $blog->author_image;
        }

        if ($validated['media'] === 'image') {
            $this->deleteFile($blog->video);
            $validated['video'] = null;

            if ($request->hasFile('image')) {
                $this->deleteFile($blog->image);

                $validated['image'] = $request
                    ->file('image')
                    ->store('blogs', 'public');
            } else {
                $validated['image'] = $blog->image;
            }
        } else {
            $this->deleteFile($blog->image);
            $validated['image'] = null;

            if ($request->hasFile('video')) {
                $this->deleteFile($blog->video);

                $validated['video'] = $request
                    ->file('video')
                    ->store('blogs/videos', 'public');
            } else {
                $validated['video'] = $blog->video;
            }
        }

        $blog->update($validated);

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $this->deleteFile($blog->image);
        $this->deleteFile($blog->video);
        $this->deleteFile($blog->author_image);

        $blog->delete();

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog deleted successfully.');
    }

    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (
            Blog::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where('id', '!=', $ignoreId)
                )
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
@extends('layouts.app')

@section('adminContent')

<section class="mx-auto max-w-7xl px-4 py-8">
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900">Blog</h1>
        <p class="mt-1 text-sm text-gray-500">Manage your jewellery blog posts.</p>
    </div>

    <a href="{{ route('admin.blog.create') }}"
       class="rounded-xl bg-black px-5 py-3 text-sm font-semibold text-white hover:bg-gray-800">
        + Create Blog
    </a>
</div>

@if(session('success'))
    <div class="mb-5 rounded-xl bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
    <div class="overflow-x-auto">

        <table class="w-full min-w-[1000px] text-left text-sm">

            <thead class="border-b bg-gray-50">
                <tr>
                    <th class="px-5 py-4 font-semibold text-gray-700">Blog</th>
                    <th class="px-5 py-4 font-semibold text-gray-700">Slug</th>
                    <th class="px-5 py-4 font-semibold text-gray-700">Customer</th>
                    <th class="px-5 py-4 font-semibold text-gray-700">Description</th>
                    <th class="px-5 py-4 text-center font-semibold text-gray-700">Media</th>
                    <th class="px-5 py-4 text-right font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($blogs as $blog)

                    <tr class="hover:bg-gray-50">

                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">

                                @if($blog->image)
                                    <button
                                        onclick="preview('{{ asset('storage/'.$blog->image) }}','{{ addslashes($blog->title) }}')"
                                        class="h-14 w-14 shrink-0 overflow-hidden rounded-xl"
                                    >
                                        <img
                                            src="{{ asset('storage/'.$blog->image) }}"
                                            class="h-full w-full object-cover transition hover:scale-110"
                                            alt="{{ $blog->title }}"
                                        >
                                    </button>
                                @else
                                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gray-100 text-xs text-gray-400">
                                        No Image
                                    </div>
                                @endif

                                <div class="min-w-0">
                                    <p class="truncate font-medium text-gray-900">
                                        {{ $blog->title }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        {{ $blog->created_at?->format('M d, Y') }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <td class="px-5 py-4">
                            <span class="rounded-lg bg-gray-100 px-3 py-1 text-xs">
                                {{ $blog->slug }}
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">

                                @if($blog->customer_image)
                                    <img
                                        src="{{ asset('storage/'.$blog->customer_image) }}"
                                        class="h-9 w-9 rounded-full object-cover"
                                        alt="{{ $blog->customer }}"
                                    >
                                @else
                                    <div class="h-9 w-9 rounded-full bg-gray-100"></div>
                                @endif

                                <span class="max-w-[140px] truncate">
                                    {{ $blog->customer ?: '—' }}
                                </span>

                            </div>
                        </td>

                        <td class="px-5 py-4">
                            <p class="max-w-md truncate text-gray-500">
                                {{ $blog->description }}
                            </p>
                        </td>

                        <td class="px-5 py-4 text-center">

                            @if($blog->media)
                                <button
                                    onclick='mediaPreview(@json($blog->media),"{{ addslashes($blog->title) }}")'
                                    class="rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-medium hover:bg-gray-200"
                                >
                                    {{ count($blog->media) }} Images
                                </button>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif

                        </td>

                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-2">

                                <a
                                    href="{{ route('admin.blog.edit',$blog) }}"
                                    class="rounded-lg border px-3 py-2 text-xs hover:bg-gray-100"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.blog.destroy',$blog) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this blog?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="rounded-lg border border-red-200 px-3 py-2 text-xs text-red-600 hover:bg-red-50"
                                    >
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="px-5 py-16 text-center">
                            <p class="font-medium text-gray-700">No blog posts found.</p>

                            <a
                                href="{{ route('admin.blog.create') }}"
                                class="mt-4 inline-block rounded-xl bg-black px-5 py-3 text-sm font-semibold text-white"
                            >
                                Create Blog
                            </a>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>
</div>

@if($blogs->hasPages())
    <div class="mt-6">
        {{ $blogs->links() }}
    </div>
@endif
</section>

<div
    id="previewModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 p-4"
    onclick="closePreview(event)"
>
    <div class="relative max-w-5xl">
    <button
        onclick="closePreview()"
        class="absolute -right-3 -top-3 z-10 h-9 w-9 rounded-full bg-white text-gray-700 shadow"
    >
        ✕
    </button>

    <img
        id="previewImage"
        class="max-h-[85vh] max-w-full rounded-2xl object-contain"
        onclick="event.stopPropagation()"
    >

    <p id="previewTitle" class="mt-3 text-center text-sm text-white"></p>

</div>
</div>

<div
    id="mediaModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 p-4"
    onclick="closeMedia(event)"
>
    <div class="w-full max-w-5xl rounded-2xl bg-white p-5">
    <div class="mb-4 flex items-center justify-between">
        <h2 id="mediaTitle" class="font-semibold"></h2>

        <button
            onclick="closeMedia()"
            class="h-8 w-8 rounded-full bg-gray-100"
        >
            ✕
        </button>
    </div>

    <div
        id="mediaGrid"
        class="grid max-h-[70vh] grid-cols-2 gap-3 overflow-y-auto sm:grid-cols-3 lg:grid-cols-4"
        onclick="event.stopPropagation()"
    ></div>

</div>
</div>

<script>
    const storage = @json(asset('storage'));

    function preview(src, title = '') {
        document.getElementById('previewImage').src = src;
        document.getElementById('previewTitle').textContent = title;
        show('previewModal');
    }

    function mediaPreview(files, title = '') {
        const grid = document.getElementById('mediaGrid');

        grid.innerHTML = files.map(file => `
            <button
                onclick="preview('${storage}/${file}','${title.replace(/'/g,"\\'")}')"
                class="aspect-square overflow-hidden rounded-xl bg-gray-100"
            >
                <img
                    src="${storage}/${file}"
                    class="h-full w-full object-cover hover:scale-105 transition"
                >
            </button>
        `).join('');

        document.getElementById('mediaTitle').textContent = title;
        show('mediaModal');
    }

    function show(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById(id).classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function hide(id) {
        document.getElementById(id).classList.add('hidden');
        document.getElementById(id).classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    function closePreview(e) {
        if (!e || e.target === e.currentTarget) hide('previewModal');
    }

    function closeMedia(e) {
        if (!e || e.target === e.currentTarget) hide('mediaModal');
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            hide('previewModal');
            hide('mediaModal');
        }
    });
</script>

@endsection

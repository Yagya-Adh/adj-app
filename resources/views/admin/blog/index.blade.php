@extends('layouts.app')

@section('adminContent')

<section class="mx-auto max-w-7xl px-4 py-8">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Blog</h1>
            <p class="mt-1 text-sm text-gray-500">
                Manage your jewellery blog posts.
            </p>
        </div>

        <a
            href="{{ route('admin.blog.create') }}"
            class="rounded-xl bg-black px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-800"
        >
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
                        <th class="px-5 py-4 font-semibold text-gray-700">Author</th>
                        <th class="px-5 py-4 font-semibold text-gray-700">Description</th>
                        <th class="px-5 py-4 text-center font-semibold text-gray-700">Media</th>
                        <th class="px-5 py-4 text-right font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse($blogs as $blog)

                        <tr class="transition hover:bg-gray-50">

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">

                                    @if($blog->media === 'video' && $blog->video)

                                        <button
                                            type="button"
                                            onclick="previewVideo('{{ asset('storage/'.$blog->video) }}', '{{ addslashes($blog->title) }}')"
                                            class="relative h-14 w-14 shrink-0 overflow-hidden rounded-xl bg-gray-900"
                                        >
                                            <video
                                                src="{{ asset('storage/'.$blog->video) }}"
                                                muted
                                                preload="metadata"
                                                class="h-full w-full object-cover"
                                            ></video>

                                            <span class="absolute inset-0 flex items-center justify-center bg-black/30">
                                                <span class="flex h-7 w-7 items-center justify-center rounded-full bg-white text-gray-900">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="ml-0.5 h-4 w-4"
                                                        viewBox="0 0 24 24"
                                                        fill="currentColor"
                                                    >
                                                        <path d="M8 5v14l11-7z"/>
                                                    </svg>
                                                </span>
                                            </span>
                                        </button>

                                    @elseif($blog->image)

                                        <button
                                            type="button"
                                            onclick="previewImage('{{ asset('storage/'.$blog->image) }}', '{{ addslashes($blog->title) }}')"
                                            class="h-14 w-14 shrink-0 overflow-hidden rounded-xl"
                                        >
                                            <img
                                                src="{{ asset('storage/'.$blog->image) }}"
                                                class="h-full w-full object-cover transition duration-300 hover:scale-110"
                                                alt="{{ $blog->title }}"
                                            >
                                        </button>

                                    @else

                                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-xs text-gray-400">
                                            No Media
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

                                    @if($blog->author_image)
                                        <img
                                            src="{{ asset('storage/'.$blog->author_image) }}"
                                            class="h-9 w-9 rounded-full object-cover"
                                            alt="{{ $blog->author }}"
                                        >
                                    @else
                                        <div class="h-9 w-9 rounded-full bg-gray-100"></div>
                                    @endif

                                    <span class="max-w-[140px] truncate">
                                        {{ $blog->author ?: '—' }}
                                    </span>

                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <p class="max-w-md truncate text-gray-500">
                                    {{ $blog->description }}
                                </p>
                            </td>

                            <td class="px-5 py-4 text-center">

                                @if($blog->media === 'video')

                                    <button
                                        type="button"
                                        onclick="previewVideo('{{ asset('storage/'.$blog->video) }}', '{{ addslashes($blog->title) }}')"
                                        class="inline-flex items-center gap-1 rounded-lg bg-purple-100 px-3 py-1.5 text-xs font-medium text-purple-700 transition hover:bg-purple-200"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                        >
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                        Video
                                    </button>

                                @elseif($blog->media === 'image')

                                    <button
                                        type="button"
                                        onclick="previewImage('{{ asset('storage/'.$blog->image) }}', '{{ addslashes($blog->title) }}')"
                                        class="inline-flex items-center gap-1 rounded-lg bg-blue-100 px-3 py-1.5 text-xs font-medium text-blue-700 transition hover:bg-blue-200"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                        >
                                            <path d="M4 5h16v14H4z"/>
                                            <path d="m7 16 3-4 2 3 2-2 3 3z"/>
                                        </svg>
                                        Image
                                    </button>

                                @else
                                    <span class="text-gray-400">—</span>
                                @endif

                            </td>

                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('admin.blog.edit', $blog) }}"
                                        class="rounded-lg border px-3 py-2 text-xs transition hover:bg-gray-100"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.blog.destroy', $blog) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this blog?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg border border-red-200 px-3 py-2 text-xs text-red-600 transition hover:bg-red-50"
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
                                <p class="font-medium text-gray-700">
                                    No blog posts found.
                                </p>

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
    <div class="relative w-full max-w-5xl">

        <button
            type="button"
            onclick="closePreview()"
            class="absolute -right-3 -top-3 z-10 flex h-9 w-9 items-center justify-center rounded-full bg-white text-gray-700 shadow transition hover:bg-gray-100"
        >
            ✕
        </button>

        <div class="overflow-hidden rounded-2xl bg-black">

            <img
                id="previewImage"
                class="hidden max-h-[85vh] w-full object-contain"
                alt=""
            >

            <video
                id="previewVideo"
                class="hidden max-h-[85vh] w-full object-contain"
                controls
                playsinline
            ></video>

        </div>

        <p
            id="previewTitle"
            class="mt-3 text-center text-sm text-white"
        ></p>

    </div>
</div>

<script>
    const modal = document.getElementById('previewModal');
    const image = document.getElementById('previewImage');
    const video = document.getElementById('previewVideo');
    const title = document.getElementById('previewTitle');

    function openPreview() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function previewImage(src, blogTitle = '') {
        video.pause();
        video.removeAttribute('src');
        video.load();

        video.classList.add('hidden');

        image.src = src;
        image.alt = blogTitle;
        image.classList.remove('hidden');

        title.textContent = blogTitle;

        openPreview();
    }

    function previewVideo(src, blogTitle = '') {
        image.removeAttribute('src');
        image.classList.add('hidden');

        video.src = src;
        video.classList.remove('hidden');

        title.textContent = blogTitle;

        openPreview();
    }

    function closePreview(event) {
        if (event && event.target !== event.currentTarget) {
            return;
        }

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        video.pause();
        video.removeAttribute('src');
        video.load();

        image.removeAttribute('src');

        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            closePreview();
        }
    });
</script>

@endsection
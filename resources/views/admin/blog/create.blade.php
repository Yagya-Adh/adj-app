@extends('layouts.app')

@section('adminContent')

<section class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

    <div class="mb-8 flex items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <a
                href="{{ route('admin.blog.index') }}"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-500 transition hover:bg-gray-100 hover:text-gray-900"
                aria-label="Back"
            >
                ←
            </a>

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-gray-400">
                    Journal
                </p>

                <h1 class="mt-1 text-2xl font-semibold text-gray-900">
                    Create Blog
                </h1>
            </div>
        </div>

        <a
            href="{{ route('admin.blog.index') }}"
            class="hidden rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 sm:block"
        >
            Cancel
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">
            <p class="text-sm font-semibold text-red-700">
                Please fix the following errors.
            </p>

            <ul class="mt-2 space-y-1 text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.blog.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_340px]">

            <div class="space-y-6">

                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

                    <div class="mb-7">
                        <span class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-400">
                            Article
                        </span>

                        <h2 class="mt-2 text-xl font-semibold text-gray-900">
                            Blog Content
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Write the main content of your journal article.
                        </p>
                    </div>

                    <div class="space-y-6">

                        <div>
                            <label
                                for="title"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Title
                            </label>

                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="Enter an engaging blog title"
                                required
                                class="w-full rounded-2xl border border-gray-200 px-4 py-3.5 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-gray-900 focus:ring-4 focus:ring-gray-900/5"
                            >
                        </div>

                        <div>
                            <div class="mb-2 flex items-center justify-between">
                                <label
                                    for="description"
                                    class="text-sm font-semibold text-gray-700"
                                >
                                    Description
                                </label>

                                <span class="text-xs text-gray-400">
                                    Blog content
                                </span>
                            </div>

                            <textarea
                                id="description"
                                name="description"
                                rows="15"
                                required
                                placeholder="Start writing your story..."
                                class="w-full resize-y rounded-2xl border border-gray-200 px-4 py-4 text-sm leading-7 text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-gray-900 focus:ring-4 focus:ring-gray-900/5"
                            >{{ old('description') }}</textarea>
                        </div>

                    </div>
                </div>

                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

                    <div class="mb-6">
                        <span class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-400">
                            Optional
                        </span>

                        <h2 class="mt-2 text-xl font-semibold text-gray-900">
                            Author
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Add author information for this article.
                        </p>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">

                        <div>
                            <label
                                for="author"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Author Name
                            </label>

                            <input
                                type="text"
                                id="author"
                                name="author"
                                value="{{ old('author') }}"
                                placeholder="Author name"
                                class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-gray-900 focus:ring-4 focus:ring-gray-900/5"
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Author Image
                            </label>

                            <label
                                for="author_image"
                                class="flex cursor-pointer items-center gap-3 rounded-2xl border border-gray-200 bg-gray-50 p-3 transition hover:border-gray-400"
                            >

                                <div
                                    id="authorPlaceholder"
                                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-white text-gray-400 shadow-sm"
                                >
                                    👤
                                </div>

                                <img
                                    id="authorPreview"
                                    class="hidden h-12 w-12 shrink-0 rounded-full object-cover"
                                    alt="Author preview"
                                >

                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-700">
                                        Upload photo
                                    </p>

                                    <p class="mt-1 text-xs text-gray-400">
                                        JPG, PNG, WEBP · 2MB
                                    </p>
                                </div>

                                <input
                                    type="file"
                                    id="author_image"
                                    name="author_image"
                                    accept=".jpg,.jpeg,.png,.webp"
                                    class="hidden"
                                    onchange="previewImage(this,'authorPreview','authorPlaceholder')"
                                >
                            </label>
                        </div>

                    </div>
                </div>

            </div>

            <aside class="space-y-6">

                <div class="rounded-3xl border border-gray-200 bg-white p-5 shadow-sm">

                    <div class="mb-5">
                        <span class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-400">
                            Cover
                        </span>

                        <h2 class="mt-2 font-semibold text-gray-900">
                            Featured Media
                        </h2>

                        <p class="mt-1 text-xs leading-5 text-gray-500">
                            Upload an image or video based on the selected media type.
                        </p>
                    </div>

                    <div id="imageUpload">

                        <label
                            for="image"
                            class="group relative block cursor-pointer overflow-hidden rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 transition hover:border-gray-400"
                        >

                            <div
                                id="imagePlaceholder"
                                class="flex aspect-[4/5] flex-col items-center justify-center p-6 text-center"
                            >
                                <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-2xl shadow-sm">
                                    +
                                </div>

                                <p class="text-sm font-semibold text-gray-700">
                                    Upload image
                                </p>

                                <p class="mt-2 text-xs leading-5 text-gray-400">
                                    JPG, JPEG, PNG or WEBP
                                    <br>
                                    Maximum 5MB
                                </p>
                            </div>

                            <img
                                id="imagePreview"
                                class="hidden aspect-[4/5] w-full object-cover"
                                alt="Blog image preview"
                            >

                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/jpeg,image/png,image/webp"
                                class="hidden"
                                onchange="previewImage(this,'imagePreview','imagePlaceholder')"
                            >

                        </label>

                    </div>

                    <div id="videoUpload" class="hidden">

                        <label
                            for="video"
                            class="group relative block cursor-pointer overflow-hidden rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 transition hover:border-purple-400"
                        >

                            <div
                                id="videoPlaceholder"
                                class="flex aspect-[4/5] flex-col items-center justify-center p-6 text-center"
                            >
                                <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-50 text-purple-600 shadow-sm">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-7 w-7"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                    >
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>

                                <p class="text-sm font-semibold text-gray-700">
                                    Upload video
                                </p>

                                <p class="mt-2 text-xs leading-5 text-gray-400">
                                    MP4, WEBM, MOV or AVI
                                    <br>
                                    Maximum 50MB
                                </p>
                            </div>

                            <video
                                id="videoPreview"
                                class="hidden aspect-[4/5] w-full object-cover"
                                controls
                                playsinline
                            ></video>

                            <input
                                type="file"
                                id="video"
                                name="video"
                                accept="video/mp4,video/webm,video/quicktime,video/x-msvideo"
                                class="hidden"
                                onchange="previewVideo(this)"
                            >

                        </label>

                    </div>

                </div>

                <div class="rounded-3xl border border-gray-200 bg-white p-5 shadow-sm">

                    <div class="mb-5">
                        <span class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-400">
                            Content Type
                        </span>

                        <h2 class="mt-2 font-semibold text-gray-900">
                            Media Type
                        </h2>

                        <p class="mt-1 text-xs leading-5 text-gray-500">
                            Choose whether this blog post contains an image or video.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-3">

                        <label class="cursor-pointer">
                            <input
                                type="radio"
                                name="media"
                                value="image"
                                class="peer sr-only"
                                {{ old('media', 'image') === 'image' ? 'checked' : '' }}
                                onchange="switchMedia('image')"
                            >

                            <div class="rounded-2xl border-2 border-gray-200 p-4 text-center transition peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-400">

                                <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                    >
                                        <path d="M4 5h16v14H4z"/>
                                        <path d="m7 16 3-4 2 3 2-2 3 3z"/>
                                    </svg>
                                </div>

                                <p class="mt-3 text-sm font-semibold text-gray-800">
                                    Image
                                </p>

                                <p class="mt-1 text-xs text-gray-400">
                                    Image article
                                </p>

                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input
                                type="radio"
                                name="media"
                                value="video"
                                class="peer sr-only"
                                {{ old('media') === 'video' ? 'checked' : '' }}
                                onchange="switchMedia('video')"
                            >

                            <div class="rounded-2xl border-2 border-gray-200 p-4 text-center transition peer-checked:border-purple-500 peer-checked:bg-purple-50 hover:border-gray-400">

                                <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl bg-purple-100 text-purple-600">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                    >
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>

                                <p class="mt-3 text-sm font-semibold text-gray-800">
                                    Video
                                </p>

                                <p class="mt-1 text-xs text-gray-400">
                                    Video article
                                </p>

                            </div>
                        </label>

                    </div>

                </div>

                <div class="rounded-3xl bg-gray-950 p-5 text-white shadow-sm">

                    <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-500">
                        Ready?
                    </p>

                    <h2 class="mt-2 text-lg font-semibold">
                        Publish your story
                    </h2>

                    <p class="mt-1 text-xs leading-5 text-gray-400">
                        Your blog will be added to the journal immediately after submission.
                    </p>

                    <button
                        type="submit"
                        class="mt-5 w-full rounded-xl bg-white px-5 py-3 text-sm font-semibold text-gray-900 transition hover:bg-gray-200"
                    >
                        Create Blog
                    </button>

                </div>

            </aside>

        </div>

        <div class="mt-6 sm:hidden">
            <a
                href="{{ route('admin.blog.index') }}"
                class="block w-full rounded-xl border border-gray-200 bg-white px-5 py-3 text-center text-sm font-semibold text-gray-700"
            >
                Cancel
            </a>
        </div>

    </form>

</section>

<script>
    function previewImage(input, previewId, placeholderId) {
        const file = input.files?.[0];
        const image = document.getElementById(previewId);
        const placeholder = document.getElementById(placeholderId);

        if (!file) return;

        const reader = new FileReader();

        reader.onload = event => {
            image.src = event.target.result;
            image.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };

        reader.readAsDataURL(file);
    }

    function previewVideo(input) {
        const file = input.files?.[0];
        const video = document.getElementById('videoPreview');
        const placeholder = document.getElementById('videoPlaceholder');

        if (!file) return;

        if (video.src) {
            URL.revokeObjectURL(video.src);
        }

        video.src = URL.createObjectURL(file);
        video.classList.remove('hidden');
        placeholder.classList.add('hidden');
    }

    function switchMedia(type) {
        const imageUpload = document.getElementById('imageUpload');
        const videoUpload = document.getElementById('videoUpload');

        const imageInput = document.getElementById('image');
        const videoInput = document.getElementById('video');

        if (type === 'video') {
            imageUpload.classList.add('hidden');
            videoUpload.classList.remove('hidden');

            imageInput.value = '';
        } else {
            videoUpload.classList.add('hidden');
            imageUpload.classList.remove('hidden');

            videoInput.value = '';

            const video = document.getElementById('videoPreview');

            if (video.src) {
                URL.revokeObjectURL(video.src);
                video.removeAttribute('src');
                video.load();
            }

            document
                .getElementById('videoPreview')
                .classList.add('hidden');

            document
                .getElementById('videoPlaceholder')
                .classList.remove('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const selectedMedia = document.querySelector(
            'input[name="media"]:checked'
        );

        switchMedia(selectedMedia?.value || 'image');
    });
</script>

@endsection 
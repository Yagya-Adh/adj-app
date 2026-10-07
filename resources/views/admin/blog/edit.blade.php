@extends('layouts.app')

@section('adminContent')

<section class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

    <div class="mb-8 flex items-center justify-between gap-4">

        <div class="flex items-center gap-3">

            <a
                href="{{ route('admin.blog.index') }}"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-500 transition hover:bg-gray-100 hover:text-gray-900"
            >
                ←
            </a>

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-gray-400">
                    Journal
                </p>

                <h1 class="mt-1 text-2xl font-semibold text-gray-900">
                    Edit Blog
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
        action="{{ route('admin.blog.update', $blog->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

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
                            Update the main content of your journal article.
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
                                value="{{ old('title', $blog->title) }}"
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
                            >{{ old('description', $blog->description) }}</textarea>

                        </div>

                    </div>

                </div>

                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

                    <div class="mb-6">

                        <span class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-400">
                            Author
                        </span>

                        <h2 class="mt-2 text-xl font-semibold text-gray-900">
                            Author Information
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Add or update the author information for this article.
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
                                value="{{ old('author', $blog->author) }}"
                                placeholder="Author name"
                                class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-gray-900 focus:ring-4 focus:ring-gray-900/5"
                            >

                        </div>

                        <div>

                            <label
                                for="author_image"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Author Image
                            </label>

                            <label
                                for="author_image"
                                class="flex cursor-pointer items-center gap-3 rounded-2xl border border-gray-200 bg-gray-50 p-3 transition hover:border-gray-400"
                            >

                                @if($blog->author_image)

                                    <img
                                        id="authorPreview"
                                        src="{{ asset('storage/' . $blog->author_image) }}"
                                        class="h-12 w-12 shrink-0 rounded-full object-cover"
                                        alt="{{ $blog->author }}"
                                    >

                                    <div
                                        id="authorPlaceholder"
                                        class="hidden h-12 w-12 shrink-0 items-center justify-center rounded-full bg-white text-gray-400 shadow-sm"
                                    >
                                        👤
                                    </div>

                                @else

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

                                @endif

                                <div class="min-w-0">

                                    <p class="text-sm font-medium text-gray-700">
                                        Replace photo
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
                            Media
                        </span>

                        <h2 class="mt-2 font-semibold text-gray-900">
                            Blog Media
                        </h2>

                        <p class="mt-1 text-xs leading-5 text-gray-500">
                            Choose whether this article uses an image or video.
                        </p>

                    </div>

                    <div class="grid grid-cols-2 gap-3">

                        <label class="cursor-pointer">
                            <input
                                type="radio"
                                name="media"
                                value="image"
                                class="peer hidden"
                                {{ old('media', $blog->media) === 'image' ? 'checked' : '' }}
                                onchange="switchMedia('image')"
                            >

                            <div class="rounded-xl border border-gray-200 p-3 text-center text-sm font-medium text-gray-600 transition peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:text-blue-700">
                                Image
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input
                                type="radio"
                                name="media"
                                value="video"
                                class="peer hidden"
                                {{ old('media', $blog->media) === 'video' ? 'checked' : '' }}
                                onchange="switchMedia('video')"
                            >

                            <div class="rounded-xl border border-gray-200 p-3 text-center text-sm font-medium text-gray-600 transition peer-checked:border-purple-500 peer-checked:bg-purple-50 peer-checked:text-purple-700">
                                Video
                            </div>
                        </label>

                    </div>

                </div>

                <div
                    id="imageSection"
                    class="{{ old('media', $blog->media) === 'image' ? '' : 'hidden' }} rounded-3xl border border-gray-200 bg-white p-5 shadow-sm"
                >

                    <div class="mb-5">

                        <span class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-400">
                            Cover
                        </span>

                        <h2 class="mt-2 font-semibold text-gray-900">
                            Featured Image
                        </h2>

                        <p class="mt-1 text-xs leading-5 text-gray-500">
                            Upload a new image to replace the current one.
                        </p>

                    </div>

                    <label
                        for="image"
                        class="group relative block cursor-pointer overflow-hidden rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 transition hover:border-gray-400"
                    >

                        @if($blog->image)

                            <div
                                id="imagePlaceholder"
                                class="hidden aspect-[4/5] flex-col items-center justify-center p-6 text-center"
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
                                src="{{ asset('storage/' . $blog->image) }}"
                                class="aspect-[4/5] w-full object-cover"
                                alt="Blog image"
                            >

                        @else

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
                                alt="Blog preview"
                            >

                        @endif

                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="hidden"
                            onchange="previewImage(this,'imagePreview','imagePlaceholder')"
                        >

                    </label>

                </div>

                <div
                    id="videoSection"
                    class="{{ old('media', $blog->media) === 'video' ? '' : 'hidden' }} rounded-3xl border border-gray-200 bg-white p-5 shadow-sm"
                >

                    <div class="mb-5">

                        <span class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-400">
                            Video
                        </span>

                        <h2 class="mt-2 font-semibold text-gray-900">
                            Featured Video
                        </h2>

                        <p class="mt-1 text-xs leading-5 text-gray-500">
                            Upload a new video only if you want to replace the current one.
                        </p>

                    </div>

                    <label
                        for="video"
                        class="block cursor-pointer overflow-hidden rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 transition hover:border-gray-400"
                    >

                        @if($blog->video)

                            <div id="videoPlaceholder" class="hidden aspect-video flex-col items-center justify-center p-6 text-center">
                                <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-2xl shadow-sm">
                                    +
                                </div>

                                <p class="text-sm font-semibold text-gray-700">
                                    Upload video
                                </p>

                                <p class="mt-2 text-xs leading-5 text-gray-400">
                                    MP4, WEBM, MOV or AVI
                                    <br>
                                    Maximum 100MB
                                </p>
                            </div>

                            <video
                                id="videoPreview"
                                src="{{ asset('storage/' . $blog->video) }}"
                                controls
                                class="aspect-video w-full bg-black object-contain"
                            ></video>

                        @else

                            <div
                                id="videoPlaceholder"
                                class="flex aspect-video flex-col items-center justify-center p-6 text-center"
                            >
                                <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-2xl shadow-sm">
                                    ▶
                                </div>

                                <p class="text-sm font-semibold text-gray-700">
                                    Upload video
                                </p>

                                <p class="mt-2 text-xs leading-5 text-gray-400">
                                    MP4, WEBM, MOV or AVI
                                    <br>
                                    Maximum 100MB
                                </p>
                            </div>

                            <video
                                id="videoPreview"
                                class="hidden aspect-video w-full bg-black object-contain"
                                controls
                            ></video>

                        @endif

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

                <div class="rounded-3xl bg-gray-950 p-5 text-white shadow-sm">

                    <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-500">
                        Update
                    </p>

                    <h2 class="mt-2 text-lg font-semibold">
                        Save your changes
                    </h2>

                    <p class="mt-1 text-xs leading-5 text-gray-400">
                        Your changes will be saved immediately after submission.
                    </p>

                    <button
                        type="submit"
                        class="mt-5 w-full rounded-xl bg-white px-5 py-3 text-sm font-semibold text-gray-900 transition hover:bg-gray-200"
                    >
                        Update Blog
                    </button>

                </div>

            </aside>

        </div>

    </form>

    <div class="mt-6 sm:hidden">

        <a
            href="{{ route('admin.blog.index') }}"
            class="block w-full rounded-xl border border-gray-200 bg-white px-5 py-3 text-center text-sm font-semibold text-gray-700"
        >
            Cancel
        </a>

    </div>

</section>

<script>
    function previewImage(input, previewId, placeholderId) {
        const file = input.files?.[0];

        if (!file) return;

        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById(placeholderId);

        const reader = new FileReader();

        reader.onload = event => {
            preview.src = event.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };

        reader.readAsDataURL(file);
    }

    function previewVideo(input) {
        const file = input.files?.[0];

        if (!file) return;

        const preview = document.getElementById('videoPreview');
        const placeholder = document.getElementById('videoPlaceholder');

        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
        placeholder.classList.add('hidden');
        preview.load();
    }

    function switchMedia(type) {
        const imageSection = document.getElementById('imageSection');
        const videoSection = document.getElementById('videoSection');

        if (type === 'video') {
            imageSection.classList.add('hidden');
            videoSection.classList.remove('hidden');
        } else {
            videoSection.classList.add('hidden');
            imageSection.classList.remove('hidden');
        }
    }
</script>

@endsection
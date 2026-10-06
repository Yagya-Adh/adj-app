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
                        Optional
                    </span>

                    <h2 class="mt-2 text-xl font-semibold text-gray-900">
                        Customer Story
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Add customer information when the article includes a testimonial or story.
                    </p>

                </div>

                <div class="grid gap-5 sm:grid-cols-2">

                    <div>

                        <label
                            for="customer"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Customer Name
                        </label>

                        <input
                            type="text"
                            id="customer"
                            name="customer"
                            value="{{ old('customer', $blog->customer) }}"
                            placeholder="Customer name"
                            class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-gray-900 focus:ring-4 focus:ring-gray-900/5"
                        >

                    </div>

                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Customer Image
                        </label>

                        <label
                            for="customer_image"
                            class="flex cursor-pointer items-center gap-3 rounded-2xl border border-gray-200 bg-gray-50 p-3 transition hover:border-gray-400"
                        >

                            @if($blog->customer_image)
                                <img
                                    id="customerPreview"
                                    src="{{ asset('storage/' . $blog->customer_image) }}"
                                    class="h-12 w-12 shrink-0 rounded-full object-cover"
                                    alt="Customer image"
                                >

                                <div
                                    id="customerPlaceholder"
                                    class="hidden h-12 w-12 shrink-0 items-center justify-center rounded-full bg-white text-gray-400 shadow-sm"
                                >
                                    👤
                                </div>
                            @else
                                <div
                                    id="customerPlaceholder"
                                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-white text-gray-400 shadow-sm"
                                >
                                    👤
                                </div>

                                <img
                                    id="customerPreview"
                                    class="hidden h-12 w-12 shrink-0 rounded-full object-cover"
                                    alt="Customer preview"
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
                                id="customer_image"
                                name="customer_image"
                                accept=".jpg,.jpeg,.png,.webp"
                                class="hidden"
                                onchange="preview(this,'customerPreview','customerPlaceholder')"
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
                        Featured Image
                    </h2>

                    <p class="mt-1 text-xs leading-5 text-gray-500">
                        Upload a new image only if you want to replace the current one.
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
                                Maximum 2MB
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
                                Maximum 2MB
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
                        onchange="preview(this,'imagePreview','imagePlaceholder')"
                    >

                </label>

            </div>

            <div class="rounded-3xl border border-gray-200 bg-white p-5 shadow-sm">

                <div class="mb-5">

                    <span class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-400">
                        Gallery
                    </span>

                    <h2 class="mt-2 font-semibold text-gray-900">
                        Additional Media
                    </h2>

                    <p class="mt-1 text-xs leading-5 text-gray-500">
                        Upload additional images for your article gallery.
                    </p>

                </div>

                <label
                    for="media"
                    class="flex cursor-pointer items-center justify-center rounded-2xl border border-gray-200 bg-gray-50 px-4 py-5 text-center transition hover:border-gray-400 hover:bg-gray-100"
                >

                    <div>

                        <div class="text-xl text-gray-400">
                            +
                        </div>

                        <p class="mt-2 text-sm font-medium text-gray-700">
                            Add gallery images
                        </p>

                        <p class="mt-1 text-xs text-gray-400">
                            Multiple files · Max 5MB each
                        </p>

                    </div>

                    <input
                        type="file"
                        id="media"
                        name="media[]"
                        accept=".jpg,.jpeg,.png,.webp"
                        multiple
                        class="hidden"
                        onchange="showFiles(this)"
                    >

                </label>

                <div
                    id="mediaFiles"
                    class="mt-3 space-y-2"
                ></div>

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
    function preview(input, previewId, placeholderId) {
        const file = input.files?.[0];
        const image = document.getElementById(previewId);
        const placeholder = document.getElementById(placeholderId);

        if (!file) return;

        const reader = new FileReader();

        reader.onload = e => {
            image.src = e.target.result;
            image.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };

        reader.readAsDataURL(file);
    }

    function showFiles(input) {
        const container = document.getElementById('mediaFiles');

        container.innerHTML = [...input.files].map(file => `
            <div class="flex items-center gap-3 rounded-xl bg-gray-50 px-3 py-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-white text-xs text-gray-400">
                    IMG
                </div>

                <p class="min-w-0 flex-1 truncate text-xs text-gray-600">
                    ${file.name}
                </p>
            </div>
        `).join('');
    }
</script>

@endsection

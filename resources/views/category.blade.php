@extends('client.app')

@section('content')

{{-- LATEST COLLECTIONS --}}
<section class="bg-white py-14 text-gray-900 sm:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mb-10 flex flex-col items-start justify-between gap-5 sm:mb-12 sm:flex-row sm:items-end">
            <div>
                <p class="mb-3 text-xs font-semibold uppercase tracking-[0.3em] text-gray-900 sm:text-sm">
                    Latest Collections
                </p>

                <h2 class="font-serif text-3xl font-normal tracking-tight text-gray-950 sm:text-4xl lg:text-6xl">
                    Discover Our Latest Pieces
                </h2>
            </div>

            <span class="hidden text-xs uppercase tracking-[0.2em] text-gray-500 sm:block">
                New Arrivals
            </span>
        </div>

        <div class="flex gap-5 overflow-x-auto pb-5">
            @foreach ($latestCollections ?? [] as $latest)
                <a
                    href="{{ route('collection.show', $latest->slug) }}"
                    class="group w-[250px] shrink-0 sm:w-[280px]"
                >
                    <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white">
                        @if ($latest->image)
                            <img
                                src="{{ asset('storage/' . $latest->image) }}"
                                alt="{{ $latest->name }}"
                                loading="lazy"
                                class="h-[300px] w-full object-cover transition duration-700 group-hover:scale-105 sm:h-[340px]"
                            >
                        @else
                            <div class="flex h-[300px] items-center justify-center bg-white text-xs text-gray-400 sm:h-[340px]">
                                Image coming soon
                            </div>
                        @endif
                    </div>

                    <div class="px-1 pt-5">
                        <h3 class="text-sm font-semibold tracking-wide text-gray-950">
                            {{ $latest->name }}
                        </h3>

                        <p class="mt-2 text-[10px] font-medium uppercase tracking-[0.15em] text-gray-500">
                            {{ is_object($latest->category) ? ($latest->category->name ?? 'Jewelry') : ($latest->category ?? 'Jewelry') }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>


{{-- CATEGORY COLLECTIONS --}}
<section class="bg-white py-14 text-gray-900 sm:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <header class="mx-auto mb-12 max-w-2xl text-center sm:mb-16">
            <p class="mb-4 text-[10px] font-semibold uppercase tracking-[0.4em] text-gray-900">
                Our Collection
            </p>

            <h1 class="font-serif text-4xl font-normal tracking-tight text-gray-950 sm:text-5xl lg:text-6xl">
                {{ $category['name'] }}
            </h1>

            <div class="mx-auto mt-6 h-px w-14 text-gray-700"></div>

            <p class="mx-auto mt-6 max-w-xl text-sm leading-7 text-gray-600 sm:text-base">
                Explore our {{ strtolower($category['name']) }} collection,
                thoughtfully selected to bring timeless elegance to every occasion.
            </p>
        </header>

        {{-- COLLECTION GRID --}}
        <div class="grid grid-cols-1 gap-x-6 gap-y-12 sm:grid-cols-2 lg:grid-cols-4">

            @forelse ($collections as $collection)

                @php
                    $image = $collection->image
                        ? asset('storage/' . $collection->image)
                        : null;

                    $discountPercentage = $collection->is_sale
                        && (float) $collection->fullprice > 0
                        && (float) $collection->price < (float) $collection->fullprice
                            ? (($collection->fullprice - $collection->price) / $collection->fullprice) * 100
                            : 0;
                @endphp

                <article class="group min-w-0">

                    {{-- IMAGE CARD --}}
                    <div class="relative overflow-hidden rounded-2xl border border-gray-100 bg-white transition duration-500 hover:-translate-y-1 hover:shadow-lg">

                        @if ($collection->is_sale)
                            <span class="absolute left-4 top-4 z-20 rounded-full bg-gray-950 px-3 py-2 text-[9px] font-semibold uppercase tracking-[0.18em] text-white">
                                Sale
                            </span>
                        @endif

                        @if ($collection->gold_karats)
                            <span class="absolute right-4 top-4 z-20 rounded-full border border-gray-200 bg-white px-3 py-2 text-[9px] font-semibold tracking-[0.15em] text-gray-800">
                                {{ $collection->gold_karats }}K
                            </span>
                        @endif

                        <button
                            type="button"
                            onclick="openImagePreview({{ Js::from($image) }}, {{ Js::from($collection->name) }})"
                            aria-label="Preview {{ $collection->name }}"
                            class="relative block w-full cursor-zoom-in text-left"
                        >
                            @if ($image)
                                <img
                                    src="{{ $image }}"
                                    alt="{{ $collection->name }}"
                                    loading="lazy"
                                    class="h-[340px] w-full object-cover transition duration-700 group-hover:scale-105 sm:h-[370px] lg:h-[390px]"
                                >
                            @else
                                <div class="flex h-[340px] items-center justify-center bg-white sm:h-[370px] lg:h-[390px]">
                                    <span class="text-[10px] font-medium uppercase tracking-[0.25em] text-gray-400">
                                        No Image Available
                                    </span>
                                </div>
                            @endif

                            @if ($image)
                                <span class="absolute bottom-5 left-1/2 -translate-x-1/2 rounded-full border border-gray-100 bg-white px-4 py-2 text-[9px] font-semibold uppercase tracking-[0.2em] text-gray-900 opacity-0 transition group-hover:opacity-100">
                                    Preview Image
                                </span>
                            @endif
                        </button>

                        {{-- VIEW COLLECTION --}}
                        <a
                            href="{{ route('category.only', ['slug' => $slug, 'id' => $collection->id]) }}"
                            class="absolute bottom-4 left-4 right-4 translate-y-2 rounded-xl bg-white px-4 py-3.5 text-center text-[9px] font-bold uppercase tracking-[0.2em] text-gray-950 opacity-0 shadow-md transition duration-300 hover:bg-gray-950 hover:text-white group-hover:translate-y-0 group-hover:opacity-100 focus:translate-y-0 focus:opacity-100"
                        >
                            View Collection
                        </a>

                    </div>

                    {{-- COLLECTION DETAILS --}}
                    <div class="px-1 pt-5">

                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <h2 class="truncate text-sm font-semibold tracking-wide text-gray-950 sm:text-base">
                                    {{ $collection->name }}
                                </h2>

                                @if ($collection->sku)
                                    <p class="mt-2 text-[10px] font-medium uppercase tracking-[0.18em] text-gray-500">
                                        {{ $collection->sku }}
                                    </p>
                                @endif
                            </div>

                            @if ($collection->gold_karats)
                                <span class="shrink-0 text-[10px] font-semibold uppercase tracking-[0.15em] text-gray-900">
                                    {{ $collection->gold_karats }}K
                                </span>
                            @endif
                        </div>

                        {{-- PRICING --}}
                        <div class="mt-4 flex flex-wrap items-center gap-3">

                            @if ($collection->is_sale && $collection->fullprice !== null)
                                <span class="text-xs text-gray-400 line-through">
                                    {{ number_format((float) $collection->fullprice, 2) }}
                                </span>
                            @endif

                            <span class="text-base font-semibold tracking-wide text-gray-950">
                                {{ number_format((float) $collection->price, 2) }}
                            </span>

                            @if ($collection->is_sale && $collection->discount)
                                <span class="rounded-full bg-red-50 px-2.5 py-1 text-[9px] font-bold uppercase tracking-wider text-red-700">
                                    -{{ number_format((float) $collection->discount, 2) }}%
                                </span>
                            @endif

                        </div>

                        @if ($discountPercentage > 0)
                            <p class="mt-2 text-[10px] font-medium uppercase tracking-[0.15em] text-emerald-700">
                                Save {{ number_format($discountPercentage, 0) }}%
                            </p>
                        @endif

                        {{-- STOCK STATUS --}}
                        @if ($collection->stock_status)
                            <div class="mt-4 flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full {{ $collection->stock_status === 'in_stock' ? 'bg-emerald-500' : 'bg-red-500' }}"></span>

                                <span class="text-[10px] font-medium uppercase tracking-[0.18em] text-gray-500">
                                    {{ str_replace('_', ' ', $collection->stock_status) }}
                                </span>
                            </div>
                        @endif

                    </div>

                </article>

            @empty

                <div class="col-span-full rounded-2xl border border-gray-200 bg-white px-6 py-20 text-center">
                    <p class="text-xs font-medium uppercase tracking-[0.25em] text-gray-500">
                        No collections found
                    </p>

                    <p class="mt-3 text-sm text-gray-400">
                        Please check back later for new arrivals.
                    </p>
                </div>

            @endforelse

        </div>
    </div>
</section>


{{-- IMAGE PREVIEW MODAL --}}
<div
    id="imagePreview"
    class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/80 p-4 backdrop-blur-sm"
    onclick="closeImagePreview()"
    role="dialog"
    aria-modal="true"
    aria-label="Collection image preview"
>
    <div
        class="relative max-h-[92vh] max-w-5xl"
        onclick="event.stopPropagation()"
    >
        <button
            type="button"
            onclick="closeImagePreview()"
            aria-label="Close image preview"
            class="absolute -right-3 -top-3 z-20 flex h-10 w-10 items-center justify-center rounded-full bg-white text-2xl text-gray-900 shadow-lg transition hover:bg-gray-100"
        >
            &times;
        </button>

        <img
            id="previewImage"
            src=""
            alt=""
            class="max-h-[82vh] max-w-full rounded-2xl bg-white object-contain shadow-2xl"
        >

        <p
            id="previewName"
            class="mt-4 text-center text-sm font-medium tracking-wide text-white"
        ></p>
    </div>
</div>


{{-- IMAGE PREVIEW SCRIPT --}}
<script>
    function openImagePreview(image, name) {
        if (!image) return;

        const modal = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');

        previewImage.src = image;
        previewImage.alt = name;

        document.getElementById('previewName').textContent = name;

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.body.classList.add('overflow-hidden');
    }

    function closeImagePreview() {
        const modal = document.getElementById('imagePreview');

        if (!modal) return;

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeImagePreview();
        }
    });
</script>

@endsection
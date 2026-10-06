@extends('client.app')

@section('content')

<div class="bg-[#f7f5f0] text-gray-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mb-12 flex items-end justify-between gap-6">
            <div>
                <p class="mb-3 text-base font-semibold uppercase tracking-[0.35em] text-gray-600 md:text-xl">
                    Latest Collections
                </p>

                <h2 class="font-serif text-3xl font-light tracking-tight text-gray-950 sm:text-4xl md:text-7xl">
                    Discover Our Latest Pieces
                </h2>
            </div>

            <span class="hidden text-xs uppercase tracking-[0.2em] text-gray-500 sm:block">
                New Arrivals
            </span>
        </div>

        <div class="flex gap-5 overflow-x-auto pb-5 scrollbar-hide">
            @foreach ($latestCollections ?? [] as $latest)
                <a
                    href="{{ route('collection.show', $latest->slug) }}"
                    class="group min-w-[250px] max-w-[280px] flex-1"
                >
                    <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl">
                        <img
                            src="{{ asset('storage/' . $latest->image) }}"
                            alt="{{ $latest->name }}"
                            loading="lazy"
                            class="h-[310px] w-full object-cover transition duration-700 group-hover:scale-105"
                        >
                    </div>

                    <div class="px-1 pt-5">
                        <h3 class="text-sm font-semibold tracking-wide text-gray-950">
                            {{ $latest->name }}
                        </h3>

                        <p class="mt-1 text-[10px] font-medium uppercase tracking-[0.15em] text-gray-500">
                            {{ $latest->category }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>

<section class="bg-[#eeece6] py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <header class="mx-auto mb-16 max-w-2xl text-center">
            <p class="mb-4 text-[10px] font-semibold uppercase tracking-[0.4em] text-gray-600">
                Collection
            </p>

            <h1 class="text-4xl font-light tracking-tight text-gray-950 sm:text-5xl lg:text-6xl">
                {{ $category['name'] }}
            </h1>

            <div class="mx-auto mt-6 h-px w-12 bg-gray-900/30"></div>

            <p class="mx-auto mt-6 max-w-xl text-sm leading-7 text-gray-600 sm:text-base">
                Explore our {{ strtolower($category['name']) }} collection,
                thoughtfully crafted to bring timeless elegance to every occasion.
            </p>
        </header>

        <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4">

            @forelse ($collections as $collection)

                @php
                    $image = $collection->image
                        ? asset('storage/' . $collection->image)
                        : null;

                    $discountPercentage = $collection->is_sale && $collection->fullprice && $collection->price
                        ? (($collection->fullprice - $collection->price) / $collection->fullprice) * 100
                        : 0;
                @endphp

                <article class="group">

                    <div class="relative overflow-hidden rounded-[1.5rem] border border-gray-100 bg-white shadow-xl transition duration-500 hover:-translate-y-1 hover:shadow-2xl">

                        @if ($collection->is_sale)
                            <span class="absolute left-4 top-4 z-20 rounded-full bg-black px-3 py-1.5 text-[9px] font-semibold uppercase tracking-[0.2em] text-white shadow-xl">
                                Sale
                            </span>
                        @endif

                        @if ($collection->gold_karats)
                            <span class="absolute right-4 top-4 z-20 rounded-full border border-gray-200 bg-white/95 px-3 py-1.5 text-[9px] font-semibold tracking-[0.15em] text-gray-800 shadow-lg backdrop-blur">
                                {{ $collection->gold_karats }}K
                            </span>
                        @endif

                        <button
                            type="button"
                            onclick="openImagePreview({{ Js::from($image) }}, {{ Js::from($collection->name) }})"
                            class="relative block w-full cursor-zoom-in text-left"
                        >
                            @if ($image)
                                <img
                                    src="{{ $image }}"
                                    alt="{{ $collection->name }}"
                                    loading="lazy"
                                    class="h-[390px] w-full object-cover transition duration-700 group-hover:scale-105"
                                >
                            @else
                                <div class="flex h-[390px] items-center justify-center bg-gray-100">
                                    <span class="text-[10px] font-medium uppercase tracking-[0.25em] text-gray-500">
                                        No Image
                                    </span>
                                </div>
                            @endif

                            @if ($image)
                                <span class="absolute bottom-5 left-1/2 -translate-x-1/2 rounded-full bg-white/95 px-4 py-2 text-[9px] font-semibold uppercase tracking-[0.2em] text-gray-900 opacity-0 shadow-xl backdrop-blur transition group-hover:opacity-100">
                                    Preview Image
                                </span>
                            @endif
                        </button>

                        <a
                            href="{{ route('category.only', ['slug' => $slug, 'id' => $collection->id]) }}"
                            class="absolute bottom-4 left-4 right-4 translate-y-3 rounded-xl bg-white px-5 py-3.5 text-center text-[9px] font-bold uppercase tracking-[0.25em] text-gray-900 opacity-0 shadow-xl transition duration-500 hover:bg-black hover:text-white group-hover:translate-y-0 group-hover:opacity-100"
                        >
                            View Collection
                        </a>

                    </div>

                    <div class="px-1 pt-6">

                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <h2 class="truncate text-sm font-semibold tracking-wide text-gray-950 md:text-base">
                                    {{ $collection->name }}
                                </h2>

                                @if ($collection->sku)
                                    <p class="mt-1.5 text-[10px] font-medium uppercase tracking-[0.2em] text-gray-500">
                                        {{ $collection->sku }}
                                    </p>
                                @endif
                            </div>

                            @if ($collection->gold_karats)
                                <span class="shrink-0 text-[10px] font-semibold uppercase tracking-[0.15em] text-gray-600">
                                    {{ $collection->gold_karats }}K
                                </span>
                            @endif
                        </div>

                        <div class="mt-4 flex flex-wrap items-center gap-3">

                            @if ($collection->is_sale && $collection->fullprice)
                                <span class="text-xs text-gray-500 line-through">
                                    {{ number_format($collection->fullprice, 2) }}
                                </span>
                            @endif

                            <span class="text-base font-bold tracking-wide text-gray-950">
                                {{ number_format($collection->price, 2) }}
                            </span>

                            @if ($collection->is_sale && $collection->discount)
                                <span class="rounded-full bg-black px-2 py-1 text-[8px] font-bold uppercase tracking-wider text-white">
                                    -{{ number_format($collection->discount, 2) }}
                                </span>
                            @endif

                        </div>

                        @if ($discountPercentage > 0)
                            <p class="mt-2 text-[10px] font-medium uppercase tracking-[0.15em] text-gray-500">
                                Save {{ number_format($discountPercentage, 0) }}%
                            </p>
                        @endif

                        @if ($collection->stock_status)
                            <div class="mt-4 flex items-center gap-2">
                                <span
                                    class="h-1.5 w-1.5 rounded-full {{ $collection->stock_status === 'in_stock' ? 'bg-emerald-500' : 'bg-red-500' }}"
                                ></span>

                                <span class="text-[10px] font-medium uppercase tracking-[0.18em] text-gray-600">
                                    {{ str_replace('_', ' ', $collection->stock_status) }}
                                </span>
                            </div>
                        @endif

                    </div>

                </article>

            @empty

                <div class="col-span-full rounded-3xl border border-gray-100 bg-white py-24 text-center shadow-xl">
                    <p class="text-[10px] font-medium uppercase tracking-[0.3em] text-gray-500">
                        No collections found
                    </p>
                </div>

            @endforelse

        </div>
    </div>
</section>
</div>

<div
    id="imagePreview"
    class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/80 p-4 backdrop-blur-md"
    onclick="closeImagePreview()"
>
    <div
        class="relative max-h-[92vh] max-w-5xl"
        onclick="event.stopPropagation()"
    >
        <button
            type="button"
            onclick="closeImagePreview()"
            aria-label="Close image preview"
            class="absolute -right-3 -top-3 z-20 flex h-10 w-10 items-center justify-center rounded-full bg-white text-xl text-gray-900 shadow-xl transition hover:bg-gray-100"
        >
            &times;
        </button>
    <img
        id="previewImage"
        src=""
        alt=""
        class="max-h-[88vh] max-w-full rounded-2xl object-contain shadow-2xl"
    >

    <p
        id="previewName"
        class="mt-4 text-center text-sm font-medium tracking-wide text-white"
    ></p>
</div>

</div>

<script>
    function openImagePreview(image, name) {
        const modal = document.getElementById('imagePreview');

        document.getElementById('previewImage').src = image || '';
        document.getElementById('previewImage').alt = name;
        document.getElementById('previewName').textContent = name;

        modal.classList.replace('hidden', 'flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeImagePreview() {
        const modal = document.getElementById('imagePreview');

        modal.classList.replace('flex', 'hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            closeImagePreview();
        }
    });
</script>

@endsection

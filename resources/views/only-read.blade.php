```blade
@extends('client.app')

@section('content')

@php
    $price = max(0, (float) ($collection->price ?? 0));
    $discount = min(100, max(0, (float) ($collection->discount ?? 0)));
    $currency = config('app.currency_symbol', '$');

    $money = fn ($amount) => $currency . number_format((float) $amount, 2);

    $saleStart = $collection->sale_start
        ? \Illuminate\Support\Carbon::parse($collection->sale_start)
        : null;

    $saleEnd = $collection->sale_end
        ? \Illuminate\Support\Carbon::parse($collection->sale_end)->endOfDay()
        : null;

    $now = now();

    $isSaleActive = $discount > 0
        && (!$saleStart || $now->greaterThanOrEqualTo($saleStart))
        && (!$saleEnd || $now->lessThanOrEqualTo($saleEnd));

    $activeDiscount = $isSaleActive ? $discount : 0;
    $discountAmount = round($price * $activeDiscount / 100, 2);
    $salePrice = max(0, round($price - $discountAmount, 2));

    $category = $collection->category ?? null;

    $categoryName = is_object($category)
        ? ($category->name ?? 'Jewelry')
        : ($category ?: 'Jewelry');

    $inStock = !isset($collection->stock) || $collection->stock > 0;

    $imageUrl = $collection->image
        ? asset('storage/' . $collection->image)
        : null;
@endphp

<div class="overflow-hidden bg-white text-[#25231f]">

    {{-- HERO SECTION --}}
    <section class="border-b border-gray-100 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-14">

            {{-- Breadcrumb --}}
            <nav class="mb-8 flex flex-wrap items-center gap-2 text-xs text-gray-500">
                <a href="{{ url('/') }}" class="transition hover:text-amber-800">
                    Home
                </a>
                <span>/</span>
                <span>Collections</span>
                <span>/</span>
                <span class="font-medium text-gray-900">
                    {{ $collection->name }}
                </span>
            </nav>

            <div class="grid items-start gap-10 lg:grid-cols-12 lg:gap-12">

                {{-- COLLECTION IMAGE --}}
                <div class="lg:col-span-6">
                    <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white">

                        @if($imageUrl)
                            <img
                                src="{{ $imageUrl }}"
                                alt="{{ $collection->name }}"
                                fetchpriority="high"
                                class="aspect-[4/5] w-full object-cover transition duration-700 group-hover:scale-[1.025]"
                            >
                        @else
                            <div class="flex aspect-[4/5] flex-col items-center justify-center gap-4 bg-white text-gray-400">
                                <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <circle cx="12" cy="12" r="8"/>
                                    <path d="M8 12h8M12 8v8"/>
                                </svg>
                                <span class="text-sm">Collection image coming soon</span>
                            </div>
                        @endif

                        @if($isSaleActive)
                            <span class="absolute left-4 top-4 rounded-full bg-red-700 px-4 py-2 text-[10px] font-bold uppercase tracking-[0.2em] text-white shadow-sm sm:left-6 sm:top-6">
                                Save {{ rtrim(rtrim(number_format($activeDiscount, 2), '0'), '.') }}%
                            </span>
                        @endif

                        <span class="absolute bottom-4 left-4 inline-flex items-center gap-2 rounded-full border border-white bg-white px-4 py-2 text-[10px] font-semibold uppercase tracking-[0.18em] text-gray-800 sm:bottom-6 sm:left-6">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-700"></span>
                            {{ $categoryName }}
                        </span>
                    </div>

                    {{-- IMAGE CAPTION --}}
                    <div class="mt-4 flex flex-wrap items-center justify-between gap-3 px-1">
                        <p class="text-xs tracking-wide text-gray-500">
                            Curated with care. Chosen to last.
                        </p>
                        <span class="text-xs text-gray-400">
                            Refined · Timeless · Distinctive
                        </span>
                    </div>

                    {{-- BRAND PROMISE --}}
                    <div class="mt-6 flex items-center gap-4 rounded-2xl border border-gray-100 bg-white p-5">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-amber-50 text-amber-800">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                <path d="m12 3 2.7 5.5 6.1.9-4.4 4.3 1 6.1-5.4-2.9-5.4 2.9 1-6.1-4.4-4.3 6.1-.9L12 3Z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">
                                Elegance in Every Detail
                            </h3>
                            <p class="mt-1 text-xs leading-5 text-gray-500">
                                Discover timeless designs and carefully curated pieces.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- COLLECTION DETAILS --}}
                <div class="lg:col-span-6 lg:pt-4">

                    <div class="flex items-center gap-3">
                        <span class="h-px w-10 bg-amber-700"></span>
                        <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-amber-800">
                            Discover the Collection
                        </p>
                    </div>

                    <h1 class="mt-6 max-w-2xl font-serif text-4xl font-normal leading-[1.1] tracking-tight text-gray-950 sm:text-5xl lg:text-6xl">
                        {{ $collection->name }}
                    </h1>

                    <div class="mt-6 flex items-center gap-3 text-amber-700">
                        <span class="h-px w-10 bg-amber-300"></span>
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="m12 2 2.5 7.5L22 12l-7.5 2.5L12 22l-2.5-7.5L2 12l7.5-2.5L12 2Z"/>
                        </svg>
                        <span class="h-px w-10 bg-amber-300"></span>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mt-6 whitespace-pre-line text-sm leading-8 text-gray-600 sm:text-base">
                        {{ $collection->description ?: 'Discover a thoughtfully curated collection where timeless style meets refined craftsmanship. Find a piece that complements your style or makes a meaningful gift.' }}
                    </div>

                    {{-- PRICE SUMMARY --}}
                    <div class="mt-8 rounded-2xl border border-gray-200 bg-white p-5 sm:p-7">
                        <div class="flex flex-wrap items-start justify-between gap-4">
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-[0.22em] text-gray-500">
                                    Collection Price
                                </p>

                                <div class="mt-3 flex flex-wrap items-baseline gap-3">
                                    <span class="font-serif text-3xl text-gray-950 sm:text-4xl">
                                        {{ $money($salePrice) }}
                                    </span>

                                    @if($isSaleActive)
                                        <span class="text-sm text-gray-400 line-through">
                                            {{ $money($price) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if($isSaleActive)
                                <span class="rounded-full bg-red-50 px-3 py-2 text-xs font-semibold text-red-700">
                                    {{ rtrim(rtrim(number_format($activeDiscount, 2), '0'), '.') }}% OFF
                                </span>
                            @endif
                        </div>

                        <div class="mt-5 flex flex-wrap items-center justify-between gap-3 border-t border-dashed border-gray-200 pt-4">
                            <span class="text-xs leading-5 text-gray-500">
                                @if($isSaleActive)
                                    You save {{ $money($discountAmount) }} with this offer.
                                @else
                                    Contact us for more information about this collection.
                                @endif
                            </span>

                            <span class="inline-flex items-center gap-2 text-xs font-medium {{ $inStock ? 'text-emerald-700' : 'text-red-700' }}">
                                <span class="h-2 w-2 rounded-full {{ $inStock ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                {{ $inStock ? 'In Stock' : 'Currently Unavailable' }}
                            </span>
                        </div>
                    </div>

                    {{-- COLLECTION HIGHLIGHTS --}}
                    <div class="mt-8 grid gap-5 sm:grid-cols-2">
                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-800">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="m12 3 8 4.5v9L12 21l-8-4.5v-9L12 3Z"/>
                                    <path d="m8.5 12 2.3 2.3 4.7-4.7"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">
                                    Timeless Design
                                </h3>
                                <p class="mt-1 text-xs leading-5 text-gray-500">
                                    Discover styles for everyday wear and special occasions.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-800">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M12 3 20 7.5v9L12 21l-8-4.5v-9L12 3Z"/>
                                    <path d="m8.5 12 2.3 2.3 4.7-4.7"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">
                                    Curated Selection
                                </h3>
                                <p class="mt-1 text-xs leading-5 text-gray-500">
                                    Explore pieces chosen with attention to detail.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- CTA BUTTONS --}}
                    <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                        <a
                            href="{{ route('contact-us') }}"
                            class="inline-flex min-h-14 flex-1 items-center justify-center gap-3 rounded-xl bg-gray-950 px-6 py-4 text-xs font-bold uppercase tracking-[0.16em] text-white transition hover:bg-amber-800 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:ring-offset-2 {{ !$inStock ? 'pointer-events-none opacity-50' : '' }}"
                            @if(!$inStock) aria-disabled="true" @endif
                        >
                            Enquire About Collection
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path d="M5 12h14m-6-6 6 6-6 6"/>
                            </svg>
                        </a>

                        <a
                            href="#price-details"
                            class="inline-flex min-h-14 items-center justify-center rounded-xl border border-gray-200 bg-white px-6 py-4 text-xs font-semibold uppercase tracking-[0.14em] text-gray-800 transition hover:border-amber-700 hover:text-amber-800"
                        >
                            View Price Details
                        </a>
                    </div>

                    <p class="mt-4 text-xs text-gray-500">
                        Personal assistance for your collection enquiry.
                    </p>
                </div>
            </div>
        </div>
    </section>


    {{-- SERVICE BENEFITS --}}
    <section class="border-b border-gray-100 bg-white py-14 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mx-auto mb-12 max-w-xl text-center">
                <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-amber-800">
                    The Experience
                </p>

                <h2 class="mt-4 font-serif text-3xl font-normal text-gray-950 sm:text-4xl">
                    More Than Just a Collection
                </h2>

                <p class="mt-4 text-sm leading-7 text-gray-500">
                    Thoughtful service to help you discover a piece that feels right for you.
                </p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                @foreach([
                    [
                        'number' => '01',
                        'title' => 'Thoughtful Selection',
                        'description' => 'Explore designs curated around distinctive style and timeless appeal.',
                        'icon' => 'M12 3 14.8 9.2 21 12l-6.2 2.8L12 21l-2.8-6.2L3 12l6.2-2.8L12 3Z',
                    ],
                    [
                        'number' => '02',
                        'title' => 'Personal Assistance',
                        'description' => 'Contact our team for help with your collection enquiry.',
                        'icon' => 'M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2 M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z',
                    ],
                    [
                        'number' => '03',
                        'title' => 'Clear Pricing',
                        'description' => 'Review the listed price and any applicable promotional savings.',
                        'icon' => 'M12 2v20 M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6',
                    ],
                    [
                        'number' => '04',
                        'title' => 'A Meaningful Choice',
                        'description' => 'Discover something special for yourself or someone you love.',
                        'icon' => 'M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8l1.1 1.1L12 21l7.8-7.5 1.1-1.1a5.5 5.5 0 0 0-.1-7.8Z',
                    ],
                ] as $benefit)
                    <article class="group rounded-2xl border border-gray-200 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-amber-300 hover:shadow-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-amber-50 text-amber-800 transition group-hover:bg-gray-950 group-hover:text-white">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                    <path d="{{ $benefit['icon'] }}"/>
                                </svg>
                            </div>

                            <span class="font-serif text-2xl text-amber-200">
                                {{ $benefit['number'] }}
                            </span>
                        </div>

                        <h3 class="mt-6 font-serif text-xl text-gray-900">
                            {{ $benefit['title'] }}
                        </h3>

                        <p class="mt-3 text-sm leading-7 text-gray-500">
                            {{ $benefit['description'] }}
                        </p>
                    </article>
                @endforeach

            </div>
        </div>
    </section>


    {{-- PRICE OVERVIEW --}}
    <section id="price-details" class="scroll-mt-24 border-b border-gray-100 bg-white py-14 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="grid items-start gap-10 lg:grid-cols-12 lg:gap-16">

                {{-- SECTION INTRODUCTION --}}
                <div class="lg:col-span-5">
                    <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-amber-800">
                        Transparent Pricing
                    </p>

                    <h2 class="mt-4 font-serif text-3xl font-normal leading-tight text-gray-950 sm:text-4xl">
                        Every Detail, Clearly Presented
                    </h2>

                    <p class="mt-5 text-sm leading-8 text-gray-600">
                        Review the pricing for this collection and see how much you save when a promotional offer is active.
                    </p>

                    @if($saleStart || $saleEnd)
                        <div class="mt-8 rounded-2xl border border-gray-200 bg-white p-5">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-amber-50 text-amber-800">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="12" cy="12" r="9"/>
                                        <path d="M12 7v5l3 2"/>
                                    </svg>
                                </div>

                                <div>
                                    <h3 class="text-sm font-semibold text-gray-900">
                                        Promotional Period
                                    </h3>
                                    <p class="mt-1 text-xs leading-5 text-gray-500">
                                        {{ $isSaleActive ? 'The promotional price is currently active.' : 'The promotional price is not currently active.' }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-5 space-y-3 border-t border-gray-100 pt-4 text-sm">
                                @if($saleStart)
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="text-gray-500">Start date</span>
                                        <span class="font-medium text-gray-900">{{ $saleStart->format('M d, Y') }}</span>
                                    </div>
                                @endif

                                @if($saleEnd)
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="text-gray-500">End date</span>
                                        <span class="font-medium text-gray-900">{{ $saleEnd->format('M d, Y') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                {{-- PRICE CARD --}}
                <div class="lg:col-span-7">
                    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

                        <div class="flex items-center justify-between gap-4 border-b border-gray-100 px-6 py-6 sm:px-8">
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">
                                    Price Breakdown
                                </p>
                                <h3 class="mt-2 font-serif text-2xl text-gray-950">
                                    {{ $collection->name }}
                                </h3>
                            </div>

                            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-amber-50 text-amber-800">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                    <path d="m12 3 2.7 5.5 6.1.9-4.4 4.3 1 6.1-5.4-2.9-5.4 2.9 1-6.1-4.4-4.3 6.1-.9L12 3Z"/>
                                </svg>
                            </span>
                        </div>

                        <div class="space-y-5 p-6 sm:p-8">

                            <div class="flex items-center justify-between gap-4 text-sm">
                                <span class="text-gray-500">Original price</span>
                                <span class="font-medium text-gray-900">{{ $money($price) }}</span>
                            </div>

                            <div class="flex items-center justify-between gap-4 text-sm">
                                <span class="text-gray-500">Discount</span>
                                <span class="font-medium {{ $isSaleActive ? 'text-red-700' : 'text-gray-500' }}">
                                    {{ number_format($activeDiscount, 2) }}%
                                </span>
                            </div>

                            <div class="flex items-center justify-between gap-4 text-sm">
                                <span class="text-gray-500">Amount saved</span>
                                <span class="font-medium {{ $isSaleActive ? 'text-emerald-700' : 'text-gray-500' }}">
                                    −{{ $money($discountAmount) }}
                                </span>
                            </div>

                            <div class="border-t border-dashed border-gray-200"></div>

                            <div class="flex items-end justify-between gap-4">
                                <div>
                                    <p class="font-serif text-xl text-gray-900">
                                        Final Price
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500">
                                        {{ $isSaleActive ? 'Promotional price applied' : 'Current collection price' }}
                                    </p>
                                </div>

                                <div class="text-right">
                                    @if($isSaleActive)
                                        <p class="text-xs text-gray-400 line-through">
                                            {{ $money($price) }}
                                        </p>
                                    @endif

                                    <p class="font-serif text-3xl font-medium text-gray-950 sm:text-4xl">
                                        {{ $money($salePrice) }}
                                    </p>
                                </div>
                            </div>

                            {{-- SAVINGS --}}
                            <div class="rounded-2xl border border-emerald-100 bg-white p-5">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">
                                            Your Total Savings
                                        </p>
                                        <p class="mt-1 text-xs leading-5 text-gray-500">
                                            {{ $isSaleActive ? 'Your savings with the current offer.' : 'Savings will appear when a sale is active.' }}
                                        </p>
                                    </div>

                                    <span class="font-serif text-xl font-semibold text-emerald-700">
                                        {{ $money($discountAmount) }}
                                    </span>
                                </div>
                            </div>

                            <a
                                href="{{ route('contact-us') }}"
                                class="flex min-h-14 w-full items-center justify-center gap-3 rounded-xl bg-gray-950 px-6 py-4 text-xs font-bold uppercase tracking-[0.17em] text-white transition hover:bg-amber-800 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:ring-offset-2"
                            >
                                Request More Information
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M5 12h14m-6-6 6 6-6 6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- RELATED COLLECTIONS --}}
    @if(isset($collections))
        <section class="bg-white py-14 sm:py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="mb-10 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-amber-800">
                            Discover More
                        </p>

                        <h2 class="mt-3 font-serif text-3xl font-normal text-gray-950 sm:text-4xl">
                            Explore Other Collections
                        </h2>

                        <p class="mt-3 text-sm leading-7 text-gray-500">
                            Discover more designs to complement your personal style.
                        </p>
                    </div>

                    <span class="text-xs uppercase tracking-[0.18em] text-gray-400">
                        Curated for You
                    </span>
                </div>

                @include('client.latest', [
                    'collections' => $collections,
                    'slug' => $slug
                ])

            </div>
        </section>
    @endif


    {{-- CLOSING BANNER --}}
    <section class="bg-white px-4 pb-14 sm:px-6 sm:pb-20 lg:px-8">
        <div class="relative mx-auto max-w-7xl overflow-hidden rounded-3xl bg-gray-950">

            {{-- DECORATIVE ELEMENTS --}}
            <div class="pointer-events-none absolute -left-20 -top-24 h-72 w-72 rounded-full border border-amber-200/15"></div>
            <div class="pointer-events-none absolute -left-10 -top-14 h-52 w-52 rounded-full border border-amber-200/15"></div>
            <div class="pointer-events-none absolute -bottom-32 -right-16 h-80 w-80 rounded-full border border-amber-200/15"></div>

            <div class="relative mx-auto max-w-3xl px-6 py-14 text-center sm:px-12 sm:py-20">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full border border-amber-200/30 text-amber-200">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3">
                        <path d="m12 3 2.7 5.5 6.1.9-4.4 4.3 1 6.1-5.4-2.9-5.4 2.9 1-6.1-4.4-4.3 6.1-.9L12 3Z"/>
                    </svg>
                </div>

                <p class="mt-6 text-[10px] font-bold uppercase tracking-[0.35em] text-amber-200">
                    An Expression of You
                </p>

                <h2 class="mt-5 font-serif text-3xl font-normal leading-tight text-white sm:text-5xl">
                    Some Things Are Simply Timeless.
                </h2>

                <p class="mx-auto mt-5 max-w-xl text-sm leading-8 text-white/65">
                    Discover a collection that reflects your individuality. Let us help you find something meaningful, memorable, and uniquely yours.
                </p>

                <a
                    href="{{ route('contact-us') }}"
                    class="mt-8 inline-flex min-h-14 items-center justify-center gap-3 rounded-xl bg-amber-200 px-7 py-4 text-xs font-bold uppercase tracking-[0.16em] text-gray-950 transition hover:bg-white focus:outline-none focus:ring-2 focus:ring-amber-200 focus:ring-offset-2 focus:ring-offset-gray-950"
                >
                    Enquire About This Collection
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M5 12h14m-6-6 6 6-6 6"/>
                    </svg>
                </a>

                <p class="mt-5 text-xs text-white/45">
                    Personal assistance · Thoughtful choices · Timeless style
                </p>
            </div>
        </div>
    </section>

</div>

@endsection
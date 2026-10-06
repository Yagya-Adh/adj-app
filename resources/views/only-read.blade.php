@extends('client.app')

@section('content')

<div class="bg-[#f7f5f0] text-gray-900">

```
<section class="border-b border-black/5 bg-[#fbfaf7] py-16 md:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-16">

            <div class="relative overflow-hidden rounded-[2rem] bg-white shadow-xl">
                @if($collection->image)
                    <img
                        src="{{ asset('storage/' . $collection->image) }}"
                        alt="{{ $collection->name }}"
                        class="aspect-square w-full object-cover"
                    >
                @else
                    <div class="flex aspect-square items-center justify-center bg-gray-100 text-sm text-gray-400">
                        No Image Available
                    </div>
                @endif

                @if(isset($collection->discount) && $collection->discount > 0)
                    <span class="absolute left-5 top-5 rounded-full bg-red-500 px-4 py-2 text-xs font-bold uppercase tracking-wider text-white shadow-lg">
                        {{ $collection->discount }}% Off
                    </span>
                @endif
            </div>

            <div>

                <p class="mb-4 text-xs font-bold uppercase tracking-[0.3em] text-gray-500">
                    Collection
                </p>

                <h1 class="text-4xl font-semibold leading-tight tracking-tight text-gray-950 sm:text-5xl lg:text-6xl">
                    {{ $collection->name }}
                </h1>

                @if($collection->description)
                    <div class="mt-6 max-w-2xl text-base leading-8 text-gray-600 md:text-lg">
                        {!! nl2br(e($collection->description)) !!}
                    </div>
                @endif

                <div class="mt-8 rounded-2xl border border-black/5 bg-white p-6 shadow-xl">

                    @php
                        $price = (float) ($collection->price ?? 0);
                        $discount = (float) ($collection->discount ?? 0);
                        $salePrice = $discount > 0
                            ? $price - ($price * $discount / 100)
                            : $price;
                        $saving = $price - $salePrice;
                    @endphp

                    <div class="flex flex-wrap items-end gap-3">

                        @if($discount > 0)
                            <span class="text-3xl font-bold text-gray-950">
                                ${{ number_format($salePrice, 2) }}
                            </span>

                            <span class="mb-1 text-lg text-gray-400 line-through">
                                ${{ number_format($price, 2) }}
                            </span>
                        @else
                            <span class="text-3xl font-bold text-gray-950">
                                ${{ number_format($price, 2) }}
                            </span>
                        @endif

                    </div>

                    @if($discount > 0)
                        <div class="mt-4 flex flex-wrap gap-2">

                            <span class="rounded-lg bg-red-50 px-3 py-2 text-xs font-bold uppercase tracking-wider text-red-600">
                                Save {{ $discount }}%
                            </span>

                            <span class="rounded-lg bg-green-50 px-3 py-2 text-xs font-bold uppercase tracking-wider text-green-600">
                                Save ${{ number_format($saving, 2) }}
                            </span>

                        </div>
                    @endif

                    <div class="mt-6 grid grid-cols-2 gap-4 border-t border-gray-100 pt-6 sm:grid-cols-3">

                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                Price
                            </p>
                            <p class="mt-1 text-sm font-semibold text-gray-900">
                                ${{ number_format($price, 2) }}
                            </p>
                        </div>

                        @if($discount > 0)
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                    Sale Price
                                </p>
                                <p class="mt-1 text-sm font-semibold text-red-600">
                                    ${{ number_format($salePrice, 2) }}
                                </p>
                            </div>

                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                    You Save
                                </p>
                                <p class="mt-1 text-sm font-semibold text-green-600">
                                    ${{ number_format($saving, 2) }}
                                </p>
                            </div>
                        @endif

                    </div>

                    @if(isset($collection->sale_start) || isset($collection->sale_end))
                        <div class="mt-6 rounded-xl bg-gray-50 p-4">

                            <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">
                                Sale Period
                            </p>

                            <div class="mt-2 flex flex-wrap gap-x-5 gap-y-1 text-sm text-gray-600">

                                @if($collection->sale_start)
                                    <span>
                                        Starts:
                                        <strong class="text-gray-900">
                                            {{ \Carbon\Carbon::parse($collection->sale_start)->format('M d, Y') }}
                                        </strong>
                                    </span>
                                @endif

                                @if($collection->sale_end)
                                    <span>
                                        Ends:
                                        <strong class="text-gray-900">
                                            {{ \Carbon\Carbon::parse($collection->sale_end)->format('M d, Y') }}
                                        </strong>
                                    </span>
                                @endif

                            </div>

                        </div>
                    @endif

                    <a
                        href="#"
                        class="mt-6 flex w-full items-center justify-center rounded-xl bg-gray-950 px-6 py-4 text-xs font-bold uppercase tracking-[0.2em] text-white shadow-lg transition duration-300 hover:bg-gray-800"
                    >
                        Get This Collection
                    </a>

                </div>

                <div class="mt-6 flex flex-wrap gap-6 text-xs font-medium text-gray-500">

                    @if(isset($collection->stock))
                        <span>
                            Availability:
                            <strong class="text-gray-900">
                                {{ $collection->stock > 0 ? 'In Stock' : 'Sold Out' }}
                            </strong>
                        </span>
                    @endif

                    @if(isset($collection->category))
                        <span>
                            Category:
                            <strong class="text-gray-900">
                                {{ is_object($collection->category) ? $collection->category->name : $collection->category }}
                            </strong>
                        </span>
                    @endif

                </div>

            </div>

        </div>

    </div>
</section>

<section class="bg-[#f7f5f0] py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mb-10">
            <p class="mb-2 text-xs font-bold uppercase tracking-[0.3em] text-gray-500">
                Collection Details
            </p>

            <h2 class="text-2xl font-semibold tracking-tight text-gray-950 md:text-3xl">
                Everything included
            </h2>
        </div>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

            <div class="rounded-2xl bg-white p-6 shadow-xl">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                    Original Price
                </p>
                <p class="mt-3 text-2xl font-semibold text-gray-950">
                    ${{ number_format($price, 2) }}
                </p>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-xl">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                    Current Price
                </p>
                <p class="mt-3 text-2xl font-semibold text-gray-950">
                    ${{ number_format($salePrice, 2) }}
                </p>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-xl">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                    Discount
                </p>
                <p class="mt-3 text-2xl font-semibold text-red-600">
                    {{ number_format($discount, 0) }}%
                </p>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-xl">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                    Total Savings
                </p>
                <p class="mt-3 text-2xl font-semibold text-green-600">
                    ${{ number_format($saving, 2) }}
                </p>
            </div>

        </div>

    </div>
</section>

<section class="border-t border-black/5 bg-[#fbfaf7] py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mb-10">
            <p class="mb-2 text-xs font-bold uppercase tracking-[0.3em] text-gray-500">
                More From This Collection
            </p>

            <h2 class="text-2xl font-semibold tracking-tight text-gray-950 md:text-3xl">
                Explore more
            </h2>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @forelse($collection->items ?? [] as $item)

                <article class="group overflow-hidden rounded-2xl border border-black/5 bg-white shadow-xl transition duration-500 hover:-translate-y-1">

                    @if($item->image)
                        <div class="aspect-[4/3] overflow-hidden">
                            <img
                                src="{{ asset('storage/' . $item->image) }}"
                                alt="{{ $item->name }}"
                                class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                            >
                        </div>
                    @endif

                    <div class="p-6">

                        <h3 class="text-lg font-semibold text-gray-950">
                            {{ $item->name }}
                        </h3>

                        @if($item->description)
                            <p class="mt-2 line-clamp-3 text-sm leading-6 text-gray-500">
                                {{ $item->description }}
                            </p>
                        @endif

                    </div>

                </article>

            @empty

                <div class="col-span-full rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center shadow-sm">
                    <p class="text-sm font-medium text-gray-500">
                        No additional items available.
                    </p>
                </div>

            @endforelse

        </div>

    </div>
</section>
</div>

@endsection

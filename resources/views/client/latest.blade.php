<section class="mx-auto max-w-[1800px] px-5 py-20 md:px-10 md:py-28 lg:px-16">

    {{-- Section Heading --}}
    <header class="mb-16 text-center">
        <span class="mb-6 block text-[11px] font-medium uppercase tracking-[0.4em] text-neutral-400">
            The New Edit
        </span>

        <h2 class="font-serif text-4xl font-normal leading-tight tracking-tight text-neutral-950 sm:text-6xl md:text-8xl">
            Latest <span>Collections</span>
        </h2>

        <p class="mx-auto mt-6 max-w-xl text-sm leading-7 text-neutral-500 sm:text-base sm:leading-8">
            Discover our newest pieces, thoughtfully curated to bring
            timeless elegance to every occasion.
        </p>
    </header>

    {{-- Collection Cards --}}
    @forelse ($collections as $collection)

        @if ($loop->first)
            <div class="flex flex-wrap justify-center gap-x-7 gap-y-14">
        @endif

        <article class="group w-full sm:w-[calc(50%-0.875rem)] lg:w-[calc(25%-1.313rem)]">

            <a
                href="{{ route('category.show', ['slug' => Str::slug($collection->category)]) }}"
                class="block"
                aria-label="Explore {{ $collection->name }}"
            >
                {{-- Collection Image --}}
                <div class="relative isolate overflow-hidden bg-neutral-100">

                    @if ($collection->image)
                        <img
                            src="{{ asset('storage/' . $collection->image) }}"
                            alt="{{ $collection->name }}"
                            loading="lazy"
                            class="aspect-[4/5] w-full object-cover transition-transform duration-1000 ease-out group-hover:scale-105"
                        >
                    @else
                        <div class="flex aspect-[4/5] items-center justify-center">
                            <span class="text-[10px] uppercase tracking-[0.3em] text-neutral-400">
                                No Image Available
                            </span>
                        </div>
                    @endif

                    {{-- Image Overlay --}}
                    @if ($collection->category)
                        <div class="absolute inset-0 flex items-center justify-center bg-black/10 px-4 text-center transition-colors duration-500 group-hover:bg-black/20">
                            <div class="text-white drop-shadow-lg">
                                <h3 class="break-words font-serif text-4xl font-normal uppercase leading-[0.9] tracking-tight sm:text-5xl lg:text-6xl">
                                    {{ $collection->category }}
                                </h3>

                                <span class="mx-auto mt-6 block h-px w-10 bg-white transition-all duration-500 group-hover:w-20"></span>
                            </div>
                        </div>
                    @endif

                    {{-- Sale Badge --}}
                    @if ($collection->is_sale && $collection->discount)
                        <span class="absolute left-4 top-4 bg-white px-3 py-2 text-[10px] font-semibold uppercase tracking-[0.15em] text-neutral-900">
                            -{{ $collection->discount }}%
                        </span>
                    @endif

                    {{-- Hover Action --}}
                    <div class="absolute inset-x-0 bottom-0 translate-y-full transition-transform duration-500 ease-out group-hover:translate-y-0">
                        <div class="flex items-center justify-between bg-white/95 px-4 py-4 backdrop-blur-md sm:px-5">
                            <span class="text-[10px] font-semibold uppercase tracking-[0.2em] text-neutral-900">
                                Explore Collection
                            </span>

                            <span class="flex h-9 w-9 items-center justify-center rounded-full border border-neutral-300 transition-colors duration-300 group-hover:border-neutral-900 group-hover:bg-neutral-900 group-hover:text-white">
                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M7 17L17 7M7 7h10v10"
                                    />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Collection Details --}}
            <div class="pt-5">

                <p class="mb-2 text-[10px] font-medium uppercase tracking-[0.25em] text-neutral-400">
                    Collection
                </p>

                <div class="flex items-start justify-between gap-3">
                    <h4 class="min-w-0 font-serif text-xl leading-snug tracking-tight text-neutral-900 sm:text-2xl">
                        {{ $collection->name }}
                    </h4>

                    <div class="shrink-0 text-right">
                        @if ($collection->is_sale)
                            <p class="text-xs text-neutral-400 line-through">
                                ${{ number_format($collection->fullprice ?? 0, 2) }}
                            </p>
                        @endif

                        <p class="text-sm font-medium text-neutral-900 sm:text-base">
                            ${{ number_format($collection->price ?? 0, 2) }}
                        </p>
                    </div>
                </div>

                {{-- Sale Details --}}
                @if ($collection->is_sale && $collection->discount)
                    <div class="mt-4 flex items-center gap-3">
                        <span class="text-[10px] font-medium uppercase tracking-[0.18em] text-neutral-700">
                            Save {{ $collection->discount }}%
                        </span>

                        <span class="h-px w-6 bg-neutral-300"></span>

                        <span class="text-[10px] uppercase tracking-[0.15em] text-neutral-400">
                            Special Offer
                        </span>
                    </div>
                @endif

                {{-- Bottom Divider --}}
                <div class="mt-5 h-px w-full bg-neutral-200">
                    <div class="h-px w-0 bg-neutral-900 transition-all duration-700 group-hover:w-full"></div>
                </div>

            </div>
        </article>

        @if ($loop->last)
            </div>
        @endif

    @empty

        <div class="border border-dashed border-neutral-200 py-20 text-center">
            <h3 class="font-serif text-2xl text-neutral-800">
                No Collections Available
            </h3>

            <p class="mt-3 text-sm text-neutral-500">
                New collections will be available soon.
            </p>
        </div>

    @endforelse

    {{-- Pagination --}}
    @if ($collections->hasPages())
        <nav class="mt-16 flex flex-wrap items-center justify-center gap-2" aria-label="Collection pagination">

            {{-- Previous --}}
            @if ($collections->onFirstPage())
                <span class="flex h-11 w-11 items-center justify-center border border-neutral-100 text-neutral-300" aria-disabled="true">
                    ←
                </span>
            @else
                <a
                    href="{{ $collections->previousPageUrl() }}"
                    rel="prev"
                    aria-label="Previous page"
                    class="flex h-11 w-11 items-center justify-center border border-neutral-300 transition hover:border-black hover:bg-black hover:text-white"
                >
                    ←
                </a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($collections->getUrlRange(1, $collections->lastPage()) as $page => $url)
                @if ($page == $collections->currentPage())
                    <span class="flex h-11 min-w-11 items-center justify-center bg-black px-3 text-sm text-white" aria-current="page">
                        {{ $page }}
                    </span>
                @else
                    <a
                        href="{{ $url }}"
                        aria-label="Go to page {{ $page }}"
                        class="flex h-11 min-w-11 items-center justify-center border border-neutral-200 px-3 text-sm text-neutral-900 transition hover:border-black hover:bg-black hover:text-white"
                    >
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            {{-- Next --}}
            @if ($collections->hasMorePages())
                <a
                    href="{{ $collections->nextPageUrl() }}"
                    rel="next"
                    aria-label="Next page"
                    class="flex h-11 w-11 items-center justify-center border border-neutral-300 transition hover:border-black hover:bg-black hover:text-white"
                >
                    →
                </a>
            @else
                <span class="flex h-11 w-11 items-center justify-center border border-neutral-100 text-neutral-300" aria-disabled="true">
                    →
                </span>
            @endif

        </nav>
    @endif

</section>
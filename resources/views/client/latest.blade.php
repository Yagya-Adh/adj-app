<section class="mx-auto max-w-[1800px] px-5 py-20 md:px-10 md:py-28 lg:px-16">

    <div class="mb-16 text-center animate-fade-in-up">

        <span class="mb-6 block text-xs font-medium uppercase tracking-[0.5em] text-neutral-400">
            The New Edit
        </span>

        <h2 class="font-serif text-3xl leading-[0.85] tracking-tight text-black sm:text-7xl md:text-8xl">
            Latest
            <span class="font-normal">Collections</span>
        </h2>

        <p class="mx-auto mt-8 max-w-2xl text-base leading-8 text-neutral-500 md:text-lg">
            Discover our newest pieces, thoughtfully crafted to bring
            timeless elegance to every occasion.
        </p>

    </div>


    <div class="flex flex-wrap justify-center gap-x-8 gap-y-16">

        @forelse ($collections as $collection)

            <a
                href="{{ route('category.show', ['slug' => Str::slug($collection->category)]) }}"
                class="group block w-full sm:w-[calc(50%-1rem)] lg:w-[calc(25%-1.5rem)]"
            >

                <div class="relative overflow-hidden bg-neutral-100">

                    @if ($collection->image)

                        <img
                            src="{{ asset('storage/' . $collection->image) }}"
                            alt="{{ $collection->name }}"
                            class="aspect-[4/5] w-full object-cover transition duration-[1200ms] ease-out group-hover:scale-[1.045]"
                        >

                    @else

                        <div class="flex aspect-[4/5] items-center justify-center">
                            <span class="text-sm uppercase tracking-[0.4em] text-neutral-400">
                                No Image
                            </span>
                        </div>
                    @endif
                    @if ($collection->category)
                        <div class="absolute inset-0 flex items-center justify-center">

                            <div class="w-full px-5 text-center text-white drop-shadow-[0_4px_20px_rgba(0,0,0,0.5)]">

                                <h3 class="break-words font-serif text-6xl font-normal uppercase leading-[0.8] tracking-[0.02em] sm:text-7xl md:text-8xl lg:text-[7rem]">
                                    {{ $collection->category }}
                                </h3>
                                <div class="mx-auto mt-8 h-px w-16 bg-white transition-all duration-700 group-hover:w-32"></div>
                            </div>
                        </div>
                    @endif
                    @if ($collection->is_sale && $collection->discount)
                        <span class="absolute left-5 top-5 bg-white px-4 py-3 text-xs font-medium uppercase tracking-[0.2em] text-black">
                            {{ $collection->discount }}% Off
                        </span>
                    @endif
                    <div class="absolute inset-x-0 bottom-0 translate-y-full transition duration-500 group-hover:translate-y-0">
                        <div class="flex items-center justify-between bg-white/90 px-5 py-5 backdrop-blur-xl">

                            <span class="text-xs font-medium uppercase tracking-[0.25em]">
                                Discover Piece
                            </span>

                            <span class="flex h-10 w-10 items-center justify-center rounded-full border border-black transition group-hover:bg-black group-hover:text-white">
                                →
                            </span>
                        </div>
                    </div>
                </div>
                <div class="pt-6">

                    <div class="flex items-start justify-between gap-5">

                        <div class="min-w-0">

                            <p class="mb-3 text-xs uppercase tracking-[0.3em] text-neutral-400">
                                Collection
                            </p>

                            <h4 class="truncate font-serif text-2xl tracking-tight text-black md:text-3xl">
                                {{ $collection->name }}
                            </h4>
                        </div>
                        <div class="shrink-0 text-right">

                            @if ($collection->is_sale)

                                <p class="text-sm text-neutral-400 line-through">
                                    ${{ number_format($collection->fullprice ?? 0, 2) }}
                                </p>

                                <p class="mt-1 text-lg font-medium text-black">
                                    ${{ number_format($collection->price ?? 0, 2) }}
                                </p>

                            @else

                                <p class="text-lg font-medium text-black">
                                    ${{ number_format($collection->price ?? 0, 2) }}
                                </p>

                            @endif
                        </div>
                    </div>
                    @if ($collection->is_sale && $collection->discount)

                        <div class="mt-4 flex items-center gap-3">

                            <span class="text-xs font-medium uppercase tracking-[0.2em] text-neutral-600">
                                Save {{ $collection->discount }}%
                            </span>

                            <span class="h-px w-8 bg-neutral-300"></span>

                            <span class="text-xs uppercase tracking-[0.2em] text-neutral-400">
                                Limited Offer
                            </span>
                        </div>
                    @endif
                </div>
            </a>

        @empty

            <div class="w-full py-20 text-center">

                <p class="font-serif text-3xl text-neutral-400">
                    No collections available.
                </p>

            </div>

        @endforelse

    </div>


    @if ($collections->hasPages())

        <div class="mt-20 flex flex-wrap items-center justify-center gap-2">

            @if ($collections->previousPageUrl())

                <a
                    href="{{ $collections->previousPageUrl() }}"
                    class="flex h-11 w-11 items-center justify-center border border-neutral-300 transition hover:bg-black hover:text-white"
                >
                    ←
                </a>

            @endif
            @foreach ($collections->getUrlRange(1, $collections->lastPage()) as $page => $url)

                @if ($page == $collections->currentPage())

                    <span class="flex h-11 min-w-11 items-center justify-center bg-black px-3 text-sm text-white">
                        {{ $page }}
                    </span>
                @else
                    <a
                        href="{{ $url }}"
                        class="flex h-11 min-w-11 items-center justify-center border border-neutral-200 px-3 text-sm transition hover:border-black hover:bg-black hover:text-white"
                    >
                        {{ $page }}
                    </a>

                @endif
            @endforeach
            @if ($collections->nextPageUrl())

                <a
                    href="{{ $collections->nextPageUrl() }}"
                    class="flex h-11 w-11 items-center justify-center border border-neutral-300 transition hover:bg-black hover:text-white"
                >
                    →
                </a>
            @endif
        </div>
    @endif
</section>
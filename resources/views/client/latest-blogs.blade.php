<section class="bg-white px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
    <div class="mx-auto max-w-7xl">

        {{-- Section Heading --}}
        <div class="mb-14 text-center">
            <span class="text-[11px] font-semibold uppercase tracking-[0.3em] text-gray-500">
                The Journal
            </span>

            <h2 class="mt-4 font-serif text-4xl font-medium tracking-tight text-gray-900 sm:text-5xl">
                Latest Stories
            </h2>

            <p class="mx-auto mt-4 max-w-lg text-sm leading-7 text-gray-500 sm:text-base">
                Thoughtful perspectives, inspiring ideas, and stories worth discovering.
            </p>
        </div>

        {{-- Blog Cards --}}
        @if(isset($blogs) && $blogs->count())
            <div class="flex flex-wrap justify-center gap-8">
                @foreach($blogs as $blog)
                    <article class="group w-full overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-[0_4px_24px_rgba(0,0,0,0.04)] transition-all duration-500 hover:-translate-y-1.5 hover:border-gray-200 hover:shadow-[0_16px_40px_rgba(0,0,0,0.09)] sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.34rem)]">

                        {{-- Image --}}
                        <a href="{{ route('blogs.show', $blog->id) }}"
                           class="relative block aspect-[4/3] overflow-hidden bg-gray-50">

                            @if($blog->media === 'video' && $blog->video)
                                <video
                                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    muted loop autoplay playsinline preload="metadata">
                                    <source src="{{ asset('storage/' . $blog->video) }}" type="video/mp4">
                                </video>
                            @else
                                <img
                                    src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('build/assets/noimage.png') }}"
                                    alt="{{ $blog->title }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @endif

                            <div class="absolute inset-0 bg-black/0 transition-colors duration-500 group-hover:bg-black/5"></div>
                        </a>

                        {{-- Content --}}
                        <div class="p-6 sm:p-7">

                            <div class="mb-4 flex items-center gap-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-gray-400">
                                <span>Journal</span>
                                <span class="h-1 w-1 rounded-full bg-gray-300"></span>
                                <time datetime="{{ $blog->created_at->toDateString() }}">
                                    {{ $blog->created_at->format('M d, Y') }}
                                </time>
                            </div>

                            <h3 class="font-serif text-2xl font-medium leading-snug tracking-tight text-gray-900">
                                <a href="{{ route('blogs.show', $blog->id) }}"
                                   class="transition-colors duration-300 group-hover:text-gray-600">
                                    {{ $blog->title }}
                                </a>
                            </h3>

                            @if($blog->description)
                                <p class="mt-4 line-clamp-3 text-sm leading-7 text-gray-500">
                                    {{ $blog->description }}
                                </p>
                            @endif

                            {{-- Bottom Link --}}
                            <div class="mt-7 border-t border-gray-100 pt-5">
                                <a href="{{ route('blogs.show', $blog->id) }}"
                                   class="inline-flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[0.18em] text-gray-800">
                                    Read Story

                                    <span class="flex h-7 w-7 items-center justify-center rounded-full border border-gray-200 transition-all duration-300 group-hover:border-gray-900 group-hover:bg-gray-900 group-hover:text-white">
                                        <svg class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-0.5"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>

                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-14">
                {{ $blogs->links() }}
            </div>
        @else
            <div class="border border-gray-100 bg-white px-6 py-16 text-center">
                <h3 class="font-serif text-2xl text-gray-900">
                    No stories yet
                </h3>
                <p class="mt-3 text-sm text-gray-500">
                    New stories and inspiration will appear here soon.
                </p>
            </div>
        @endif

    </div>
</section>
@extends('client.app')

@section('content')

<section class="relative min-h-[420px] overflow-hidden bg-gray-900 sm:min-h-[500px]">

    <img
        src="{{ asset('build/contact-ring.jpg') }}"
        alt="Journal"
        class="absolute inset-0 h-full w-full object-cover"
    >

    <div class="absolute inset-0 bg-black/50"></div>

    <div class="relative z-10 mx-auto flex min-h-[420px] max-w-7xl flex-col justify-center px-4 py-20 sm:min-h-[500px] sm:px-6 lg:px-8">

        <nav
            class="mb-8 flex items-center gap-3 text-xs font-medium uppercase tracking-[0.2em] text-white/70"
            aria-label="Breadcrumb"
        >
            <a
                href="{{ route('home') }}"
                class="transition-colors duration-300 hover:text-white"
            >
                Home
            </a>

            <span class="text-white/40">/</span>

            <span class="text-white">
                Journal
            </span>
        </nav>

        <div class="max-w-3xl">

            <span class="mb-5 inline-block text-[11px] font-medium uppercase tracking-[0.35em] text-white/70">
                Our Journal
            </span>

            <h1 class="font-serif text-5xl font-medium leading-[1.05] tracking-tight text-white sm:text-6xl lg:text-7xl">
                Stories, Ideas
                <span class="block text-white/70">& Inspiration</span>
            </h1>

            <p class="mt-6 max-w-xl text-sm leading-7 text-white/75 sm:text-base">
                Discover thoughtful stories, expert insights and timeless inspiration
                from our latest journal.
            </p>

        </div>
    </div>
</section>

<section class="bg-[#f8f7f4] px-4 py-16 sm:px-6 lg:px-8 lg:py-24">

    <div class="mx-auto max-w-7xl">

        <div class="mb-14 flex flex-col justify-between gap-6 md:flex-row md:items-end">

            <div class="max-w-2xl">

                <span class="mb-4 inline-block text-[11px] font-medium uppercase tracking-[0.3em] text-gray-500">
                    Our Journal
                </span>

                <h1 class="font-serif text-4xl font-medium tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    Stories, Ideas & Inspiration
                </h1>

                <p class="mt-5 max-w-xl text-sm leading-7 text-gray-500 sm:text-base">
                    Discover thoughtful stories, expert insights and timeless inspiration
                    from our latest journal.
                </p>

            </div>

        </div>

        @if($blogs->count())

            <div class="grid grid-cols-1 gap-x-7 gap-y-14 sm:grid-cols-2 lg:grid-cols-3">

                @foreach($blogs as $blog)

                    <article class="group">

                        <a
                            href="{{ route('blogs.show', $blog->id) }}"
                            class="relative block overflow-hidden bg-gray-100"
                        >

                            <div class="aspect-[4/5] overflow-hidden">

                                @if($blog->media === 'video' && $blog->video)

                                    <video
                                        class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105"
                                        muted
                                        loop                                        
                                        playsinline
                                        preload="metadata"
                                    >
                                        <source
                                            src="{{ asset('storage/' . $blog->video) }}"
                                            type="video/mp4"
                                        >
                                    </video>

                                @else

                                    <img
                                        src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('build/assets/noimage.png') }}"
                                        alt="{{ $blog->title }}"
                                        loading="lazy"
                                        class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105"
                                    >

                                @endif

                            </div>

                            <div class="absolute inset-0 bg-black/0 transition duration-500 group-hover:bg-black/10"></div>

                            <div class="absolute bottom-5 right-5 flex h-12 w-12 translate-y-3 items-center justify-center rounded-full bg-white opacity-0 shadow-lg transition-all duration-500 group-hover:translate-y-0 group-hover:opacity-100">

                                <svg
                                    class="h-4 w-4 text-gray-900"
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

                            </div>

                        </a>

                        <div class="pt-6">

                            <div class="mb-4 flex items-center gap-3 text-[11px] font-medium uppercase tracking-[0.16em] text-gray-500">

                                <span>
                                    Journal
                                </span>

                                <span class="h-1 w-1 rotate-45 bg-gray-400"></span>

                                <span>
                                    {{ $blog->created_at->format('F d, Y') }}
                                </span>

                            </div>

                            <a
                                href="{{ route('blogs.show', $blog->id) }}"
                                class="block"
                            >

                                <h2 class="font-serif text-2xl leading-tight text-gray-900 transition-colors duration-300 group-hover:text-gray-600 sm:text-[26px]">
                                    {{ $blog->title }}
                                </h2>

                            </a>

                            @if($blog->description)

                                <p class="mt-4 line-clamp-3 text-sm leading-6 text-gray-500">
                                    {{ $blog->description }}
                                </p>

                            @endif

                            <div class="mt-6 h-px w-full overflow-hidden bg-gray-200">

                                <div class="h-full w-0 bg-gray-900 transition-all duration-700 group-hover:w-full"></div>

                            </div>

                            <a
                                href="{{ route('blogs.show', $blog->id) }}"
                                class="group/link mt-5 inline-flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.18em] text-gray-800"
                            >

                                <span>
                                    View Details
                                </span>

                                <span class="transition-transform duration-300 group-hover/link:translate-x-1">
                                    →
                                </span>

                            </a>

                        </div>

                    </article>

                @endforeach

            </div>

            <div class="mt-16">
                {{ $blogs->links() }}
            </div>

        @else

            <div class="flex min-h-[350px] items-center justify-center border border-dashed border-gray-300">

                <div class="text-center">

                    <h2 class="font-serif text-2xl text-gray-900">
                        No stories found
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Check back soon for new articles and inspiration.
                    </p>

                </div>

            </div>

        @endif

    </div>

</section>

@endsection 
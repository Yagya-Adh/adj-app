@extends('client.app')

@section('content')

<article class="overflow-hidden bg-[#f8f7f4] text-gray-900">

    {{-- Header --}}
    <section class="px-4 pb-14 pt-20 sm:px-6 lg:px-8 lg:pb-20 lg:pt-28">
        <div class="mx-auto max-w-5xl text-center">

            <div class="mb-7 flex items-center justify-center gap-3 text-[10px] font-semibold uppercase tracking-[0.3em] text-gray-400">
                <span>{{ $blog->category ?? 'Journal' }}</span>

                <span class="h-1 w-1 rotate-45 bg-gray-400"></span>

                <span>{{ $blog->created_at->format('F d, Y') }}</span>
            </div>

            <h1 class="mx-auto max-w-5xl font-serif text-4xl font-medium leading-[1.02] tracking-[-0.03em] sm:text-6xl lg:text-8xl">
                {{ $blog->title }}
            </h1>

            @if($blog->description)
                <p class="mx-auto mt-8 max-w-2xl text-base leading-8 text-gray-500 sm:text-lg">
                    {{ $blog->description }}
                </p>
            @endif

            @if($blog->customer)
                <div class="mt-10 inline-flex items-center gap-3 border-t border-gray-200 pt-6">

                    @if($blog->customer_image)
                        <img
                            src="{{ asset('storage/' . $blog->customer_image) }}"
                            alt="{{ $blog->customer }}"
                            class="h-11 w-11 rounded-full object-cover"
                        >
                    @else
                        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-gray-900 text-sm font-medium text-white">
                            {{ strtoupper(substr($blog->customer, 0, 1)) }}
                        </div>
                    @endif

                    <div class="text-left">
                        <p class="text-[9px] font-semibold uppercase tracking-[0.25em] text-gray-400">
                            Written by
                        </p>

                        <p class="mt-1 text-sm font-medium text-gray-900">
                            {{ $blog->customer }}
                        </p>
                    </div>

                </div>
            @endif

        </div>
    </section>


    {{-- Featured Image --}}
    <section class="px-3 sm:px-6 lg:px-8">

        <div class="group relative mx-auto max-w-7xl overflow-hidden bg-gray-100">

            @if($blog->image)

                <img
                    src="{{ asset('storage/' . $blog->image) }}"
                    alt="{{ $blog->title }}"
                    class="h-[420px] w-full object-cover transition duration-1000 group-hover:scale-[1.02] sm:h-[560px] lg:h-[720px]"
                >

                <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>

            @else

                <div class="flex h-[420px] items-center justify-center sm:h-[560px] lg:h-[720px]">
                    <span class="text-[10px] font-semibold uppercase tracking-[0.3em] text-gray-400">
                        No Image
                    </span>
                </div>

            @endif

        </div>

    </section>


    {{-- Article --}}
    <section class="px-4 py-20 sm:px-6 lg:px-8 lg:py-28">

        <div class="mx-auto max-w-3xl">

            @if($blog->content)

                <div class="prose prose-lg max-w-none
                    prose-headings:font-serif
                    prose-headings:font-medium
                    prose-headings:tracking-tight
                    prose-headings:text-gray-900
                    prose-p:my-7
                    prose-p:leading-8
                    prose-p:text-gray-600
                    prose-a:text-gray-900
                    prose-a:underline
                    prose-a:underline-offset-4
                    prose-blockquote:border-gray-300
                    prose-blockquote:font-serif
                    prose-blockquote:text-gray-800
                    prose-img:w-full
                    prose-img:rounded-none">

                    {!! $blog->content !!}

                </div>

            @elseif($blog->description)

                <div class="text-base leading-8 text-gray-600 sm:text-lg">
                    {!! nl2br(e($blog->description)) !!}
                </div>

            @endif

        </div>

    </section>


    {{-- Media Gallery --}}
    @if(!empty($blog->media))

        <section class="px-4 pb-20 sm:px-6 lg:px-8 lg:pb-28">

            <div class="mx-auto max-w-7xl">

                <div class="mb-10 flex items-end justify-between border-b border-gray-200 pb-6">

                    <div>
                        <span class="text-[10px] font-semibold uppercase tracking-[0.3em] text-gray-400">
                            Visual Journal
                        </span>

                        <h2 class="mt-3 font-serif text-3xl text-gray-900 sm:text-4xl">
                            More from the story
                        </h2>
                    </div>

                    <span class="hidden text-xs text-gray-400 sm:block">
                        {{ count($blog->media) }} Images
                    </span>

                </div>


                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                    @foreach($blog->media as $media)

                        <div
                            class="group relative overflow-hidden bg-gray-100
                            {{ $loop->first ? 'md:col-span-2' : '' }}"
                        >

                            <img
                                src="{{ asset('storage/' . $media) }}"
                                alt="{{ $blog->title }}"
                                loading="lazy"
                                class="w-full object-cover transition duration-1000 group-hover:scale-[1.025]
                                {{ $loop->first
                                    ? 'max-h-[760px]'
                                    : 'aspect-[4/3]' }}"
                            >

                            <div class="pointer-events-none absolute inset-0 bg-black/0 transition duration-500 group-hover:bg-black/10"></div>

                            <div class="absolute bottom-5 left-5 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-xs font-medium opacity-0 shadow-sm transition duration-500 group-hover:opacity-100">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>

    @endif


    {{-- Closing Quote / Story End --}}
    <section class="px-4 pb-20 sm:px-6 lg:px-8 lg:pb-28">

        <div class="mx-auto max-w-4xl border-y border-gray-200 py-14 text-center sm:py-20">

            <span class="font-serif text-4xl text-gray-300">
                “
            </span>

            <p class="mx-auto mt-3 max-w-2xl font-serif text-2xl leading-relaxed text-gray-800 sm:text-3xl">
                Every story is a collection of moments worth remembering.
            </p>

            <span class="mt-6 block text-[9px] font-semibold uppercase tracking-[0.3em] text-gray-400">
                End of Story
            </span>

        </div>

    </section>


    {{-- Footer --}}
    <section class="border-t border-gray-200 px-4 py-14 sm:px-6 lg:px-8 lg:py-20">

        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-8 sm:flex-row sm:items-center">

            <a
                href="{{ route('blogs') }}"
                class="group inline-flex items-center gap-4 text-sm font-medium text-gray-800"
            >

                <span class="flex h-11 w-11 items-center justify-center rounded-full border border-gray-300 text-lg transition duration-300 group-hover:-translate-x-1 group-hover:border-gray-900 group-hover:bg-gray-900 group-hover:text-white">
                    ←
                </span>

                <span>
                    Back to Journal
                </span>

            </a>


            <div class="text-left sm:text-right">

                <span class="block text-[9px] font-semibold uppercase tracking-[0.3em] text-gray-400">
                    Published
                </span>

                <span class="mt-2 block text-sm text-gray-700">
                    {{ $blog->created_at->format('F d, Y') }}
                </span>

            </div>

        </div>

    </section>

</article>

@endsection
@extends('client.app')

@section('content')

<div class="bg-[#f7f5f0] text-gray-900">

    <section class="relative isolate overflow-hidden">

        <div class="absolute inset-0 -z-30">
            <img
                src="{{ asset('build/contact-ring.jpg') }}"
                alt="Shop collection"
                class="h-full w-full object-cover"
            >
        </div>

        <div class="absolute inset-0 -z-10 bg-white/55"></div>

        <div class="relative mx-auto flex min-h-[520px] max-w-7xl flex-col items-center px-4 py-10 text-center sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav
                aria-label="Breadcrumb"
                class="absolute left-4 top-8 z-10 sm:left-6 lg:left-8"
            >
                <ol class="flex items-center gap-2 rounded-full border border-black/10 bg-white/70 px-4 py-2 text-sm font-medium text-gray-600 shadow-sm backdrop-blur-md">

                    <li>
                        <a
                            href="{{ route('home') }}"
                            class="transition hover:text-black"
                        >
                            Home
                        </a>
                    </li>

                    <li
                        class="text-gray-400"
                        aria-hidden="true"
                    >
                        /
                    </li>

                    <li
                        class="font-semibold text-gray-900"
                        aria-current="page"
                    >
                        Shop
                    </li>

                </ol>
            </nav>

            {{-- Hero Content --}}
            <div class="my-auto max-w-2xl">

                <span class="mb-5 inline-block rounded-full border border-black/10 bg-white/60 px-4 py-2 text-sm font-medium text-gray-800 shadow-sm backdrop-blur-md">
                    Latest Collection
                </span>

                <h1 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    Discover Something Beautiful
                </h1>

                <p class="mx-auto mt-6 max-w-xl text-base leading-7 text-black/70 sm:text-lg">
                    Explore our latest collection of thoughtfully selected pieces,
                    crafted to bring timeless style to every moment.
                </p>

                <a
                    href="#latest"
                    class="mt-8 inline-flex items-center rounded-full bg-black px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-gray-800"
                >
                    Shop Collection
                </a>

            </div>

        </div>

    </section>

    <section id="latest">
        @include('client.latest')
    </section>

</div>

@endsection
@extends('client.app')

@section('content')

@php
    $slides = [
        [
            'image' => 'jew1.jpg',
            'title' => 'Where Luxury Shines',
            'description' => 'Discover the art of sophistication with our curated collection of exquisite jewelry.',
        ],
        [
            'image' => 'jew2.jpg',
            'title' => 'Where Beauty Glows',
            'description' => 'Discover the art of sophistication with our curated collection of exquisite jewelry.',
        ],
        [
            'image' => 'jew3.jpg',
            'title' => 'Where Elegance Meets',
            'description' => 'Discover the art of sophistication with our curated collection of exquisite jewelry.',
        ],
    ];
@endphp

<section
    x-data="{
        slides: @js($slides),
        active: 0,
        timer: null,

        init() {
            this.start()
        },

        next() {
            this.active = (this.active + 1) % this.slides.length
        },

        prev() {
            this.active = (this.active - 1 + this.slides.length) % this.slides.length
        },

        start() {
            this.stop()
            this.timer = setInterval(() => this.next(), 5000)
        },

        stop() {
            clearInterval(this.timer)
        }
    }"
    x-init="init()"
    @mouseenter="stop()"
    @mouseleave="start()"
    class="relative h-[650px] overflow-hidden bg-black sm:h-[700px]"
>

    <template x-for="(slide, index) in slides" :key="index">

        <div
            class="absolute inset-0 transition-all duration-1000"
            :class="active === index
                ? 'z-10 scale-100 opacity-100'
                : 'pointer-events-none z-0 scale-105 opacity-0'"
        >

            <img
                :src="'{{ asset('/build') }}/' + slide.image"
                :alt="slide.title"
                class="absolute inset-0 h-full w-full object-cover"
            >

            <div class="absolute inset-0 bg-black/60"></div>

            <div class="absolute inset-0 bg-black/20"></div>

            <div class="absolute inset-0 z-10 flex items-center justify-center px-6 text-center">

                <div class="w-full max-w-3xl">

                    <p class="mb-5 text-sm font-medium uppercase tracking-[0.4em] text-white">
                        Exquisite Jewelry
                    </p>

                    <h1
                        x-text="slide.title"
                        class="text-4xl font-light leading-tight tracking-wide text-white sm:text-6xl lg:text-7xl"
                    ></h1>

                    <p
                        x-text="slide.description"
                        class="mx-auto mt-6 max-w-2xl text-base leading-7 text-white sm:text-lg sm:leading-8"
                    ></p>

                    <a
                        href="{{ route('shop') }}"
                        class="mt-9 inline-flex items-center gap-2 rounded-full border border-white bg-transparent px-8 py-3.5 text-sm font-medium text-white transition duration-300 hover:bg-white hover:text-black"
                    >
                        Explore

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 12h14m-6-6 6 6-6 6"
                            />
                        </svg>
                    </a>

                </div>

            </div>

        </div>

    </template>

    <button
        type="button"
        @click="prev()"
        aria-label="Previous slide"
        class="absolute left-4 top-1/2 z-30 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full border border-white/50 bg-black/20 text-white backdrop-blur-md transition hover:bg-white hover:text-black sm:left-8"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="1.5"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M15 19l-7-7 7-7"
            />
        </svg>
    </button>

    <button
        type="button"
        @click="next()"
        aria-label="Next slide"
        class="absolute right-4 top-1/2 z-30 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full border border-white/50 bg-black/20 text-white backdrop-blur-md transition hover:bg-white hover:text-black sm:right-8"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="1.5"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M9 5l7 7-7 7"
            />
        </svg>
    </button>

    <div class="absolute bottom-8 left-1/2 z-30 flex -translate-x-1/2 gap-2">

        <template x-for="(slide, index) in slides" :key="index">

            <button
                type="button"
                @click="active = index"
                :aria-label="'Go to slide ' + (index + 1)"
                class="h-1.5 rounded-full transition-all duration-300"
                :class="active === index
                    ? 'w-10 bg-white'
                    : 'w-5 bg-white/50 hover:bg-white'"
            ></button>

        </template>

    </div>

</section>

@endsection 
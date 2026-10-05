@extends('client.app')

@section('content')

@php
    $slides = [
        [
            'image' => 'jew1.jpg',
            'eyebrow' => 'The Art of Fine Jewelry',
            'title' => 'Where Luxury Shines',
            'description' => 'Discover timeless pieces crafted to celebrate elegance, beauty, and individuality.',
        ],
        [
            'image' => 'jew2.jpg',
            'eyebrow' => 'Elegance, Reimagined',
            'title' => 'Where Beauty Glows',
            'description' => 'Explore a refined collection designed to make every moment beautifully unforgettable.',
        ],
        [
            'image' => 'jew3.jpg',
            'eyebrow' => 'Timelessly Yours',
            'title' => 'Where Elegance Meets',
            'description' => 'A curated expression of sophistication, crafted for those who appreciate the extraordinary.',
        ],
    ];
@endphp

<section
    x-data="{
        slides: @js($slides),
        active: 0,
        previous: 0,
        timer: null,

        init() {
            this.start()
        },

        next() {
            this.previous = this.active
            this.active = (this.active + 1) % this.slides.length
        },

        prev() {
            this.previous = this.active
            this.active = (this.active - 1 + this.slides.length) % this.slides.length
        },

        goTo(index) {
            if (index === this.active) return
            this.previous = this.active
            this.active = index
            this.start()
        },

        start() {
            this.stop()
            this.timer = setInterval(() => this.next(), 6000)
        },

        stop() {
            clearInterval(this.timer)
        }
    }"
    x-init="init()"
    @mouseenter="stop()"
    @mouseleave="start()"
    class="group relative h-[680px] overflow-hidden bg-[#111] sm:h-[760px] lg:h-[820px]"
>

    {{-- Slides --}}
    <template x-for="(slide, index) in slides" :key="index">

        <div
            class="absolute inset-0"
            :class="active === index
                ? 'z-10 opacity-100'
                : 'pointer-events-none z-0 opacity-0'"
            style="transition: opacity 1.2s ease;"
        >

            {{-- Background Image --}}
            <img
                :src="'{{ asset('/build') }}/' + slide.image"
                :alt="slide.title"
                class="absolute inset-0 h-full w-full object-cover"
                :class="active === index ? 'scale-100' : 'scale-110'"
                style="transition: transform 7s cubic-bezier(.2,.6,.2,1);"
            >

            {{-- Premium Gradient --}}
            <div class="absolute inset-0 bg-gradient-to-r from-black/65 via-black/25 to-black/10"></div>

            <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-transparent to-black/20"></div>

            {{-- Content --}}
            <div class="relative z-10 flex h-full items-center">

                <div class="mx-auto w-full max-w-screen-2xl px-6 sm:px-10 lg:px-16 xl:px-24">

                    <div class="max-w-3xl">

                        {{-- Eyebrow --}}
                        <div
                            class="mb-7 flex items-center gap-4"
                            :class="active === index ? 'translate-y-0 opacity-100' : 'translate-y-6 opacity-0'"
                            style="transition: all .8s .2s ease;"
                        >
                            <span class="h-px w-10 bg-white/80"></span>

                            <p
                                x-text="slide.eyebrow"
                                class="text-[10px] font-medium uppercase tracking-[0.45em] text-white/90 sm:text-xs"
                            ></p>
                        </div>

                        {{-- Heading --}}
                        <h1
                            x-text="slide.title"
                            class="max-w-3xl text-5xl font-light leading-[0.95] tracking-[-0.03em] text-white sm:text-7xl lg:text-8xl xl:text-[100px]"
                            :class="active === index ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                            style="transition: all 1s .3s cubic-bezier(.2,.7,.2,1);"
                        ></h1>

                        {{-- Description --}}
                        <p
                            x-text="slide.description"
                            class="mt-7 max-w-xl text-sm leading-7 text-white/80 sm:text-base sm:leading-8"
                            :class="active === index ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                            style="transition: all .9s .5s ease;"
                        ></p>

                        {{-- CTA --}}
                        <div
                            class="mt-9"
                            :class="active === index ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                            style="transition: all .9s .65s ease;"
                        >

                            <a
                                href="{{ route('shop') }}"
                                x-data="{ hover: false }"
                                @mouseenter="hover = true"
                                @mouseleave="hover = false"
                                class="relative inline-flex h-14 min-w-[185px] items-center justify-center overflow-hidden rounded-full bg-white px-8 text-sm font-medium text-black"
                            >

                                {{-- Circle --}}
                                <span
                                    class="absolute bottom-0 left-1/2 h-[240px] w-[240px] -translate-x-1/2 rounded-full bg-black"
                                    :class="hover ? 'translate-y-[38%]' : 'translate-y-full'"
                                    style="transition: transform .75s cubic-bezier(.77,0,.18,1);"
                                ></span>

                                {{-- Text --}}
                                <span class="relative z-10 block overflow-hidden">

                                    <span
                                        class="block whitespace-nowrap"
                                        :class="hover ? '-translate-y-full' : 'translate-y-0'"
                                        style="transition: transform .5s cubic-bezier(.77,0,.18,1);"
                                    >
                                        Explore Collection
                                    </span>

                                    <span
                                        class="absolute left-0 top-full whitespace-nowrap text-white"
                                        :class="hover ? '-translate-y-full' : 'translate-y-0'"
                                        style="transition: transform .5s cubic-bezier(.77,0,.18,1);"
                                    >
                                        Explore Collection
                                    </span>

                                </span>

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="relative z-10 ml-2 h-4 w-4"
                                    :class="hover ? 'text-white' : 'text-black'"
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

            </div>

        </div>

    </template>

    {{-- Slide Counter --}}
    <div class="absolute bottom-10 left-6 z-30 flex items-center gap-4 text-white sm:left-10 lg:left-16">

        <span
            class="text-xs tracking-[0.2em] text-white/60"
            x-text="String(active + 1).padStart(2, '0')"
        ></span>

        <span class="h-px w-12 bg-white/30"></span>

        <span
            class="text-xs tracking-[0.2em] text-white/40"
            x-text="String(slides.length).padStart(2, '0')"
        ></span>

    </div>

    {{-- Navigation --}}
    <div class="absolute bottom-8 right-6 z-30 flex gap-2 sm:right-10 lg:right-16">

        <button
            type="button"
            @click="prev(); start()"
            aria-label="Previous slide"
            class="flex h-12 w-12 items-center justify-center rounded-full border border-white/30 bg-white/5 text-white backdrop-blur-md transition duration-300 hover:border-white hover:bg-white hover:text-black"
        >
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
                    d="M15 19l-7-7 7-7"
                />
            </svg>
        </button>

        <button
            type="button"
            @click="next(); start()"
            aria-label="Next slide"
            class="flex h-12 w-12 items-center justify-center rounded-full border border-white/30 bg-white/5 text-white backdrop-blur-md transition duration-300 hover:border-white hover:bg-white hover:text-black"
        >
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
                    d="M9 5l7 7-7 7"
                />
            </svg>
        </button>

    </div>

    {{-- Progress Indicators --}}
    <div class="absolute bottom-10 left-1/2 z-30 flex -translate-x-1/2 items-center gap-2">

        <template x-for="(slide, index) in slides" :key="index">

            <button
                type="button"
                @click="goTo(index)"
                :aria-label="'Go to slide ' + (index + 1)"
                class="group/dot relative h-1 overflow-hidden rounded-full bg-white/30 transition-all duration-500"
                :class="active === index ? 'w-14' : 'w-5 hover:w-8'"
            >

                <span
                    class="absolute inset-y-0 left-0 bg-white"
                    :class="active === index ? 'w-full' : 'w-0'"
                    style="transition: width 6s linear;"
                ></span>

            </button>

        </template>

    </div>

</section>
@include('client.latest')
@endsection 
@extends('client.app')
@section('content')
<section class="bg-[#f4f3ef]">
<div class="relative min-h-[520px] overflow-hidden">
    <img
        src="{{ asset('build/contact-ring.jpg') }}"
        alt="Contact Us"
        class="absolute inset-0 z-0 h-full w-full object-cover"
    >

    <div class="absolute inset-0 z-10 bg-black/45"></div>

    <div class="relative z-20 mx-auto flex min-h-[520px] max-w-7xl flex-col px-5 py-8 sm:px-8 lg:px-12">

        <nav class="relative z-50 flex items-center text-[10px] uppercase tracking-[0.25em] text-white">
            <a
                href="{{ route('home') }}"
                class="text-white/70 transition duration-300 hover:text-white"
            >
                Home
            </a>

            <span class="mx-3 text-white/40">/</span>

            <span class="font-medium text-white">
                Contact
            </span>
        </nav>

        <div class="mt-auto max-w-2xl pb-14 sm:pb-16">

            <p class="mb-5 text-[10px] md:text-xl font-semibold uppercase tracking-[0.3em] text-white/60">
                Get In Touch
            </p>

            <h1 class="font-serif text-6xl font-medium leading-none tracking-tight text-white sm:text-7xl lg:text-8xl">
                Let's Talk.
            </h1>

            <p class="mt-6 max-w-lg text-sm md:text-xl leading-7 text-white/70 sm:text-base">
                Have a question, an idea, or simply want to know more?
                We'd love to hear from you.
            </p>

        </div>

    </div>
</div>
<div class="mx-auto max-w-7xl">
    <div class="grid overflow-hidden bg-white shadow-xl">
            @include('client.contact-us-form')
    </div>
</div>
</section>
@endsection

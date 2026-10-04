@extends('client.app')

@section('content')

<section class="relative flex h-[380px] items-center overflow-hidden">

    <img
        src="{{ asset('build/contact-ring.jpg') }}"
        alt="Contact Us"
        class="absolute inset-0 h-full w-full object-cover"
    >

    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative z-10 mx-auto w-full max-w-screen-xl px-4 text-center">
        <h1 class="text-4xl font-bold text-white md:text-5xl">
            Contact Us
        </h1>

        <div class="mt-4 flex items-center justify-center gap-3 text-sm">
            <a
                href="{{ route('home') }}"
                class="text-white/80 transition hover:text-white"
            >
                Home
            </a>

            <span class="h-1.5 w-1.5 rotate-45 bg-white"></span>

            <span class="text-white">
                Contact
            </span>
        </div>
    </div>

</section>
@include('client.contact-us-form')

@endsection
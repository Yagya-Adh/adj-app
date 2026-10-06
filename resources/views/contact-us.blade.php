@extends('client.app')

@section('content')

<section class="overflow-hidden bg-[#f6f5f1]">

```
{{-- Hero --}}
<div class="relative min-h-[560px] overflow-hidden">

    <img
        src="{{ asset('build/contact-ring.jpg') }}"
        alt="Contact Us"
        class="absolute inset-0 h-full w-full object-cover"
    >

    <div class="absolute inset-0 bg-black/45"></div>

    <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/10 to-black/60"></div>


    <div class="relative z-10 mx-auto flex min-h-[560px] max-w-7xl flex-col px-4 py-8 sm:px-6 lg:px-10 lg:py-10">
        <nav
            aria-label="Breadcrumb"
            class="flex items-center gap-3 text-[10px] font-semibold uppercase tracking-[0.3em]"
        >

            <a
                href="{{ route('home') }}"
                class="text-white/60 transition duration-300 hover:text-white"
            >
                Home
            </a>

            <span class="text-white/30">
                /
            </span>

            <span class="text-white">
                Contact
            </span>

        </nav>
        <div class="mt-auto max-w-5xl pb-10 sm:pb-14 lg:pb-20">

            <div class="mb-7 flex items-center gap-4">

                <span class="h-px w-12 bg-white/70"></span>

                <span class="text-[10px] font-semibold uppercase tracking-[0.35em] text-white/80">
                    Get In Touch
                </span>

            </div>


            <h1 class="font-serif text-6xl font-medium uppercase leading-[0.88] tracking-[-0.045em] text-white sm:text-7xl lg:text-[clamp(5rem,9vw,9rem)]">
                Let's Talk.
            </h1>


            <p class="mt-8 max-w-lg text-sm uppercase leading-7 tracking-[0.08em] text-white/75 sm:text-base">
                Have a question, an idea, or simply want to know more?
                We'd love to hear from you.
            </p>

        </div>

    </div>

</div>
<div class="relative z-20 mx-auto -mt-16 max-w-7xl px-4 pb-16 sm:px-6 lg:-mt-24 lg:px-10 lg:pb-28">

    <div class="overflow-hidden border border-black/[0.04] bg-white shadow-[0_30px_80px_rgba(0,0,0,0.08)]">

        @include('client.contact-us-form')

    </div>

</div>
</section>

@endsection

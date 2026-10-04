@extends('client.app')
@section('content')
<section class="relative overflow-hidden bg-[#edf0f4] px-5 py-10 sm:px-6 md:py-14">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -left-40 -top-40 h-[500px] w-[500px] rounded-full bg-white/80 blur-[120px]"></div>
        <div class="absolute -right-40 top-1/3 h-[450px] w-[450px] rounded-full bg-slate-300/60 blur-[120px]"></div>
        <div class="absolute bottom-[-250px] left-1/3 h-[500px] w-[500px] rounded-full bg-white/50 blur-[130px]"></div>
    </div>

    <div class="relative mx-auto max-w-screen-xl">
        <div class="grid items-center gap-5 lg:grid-cols-[1.35fr_.65fr]">

            <div class="relative overflow-hidden rounded-[2.5rem] border border-white/90 bg-white/30 p-7 shadow-[inset_0_2px_0_rgba(255,255,255,.95),0_25px_60px_rgba(40,50,70,.08)] backdrop-blur-3xl sm:p-10 lg:p-14">

                <div class="absolute -right-24 -top-24 h-64 w-64 rounded-full border border-white/60 bg-white/20 blur-sm"></div>
                <div class="absolute -bottom-32 -left-32 h-72 w-72 rounded-full bg-white/20 blur-3xl"></div>

                <div class="relative">
                    <div class="mb-6 inline-flex items-center gap-3 rounded-full border border-white/90 bg-white/45 px-4 py-2 text-[10px] font-bold uppercase tracking-[0.3em] text-gray-500 shadow-[inset_2px_2px_8px_rgba(255,255,255,.9)] backdrop-blur-2xl">
                        <span class="h-1.5 w-1.5 rounded-full bg-gray-900"></span>
                        Web • Apps • Research
                    </div>

                    <h1 class="max-w-4xl text-4xl font-black leading-[.95] tracking-[-0.07em] text-gray-900 sm:text-5xl md:text-6xl lg:text-7xl">
                        Empowering
                        <span class="text-gray-400">Your Vision</span>
                        Through Technology.
                    </h1>

                    <p class="mt-6 max-w-2xl text-sm leading-7 text-gray-600 md:text-base">
                        We deliver expert web solutions, application development,
                        and research through thoughtful technology and dedicated expertise.
                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        <a
                            href="{{ url('#our-store') }}"
                            class="group inline-flex items-center gap-4 rounded-full bg-gray-900 py-2 pl-6 pr-2 text-sm font-bold text-white shadow-[0_15px_35px_rgba(20,25,35,.16)] transition duration-300 hover:-translate-y-1 hover:bg-gray-800"
                        >
                            <span>Get Started</span>

                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-gray-900 transition-transform duration-300 group-hover:rotate-45">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M7 7h10v10" />
                                </svg>
                            </span>
                        </a>

                        <span class="rounded-full border border-white/90 bg-white/35 px-5 py-3 text-xs font-medium text-gray-500 backdrop-blur-2xl">
                            Built with purpose
                        </span>
                    </div>
                </div>
            </div>

            <div class="relative hidden min-h-[390px] overflow-hidden rounded-[2.5rem] border border-white/90 bg-white/20 shadow-[inset_0_2px_0_rgba(255,255,255,.95),0_25px_60px_rgba(40,50,70,.08)] backdrop-blur-3xl lg:flex lg:items-center lg:justify-center">

                <div class="absolute h-72 w-72 rounded-full border border-white/80 bg-white/20 shadow-[inset_0_0_50px_rgba(255,255,255,.8)] backdrop-blur-2xl"></div>

                <div class="relative h-56 w-56 rotate-6 rounded-[3rem] border border-white bg-white/40 p-5 shadow-[inset_0_2px_0_rgba(255,255,255,.95),0_30px_60px_rgba(40,50,70,.12)] backdrop-blur-3xl transition duration-500 hover:rotate-0 hover:scale-105">
                    <div class="flex h-full flex-col justify-between rounded-[2.4rem] border border-white/70 p-6">

                        <div class="flex items-center justify-between">
                            <span class="h-2 w-2 rounded-full bg-gray-900"></span>

                            <span class="text-[9px] font-bold uppercase tracking-[0.25em] text-gray-400">
                                01
                            </span>
                        </div>

                        <div>
                            <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-900 text-white shadow-xl">
                                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18M5.6 5.6l12.8 12.8M18.4 5.6L5.6 18.4" />
                                </svg>
                            </div>

                            <p class="text-lg font-black tracking-tight text-gray-900">
                                Build.
                            </p>

                            <p class="mt-1 text-xs text-gray-400">
                                Create. Improve. Deliver.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="absolute right-8 top-10 h-3 w-3 rounded-full bg-gray-900 shadow-lg"></div>
                <div class="absolute bottom-12 left-8 h-2 w-2 rounded-full bg-gray-400"></div>
                <div class="absolute bottom-20 right-14 h-8 w-8 rounded-xl border border-white bg-white/40 backdrop-blur-xl"></div>
            </div>

        </div>

        <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-4">
            <div class="rounded-2xl border border-white/90 bg-white/30 px-5 py-4 shadow-[inset_0_1px_0_rgba(255,255,255,.9)] backdrop-blur-2xl">
                <p class="text-lg font-black text-gray-900">Web</p>
                <p class="mt-1 text-[10px] uppercase tracking-widest text-gray-400">Solutions</p>
            </div>

            <div class="rounded-2xl border border-white/90 bg-white/30 px-5 py-4 shadow-[inset_0_1px_0_rgba(255,255,255,.9)] backdrop-blur-2xl">
                <p class="text-lg font-black text-gray-900">Apps</p>
                <p class="mt-1 text-[10px] uppercase tracking-widest text-gray-400">Development</p>
            </div>

            <div class="rounded-2xl border border-white/90 bg-white/30 px-5 py-4 shadow-[inset_0_1px_0_rgba(255,255,255,.9)] backdrop-blur-2xl">
                <p class="text-lg font-black text-gray-900">Research</p>
                <p class="mt-1 text-[10px] uppercase tracking-widest text-gray-400">Innovation</p>
            </div>

            <div class="rounded-2xl border border-white/90 bg-white/30 px-5 py-4 shadow-[inset_0_1px_0_rgba(255,255,255,.9)] backdrop-blur-2xl">
                <p class="text-lg font-black text-gray-900">Quality</p>
                <p class="mt-1 text-[10px] uppercase tracking-widest text-gray-400">Delivery</p>
            </div>
        </div>
    </div>
</section>


@endsection
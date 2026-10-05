<nav
    x-data="{ open: false }"
    class="fixed inset-y-0 left-0 z-50 flex w-[280px] -translate-x-full flex-col overflow-hidden border-r border-slate-200/80 bg-white/95 shadow-2xl shadow-slate-900/5 backdrop-blur-xl transition-transform duration-300 lg:translate-x-0"
    :class="{ 'translate-x-0': open }"
>

    {{-- Mobile overlay --}}
    <div
        x-show="open"
        x-transition.opacity
        @click="open = false"
        class="fixed inset-0 -z-10 bg-slate-950/40 backdrop-blur-sm lg:hidden"
    ></div>

    {{-- Brand --}}
    <div class="relative flex h-[88px] shrink-0 items-center border-b border-slate-100/80 px-5">

        <a
            href="{{ route('dashboard') }}"
            class="group flex min-w-0 items-center gap-3"
        >

            <div class="relative flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-slate-950 shadow-lg shadow-slate-900/20 transition duration-300 group-hover:scale-105">

                <div class="absolute inset-0 bg-gradient-to-br from-white/20 via-transparent to-transparent"></div>

                <x-application-logo class="relative h-9 w-9 object-contain" />

            </div>

            <div class="min-w-0">
                <div class="text-[17px] font-bold tracking-[-0.02em] text-slate-950">
                    Admin
                </div>

                <div class="mt-0.5 text-[11px] font-medium tracking-wide text-slate-400">
                    MANAGEMENT PANEL
                </div>
            </div>

        </a>

        <button
            @click="open = false"
            class="ml-auto rounded-xl p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-900 lg:hidden"
            aria-label="Close sidebar"
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>

    </div>


    {{-- Navigation --}}
    <div class="flex-1 overflow-y-auto px-4 py-6">

        {{-- Overview --}}
        <div class="mb-3 flex items-center gap-2 px-3">
            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                Overview
            </p>
        </div>

        <div class="space-y-1">

            {{-- Dashboard --}}
            <a
                href="{{ route('dashboard') }}"
                class="group relative flex items-center gap-3 rounded-2xl px-3.5 py-3 text-sm font-semibold transition-all duration-200
                {{ request()->routeIs('dashboard')
                    ? 'bg-slate-950 text-white shadow-lg shadow-slate-950/15'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-950' }}"
            >

                @if(request()->routeIs('dashboard'))
                    <span class="absolute left-0 top-1/2 h-6 w-1 -translate-y-1/2 rounded-r-full bg-white"></span>
                @endif

                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl
                    {{ request()->routeIs('dashboard')
                        ? 'bg-white/10'
                        : 'bg-slate-100 group-hover:bg-white group-hover:shadow-sm' }}">

                    <svg
                        class="h-[18px] w-[18px] {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-slate-800' }}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 12l9-9 9 9M5 10v10h14V10M9 20v-6h6v6"
                        />
                    </svg>

                </span>

                <span>Dashboard</span>

                @if(request()->routeIs('dashboard'))
                    <span class="ml-auto h-1.5 w-1.5 rounded-full bg-white"></span>
                @endif

            </a>


            {{-- Contacts --}}
            <a
                href="{{ route('contact.index') }}"
                class="group relative flex items-center gap-3 rounded-2xl px-3.5 py-3 text-sm font-semibold transition-all duration-200
                {{ request()->routeIs('contacts.*')
                    ? 'bg-slate-950 text-white shadow-lg shadow-slate-950/15'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-950' }}"
            >

                @if(request()->routeIs('contacts.*'))
                    <span class="absolute left-0 top-1/2 h-6 w-1 -translate-y-1/2 rounded-r-full bg-white"></span>
                @endif

                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl
                    {{ request()->routeIs('contacts.*')
                        ? 'bg-white/10'
                        : 'bg-slate-100 group-hover:bg-white group-hover:shadow-sm' }}">

                    <svg
                        class="h-[18px] w-[18px] {{ request()->routeIs('contacts.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-800' }}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                        />
                    </svg>

                </span>

                <span>Contacts</span>

                @if(request()->routeIs('contacts.*'))
                    <span class="ml-auto h-1.5 w-1.5 rounded-full bg-white"></span>
                @endif

            </a>


            {{-- Collections --}}
            <a
                href="#"
                class="group relative flex items-center gap-3 rounded-2xl px-3.5 py-3 text-sm font-semibold transition-all duration-200
                {{ request()->routeIs('collections.*')
                    ? 'bg-slate-950 text-white shadow-lg shadow-slate-950/15'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-950' }}"
            >

                @if(request()->routeIs('collections.*'))
                    <span class="absolute left-0 top-1/2 h-6 w-1 -translate-y-1/2 rounded-r-full bg-white"></span>
                @endif

                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl
                    {{ request()->routeIs('collections.*')
                        ? 'bg-white/10'
                        : 'bg-slate-100 group-hover:bg-white group-hover:shadow-sm' }}">

                    <svg
                        class="h-[18px] w-[18px] {{ request()->routeIs('collections.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-800' }}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                </span>

                <span>Collections</span>

            </a>

        </div>


        {{-- Management --}}
        <div class="mb-3 mt-8 flex items-center gap-2 px-3">
            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                Management
            </p>
        </div>

        <div class="space-y-1">

            {{-- Products --}}
            <a
                href="#"
                class="group flex items-center gap-3 rounded-2xl px-3.5 py-3 text-sm font-semibold text-slate-600 transition-all duration-200 hover:bg-slate-50 hover:text-slate-950"
            >

                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 transition group-hover:bg-white group-hover:shadow-sm">

                    <svg
                        class="h-[18px] w-[18px] text-slate-400 transition group-hover:text-slate-800"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 6v12M6 12h12"
                        />
                    </svg>

                </span>

                <span>Products</span>

            </a>


            {{-- Orders --}}
            <a
                href="#"
                class="group flex items-center gap-3 rounded-2xl px-3.5 py-3 text-sm font-semibold text-slate-600 transition-all duration-200 hover:bg-slate-50 hover:text-slate-950"
            >

                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 transition group-hover:bg-white group-hover:shadow-sm">

                    <svg
                        class="h-[18px] w-[18px] text-slate-400 transition group-hover:text-slate-800"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M8 12h8M8 16h5M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                        />
                    </svg>

                </span>

                <span>Orders</span>

            </a>


            {{-- Reports --}}
            <a
                href="#"
                class="group flex items-center gap-3 rounded-2xl px-3.5 py-3 text-sm font-semibold text-slate-600 transition-all duration-200 hover:bg-slate-50 hover:text-slate-950"
            >

                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 transition group-hover:bg-white group-hover:shadow-sm">

                    <svg
                        class="h-[18px] w-[18px] text-slate-400 transition group-hover:text-slate-800"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M5 4h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1zM8 16v-5M12 16V8M16 16v-3"
                        />
                    </svg>

                </span>

                <span>Reports</span>

            </a>

        </div>


        {{-- Account --}}
        <div class="mb-3 mt-8 flex items-center gap-2 px-3">
            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                Account
            </p>
        </div>

        <div class="space-y-1">

            <a
                href="{{ route('profile.edit') }}"
                class="group relative flex items-center gap-3 rounded-2xl px-3.5 py-3 text-sm font-semibold transition-all duration-200
                {{ request()->routeIs('profile.*')
                    ? 'bg-slate-950 text-white shadow-lg shadow-slate-950/15'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-950' }}"
            >

                @if(request()->routeIs('profile.*'))
                    <span class="absolute left-0 top-1/2 h-6 w-1 -translate-y-1/2 rounded-r-full bg-white"></span>
                @endif

                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl
                    {{ request()->routeIs('profile.*')
                        ? 'bg-white/10'
                        : 'bg-slate-100 group-hover:bg-white group-hover:shadow-sm' }}">

                    <svg
                        class="h-[18px] w-[18px] {{ request()->routeIs('profile.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-800' }}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z"
                        />
                    </svg>

                </span>

                <span>Profile</span>

            </a>

        </div>

    </div>


    {{-- User --}}
    <div class="shrink-0 border-t border-slate-100/80 bg-gradient-to-b from-white to-slate-50/80 p-4">

        <div class="group flex items-center gap-3 rounded-2xl border border-slate-200/70 bg-white p-3 shadow-sm transition hover:border-slate-300 hover:shadow-md">

            <div class="relative shrink-0">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-950 text-sm font-bold text-white shadow-md shadow-slate-950/15">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <span class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full border-2 border-white bg-emerald-500"></span>

            </div>

            <div class="min-w-0 flex-1">

                <p class="truncate text-[13px] font-bold text-slate-900">
                    {{ Auth::user()->name }}
                </p>

                <p class="mt-0.5 truncate text-[11px] text-slate-400">
                    {{ Auth::user()->email }}
                </p>

            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-400 transition hover:bg-red-50 hover:text-red-500"
                    title="Log out"
                >
                    <svg
                        class="h-[18px] w-[18px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M15 12H3m0 0l4-4m-4 4l4 4M21 4v16a1 1 0 01-1 1h-6"
                        />
                    </svg>
                </button>

            </form>

        </div>

    </div>

</nav>


{{-- Mobile menu --}}
<button
    @click="open = true"
    class="fixed left-4 top-4 z-40 flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200/80 bg-white/90 text-slate-700 shadow-lg shadow-slate-900/5 backdrop-blur-xl transition hover:bg-white hover:shadow-xl lg:hidden"
    aria-label="Open sidebar"
>
    <svg
        class="h-5 w-5"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1.8"
            d="M4 6h16M4 12h16M4 18h16"
        />
    </svg>
</button>
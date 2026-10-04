@php
    $collections = [
        [
            'name' => 'Rings',
            'slug' => 'rings',
            'image' => asset('build/rings.avif'),
        ],
        [
            'name' => 'Ear Rings',
            'slug' => 'ear-rings',
            'image' => asset('build/ear-rings.avif'),
        ],
        [
            'name' => 'Bracelets',
            'slug' => 'bracelets',
            'image' => asset('build/bracelets.avif'),
        ],
        [
            'name' => 'Necklace',
            'slug' => 'necklace',
            'image' => asset('build/necklace.avif'),
        ],
    ];

    $navItems = [
        ['name' => 'Home', 'route' => 'home'],
        ['name' => 'Collections', 'route' => 'collections', 'dropdown' => true],
        ['name' => 'Contact Us', 'route' => 'contact-us'],
        ['name' => 'Blog', 'route' => 'blog', 'special' => true],
        ['name' => 'Shop', 'route' => 'shop', 'special' => true],
        ['name' => 'FAQ', 'route' => 'faq', 'special' => true],
    ];

    $normalItems = collect($navItems)->filter(fn ($item) => empty($item['special']));
    $specialItems = collect($navItems)->filter(fn ($item) => !empty($item['special']));
@endphp

<div
    x-data="{
        asideOpen: false,
        mobileOpen: false,
        collectionOpen: false,
        mobileCollectionOpen: false,

        closeAll() {
            this.asideOpen = false;
            this.mobileOpen = false;
            this.collectionOpen = false;
            this.mobileCollectionOpen = false;
        },

        toggleMobile() {
            this.mobileOpen = !this.mobileOpen;
            this.asideOpen = false;
            this.collectionOpen = false;
        },

        openAside() {
            this.asideOpen = true;
            this.mobileOpen = false;
            this.collectionOpen = false;
        }
    }"
    x-effect="
        document.body.classList.toggle(
            'overflow-hidden',
            asideOpen || mobileOpen
        )
    "
    @keydown.escape.window="closeAll()"
    class="container mx-auto"
>

    <nav
        id="main-navbar"
        class="fixed left-0 top-0 z-50 w-full border-b border-white/30 bg-white/80 shadow-xl shadow-black/5 backdrop-blur-xl backdrop-saturate-150"
    >

        <div class="relative overflow-visible">

            <div class="container relative mx-auto flex h-16 items-center justify-between px-3 sm:h-[4.5rem] sm:px-5 lg:h-20 lg:px-8">

                <div class="hidden items-center gap-1 lg:flex">

                    @foreach ($normalItems as $item)

                        @if (!empty($item['dropdown']))

                            <div
                                class="relative"
                                @mouseenter="collectionOpen = true"
                            >

                                <button
                                    type="button"
                                    @click="collectionOpen = !collectionOpen"
                                    class="nav-link group relative flex items-center gap-1 rounded-xl px-3 py-2.5 text-sm font-medium text-gray-600 transition-colors duration-200 hover:text-gray-500 xl:px-4"
                                >

                                    <span>{{ $item['name'] }}</span>

                                    <svg
                                        class="h-3.5 w-3.5 transition-transform duration-200"
                                        :class="collectionOpen ? 'rotate-180' : ''"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 9l6 6 6-6"
                                        />
                                    </svg>

                                    <span
                                        class="absolute bottom-1 left-3 h-[2px] w-[calc(100%-1.5rem)] origin-left rounded-full bg-gray-500 transition-transform duration-300"
                                        :class="collectionOpen ? 'scale-x-100' : 'scale-x-0'"
                                    ></span>

                                </button>

                                <div
                                    x-show="collectionOpen"
                                    x-cloak
                                    @mouseleave="collectionOpen = false"
                                    x-transition:enter="transition-all duration-250 ease-out"
                                    x-transition:enter-start="translate-y-2 scale-95 opacity-0"
                                    x-transition:enter-end="translate-y-0 scale-100 opacity-100"
                                    x-transition:leave="transition-all duration-150 ease-in"
                                    x-transition:leave-start="translate-y-0 scale-100 opacity-100"
                                    x-transition:leave-end="translate-y-2 scale-95 opacity-0"
                                    class="absolute left-1/2 top-full z-[70] mt-4 w-[680px] -translate-x-1/2 overflow-hidden rounded-[2rem] border border-white/60 bg-white/80 p-4 shadow-2xl shadow-black/10 backdrop-blur-2xl backdrop-saturate-150"
                                >

                                    <div class="mb-4 flex items-center justify-between px-2">

                                        <div>
                                            <p class="text-[9px] font-semibold uppercase tracking-[0.28em] text-gray-400">
                                                Curated Collection
                                            </p>

                                            <h3 class="mt-1 text-base font-semibold tracking-tight text-gray-800">
                                                Explore Our Collection
                                            </h3>
                                        </div>

                                        <a
                                            href="{{ route('collections') }}"
                                            class="group flex items-center gap-1.5 rounded-full border border-gray-200/70 bg-white/60 px-3.5 py-2 text-[11px] font-semibold text-gray-500 transition-all duration-300 hover:border-gray-300 hover:bg-white hover:text-gray-900"
                                        >
                                            View All

                                            <svg
                                                class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-0.5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M9 5l7 7-7 7"
                                                />
                                            </svg>
                                        </a>

                                    </div>

                                    <div class="flex flex-wrap gap-3">

                                        @foreach ($collections as $collection)

                                            <a
                                                href="{{ route('category.show', $collection['slug']) }}"
                                                class="group flex min-w-[calc(50%-6px)] flex-1 overflow-hidden rounded-2xl border border-white/50 bg-white/40 p-2 transition-all duration-300 hover:-translate-y-1 hover:border-white hover:bg-white/90 hover:shadow-xl hover:shadow-black/10"
                                            >

                                                <div class="relative h-24 w-24 shrink-0 overflow-hidden rounded-xl bg-gray-100">

                                                    <img
                                                        src="{{ $collection['image'] }}"
                                                        alt="{{ $collection['name'] }}"
                                                        loading="lazy"
                                                        class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110"
                                                    >

                                                    <div class="absolute inset-0 bg-gradient-to-tr from-black/10 via-transparent to-white/20"></div>

                                                </div>

                                                <div class="flex min-w-0 flex-1 items-center justify-between px-3">

                                                    <div class="min-w-0">

                                                        <p class="text-[9px] font-medium uppercase tracking-[0.18em] text-gray-400">
                                                            Collection
                                                        </p>

                                                        <h4 class="mt-1 truncate text-sm font-semibold text-gray-700 transition-colors duration-300 group-hover:text-gray-950">
                                                            {{ $collection['name'] }}
                                                        </h4>

                                                        <p class="mt-1 text-[10px] text-gray-400">
                                                            Discover pieces
                                                        </p>

                                                    </div>

                                                    <span class="ml-2 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-gray-200/70 bg-white/60 text-gray-400 transition-all duration-300 group-hover:translate-x-1 group-hover:border-gray-300 group-hover:bg-white group-hover:text-gray-800">

                                                        <svg
                                                            class="h-3.5 w-3.5"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="1.8"
                                                                d="M9 5l7 7-7 7"
                                                            />
                                                        </svg>

                                                    </span>

                                                </div>

                                            </a>

                                        @endforeach

                                    </div>

                                    <div class="mt-4 flex items-center gap-3 px-2">

                                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>

                                        <span class="whitespace-nowrap text-[8px] font-medium uppercase tracking-[0.3em] text-gray-300">
                                            Timeless · Elegant · Refined
                                        </span>

                                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>

                                    </div>

                                </div>

                            </div>

                        @else

                            <a
                                href="{{ route($item['route']) }}"
                                class="nav-link group relative rounded-xl px-3 py-2.5 text-sm font-medium text-gray-600 transition-colors duration-200 hover:text-gray-500 xl:px-4"
                            >

                                {{ $item['name'] }}

                                <span
                                    class="absolute bottom-1 left-3 h-[2px] w-[calc(100%-1.5rem)] origin-left scale-x-0 rounded-full bg-gray-500 transition-transform duration-300 group-hover:scale-x-100 {{ request()->routeIs($item['route']) ? 'scale-x-100' : '' }}"
                                ></span>

                            </a>

                        @endif

                    @endforeach

                </div>

                <a
                    href="{{ route('home') }}"
                    class="absolute left-1/2 top-1/2 z-[52] -translate-x-1/2 -translate-y-1/2 rounded-xl border border-white/50 bg-white/40 p-1 shadow-lg shadow-black/5 backdrop-blur-md transition-transform duration-200 hover:scale-105 sm:p-1.5"
                    aria-label="Home"
                >
                    <x-application-logo class="h-9 w-9 sm:h-10 sm:w-10 lg:h-11 lg:w-11" />
                </a>

                <div class="ml-auto hidden items-center lg:flex">

                    <button
                        type="button"
                        @click="openAside()"
                        class="group flex items-center gap-2 rounded-xl border border-white/30 bg-white/30 px-4 py-2.5 text-sm font-semibold text-gray-600 shadow-sm backdrop-blur-md transition-all duration-200 hover:bg-white/50 hover:text-gray-500 xl:px-5"
                    >

                        Explore

                        <svg
                            class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>

                    </button>

                </div>

                <button
                    type="button"
                    @click="toggleMobile()"
                    class="ml-auto flex h-10 w-10 items-center justify-center rounded-xl border border-white/40 bg-white/30 text-gray-600 shadow-sm backdrop-blur-md transition-all duration-200 hover:bg-white/50 hover:text-gray-500 lg:hidden"
                    :aria-expanded="mobileOpen"
                    aria-label="Toggle navigation"
                >

                    <svg
                        x-show="!mobileOpen"
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                    <svg
                        x-show="mobileOpen"
                        x-cloak
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                </button>

            </div>

            <div
                x-show="mobileOpen"
                x-cloak
                x-transition:enter="transition-all duration-300 ease-out"
                x-transition:enter-start="max-h-0 opacity-0"
                x-transition:enter-end="max-h-[80vh] opacity-100"
                x-transition:leave="transition-all duration-200 ease-in"
                x-transition:leave-start="max-h-[80vh] opacity-100"
                x-transition:leave-end="max-h-0 opacity-0"
                class="overflow-hidden border-t border-white/20 lg:hidden"
            >

                <div class="max-h-[70vh] overflow-y-auto px-3 py-3 sm:px-5 sm:py-4">

                    @foreach ($navItems as $item)

                        @if (!empty($item['dropdown']))

                            <div class="mb-1">

                                <button
                                    type="button"
                                    @click="mobileCollectionOpen = !mobileCollectionOpen"
                                    class="flex min-h-[48px] w-full items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition-all duration-200 hover:bg-white/30 hover:text-gray-500"
                                >

                                    <span>{{ $item['name'] }}</span>

                                    <svg
                                        class="h-4 w-4 transition-transform duration-200"
                                        :class="mobileCollectionOpen ? 'rotate-180' : ''"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 9l6 6 6-6"
                                        />
                                    </svg>

                                </button>

                                <div
                                    x-show="mobileCollectionOpen"
                                    x-cloak
                                    x-transition
                                    class="flex flex-wrap gap-2 px-2 pb-2"
                                >

                                    @foreach ($collections as $collection)

                                        <a
                                            href="{{ route('category.show', $collection['slug']) }}"
                                            @click="mobileOpen = false"
                                            class="group flex w-[calc(50%-4px)] flex-col overflow-hidden rounded-2xl border border-white/30 bg-white/20 p-2 transition-all duration-200 hover:bg-white/50"
                                        >

                                            <div class="h-24 overflow-hidden rounded-xl">

                                                <img
                                                    src="{{ $collection['image'] }}"
                                                    alt="{{ $collection['name'] }}"
                                                    loading="lazy"
                                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                                >

                                            </div>

                                            <div class="px-1 py-2 text-xs font-semibold text-gray-700">
                                                {{ $collection['name'] }}
                                            </div>

                                        </a>

                                    @endforeach

                                </div>

                            </div>

                        @else

                            <a
                                href="{{ route($item['route']) }}"
                                @click="mobileOpen = false"
                                class="mb-1 flex min-h-[48px] items-center rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs($item['route']) ? 'bg-white/50 text-gray-900 shadow-sm' : 'text-gray-600 hover:bg-white/30 hover:text-gray-500' }}"
                            >

                                <span>{{ $item['name'] }}</span>

                                @if ($item['route'] === 'shop')

                                    <span class="ml-auto rounded-full bg-gray-100/70 px-2.5 py-1 text-[10px] font-bold text-gray-600">
                                        NEW
                                    </span>

                                @endif

                            </a>

                        @endif

                    @endforeach

                    <button
                        type="button"
                        @click="openAside()"
                        class="mt-2 flex min-h-[48px] w-full items-center justify-between rounded-xl border border-white/20 bg-white/20 px-4 py-3 text-sm font-semibold text-gray-600 transition-all duration-200 hover:bg-white/40 hover:text-gray-500"
                    >

                        <span>Explore More</span>

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>

                    </button>

                </div>

            </div>

        </div>

    </nav>

    <div
        x-show="asideOpen"
        x-cloak
        class="fixed inset-0 z-[60]"
        role="dialog"
        aria-modal="true"
    >

        <div
            x-show="asideOpen"
            x-transition:enter="transition-opacity duration-300 ease-out"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity duration-200 ease-in"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="asideOpen = false"
            class="absolute inset-0 bg-black/20 backdrop-blur-sm"
        ></div>

        <aside
            x-show="asideOpen"
            x-transition:enter="transform transition ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transform transition ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            @click.stop
            class="absolute right-2 top-2 z-[61] flex h-[calc(100vh-1rem)] w-[calc(100%-1rem)] flex-col overflow-hidden rounded-3xl border border-white/40 bg-white/30 shadow-2xl shadow-black/20 backdrop-blur-2xl backdrop-saturate-150 sm:right-4 sm:top-4 sm:h-[calc(100vh-2rem)] sm:w-96 sm:max-w-[calc(100%-2rem)]"
        >

            <div class="flex shrink-0 items-center justify-between border-b border-white/30 px-5 py-4 sm:px-6 sm:py-5">

                <div>
                    <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-gray-400 sm:text-xs">
                        Explore
                    </p>

                    <h2 class="mt-1 text-lg font-bold text-gray-800 sm:text-xl">
                        Discover More
                    </h2>
                </div>

                <button
                    type="button"
                    @click="asideOpen = false"
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-white/40 bg-white/30 text-gray-600 transition-all duration-200 hover:scale-105 hover:bg-white/60 hover:text-gray-800 sm:h-10 sm:w-10"
                    aria-label="Close sidebar"
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
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                </button>

            </div>

            <div class="flex-1 space-y-2 overflow-y-auto overscroll-contain p-3 sm:p-4">

                @foreach ($specialItems as $item)

                    <a
                        href="{{ route($item['route']) }}"
                        class="group flex min-h-[52px] items-center rounded-2xl border border-transparent bg-white/20 px-4 py-3.5 text-gray-700 transition-all duration-200 hover:border-white/40 hover:bg-white/50 hover:text-gray-900 hover:shadow-sm sm:px-5 sm:py-4 {{ request()->routeIs($item['route']) ? 'border-white/40 bg-white/50 text-gray-900 shadow-sm' : '' }}"
                    >

                        <span class="text-sm font-semibold">
                            {{ $item['name'] }}
                        </span>

                        @if ($item['route'] === 'shop')

                            <span class="ml-auto rounded-full bg-gray-100/70 px-2.5 py-1 text-[10px] font-bold text-gray-600">
                                NEW
                            </span>

                        @else

                            <svg
                                class="ml-auto h-4 w-4 shrink-0 text-gray-400 transition-transform duration-200 group-hover:translate-x-1 group-hover:text-gray-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>

                        @endif

                    </a>

                @endforeach

            </div>

            <div class="shrink-0 border-t border-white/30 p-4 sm:p-5">

                <div class="rounded-2xl border border-white/30 bg-white/20 p-4">

                    <p class="text-xs leading-relaxed text-gray-500">
                        Explore our latest updates, products and frequently asked questions.
                    </p>

                </div>

            </div>

        </aside>

    </div>

</div>
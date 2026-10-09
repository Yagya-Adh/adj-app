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
        ['name' => 'Collections', 'route' => 'collection', 'dropdown' => true],
        ['name' => 'Contact Us', 'route' => 'contact-us'],
        ['name' => 'Blogs', 'route' => 'blogs', 'special' => true],
        ['name' => 'Shop', 'route' => 'shop', 'special' => true],
        ['name' => 'FAQ', 'route' => 'faq', 'special' => true],
    ];

    $normalItems = collect($navItems)->filter(fn ($item) => empty($item['special']));
    $specialItems = collect($navItems)->filter(fn ($item) => !empty($item['special']));
@endphp

<style>
    [data-hidden="true"] {
        display: none !important;
    }

    .js-rotate-180 {
        transform: rotate(180deg);
    }

    .js-scale-x-100 {
        transform: scaleX(1) !important;
    }

    .js-mobile-open {
        max-height: 80vh;
        opacity: 1;
    }

    .js-aside-open {
        visibility: visible !important;
        pointer-events: auto !important;
    }

    .js-overlay-visible {
        opacity: 1 !important;
    }

    .js-aside-visible {
        transform: translateX(0) !important;
    }

    body.nav-locked {
        overflow: hidden;
    }
</style>

<div id="navbar-wrapper" class="container mx-auto">

    <nav
        id="main-navbar"
        class="fixed left-0 top-0 z-50 w-full border-b border-white/30 bg-white/90 shadow-xl shadow-black/5 backdrop-blur-xl backdrop-saturate-150"
    >

        <div class="relative overflow-visible">

            <div class="container relative mx-auto flex h-16 items-center justify-between px-3 sm:h-[4.5rem] sm:px-5 lg:h-20 lg:px-8">

                {{-- Desktop Navigation --}}
                <div class="hidden items-center gap-1 lg:flex">

                    @foreach ($normalItems as $item)

                        @if (!empty($item['dropdown']))

                            <div
                                id="collection-dropdown-wrapper"
                                class="relative"
                            >

                                <button
                                    id="collection-dropdown-button"
                                    type="button"
                                    class="nav-link group relative flex items-center gap-1 rounded-xl px-3 py-2.5 text-sm font-medium uppercase text-gray-600 transition-colors duration-200 hover:text-gray-500 xl:px-4"
                                    aria-expanded="false"
                                    aria-haspopup="true"
                                >

                                    <span>{{ $item['name'] }}</span>

                                    <svg
                                        id="collection-arrow"
                                        class="h-3.5 w-3.5 transition-transform duration-200"
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
                                        id="collection-underline"
                                        class="absolute bottom-1 left-3 h-[2px] w-[calc(100%-1.5rem)] origin-left scale-x-0 rounded-full bg-gray-500 transition-transform duration-300"
                                    ></span>

                                </button>

                                {{-- Desktop Collection Dropdown --}}
                                <div
                                    id="collection-dropdown"
                                    data-hidden="true"
                                    class="absolute left-1/2 top-full z-[70] mt-4 w-[680px] -translate-x-1/2 overflow-hidden rounded-[2rem] border border-white/60 bg-white/80 p-4 opacity-0 shadow-2xl shadow-black/10 backdrop-blur-2xl backdrop-saturate-150 transition-all duration-250"
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
                                            href="{{ route('shop') }}"
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

                {{-- Center Logo --}}
                <a
                    href="{{ route('home') }}"
                    class="absolute left-1/2 top-2/3 z-[52] flex -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-xl border border-white/70 bg-white p-1 shadow-lg shadow-black/10 transition-transform duration-200 hover:scale-105 sm:p-1.5"
                    aria-label="Home"
                >
                    <x-application-logo class="h-9 w-9 object-contain sm:h-10 sm:w-10 lg:h-14 lg:w-14" />
                </a>

                {{-- Desktop Explore Button --}}
                <div class="ml-auto hidden items-center lg:flex">

                    <button
                        id="desktop-aside-button"
                        type="button"
                        class="group flex items-center justify-center rounded-xl border border-white/30 bg-white/30 p-2.5 text-gray-600 shadow-sm backdrop-blur-md transition-all duration-200 hover:bg-white/50 hover:text-gray-500"
                        aria-label="Open menu"
                    >

                        <svg
                            class="h-5 w-5 transition-transform duration-200 group-hover:scale-110"
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

                    </button>

                </div>

                {{-- Mobile Menu Button --}}
                <button
                    id="mobile-menu-button"
                    type="button"
                    class="ml-auto flex h-10 w-10 items-center justify-center rounded-xl border border-white/40 bg-white/30 text-gray-600 shadow-sm backdrop-blur-md transition-all duration-200 hover:bg-white/50 hover:text-gray-500 lg:hidden"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >

                    <svg
                        id="mobile-menu-icon"
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
                        id="mobile-close-icon"
                        class="hidden h-5 w-5"
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

            {{-- Mobile Navigation --}}
            <div
                id="mobile-navigation"
                class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-out lg:hidden"
            >

                <div class="max-h-[70vh] overflow-y-auto px-3 py-3 sm:px-5 sm:py-4">

                    @foreach ($navItems as $item)

                        @if (!empty($item['dropdown']))

                            <div class="mb-1">

                                <button
                                    id="mobile-collection-button"
                                    type="button"
                                    class="flex min-h-[48px] w-full items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition-all duration-200 hover:bg-white/30 hover:text-gray-500"
                                    aria-expanded="false"
                                >

                                    <span>{{ $item['name'] }}</span>

                                    <svg
                                        id="mobile-collection-arrow"
                                        class="h-4 w-4 transition-transform duration-200"
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
                                    id="mobile-collection-menu"
                                    class="hidden flex-wrap gap-2 px-2 pb-2"
                                >

                                    @foreach ($collections as $collection)

                                        <a
                                            href="{{ route('category.show', $collection['slug']) }}"
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

                    {{-- Mobile Explore More --}}
                    <button
                        id="mobile-aside-button"
                        type="button"
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


    {{-- Right Side Drawer --}}
    <div
        id="aside-wrapper"
        class="invisible pointer-events-none fixed inset-0 z-[60]"
        role="dialog"
        aria-modal="true"
    >

        {{-- Overlay --}}
        <div
            id="aside-overlay"
            class="absolute inset-0 bg-black/20 opacity-0 backdrop-blur-sm transition-opacity duration-300"
        ></div>

        {{-- Aside --}}
        <aside
            id="aside-panel"
            class="absolute right-2 top-2 z-[61] flex h-[calc(100vh-1rem)] w-[calc(100%-1rem)] translate-x-full flex-col overflow-hidden rounded-3xl border border-white/40 bg-white/30 shadow-2xl shadow-black/20 backdrop-blur-2xl backdrop-saturate-150 transition-transform duration-300 ease-out sm:right-4 sm:top-4 sm:h-[calc(100vh-2rem)] sm:w-96 sm:max-w-[calc(100%-2rem)]"
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
                    id="aside-close-button"
                    type="button"
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
                                    stroke-width="1.8"
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


<script>
document.addEventListener('DOMContentLoaded', function () {

    const body = document.body;

    /* Desktop Collection Dropdown */
    const collectionButton = document.getElementById('collection-dropdown-button');
    const collectionDropdown = document.getElementById('collection-dropdown');
    const collectionArrow = document.getElementById('collection-arrow');
    const collectionUnderline = document.getElementById('collection-underline');
    const collectionWrapper = document.getElementById('collection-dropdown-wrapper');

    /* Mobile Navigation */
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileNavigation = document.getElementById('mobile-navigation');
    const mobileMenuIcon = document.getElementById('mobile-menu-icon');
    const mobileCloseIcon = document.getElementById('mobile-close-icon');

    /* Mobile Collection */
    const mobileCollectionButton = document.getElementById('mobile-collection-button');
    const mobileCollectionMenu = document.getElementById('mobile-collection-menu');
    const mobileCollectionArrow = document.getElementById('mobile-collection-arrow');

    /* Aside */
    const desktopAsideButton = document.getElementById('desktop-aside-button');
    const mobileAsideButton = document.getElementById('mobile-aside-button');
    const asideWrapper = document.getElementById('aside-wrapper');
    const asideOverlay = document.getElementById('aside-overlay');
    const asidePanel = document.getElementById('aside-panel');
    const asideCloseButton = document.getElementById('aside-close-button');


    function openCollectionDropdown() {

        if (!collectionDropdown) {
            return;
        }

        collectionDropdown.setAttribute('data-hidden', 'false');

        requestAnimationFrame(function () {
            collectionDropdown.classList.remove('opacity-0');
            collectionDropdown.classList.add('opacity-100');

            collectionDropdown.classList.remove('translate-y-2');
            collectionDropdown.classList.add('translate-y-0');

            collectionDropdown.classList.remove('scale-95');
            collectionDropdown.classList.add('scale-100');
        });

        if (collectionButton) {
            collectionButton.setAttribute('aria-expanded', 'true');
        }

        if (collectionArrow) {
            collectionArrow.classList.add('js-rotate-180');
        }

        if (collectionUnderline) {
            collectionUnderline.classList.add('js-scale-x-100');
        }
    }


    function closeCollectionDropdown() {

        if (!collectionDropdown) {
            return;
        }

        collectionDropdown.classList.remove('opacity-100');
        collectionDropdown.classList.add('opacity-0');

        collectionDropdown.classList.remove('translate-y-0');
        collectionDropdown.classList.add('translate-y-2');

        collectionDropdown.classList.remove('scale-100');
        collectionDropdown.classList.add('scale-95');

        if (collectionButton) {
            collectionButton.setAttribute('aria-expanded', 'false');
        }

        if (collectionArrow) {
            collectionArrow.classList.remove('js-rotate-180');
        }

        if (collectionUnderline) {
            collectionUnderline.classList.remove('js-scale-x-100');
        }

        setTimeout(function () {
            if (!collectionDropdown.classList.contains('opacity-100')) {
                collectionDropdown.setAttribute('data-hidden', 'true');
            }
        }, 250);
    }


    function toggleCollectionDropdown() {

        if (!collectionDropdown) {
            return;
        }

        const isOpen =
            collectionDropdown.getAttribute('data-hidden') === 'false';

        if (isOpen) {
            closeCollectionDropdown();
        } else {
            openCollectionDropdown();
        }
    }


    if (collectionButton) {
        collectionButton.addEventListener('click', function (event) {
            event.stopPropagation();
            toggleCollectionDropdown();
        });
    }


    if (collectionWrapper) {

        collectionWrapper.addEventListener('mouseenter', function () {
            if (window.innerWidth >= 1024) {
                openCollectionDropdown();
            }
        });

        collectionWrapper.addEventListener('mouseleave', function () {
            if (window.innerWidth >= 1024) {
                closeCollectionDropdown();
            }
        });

    }


    /* Mobile Navigation */

    function openMobileMenu() {

        if (!mobileNavigation) {
            return;
        }

        mobileNavigation.classList.remove('max-h-0');
        mobileNavigation.classList.add('js-mobile-open');

        mobileMenuButton?.setAttribute('aria-expanded', 'true');

        mobileMenuIcon?.classList.add('hidden');
        mobileCloseIcon?.classList.remove('hidden');

        body.classList.add('nav-locked');

        closeCollectionDropdown();
    }


    function closeMobileMenu() {

        if (!mobileNavigation) {
            return;
        }

        mobileNavigation.classList.remove('js-mobile-open');
        mobileNavigation.classList.add('max-h-0');

        mobileMenuButton?.setAttribute('aria-expanded', 'false');

        mobileMenuIcon?.classList.remove('hidden');
        mobileCloseIcon?.classList.add('hidden');

        body.classList.remove('nav-locked');

        closeMobileCollection();
    }


    function toggleMobileMenu() {

        const isOpen =
            mobileMenuButton?.getAttribute('aria-expanded') === 'true';

        if (isOpen) {
            closeMobileMenu();
        } else {
            openMobileMenu();
        }
    }


    mobileMenuButton?.addEventListener('click', function () {
        toggleMobileMenu();
    });


    /* Mobile Collection */

    function openMobileCollection() {

        if (!mobileCollectionMenu) {
            return;
        }

        mobileCollectionMenu.classList.remove('hidden');
        mobileCollectionMenu.classList.add('flex');

        mobileCollectionButton?.setAttribute('aria-expanded', 'true');

        mobileCollectionArrow?.classList.add('js-rotate-180');
    }


    function closeMobileCollection() {

        if (!mobileCollectionMenu) {
            return;
        }

        mobileCollectionMenu.classList.remove('flex');
        mobileCollectionMenu.classList.add('hidden');

        mobileCollectionButton?.setAttribute('aria-expanded', 'false');

        mobileCollectionArrow?.classList.remove('js-rotate-180');
    }


    function toggleMobileCollection() {

        const isOpen =
            mobileCollectionButton?.getAttribute('aria-expanded') === 'true';

        if (isOpen) {
            closeMobileCollection();
        } else {
            openMobileCollection();
        }
    }


    mobileCollectionButton?.addEventListener('click', function () {
        toggleMobileCollection();
    });


    /* Aside Drawer */

    function openAside() {

        if (!asideWrapper || !asidePanel || !asideOverlay) {
            return;
        }

        asideWrapper.classList.add('js-aside-open');

        requestAnimationFrame(function () {
            asideOverlay.classList.add('js-overlay-visible');
            asidePanel.classList.add('js-aside-visible');
        });

        body.classList.add('nav-locked');

        closeCollectionDropdown();
        closeMobileMenu();
    }


    function closeAside() {

        if (!asideWrapper || !asidePanel || !asideOverlay) {
            return;
        }

        asideOverlay.classList.remove('js-overlay-visible');
        asidePanel.classList.remove('js-aside-visible');

        setTimeout(function () {

            if (!asidePanel.classList.contains('js-aside-visible')) {
                asideWrapper.classList.remove('js-aside-open');
            }

        }, 300);

        body.classList.remove('nav-locked');
    }


    desktopAsideButton?.addEventListener('click', function () {
        openAside();
    });


    mobileAsideButton?.addEventListener('click', function () {
        openAside();
    });


    asideCloseButton?.addEventListener('click', function () {
        closeAside();
    });


    asideOverlay?.addEventListener('click', function () {
        closeAside();
    });


    /* Prevent clicks inside drawer from closing it */

    asidePanel?.addEventListener('click', function (event) {
        event.stopPropagation();
    });


    /* Close Everything When Clicking Outside */

    document.addEventListener('click', function (event) {

        if (
            collectionWrapper &&
            !collectionWrapper.contains(event.target)
        ) {
            closeCollectionDropdown();
        }

    });


    /* Escape Key */

    document.addEventListener('keydown', function (event) {

        if (event.key !== 'Escape') {
            return;
        }

        closeCollectionDropdown();
        closeMobileMenu();
        closeAside();

    });


    /* Close Mobile Menu After Clicking A Link */

    if (mobileNavigation) {

        mobileNavigation.querySelectorAll('a').forEach(function (link) {

            link.addEventListener('click', function () {
                closeMobileMenu();
            });

        });

    }


    /* Handle Resize */

    window.addEventListener('resize', function () {

        if (window.innerWidth >= 1024) {
            closeMobileMenu();
        }

    });

});
</script>
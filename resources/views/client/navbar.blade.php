@php
    $navItems = [
        ['name' => 'Home', 'route' => 'home'],
       
    ];
@endphp

<style>
    .glass-nav {
        background: rgba(255, 255, 255, .78);
        border: 1px solid rgba(255, 255, 255, .95);
        box-shadow:
            0 15px 45px rgba(15, 23, 42, .08),
            inset 0 1px 0 #fff;
        backdrop-filter: blur(24px) saturate(160%);
        -webkit-backdrop-filter: blur(24px) saturate(160%);
    }

    .glass-link {
        transition:
            background .25s ease,
            color .25s ease,
            box-shadow .25s ease,
            transform .25s ease;
    }

    .glass-link:hover,
    .glass-link.active {
        background: rgba(255, 255, 255, .96);
        color: #111827;
        box-shadow:
            inset 0 1px 5px #fff,
            0 5px 18px rgba(15, 23, 42, .06);
    }

    .glass-link.active::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 50%;
        width: 14px;
        height: 2px;
        border-radius: 999px;
        background: #111827;
        transform: translateX(-50%);
    }

    .glass-special {
        position: relative;
        overflow: hidden;
        color: #111827 !important;
        font-weight: 900 !important;
        letter-spacing: -.025em;
        background: linear-gradient(
            135deg,
            #ffffff 0%,
            #f8fafc 50%,
            #eef5ff 100%
        ) !important;
        border: 1px solid rgba(37, 99, 235, .18);
        box-shadow:
            0 6px 20px rgba(37, 99, 235, .10),
            inset 0 1px 0 #fff !important;
        transition:
            transform .25s ease,
            border-color .25s ease,
            box-shadow .25s ease,
            background .25s ease;
    }

    .glass-special::before {
        content: '';
        position: absolute;
        top: -22px;
        right: -22px;
        width: 62px;
        height: 62px;
        border-radius: 50%;
        background: conic-gradient(
            #2563eb 0deg 120deg,
            #dc2626 120deg 240deg,
            #111827 240deg 360deg
        );
        opacity: .18;
        transition:
            opacity .3s ease,
            transform .3s ease;
    }

    .glass-special::after {
        content: '';
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        height: 3px;
        background: linear-gradient(
            90deg,
            #1d4ed8 0%,
            #2563eb 30%,
            #dc2626 65%,
            #111827 100%
        );
    }

    .glass-special:hover {
        transform: translateY(-1px);
        border-color: rgba(37, 99, 235, .32);
        background: linear-gradient(
            135deg,
            #ffffff 0%,
            #f1f7ff 50%,
            #e5efff 100%
        ) !important;
        box-shadow:
            0 10px 28px rgba(37, 99, 235, .15),
            inset 0 1px 0 #fff !important;
    }

    .glass-special:hover::before {
        opacity: .30;
        transform: rotate(45deg) scale(1.1);
    }

    .special-text {
        position: relative;
        z-index: 10;
        display: inline-block;
        font-weight: 900;
        letter-spacing: -.035em;
        background: linear-gradient(
            90deg,
            #1d4ed8 0%,
            #2563eb 32%,
            #dc2626 68%,
            #111827 100%
        );
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
    }

    .mobile-backdrop {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition:
            opacity .3s ease,
            visibility .3s ease;
    }

    .mobile-backdrop.show {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    .mobile-drawer {
        visibility: hidden;
        transform: translateX(105%);
        transition:
            transform .45s cubic-bezier(.22, 1, .36, 1),
            visibility .45s ease;
    }

    .mobile-drawer.show {
        visibility: visible;
        transform: translateX(0);
    }

    .mobile-item {
        opacity: 0;
        transform: translateX(20px);
        transition:
            opacity .35s ease,
            transform .4s cubic-bezier(.22, 1, .36, 1);
    }

    .mobile-drawer.show .mobile-item {
        opacity: 1;
        transform: translateX(0);
    }

    .mobile-drawer.show .mobile-item:nth-child(1) {
        transition-delay: .03s;
    }

    .mobile-drawer.show .mobile-item:nth-child(2) {
        transition-delay: .06s;
    }

    .mobile-drawer.show .mobile-item:nth-child(3) {
        transition-delay: .09s;
    }

    .mobile-drawer.show .mobile-item:nth-child(4) {
        transition-delay: .12s;
    }

    .mobile-drawer.show .mobile-item:nth-child(5) {
        transition-delay: .15s;
    }

    .mobile-drawer.show .mobile-item:nth-child(6) {
        transition-delay: .18s;
    }

    .mobile-drawer.show .mobile-item:nth-child(7) {
        transition-delay: .21s;
    }

    .mobile-drawer.show .mobile-item:nth-child(8) {
        transition-delay: .24s;
    }

    .mobile-drawer.show .mobile-item:nth-child(9) {
        transition-delay: .27s;
    }

    .mobile-special {
        position: relative;
        overflow: hidden;
        background: linear-gradient(
            135deg,
            #ffffff 0%,
            #f8fafc 50%,
            #eef5ff 100%
        ) !important;
        border-color: rgba(37, 99, 235, .18) !important;
    }

    .mobile-special::before {
        content: '';
        position: absolute;
        top: -25px;
        right: -20px;
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: conic-gradient(
            #2563eb 0deg 120deg,
            #dc2626 120deg 240deg,
            #111827 240deg 360deg
        );
        opacity: .15;
    }

    .mobile-special::after {
        content: '';
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        height: 3px;
        background: linear-gradient(
            90deg,
            #1d4ed8 0%,
            #2563eb 30%,
            #dc2626 65%,
            #111827 100%
        );
    }

    .mobile-special .special-text {
        font-size: .9rem;
    }

    body.nav-open {
        overflow: hidden;
    }

    @media (max-width: 1100px) and (min-width: 768px) {
        .desktop-link {
            padding-inline: 9px !important;
            font-size: 11px !important;
        }
    }
</style>

<nav class="fixed inset-x-0 top-10 z-[100] px-3 pt-3 sm:px-5 md:px-6">
    <div class="glass-nav mx-auto flex h-16 max-w-7xl items-center justify-between rounded-[22px] px-3 sm:px-4 md:h-[70px] md:px-5">

        <a
            href="{{ route('home') }}"
            class="relative z-10 rounded-xl border border-white bg-white p-1 shadow-sm"
            aria-label="Home"
        >
            <x-application-logo />
        </a>

        <div class="hidden items-center md:flex">
            <div class="flex items-center gap-1 rounded-2xl border border-white/80 bg-white/40 p-1.5">

                @foreach ($navItems as $item)
                    @php
                        $active = request()->routeIs($item['route']);
                        $special = $item['special'] ?? false;
                    @endphp

                    <a
                        href="{{ route($item['route']) }}"
                        class="desktop-link glass-link relative rounded-xl px-3 py-2.5 text-xs {{ $special ? 'glass-special' : 'font-semibold text-gray-500' }} {{ $active ? 'active' : '' }}"
                    >
                        @if($special)
                            <span class="special-text">
                                BuyMeACar
                            </span>
                        @else
                            {{ $item['name'] }}
                        @endif
                    </a>
                @endforeach

            </div>
        </div>

        <button
            id="navToggle"
            type="button"
            class="relative z-[110] flex h-11 w-11 items-center justify-center rounded-xl border border-white bg-white/90 shadow-sm transition hover:bg-white md:hidden"
            aria-label="Open navigation"
            aria-expanded="false"
        >
            <span class="flex flex-col gap-1.5">
                <span class="h-0.5 w-5 rounded-full bg-gray-900"></span>
                <span class="h-0.5 w-3.5 self-end rounded-full bg-gray-900"></span>
                <span class="h-0.5 w-5 rounded-full bg-gray-900"></span>
            </span>
        </button>

    </div>
</nav>

<div
    id="navBackdrop"
    class="mobile-backdrop fixed inset-0 z-[105] bg-gray-950/40 backdrop-blur-sm md:hidden"
></div>

<aside
    id="mobileDrawer"
    class="mobile-drawer fixed right-2 top-2 z-[110] flex h-[calc(100dvh-1rem)] w-[calc(100%-1rem)] max-w-[380px] flex-col overflow-hidden rounded-[28px] border border-white bg-white shadow-2xl md:hidden"
>

    <div class="flex items-center justify-between border-b border-gray-100 bg-white px-4 py-4">

        <a
            href="{{ route('home') }}"
            class="rounded-xl border border-gray-100 bg-white p-1 shadow-sm"
            aria-label="Home"
        >
            <x-application-logo />
        </a>

        <button
            id="navClose"
            type="button"
            class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-100 bg-gray-50 text-gray-700 transition hover:bg-gray-100"
            aria-label="Close navigation"
        >
            <svg
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 6l12 12M18 6L6 18"
                />
            </svg>
        </button>

    </div>

    <div class="flex-1 overflow-y-auto bg-gray-50/80 p-4">

        <div class="mb-4 rounded-2xl border border-white bg-white p-4 shadow-sm">

            <p class="text-[9px] font-bold uppercase tracking-[.28em] text-gray-400">
                Navigation
            </p>

            <h2 class="mt-1 text-xl font-black tracking-tight text-gray-900">
                Explore Cupstack
            </h2>

        </div>

        <ul class="space-y-2">

            @foreach ($navItems as $index => $item)
                @php
                    $active = request()->routeIs($item['route']);
                    $special = $item['special'] ?? false;
                @endphp

                <li class="mobile-item">

                    <a
                        href="{{ route($item['route']) }}"
                        class="group flex min-h-[54px] items-center gap-3 rounded-2xl border border-white bg-white px-3 shadow-sm transition hover:-translate-x-0.5 hover:shadow-md {{ $active ? 'ring-1 ring-gray-200' : '' }} {{ $special ? 'mobile-special' : '' }}"
                    >

                        <span class="relative z-10 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gray-50 text-[9px] font-bold text-gray-400">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        @if($special)

                            <span class="relative z-10 flex flex-1 items-center">
                                <span class="special-text">
                                    BuyMeACar
                                </span>
                            </span>

                        @else

                            <span class="relative z-10 flex-1 text-sm font-semibold text-gray-700">
                                {{ $item['name'] }}
                            </span>

                        @endif

                        <svg
                            class="relative z-10 h-4 w-4 shrink-0 text-gray-300 transition group-hover:translate-x-1 group-hover:text-gray-700"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>

                    </a>

                </li>

            @endforeach

        </ul>

    </div>

    <div class="border-t border-gray-100 bg-white p-4">

        <div class="flex items-center justify-between rounded-2xl border border-gray-100 bg-gray-50 px-4 py-3">

            <div>
                <p class="text-[8px] font-bold uppercase tracking-[.25em] text-gray-400">
                    Cupstack
                </p>

                <p class="mt-1 text-xs font-semibold text-gray-700">
                    Build · Learn · Create
                </p>
            </div>

            <span class="h-2 w-2 rounded-full bg-gray-900"></span>

        </div>

    </div>

</aside>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggle = document.getElementById('navToggle');
        const close = document.getElementById('navClose');
        const drawer = document.getElementById('mobileDrawer');
        const backdrop = document.getElementById('navBackdrop');

        if (!toggle || !close || !drawer || !backdrop) {
            return;
        }

        const setMenu = (open) => {
            drawer.classList.toggle('show', open);
            backdrop.classList.toggle('show', open);
            document.body.classList.toggle('nav-open', open);
            toggle.setAttribute('aria-expanded', String(open));
        };

        toggle.addEventListener('click', () => {
            setMenu(!drawer.classList.contains('show'));
        });

        close.addEventListener('click', () => {
            setMenu(false);
        });

        backdrop.addEventListener('click', () => {
            setMenu(false);
        });

        drawer.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                setMenu(false);
            });
        });

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape') {
                setMenu(false);
            }
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                setMenu(false);
            }
        });
    });
</script>
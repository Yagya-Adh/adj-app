<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin Dashboard') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-50 font-sans text-slate-800 antialiased">

<div
    x-data="{ sidebarOpen: false }"
    class="min-h-screen"
>

    @include('layouts.navigation')

    <div
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-slate-950/50 backdrop-blur-sm lg:hidden"
        x-cloak
    ></div>

    <div class="lg:pl-72">

        <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/90 backdrop-blur-xl">
            <div class="flex h-20 items-center justify-between px-4 sm:px-6 lg:px-8">

                <div class="flex items-center gap-4">

                    <button
                        @click="sidebarOpen = true"
                        class="rounded-xl border border-slate-200 p-2.5 text-slate-600 transition hover:bg-slate-100 lg:hidden"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>
                    </button>

                    <div>
                        <h1 class="text-xl font-bold text-slate-900">
                            Dashboard
                        </h1>

                        <p class="hidden text-sm text-slate-400 sm:block">
                            Welcome back, {{ Auth::user()->name }}
                        </p>
                    </div>

                </div>

                <div class="flex items-center gap-2 sm:gap-4">

                    <button
                        class="relative rounded-xl p-2.5 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M15 17h5l-1.5-2v-5a6.5 6.5 0 00-13 0v5L4 17h5m6 0a3 3 0 01-6 0"
                            />
                        </svg>

                        <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-red-500"></span>
                    </button>

                    <div class="hidden h-8 w-px bg-slate-200 sm:block"></div>

                    <div class="flex items-center gap-3">

                        <div class="hidden text-right sm:block">
                            <p class="text-sm font-semibold text-slate-800">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-slate-400">
                                Administrator
                            </p>
                        </div>

                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-sm font-bold text-white">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                    </div>

                </div>

            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">

            @isset($header)
                <div class="mb-8">
                    {{ $header }}
                </div>
            @endisset

            @yield('adminContent')

        </main>

    </div>

</div>

</body>
</html>
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

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-slate-50 font-sans text-slate-800 antialiased">

<div x-data="{ sidebarOpen: false }" class="min-h-screen">

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
                        aria-label="Open navigation"
                        class="rounded-xl border border-slate-200 p-2.5 text-slate-600 transition hover:bg-slate-100 lg:hidden"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <div>
                        <h1 class="text-xl font-bold text-slate-900">Dashboard</h1>
                        <p class="hidden text-sm text-slate-400 sm:block">
                            Welcome back, {{ Auth::user()->name }}
                        </p>
                    </div>

                </div>

                <div class="flex items-center gap-2 sm:gap-4">

                    {{-- Notifications --}}
                    <div
                        x-data="adminNotifications()"
                        x-init="init()"
                        @keydown.escape.window="open = false"
                        @click.outside="open = false"
                        class="relative"
                    >

                        <button
                            @click="open = !open; if (open) loadNotifications()"
                            :aria-expanded="open.toString()"
                            aria-label="Notifications"
                            class="relative rounded-xl p-2.5 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M15 17h5l-1.5-2v-5a6.5 6.5 0 00-13 0v5L4 17h5m6 0a3 3 0 01-6 0"/>
                            </svg>

                            <span
                                x-show="unreadCount > 0"
                                x-cloak
                                x-text="unreadCount > 99 ? '99+' : unreadCount"
                                class="absolute -right-1 -top-1 flex min-h-5 min-w-5 items-center justify-center rounded-full bg-rose-500 px-1 text-[10px] font-bold text-white ring-2 ring-white"
                            ></span>
                        </button>

                        {{-- Notification dropdown --}}
                        <div
                            x-show="open"
                            x-transition.origin.top.right
                            x-cloak
                            class="absolute right-0 z-50 mt-3 w-[min(90vw,380px)] overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl shadow-slate-900/10"
                        >

                            <div class="flex items-center justify-between border-b border-slate-100 px-4 py-4">
                                <div>
                                    <h2 class="font-bold text-slate-900">Notifications</h2>
                                    <p class="mt-0.5 text-xs text-slate-500">
                                        <span x-text="unreadCount"></span> unread
                                    </p>
                                </div>

                                <button
                                    @click="markAllAsRead()"
                                    :disabled="unreadCount === 0 || busy"
                                    class="text-xs font-semibold text-indigo-600 transition hover:text-indigo-800 disabled:cursor-not-allowed disabled:opacity-40"
                                >
                                    Mark all read
                                </button>
                            </div>

                            <div class="max-h-[380px] overflow-y-auto">

                                <div x-show="loading" class="px-4 py-10 text-center text-sm text-slate-500">
                                    Loading notifications...
                                </div>

                                <div x-show="error" x-cloak class="px-4 py-8 text-center">
                                    <p class="text-sm text-rose-600" x-text="error"></p>

                                    <button
                                        @click="loadNotifications()"
                                        class="mt-2 text-sm font-semibold text-indigo-600"
                                    >
                                        Try again
                                    </button>
                                </div>

                                <template x-if="!loading && !error && notifications.length === 0">
                                    <div class="px-4 py-10 text-center">
                                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                                      d="M15 17h5l-1.5-2v-5a6.5 6.5 0 00-13 0v5L4 17h5m6 0a3 3 0 01-6 0"/>
                                            </svg>
                                        </div>

                                        <p class="text-sm font-semibold text-slate-700">
                                            You're all caught up
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            New notifications will appear here.
                                        </p>
                                    </div>
                                </template>

                                <template x-for="notification in notifications" :key="notification.id">
                                    <button
                                        @click="openNotification(notification)"
                                        :disabled="busy"
                                        class="flex w-full gap-3 border-b border-slate-100 px-4 py-4 text-left transition hover:bg-slate-50 disabled:opacity-60"
                                        :class="notification.read_at ? '' : 'bg-indigo-50/60'"
                                    >
                                        <span
                                            class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full"
                                            :class="notification.read_at ? 'bg-slate-200' : 'bg-indigo-500'"
                                        ></span>

                                        <span class="min-w-0 flex-1">
                                            <span
                                                class="block text-sm font-semibold text-slate-800"
                                                x-text="notification.title"
                                            ></span>

                                            <span
                                                class="mt-1 block break-words text-xs leading-5 text-slate-500"
                                                x-text="notification.message"
                                            ></span>

                                            <span
                                                class="mt-2 block text-[11px] text-slate-400"
                                                x-text="notification.created_at || ''"
                                            ></span>
                                        </span>
                                    </button>
                                </template>

                            </div>

                            <div class="border-t border-slate-100 bg-slate-50 px-4 py-3">
                                <button
                                    @click="loadNotifications()"
                                    class="w-full text-center text-xs font-semibold text-slate-500 hover:text-indigo-600"
                                >
                                    Refresh notifications
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="hidden h-8 w-px bg-slate-200 sm:block"></div>

                    <div class="flex items-center gap-3">
                        <div class="hidden text-right sm:block">
                            <p class="text-sm font-semibold text-slate-800">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-slate-400">Administrator</p>
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
                <div class="mb-8">{{ $header }}</div>
            @endisset

            @yield('adminContent')
        </main>

    </div>
</div>

<script>
    function adminNotifications() {
        return {
            open: false,
            loading: false,
            busy: false,
            error: '',
            notifications: [],
            unreadCount: 0,
            refreshTimer: null,

            init() {
                this.loadNotifications();

                this.refreshTimer = setInterval(
                    () => this.loadNotifications(),
                    30000
                );

                window.addEventListener('beforeunload', () => {
                    clearInterval(this.refreshTimer);
                }, { once: true });
            },

            async request(url, options = {}) {
                const response = await fetch(url, {
                    credentials: 'same-origin',
                    ...options,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                        ...(options.headers || {})
                    }
                });

                if (!response.ok) {
                    throw new Error(`Request failed (${response.status}).`);
                }

                return response.json();
            },

            async loadNotifications() {
                if (this.loading) return;

                this.loading = true;
                this.error = '';

                try {
                    const data = await this.request(
                        @json(route('admin.notifications.index'))
                    );

                    this.notifications = data.notifications || [];
                    this.unreadCount = Number(data.unread_count || 0);
                } catch (error) {
                    this.error = 'Unable to load notifications. Please try again.';
                } finally {
                    this.loading = false;
                }
            },

            async markAllAsRead() {
                if (this.busy || this.unreadCount === 0) return;

                this.busy = true;

                try {
                    await this.request(
                        @json(route('admin.notifications.readAll')),
                        { method: 'POST' }
                    );

                    this.notifications = this.notifications.map(item => ({
                        ...item,
                        read_at: item.read_at || new Date().toISOString()
                    }));

                    this.unreadCount = 0;
                } catch (error) {
                    this.error = 'Could not mark notifications as read.';
                } finally {
                    this.busy = false;
                }
            },

            async openNotification(notification) {
                if (this.busy) return;

                this.busy = true;
                this.error = '';

                try {
                    if (!notification.read_at) {
                        await this.request(
                            @json(url('/admin/notifications')) + '/' +
                            encodeURIComponent(notification.id) + '/read',
                            { method: 'POST' }
                        );

                        notification.read_at = new Date().toISOString();
                        this.unreadCount = Math.max(0, this.unreadCount - 1);
                    }

                    this.open = false;

                    // Redirect to the contact index page after clicking.
                    window.location.href = @json(route('contact.index'));

                } catch (error) {
                    this.error = 'Could not update this notification.';
                } finally {
                    this.busy = false;
                }
            }
        };
    }
</script>

</body>
</html>
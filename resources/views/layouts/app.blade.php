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
                            class="absolute right-0 z-50 mt-3 w-[min(90vw,400px)] overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl shadow-slate-900/10"
                        >

                            {{-- Header --}}
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
                                    class="text-xs font-semibold text-indigo-600 transition hover:text-indigo-800 disabled:opacity-40"
                                >
                                    Mark all read
                                </button>
                            </div>

                            {{-- Feedback --}}
                            <div
                                x-show="notice"
                                x-cloak
                                class="border-b border-emerald-100 bg-emerald-50 px-4 py-2 text-xs text-emerald-700"
                                x-text="notice"
                            ></div>

                            {{-- Notification list --}}
                            <div class="max-h-[380px] overflow-y-auto">

                                <div
                                    x-show="loading && notifications.length === 0"
                                    class="px-4 py-10 text-center text-sm text-slate-500"
                                >
                                    Loading notifications...
                                </div>

                                <div
                                    x-show="error"
                                    x-cloak
                                    class="px-4 py-6 text-center"
                                >
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
                                    <div
                                        class="flex items-start gap-3 border-b border-slate-100 px-4 py-4 transition"
                                        :class="notification.read_at ? 'bg-white' : 'bg-indigo-50/60'"
                                    >

                                        {{-- Click notification to open --}}
                                        <button
                                            type="button"
                                            @click="openNotification(notification)"
                                            :disabled="busy || deletingId === notification.id"
                                            class="flex min-w-0 flex-1 gap-3 text-left disabled:opacity-60"
                                        >
                                            <span
                                                class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full"
                                                :class="notification.read_at ? 'bg-slate-200' : 'bg-indigo-500'"
                                            ></span>

                                            <span class="min-w-0 flex-1">
                                                <span
                                                    class="block break-words text-sm font-semibold text-slate-800"
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

                                        {{-- AJAX Delete button --}}
                                        <button
                                            type="button"
                                            @click.stop="deleteNotification(notification)"
                                            :disabled="deletingId === notification.id"
                                            :aria-label="'Delete ' + notification.title"
                                            title="Delete notification"
                                            class="shrink-0 rounded-lg p-2 text-slate-400 transition hover:bg-rose-100 hover:text-rose-600 disabled:cursor-wait disabled:opacity-50"
                                        >
                                            <template x-if="deletingId !== notification.id">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                          stroke-linecap="round" stroke-linejoin="round"
                                                          d="M3 6h18m-2 0-.9 14H5.9L5 6m4 0V4h6v2m-5 4v6m4-6v6"/>
                                                </svg>
                                            </template>

                                            <svg
                                                x-show="deletingId === notification.id"
                                                x-cloak
                                                class="h-4 w-4 animate-spin"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                            >
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4"/>
                                                <path class="opacity-75" fill="currentColor"
                                                      d="M4 12a8 8 0 018-8V0C5.37 0 0 5.37 0 12h4z"/>
                                            </svg>
                                        </button>

                                    </div>
                                </template>

                            </div>

                            {{-- Footer --}}
                            <div class="border-t border-slate-100 bg-slate-50 px-4 py-3">
                                <button
                                    @click="loadNotifications()"
                                    :disabled="loading"
                                    class="w-full text-center text-xs font-semibold text-slate-500 transition hover:text-indigo-600 disabled:opacity-50"
                                >
                                    <span x-text="loading ? 'Refreshing...' : 'Refresh notifications'"></span>
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="hidden h-8 w-px bg-slate-200 sm:block"></div>

                    {{-- User --}}
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

        {{-- Main content --}}
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
            notice: '',
            notifications: [],
            unreadCount: 0,
            deletingId: null,
            refreshTimer: null,

            init() {
                this.loadNotifications();

                this.refreshTimer = setInterval(() => {
                    if (!this.loading && !this.busy && !this.deletingId) {
                        this.loadNotifications();
                    }
                }, 30000);

                window.addEventListener('beforeunload', () => {
                    clearInterval(this.refreshTimer);
                }, { once: true });
            },

            async request(url, options = {}) {
                const csrf = document.querySelector(
                    'meta[name="csrf-token"]'
                )?.content;

                const response = await fetch(url, {
                    credentials: 'same-origin',
                    ...options,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        ...(csrf ? { 'X-CSRF-TOKEN': csrf } : {}),
                        ...(options.headers || {})
                    }
                });

                if (!response.ok) {
                    const data = await response.json().catch(() => ({}));
                    throw new Error(
                        data.message || `Request failed (${response.status}).`
                    );
                }

                return response.json();
            },

            async loadNotifications() {
                if (this.loading || this.deletingId) return;

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
                this.error = '';

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
                    this.notice = 'All notifications marked as read.';
                } catch (error) {
                    this.error = error.message || 'Could not mark notifications as read.';
                } finally {
                    this.busy = false;
                }
            },

            async deleteNotification(notification) {
                if (this.busy || this.deletingId) return;

                if (!confirm('Are you sure you want to delete this notification?')) {
                    return;
                }

                this.deletingId = notification.id;
                this.error = '';
                this.notice = '';

                try {
                    await this.request(
                        @json(url('/admin/notifications')) + '/' +
                        encodeURIComponent(notification.id),
                        { method: 'DELETE' }
                    );

                    // Remove notification immediately without reloading.
                    this.notifications = this.notifications.filter(
                        item => item.id !== notification.id
                    );

                    // Decrease count only when the deleted notification was unread.
                    if (!notification.read_at) {
                        this.unreadCount = Math.max(0, this.unreadCount - 1);
                    }

                    this.notice = 'Notification deleted successfully.';
                } catch (error) {
                    this.error = error.message || 'Failed to delete notification.';
                } finally {
                    this.deletingId = null;
                }
            },

            async openNotification(notification) {
                if (this.busy || this.deletingId) return;

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
                    window.location.href = @json(route('contact.index'));
                } catch (error) {
                    this.error = error.message || 'Could not update this notification.';
                } finally {
                    this.busy = false;
                }
            }
        };
    }
</script>

</body>
</html>
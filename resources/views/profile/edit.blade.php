@extends('layouts.app')

@section('adminContent')
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-10 dark:bg-gray-900">
        <div class="mx-auto max-w-5xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Page Heading --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Profile Settings
                </h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Manage your personal information, avatar, and account security.
                </p>
            </div>

            {{-- Profile Overview --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700">
                <div class="flex flex-col gap-5 p-6 sm:flex-row sm:items-center">

                    {{-- Profile Avatar: Always Display --}}
                    <div class="shrink-0">
                        <img
                            id="profile-avatar-preview"
                            src="{{ auth()->user()->avatar
                                ? asset('storage/' . auth()->user()->avatar) . '?v=' . (auth()->user()->updated_at?->timestamp ?? time())
                                : '' }}"
                            alt="Profile avatar"
                            class="{{ auth()->user()->avatar ? 'block' : 'hidden' }} h-24 w-24 rounded-full border-4 border-indigo-100 object-cover dark:border-indigo-900"
                            onerror="this.classList.add('hidden'); document.getElementById('profile-avatar-initial').classList.remove('hidden'); document.getElementById('profile-avatar-initial').classList.add('flex');"
                        >

                        <div
                            id="profile-avatar-initial"
                            class="{{ auth()->user()->avatar ? 'hidden' : 'flex' }} h-24 w-24 items-center justify-center rounded-full bg-indigo-100 text-3xl font-bold text-indigo-700 dark:bg-indigo-900 dark:text-indigo-200"
                        >
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </div>
                    </div>

                    <div class="min-w-0 flex-1">
                        <h2 class="truncate text-xl font-bold text-gray-900 dark:text-white">
                            {{ auth()->user()->name }}
                        </h2>

                        <p class="mt-1 break-words text-sm text-gray-600 dark:text-gray-400">
                            {{ auth()->user()->email }}
                        </p>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ auth()->user()->phone ?: 'Phone number not added' }}
                        </p>

                        <span class="mt-3 inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700 dark:bg-green-900 dark:text-green-200">
                            Active Account
                        </span>
                    </div>
                </div>
            </div>

            {{-- Success Messages --}}
            @if (session('status') === 'profile-updated')
                <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300">
                    Profile information updated successfully.
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300">
                    Password updated successfully.
                </div>
            @endif

            {{-- Personal Information --}}
            <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700 sm:p-8">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Personal Information
                    </h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Update your name, email, phone number, and profile avatar.
                    </p>
                </div>

                @include('profile.partials.update-profile-information-form')
            </section>

            {{-- Password Settings --}}
            <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700 sm:p-8">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Password & Security
                    </h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Use a strong password to protect your account.
                    </p>
                </div>

                @include('profile.partials.update-password-form')
            </section>

            {{-- Delete Account --}}
            <section class="rounded-2xl border border-red-200 bg-white p-6 shadow-sm dark:border-red-900 dark:bg-gray-800 sm:p-8">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-red-600 dark:text-red-400">
                        Delete Account
                    </h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Permanently delete your account and associated data.
                    </p>
                </div>

                @include('profile.partials.delete-user-form')
            </section>

        </div>
    </div>

    {{-- Avatar Preview JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('avatar');
            const preview = document.getElementById('profile-avatar-preview');
            const initial = document.getElementById('profile-avatar-initial');

            if (!input || !preview || !initial) return;

            let previousUrl = null;

            input.addEventListener('change', function () {
                const file = this.files[0];

                if (!file) return;

                if (!file.type.startsWith('image/')) {
                    this.value = '';
                    alert('Please select a valid image file.');
                    return;
                }

                if (previousUrl) {
                    URL.revokeObjectURL(previousUrl);
                }

                previousUrl = URL.createObjectURL(file);
                preview.src = previousUrl;

                preview.classList.remove('hidden');
                initial.classList.add('hidden');
                initial.classList.remove('flex');
            });

            preview.addEventListener('error', function () {
                if (!preview.src.startsWith('blob:')) {
                    preview.classList.add('hidden');
                    initial.classList.remove('hidden');
                    initial.classList.add('flex');
                }
            });
        });
    </script>
@endsection
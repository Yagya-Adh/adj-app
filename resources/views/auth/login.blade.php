<x-guest-layout>
    <div class="relative flex min-h-screen w-full items-center justify-center overflow-hidden bg-[#eef1f7] px-4 py-8">
    <div class="pointer-events-none absolute -left-40 -top-40 h-[32rem] w-[32rem] rounded-full bg-indigo-300/30 blur-[120px]"></div>
    <div class="pointer-events-none absolute -bottom-40 -right-40 h-[32rem] w-[32rem] rounded-full bg-purple-300/30 blur-[120px]"></div>

    <div class="pointer-events-none absolute left-1/2 top-1/2 h-72 w-72 -translate-x-1/2 -translate-y-1/2 rounded-full bg-blue-200/20 blur-[100px]"></div>

    <div class="relative mx-auto flex w-full max-w-md flex-col justify-center">

        <div class="mb-7 text-center">

            <div class="relative mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-[1.4rem] border border-white/80 bg-white/50 shadow-[0_15px_45px_rgba(79,70,229,0.18)] backdrop-blur-xl">

                <div class="absolute inset-[1px] rounded-[1.3rem] bg-gradient-to-br from-indigo-500 via-violet-600 to-purple-700"></div>

                <svg
                    class="relative z-10 h-7 w-7 text-white drop-shadow-lg"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.6"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2zm10-11V7a4 4 0 00-8 0v1h8z"
                    />
                </svg>
            </div>

            <h1 class="text-3xl font-black tracking-tight text-slate-900">
                Welcome back
            </h1>

            <p class="mt-2 text-sm font-medium text-slate-500">
                Sign in to continue to your account
            </p>
        </div>

        <div class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/55 p-1 shadow-[0_30px_100px_-25px_rgba(15,23,42,0.28)] backdrop-blur-2xl">

            <div class="relative rounded-[1.75rem] border border-white/60 bg-white/65 p-7 sm:p-9">

                <x-auth-session-status
                    class="mb-6 rounded-2xl border border-green-200/60 bg-green-50/70 px-4 py-3 text-sm font-medium text-green-700 shadow-sm"
                    :status="session('status')"
                />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label
                            for="email"
                            :value="__('Email address')"
                            class="mb-2.5 text-sm font-bold text-slate-700"
                        />

                        <div class="group relative">

                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 transition group-focus-within:text-indigo-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    />
                                </svg>
                            </div>

                            <x-text-input
                                id="email"
                                class="block w-full rounded-2xl border border-slate-200/80 bg-white/70 py-4 pl-12 pr-4 text-sm font-medium text-slate-800 shadow-inner shadow-white/80 transition focus:border-indigo-400 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="you@example.com"
                            />
                        </div>

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />
                    </div>

                    <div>
                        <div class="mb-2.5 flex items-center justify-between">

                            <x-input-label
                                for="password"
                                :value="__('Password')"
                                class="text-sm font-bold text-slate-700"
                            />

                            @if (Route::has('password.request'))
                                <a
                                    href="{{ route('password.request') }}"
                                    class="text-xs font-bold text-indigo-600 transition hover:text-violet-600"
                                >
                                    Forgot password?
                                </a>
                            @endif

                        </div>

                        <div
                            class="group relative"
                            x-data="{ show: false }"
                        >

                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 transition group-focus-within:text-indigo-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2zm10-11V7a4 4 0 00-8 0v1h8z"
                                    />
                                </svg>
                            </div>

                            <x-text-input
                                id="password"
                                class="block w-full rounded-2xl border border-slate-200/80 bg-white/70 py-4 pl-12 pr-12 text-sm font-medium text-slate-800 shadow-inner shadow-white/80 transition focus:border-indigo-400 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                                x-bind:type="show ? 'text' : 'password'"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                            />

                            <button
                                type="button"
                                @click="show = !show"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 transition hover:text-indigo-600"
                            >
                                <svg
                                    x-show="!show"
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"
                                    />
                                    <circle cx="12" cy="12" r="2.5" stroke-width="1.7"/>
                                </svg>

                                <svg
                                    x-show="show"
                                    x-cloak
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M3 3l18 18M10.6 10.6a2 2 0 002.8 2.8M9.9 5.2A9.9 9.9 0 0112 5c6 0 9.5 7 9.5 7a17.8 17.8 0 01-3.2 3.9M6.7 6.7C4 8.3 2.5 12 2.5 12s3.5 6 9.5 6c1.1 0 2.1-.2 3-.5"
                                    />
                                </svg>
                            </button>

                        </div>

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />
                    </div>

                    <div class="flex items-center">

                        <label
                            for="remember_me"
                            class="inline-flex cursor-pointer items-center"
                        >
                            <input
                                id="remember_me"
                                type="checkbox"
                                name="remember"
                                class="h-4 w-4 rounded-md border-slate-300 text-indigo-600 shadow-sm focus:ring-2 focus:ring-indigo-500/20"
                            >

                            <span class="ms-2 text-sm font-medium text-slate-500">
                                {{ __('Remember me') }}
                            </span>
                        </label>

                    </div>

                    <button
                        type="submit"
                        class="group relative flex w-full items-center justify-center overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-600 via-violet-600 to-purple-600 px-5 py-4 text-sm font-bold text-white shadow-[0_12px_30px_-8px_rgba(79,70,229,0.55)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_-8px_rgba(79,70,229,0.65)] focus:outline-none focus:ring-4 focus:ring-indigo-500/20"
                    >
                        <span class="absolute inset-x-0 top-0 h-px bg-white/60"></span>

                        <span class="absolute inset-0 -translate-x-full skew-x-12 bg-white/20 transition-transform duration-700 group-hover:translate-x-full"></span>

                        <span class="relative z-10 flex items-center gap-2.5">
                            {{ __('Log in') }}

                            <svg
                                class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 12h14m-6-6l6 6-6 6"
                                />
                            </svg>
                        </span>
                    </button>

                </form>

                <div class="mt-8 flex items-center gap-4">

                    <div class="h-px flex-1 bg-slate-200"></div>

                    <span class="text-[10px] font-bold tracking-[0.2em] text-slate-400">
                        SECURE LOGIN
                    </span>

                    <div class="h-px flex-1 bg-slate-200"></div>

                </div>

                <div class="mt-5 flex items-center justify-center gap-2 text-xs font-medium text-slate-400">

                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-50">
                        <svg
                            class="h-3.5 w-3.5 text-emerald-500"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                    </span>

                    Your information is protected

                </div>

            </div>
        </div>

        <p class="mt-6 text-center text-xs font-medium text-slate-400">
            © {{ date('Y') }} All rights reserved.
        </p>

    </div>
</div>
</x-guest-layout>

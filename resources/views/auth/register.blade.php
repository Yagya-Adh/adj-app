<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
            Create an Account
        </h2>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            Register to get started.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}"
          enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Full Name" />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full rounded-lg"
                :value="old('name')"
                placeholder="Enter your full name"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email Address" />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full rounded-lg"
                :value="old('email')"
                placeholder="you@example.com"
                required
                autocomplete="username"
            />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" value="Phone Number (Optional)" />

            <x-text-input
                id="phone"
                name="phone"
                type="tel"
                class="mt-1 block w-full rounded-lg"
                :value="old('phone')"
                placeholder="Enter your phone number"
                autocomplete="tel"
            />

            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Avatar -->
        <div>
            <x-input-label for="avatar" value="Profile Photo (Optional)" />

            <input
                id="avatar"
                name="avatar"
                type="file"
                accept="image/*"
                class="mt-1 block w-full cursor-pointer rounded-lg border border-gray-300
                       bg-white text-sm text-gray-700
                       file:mr-4 file:border-0 file:bg-indigo-600
                       file:px-4 file:py-2 file:text-white
                       hover:file:bg-indigo-700
                       dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300"
            />

            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" />

            <x-text-input
                id="password"
                name="password"
                type="password"
                class="mt-1 block w-full rounded-lg"
                placeholder="Create a strong password"
                required
                autocomplete="new-password"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Confirm Password" />

            <x-text-input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1 block w-full rounded-lg"
                placeholder="Re-enter your password"
                required
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />
        </div>

        <!-- Actions -->
        <div class="flex flex-col gap-4 pt-2">
            <x-primary-button
                class="w-full justify-center rounded-lg bg-indigo-600 py-3
                       text-center hover:bg-indigo-700"
            >
                Create Account
            </x-primary-button>

            <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                Already have an account?
                <a
                    href="{{ route('login') }}"
                    class="font-semibold text-indigo-600 hover:text-indigo-800
                           dark:text-indigo-400"
                >
                    Sign in
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
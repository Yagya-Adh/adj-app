<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information, email address, phone number, and avatar.") }}
        </p>
    </header>

    {{-- Email Verification --}}
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Profile Update Form --}}
    <form
        method="POST"
        action="{{ route('profile.update') }}"
        enctype="multipart/form-data"
        class="mt-6 space-y-6"
    >
        @csrf
        @method('PATCH')

        {{-- Avatar --}}
        <div>
            <x-input-label for="avatar" value="Profile Avatar" />

            <div class="mt-3 flex flex-col items-start gap-4 sm:flex-row sm:items-center">
                <div class="shrink-0">
                    <img
                        id="avatar-preview"
                        src="{{ $user->avatar ? asset('storage/' . $user->avatar) . '?v=' . ($user->updated_at?->timestamp ?? time()) : '' }}"
                        alt="Profile avatar preview"
                        class="{{ $user->avatar ? '' : 'hidden' }} h-24 w-24 rounded-full border-4 border-indigo-100 object-cover shadow-sm dark:border-indigo-900"
                    >

                    <div
                        id="avatar-placeholder"
                        class="{{ $user->avatar ? 'hidden' : 'flex' }} h-24 w-24 items-center justify-center rounded-full bg-indigo-100 text-3xl font-semibold text-indigo-700 dark:bg-indigo-900 dark:text-indigo-200"
                    >
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </div>
                </div>

                <div class="w-full flex-1">
                    <input
                        id="avatar"
                        name="avatar"
                        type="file"
                        accept="image/jpeg,image/png,image/webp"
                        class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:font-medium file:text-indigo-700 hover:file:bg-indigo-100 dark:text-gray-300"
                    >

                    <div class="mt-3 flex flex-wrap gap-2">
                        <button
                            type="button"
                            id="toggle-avatar-preview"
                            class="rounded-lg bg-indigo-600 px-3 py-2 text-sm font-medium text-white transition hover:bg-indigo-700"
                        >
                            Hide Preview
                        </button>

                        <button
                            type="button"
                            id="reset-avatar-preview"
                            class="rounded-lg bg-gray-200 px-3 py-2 text-sm font-medium text-gray-800 transition hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600"
                        >
                            Reset Image
                        </button>
                    </div>

                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        JPG, PNG, or WEBP. Maximum size: 5 MB.
                    </p>

                    <p id="avatar-error" class="mt-2 hidden text-sm text-red-600"></p>

                    <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                </div>
            </div>
        </div>

        {{-- Name --}}
        <div>
            <x-input-label for="name" value="Name" />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)"
                required
                autocomplete="name"
            />

            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" value="Email" />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />

            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}

                    <button
                        type="submit"
                        form="send-verification"
                        class="text-sm text-indigo-600 underline hover:text-indigo-800 dark:text-indigo-400"
                    >
                        {{ __('Resend verification email') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        {{-- Phone --}}
        <div>
            <x-input-label for="phone" value="Phone Number" />

            <x-text-input
                id="phone"
                name="phone"
                type="tel"
                class="mt-1 block w-full"
                :value="old('phone', $user->phone)"
                autocomplete="tel"
                placeholder="Enter your phone number"
            />

            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        {{-- Save --}}
        <div class="flex items-center gap-4">
            <x-primary-button>
                {{ __('Save Changes') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <span class="text-sm font-medium text-green-600 dark:text-green-400">
                    {{ __('Saved successfully.') }}
                </span>
            @endif
        </div>
    </form>
</section>

{{-- Avatar Preview, Toggle and Validation --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('avatar');
    const preview = document.getElementById('avatar-preview');
    const placeholder = document.getElementById('avatar-placeholder');
    const toggleButton = document.getElementById('toggle-avatar-preview');
    const resetButton = document.getElementById('reset-avatar-preview');
    const error = document.getElementById('avatar-error');

    if (!input || !preview || !placeholder || !toggleButton || !resetButton || !error) {
        return;
    }

    const originalImage = preview.getAttribute('src');
    let previewUrl = null;
    let previewVisible = true;

    function clearError() {
        error.textContent = '';
        error.classList.add('hidden');
    }

    function showError(message) {
        error.textContent = message;
        error.classList.remove('hidden');
    }

    function releasePreviewUrl() {
        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }
    }

    function updatePreview() {
        preview.classList.toggle('hidden', !previewVisible);
        placeholder.classList.toggle('hidden', previewVisible);
        placeholder.classList.toggle('flex', !previewVisible);

        toggleButton.textContent = previewVisible
            ? 'Hide Preview'
            : 'Show Preview';
    }

    input.addEventListener('change', function () {
        clearError();

        const file = this.files[0];

        if (!file) return;

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {
            this.value = '';
            showError('Please select a JPG, PNG, or WEBP image.');
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            this.value = '';
            showError('The image must not exceed 5 MB.');
            return;
        }

        releasePreviewUrl();

        previewUrl = URL.createObjectURL(file);
        preview.src = previewUrl;
        previewVisible = true;

        updatePreview();
    });

    toggleButton.addEventListener('click', function () {
        previewVisible = !previewVisible;
        updatePreview();
    });

    resetButton.addEventListener('click', function () {
        input.value = '';
        clearError();
        releasePreviewUrl();

        preview.src = originalImage;
        previewVisible = Boolean(originalImage);

        updatePreview();
    });

    preview.addEventListener('error', function () {
        if (previewUrl && preview.src === previewUrl) {
            clearError();
            showError('Unable to preview this image. Please select another image.');
            previewVisible = false;
            updatePreview();
        } else if (originalImage && preview.src !== originalImage) {
            previewVisible = false;
            updatePreview();
        }
    });

    updatePreview();
});
</script>
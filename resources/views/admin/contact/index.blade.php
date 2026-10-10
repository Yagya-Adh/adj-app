@extends('layouts.app')

@section('adminContent')

<div
    x-data="{
        modalOpen: false,
        selected: {},
        showContact(contact) {
            this.selected = contact;
            this.modalOpen = true;
        }
    }"
    @keydown.escape.window="modalOpen = false"
    class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8"
>
    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Contact Submissions
        </h1>
        <p class="mt-2 text-sm text-gray-500">
            View and manage messages submitted through your contact form.
        </p>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation errors --}}
    @if($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- Contacts table --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Name
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Email
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Message
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($contacts as $contact)
                        <tr class="transition hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-900">
                                {{ $contact->name }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-4 text-sm text-blue-600">
                                {{ $contact->email }}
                            </td>

                            <td class="max-w-xs px-6 py-4 text-sm text-gray-600">
                                <p class="truncate">
                                    {{ \Illuminate\Support\Str::limit($contact->message, 70) }}
                                </p>
                            </td>

                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="flex items-center justify-end gap-3">

                                    {{-- View contact modal --}}
                                    <button
                                        type="button"
                                        @click="showContact({
                                            name: @js($contact->name),
                                            email: @js($contact->email),
                                            phone: @js($contact->phone ?? ''),
                                            subject: @js($contact->subject),
                                            message: @js($contact->message)
                                        })"
                                        class="rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100"
                                    >
                                        View
                                    </button>

                                    {{-- Delete contact --}}
                                    <form
                                        action="{{ route('contact.destroy', $contact) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to permanently delete this contact message?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100"
                                        >
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <p class="font-semibold text-gray-700">
                                    No contact messages found.
                                </p>
                                <p class="mt-1 text-sm text-gray-500">
                                    New submissions will appear here.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($contacts->hasPages())
            <div class="border-t border-gray-100 px-6 py-4">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>

    {{-- Contact details modal --}}
    <div
        x-show="modalOpen"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-gray-950/60 p-4 backdrop-blur-sm"
        @click.self="modalOpen = false"
        style="display: none;"
    >
        <div
            x-show="modalOpen"
            x-transition.scale.origin.center
            class="my-auto w-full max-w-2xl overflow-hidden rounded-2xl bg-white shadow-2xl"
            @click.stop
        >
            {{-- Modal header --}}
            <div class="flex items-center justify-between border-b border-gray-100 bg-gray-50 px-6 py-5">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        Contact Details
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Full message and sender information
                    </p>
                </div>

                <button
                    type="button"
                    @click="modalOpen = false"
                    aria-label="Close modal"
                    class="rounded-xl p-2 text-gray-400 transition hover:bg-gray-200 hover:text-gray-700"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Modal body --}}
            <div class="max-h-[65vh] space-y-5 overflow-y-auto p-6">

                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Full Name
                        </p>
                        <p class="mt-2 break-words font-semibold text-gray-900"
                           x-text="selected.name"></p>
                    </div>

                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Email Address
                        </p>
                        <p class="mt-2 break-all text-sm font-medium text-blue-600"
                           x-text="selected.email"></p>
                    </div>

                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Phone Number
                        </p>
                        <p class="mt-2 break-words font-medium text-gray-900"
                           x-text="selected.phone || 'Not provided'"></p>
                    </div>

                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Subject
                        </p>
                        <p class="mt-2 break-words font-medium text-gray-900"
                           x-text="selected.subject"></p>
                    </div>
                </div>

                <div>
                    <h3 class="mb-3 text-sm font-semibold text-gray-700">
                        Message
                    </h3>

                    <div class="rounded-xl border border-gray-200 bg-white p-5">
                        <p
                            class="whitespace-pre-wrap break-words text-sm leading-7 text-gray-700"
                            x-text="selected.message"
                        ></p>
                    </div>
                </div>

            </div>

            {{-- Modal footer --}}
            <div class="flex justify-end border-t border-gray-100 bg-gray-50 px-6 py-4">
                <button
                    type="button"
                    @click="modalOpen = false"
                    class="rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-700"
                >
                    Close
                </button>
            </div>
        </div>
    </div>

</div>

@endsection
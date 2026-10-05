@extends('layouts.app')
@section('adminContent')

<section>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Contact Submissions</h1>
        <p class="mb-6">View messages submitted via the contact form.</p>

        <div class="bg-white shadow-md rounded-lg overflow-x-auto mt-3">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Message
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($contacts as $contact)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">
                            {{ $contact->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-blue-500">
                            {{ $contact->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 max-w-md truncate">
                            {{ \Illuminate\Support\Str::limit($contact->message, 80) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500 flex items-center gap-4 space-x-2">
                            <a href=" "
                                class="text-blue-500 hover:text-blue-700 transition">View</a>

                            <form action=" " method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this contact message?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                    Delete
                                </button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            No contact messages found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $contacts->links() }}
        </div>
    </div>
</section>


@endsection
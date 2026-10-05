@extends('layouts.app')

@section('adminContent')

<section class="mx-auto max-w-7xl px-4 py-8">

    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Collections</h1>
            <p class="mt-1 text-sm text-gray-500">
                Manage your jewelry collections.
            </p>
        </div>

        <a
            href="{{ route('admin.collections.create') }}"
            class="rounded-xl bg-black px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-800"
        >
            + Create Collection
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">
            <table class="w-full min-w-[1100px] text-left text-sm">

                <thead class="border-b border-gray-200 bg-gray-50">
                    <tr>
                        <th class="px-5 py-4 font-semibold text-gray-700">Collection</th>
                        <th class="px-5 py-4 font-semibold text-gray-700">SKU</th>
                        <th class="px-5 py-4 font-semibold text-gray-700">Category</th>
                        <th class="px-5 py-4 font-semibold text-gray-700">Price</th>
                        <th class="px-5 py-4 font-semibold text-gray-700">Gold</th>
                        <th class="px-5 py-4 font-semibold text-gray-700">Stock</th>
                        <th class="px-5 py-4 font-semibold text-gray-700">Sale</th>
                        <th class="px-5 py-4 text-right font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse ($collections as $collection)

                        <tr class="transition hover:bg-gray-50">

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">

                                    @if ($collection->image)

                                        <button
                                            type="button"
                                            class="group relative h-12 w-12 shrink-0 overflow-hidden rounded-xl focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2"
                                            onclick="previewImage(
                                                '{{ asset('storage/' . $collection->image) }}',
                                                '{{ addslashes($collection->name) }}'
                                            )"
                                        >
                                            <img
                                                src="{{ asset('storage/' . $collection->image) }}"
                                                alt="{{ $collection->name }}"
                                                class="h-full w-full object-cover transition duration-300 group-hover:scale-110"
                                            >

                                            <span class="absolute inset-0 flex items-center justify-center bg-black/0 text-white opacity-0 transition group-hover:bg-black/40 group-hover:opacity-100">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                                                    />
                                                </svg>
                                            </span>
                                        </button>

                                    @else

                                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-xs text-gray-400">
                                            No Image
                                        </div>

                                    @endif

                                    <div>
                                        <p class="font-medium text-gray-900">
                                            {{ $collection->name }}
                                        </p>

                                        <p class="max-w-xs truncate text-xs text-gray-500">
                                            {{ $collection->description }}
                                        </p>
                                    </div>

                                </div>
                            </td>

                            <td class="px-5 py-4 text-gray-600">
                                {{ $collection->sku }}
                            </td>

                            <td class="px-5 py-4">
                                <span class="rounded-lg bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                                    {{ $collection->category ?: '—' }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <div>
                                    @if ($collection->fullprice)
                                        <span class="text-xs text-gray-400 line-through">
                                            ${{ number_format($collection->fullprice, 2) }}
                                        </span>
                                    @endif

                                    <p class="font-semibold text-gray-900">
                                        ${{ number_format($collection->price ?? 0, 2) }}
                                    </p>
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <p class="font-medium text-gray-800">
                                    {{ $collection->gold_karats ? $collection->gold_karats . 'K' : '—' }}
                                </p>

                                @if ($collection->gold_color)
                                    <p class="text-xs capitalize text-gray-500">
                                        {{ $collection->gold_color }}
                                    </p>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                @if ($collection->stock_status === 'in_stock')
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                                        In Stock
                                    </span>
                                @elseif ($collection->stock_status === 'pre_order')
                                    <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700">
                                        Pre Order
                                    </span>
                                @else
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                                        Out of Stock
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                @if ($collection->is_sale)
                                    <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-medium text-purple-700">
                                        Sale
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400">
                                        No
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('admin.collections.edit', $collection) }}"
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-medium text-gray-700 transition hover:bg-gray-100"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.collections.destroy', $collection) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this collection?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg border border-red-200 px-3 py-2 text-xs font-medium text-red-600 transition hover:bg-red-50"
                                        >
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="px-5 py-16 text-center">

                                <p class="font-medium text-gray-700">
                                    No collections found.
                                </p>

                                <p class="mt-1 text-sm text-gray-400">
                                    Create your first collection to get started.
                                </p>

                                <a
                                    href="{{ route('admin.collections.create') }}"
                                    class="mt-5 inline-block rounded-xl bg-black px-5 py-3 text-sm font-semibold text-white hover:bg-gray-800"
                                >
                                    Create Collection
                                </a>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

    @if ($collections->hasPages())
        <div class="mt-6">
            {{ $collections->links() }}
        </div>
    @endif

</section>


<div
    id="imagePreview"
    class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/80 p-4 backdrop-blur-sm"
    onclick="closeImagePreview(event)"
>

    <div class="relative max-h-[90vh] max-w-5xl">

        <button
            type="button"
            onclick="closeImagePreview()"
            class="absolute -right-3 -top-3 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-white text-gray-700 shadow-lg transition hover:bg-gray-100"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>

        <img
            id="previewImage"
            src=""
            alt=""
            class="max-h-[85vh] max-w-full rounded-2xl object-contain shadow-2xl"
            onclick="event.stopPropagation()"
        >

        <p
            id="previewTitle"
            class="mt-3 text-center text-sm font-medium text-white"
        ></p>

    </div>

</div>


<script>
    function previewImage(src, title = '') {
        const modal = document.getElementById('imagePreview');
        const image = document.getElementById('previewImage');
        const titleElement = document.getElementById('previewTitle');

        image.src = src;
        image.alt = title;
        titleElement.textContent = title;

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.body.classList.add('overflow-hidden');
    }

    function closeImagePreview(event = null) {
        if (event && event.target !== event.currentTarget) {
            return;
        }

        const modal = document.getElementById('imagePreview');
        const image = document.getElementById('previewImage');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        image.src = '';

        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeImagePreview();
        }
    });
</script>

@endsection
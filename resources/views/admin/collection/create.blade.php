@extends('layouts.app')

@section('adminContent')

<section class="mx-auto max-w-6xl px-4 py-8">

    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">Create Collection</h1>
        <p class="mt-1 text-sm text-gray-500">
            Add a new jewelry collection.
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.collections.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >
        @csrf

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-lg font-semibold text-gray-900">Basic Information</h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Name
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-gray-500 focus:ring-2 focus:ring-gray-100"
                        placeholder="e.g. Diamond Ring"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        SKU
                    </label>
                    <input
                        type="text"
                        name="sku"
                        value="{{ old('sku') }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-gray-500 focus:ring-2 focus:ring-gray-100"
                        placeholder="e.g. RING-001"
                    >
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Description
                    </label>
                    <textarea
                        name="description"
                        rows="5"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-gray-500 focus:ring-2 focus:ring-gray-100"
                        placeholder="Describe the collection..."
                    >{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Category
                    </label>
                    <input
                        type="text"
                        name="category"
                        value="{{ old('category') }}"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-gray-500 focus:ring-2 focus:ring-gray-100"
                        placeholder="e.g. Rings"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Image
                    </label>
                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm"
                    >
                </div>

            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-lg font-semibold text-gray-900">Pricing</h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Full Price
                    </label>
                    <input
                        type="number"
                        name="fullprice"
                        value="{{ old('fullprice') }}"
                        step="0.01"
                        min="0"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-gray-500 focus:ring-2 focus:ring-gray-100"
                        placeholder="0.00"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Discount
                    </label>
                    <input
                        type="number"
                        name="discount"
                        value="{{ old('discount') }}"
                        step="0.01"
                        min="0"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-gray-500 focus:ring-2 focus:ring-gray-100"
                        placeholder="0.00"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Sale Price
                    </label>
                    <input
                        type="number"
                        name="price"
                        value="{{ old('price') }}"
                        step="0.01"
                        min="0"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-gray-500 focus:ring-2 focus:ring-gray-100"
                        placeholder="0.00"
                    >
                </div>

            </div>

            <div class="mt-5 flex items-center gap-3">
                <input
                    type="checkbox"
                    name="is_sale"
                    value="1"
                    id="is_sale"
                    {{ old('is_sale') ? 'checked' : '' }}
                    class="h-5 w-5 rounded border-gray-300"
                >
                <label for="is_sale" class="text-sm font-medium text-gray-700">
                    Mark as on sale
                </label>
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-lg font-semibold text-gray-900">Jewelry Details</h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Gold Karats
                    </label>
                    <input
                        type="number"
                        name="gold_karats"
                        value="{{ old('gold_karats') }}"
                        step="0.01"
                        min="0"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-gray-500 focus:ring-2 focus:ring-gray-100"
                        placeholder="e.g. 18"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Diamond Weight
                    </label>
                    <input
                        type="number"
                        name="diamond_weight"
                        value="{{ old('diamond_weight') }}"
                        step="0.01"
                        min="0"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-gray-500 focus:ring-2 focus:ring-gray-100"
                        placeholder="e.g. 1.25"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Gold Color
                    </label>
                    <select
                        name="gold_color"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none focus:border-gray-500 focus:ring-2 focus:ring-gray-100"
                    >
                        <option value="">Select Color</option>
                        <option value="yellow" {{ old('gold_color') == 'yellow' ? 'selected' : '' }}>Yellow Gold</option>
                        <option value="white" {{ old('gold_color') == 'white' ? 'selected' : '' }}>White Gold</option>
                        <option value="rose" {{ old('gold_color') == 'rose' ? 'selected' : '' }}>Rose Gold</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-lg font-semibold text-gray-900">Inventory</h2>

            <div class="max-w-md">
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Stock Status
                </label>

                <select
                    name="stock_status"
                    class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none focus:border-gray-500 focus:ring-2 focus:ring-gray-100"
                >
                    <option value="in_stock" {{ old('stock_status', 'in_stock') == 'in_stock' ? 'selected' : '' }}>
                        In Stock
                    </option>
                    <option value="out_of_stock" {{ old('stock_status') == 'out_of_stock' ? 'selected' : '' }}>
                        Out of Stock
                    </option>
                    <option value="pre_order" {{ old('stock_status') == 'pre_order' ? 'selected' : '' }}>
                        Pre Order
                    </option>
                </select>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a
                href="{{ route('admin.collections.index') }}"
                class="rounded-xl border border-gray-300 px-5 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="rounded-xl bg-black px-6 py-3 text-sm font-semibold text-white transition hover:bg-gray-800"
            >
                Create Collection
            </button>
        </div>

    </form>

</section>

@endsection 
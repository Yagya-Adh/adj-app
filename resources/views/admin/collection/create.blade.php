```blade
@extends('layouts.app')

@section('adminContent')

<section class="mx-auto max-w-6xl px-4 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">
            Create Collection
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Add a new jewelry collection to your store.
        </p>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <p class="mb-2 font-semibold">Please correct the following errors:</p>
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

        {{-- Basic Information --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Basic Information
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                <div>
                    <label for="name" class="mb-2 block text-sm font-medium text-gray-700">
                        Collection Name *
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        required
                        maxlength="255"
                        class="form-input"
                        placeholder="e.g. Diamond Ring"
                    >
                </div>

                <div>
                    <label for="sku" class="mb-2 block text-sm font-medium text-gray-700">
                        SKU *
                    </label>
                    <input
                        type="text"
                        name="sku"
                        id="sku"
                        value="{{ old('sku') }}"
                        required
                        maxlength="255"
                        class="form-input"
                        placeholder="e.g. RING-001"
                    >
                </div>

                <div>
                    <label for="category" class="mb-2 block text-sm font-medium text-gray-700">
                        Category
                    </label>
                    <input
                        type="text"
                        name="category"
                        id="category"
                        value="{{ old('category') }}"
                        maxlength="255"
                        class="form-input"
                        placeholder="e.g. Rings"
                    >
                </div>

                <div>
                    <label for="image" class="mb-2 block text-sm font-medium text-gray-700">
                        Product Image
                    </label>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept=".jpg,.jpeg,.png,.gif,.webp,.avif"
                        class="form-input bg-white text-sm"
                    >
                    <p class="mt-1 text-xs text-gray-500">
                        Supported formats: JPG, PNG, GIF, WebP, AVIF. Maximum 2 MB.
                    </p>
                    <p id="image_error" class="mt-1 hidden text-xs text-red-600">
                        Please select a supported image under 2 MB.
                    </p>
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="mb-2 block text-sm font-medium text-gray-700">
                        Description
                    </label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="form-input"
                        placeholder="Describe the collection..."
                    >{{ old('description') }}</textarea>
                </div>

            </div>
        </div>

        {{-- Pricing --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Pricing
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                <div>
                    <label for="fullprice" class="mb-2 block text-sm font-medium text-gray-700">
                        Original Price (Rs.) *
                    </label>
                    <input
                        type="number"
                        name="fullprice"
                        id="fullprice"
                        value="{{ old('fullprice') }}"
                        step="0.01"
                        min="0"
                        required
                        class="form-input"
                        placeholder="10000.00"
                    >
                </div>

                <div>
                    <label for="discount" class="mb-2 block text-sm font-medium text-gray-700">
                        Discount (%)
                    </label>
                    <input
                        type="number"
                        name="discount"
                        id="discount"
                        value="{{ old('discount', 0) }}"
                        step="0.01"
                        min="0"
                        max="100"
                        required
                        class="form-input"
                    >
                </div>

                <div>
                    <label for="price" class="mb-2 block text-sm font-medium text-gray-700">
                        Final Price (Rs.)
                    </label>
                    <input
                        type="number"
                        id="price"
                        step="0.01"
                        readonly
                        class="form-input border-green-300 bg-green-50 font-semibold text-green-700"
                        placeholder="0.00"
                    >
                    <p class="mt-1 text-xs text-gray-500">
                        Calculated automatically.
                    </p>
                </div>

            </div>

            {{-- Sale Toggle --}}
            <label
                for="is_sale"
                class="mt-5 flex cursor-pointer items-start gap-3 rounded-xl border border-gray-200 p-4 transition hover:bg-gray-50"
            >
                <input
                    type="checkbox"
                    name="is_sale"
                    id="is_sale"
                    value="1"
                    {{ old('is_sale') ? 'checked' : '' }}
                    class="mt-1 h-5 w-5 rounded border-gray-300"
                >
                <span>
                    <span class="block text-sm font-semibold text-gray-900">
                        Enable Sale
                    </span>
                    <span class="mt-1 block text-xs text-gray-500">
                        The discount is applied only when this option is enabled.
                    </span>
                </span>
            </label>

            {{-- Price Summary --}}
            <div class="mt-5 space-y-3 rounded-xl bg-gray-50 p-4 text-sm">
                <div class="flex items-center justify-between gap-4">
                    <span class="text-gray-600">Original Price</span>
                    <span id="original_price_display" class="font-semibold text-gray-900">
                        Rs. 0.00
                    </span>
                </div>

                <div class="flex items-center justify-between gap-4">
                    <span class="text-gray-600">Discount Amount</span>
                    <span id="discount_amount" class="font-semibold text-red-600">
                        Rs. 0.00
                    </span>
                </div>

                <div class="flex items-center justify-between gap-4">
                    <span class="text-gray-600">Final Price</span>
                    <span id="sale_price_display" class="font-bold text-green-700">
                        Rs. 0.00
                    </span>
                </div>

                <div class="flex items-center justify-between gap-4">
                    <span class="text-gray-600">Customer Savings</span>
                    <span id="savings_percent" class="font-semibold text-green-600">
                        0%
                    </span>
                </div>
            </div>
        </div>

        {{-- Jewelry Details --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Jewelry Details
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                {{-- Jewelry Type --}}
                <div>
                    <label for="jewelry_type" class="mb-2 block text-sm font-medium text-gray-700">
                        Jewelry Type *
                    </label>
                    <select
                        name="jewelry_type"
                        id="jewelry_type"
                        required
                        class="form-input bg-white"
                    >
                        <option value="">Select Type</option>
                        <option value="gold" @selected(old('jewelry_type') === 'gold')>Gold</option>
                        <option value="silver" @selected(old('jewelry_type') === 'silver')>Silver</option>
                        <option value="diamond" @selected(old('jewelry_type') === 'diamond')>Diamond</option>
                        <option value="platinum" @selected(old('jewelry_type') === 'platinum')>Platinum</option>
                        <option value="other" @selected(old('jewelry_type') === 'other')>Other</option>
                    </select>
                </div>

                {{-- Purity --}}
                <div>
                    <label for="jewelry_purity" class="mb-2 block text-sm font-medium text-gray-700">
                        Purity / Grade
                    </label>
                    <input
                        type="number"
                        name="jewelry_purity"
                        id="jewelry_purity"
                        value="{{ old('jewelry_purity') }}"
                        step="0.01"
                        min="0"
                        class="form-input"
                        placeholder="e.g. 18, 925, 950"
                    >
                    <p id="purity_help" class="mt-1 text-xs text-gray-500">
                        Select a jewelry type for guidance.
                    </p>
                </div>

                {{-- Weight --}}
                <div>
                    <label for="jewelry_weight" class="mb-2 block text-sm font-medium text-gray-700">
                        Weight
                    </label>
                    <div class="flex">
                        <input
                            type="number"
                            name="jewelry_weight"
                            id="jewelry_weight"
                            value="{{ old('jewelry_weight') }}"
                            step="0.001"
                            min="0"
                            class="form-input min-w-0 flex-1 rounded-r-none"
                            placeholder="e.g. 5.250"
                        >
                        <select
                            name="weight_unit"
                            id="weight_unit"
                            required
                            class="w-28 rounded-r-xl border border-l-0 border-gray-300 bg-gray-50 px-2 py-3 text-sm outline-none focus:border-gray-500"
                        >
                            <option value="g" @selected(old('weight_unit', 'g') === 'g')>Grams (g)</option>
                            <option value="mg" @selected(old('weight_unit') === 'mg')>Milligrams</option>
                            <option value="ct" @selected(old('weight_unit') === 'ct')>Carats (ct)</option>
                        </select>
                    </div>
                </div>

                {{-- Gold Color --}}
                <div id="gold_color_group" class="hidden">
                    <label for="gold_color" class="mb-2 block text-sm font-medium text-gray-700">
                        Gold Color *
                    </label>
                    <select
                        name="gold_color"
                        id="gold_color"
                        class="form-input bg-white"
                    >
                        <option value="">Select Color</option>
                        <option value="yellow" @selected(old('gold_color') === 'yellow')>Yellow Gold</option>
                        <option value="white" @selected(old('gold_color') === 'white')>White Gold</option>
                        <option value="rose" @selected(old('gold_color') === 'rose')>Rose Gold</option>
                    </select>
                </div>

            </div>
        </div>

        {{-- Inventory --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Inventory
            </h2>

            <div class="max-w-md">
                <label for="stock_status" class="mb-2 block text-sm font-medium text-gray-700">
                    Stock Status *
                </label>
                <select
                    name="stock_status"
                    id="stock_status"
                    required
                    class="form-input bg-white"
                >
                    <option value="in_stock" @selected(old('stock_status', 'in_stock') === 'in_stock')>
                        In Stock
                    </option>
                    <option value="out_of_stock" @selected(old('stock_status') === 'out_of_stock')>
                        Out of Stock
                    </option>
                    <option value="pre_order" @selected(old('stock_status') === 'pre_order')>
                        Pre-Order
                    </option>
                </select>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <a
                href="{{ route('admin.collections.index') }}"
                class="rounded-xl border border-gray-300 px-5 py-3 text-center text-sm font-medium text-gray-700 transition hover:bg-gray-50"
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

{{-- Shared Input Styling and Form Logic --}}
<style>
    .form-input {
        display: block;
        width: 100%;
        border: 1px solid #d1d5db;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-input:focus {
        border-color: #6b7280;
        box-shadow: 0 0 0 2px #f3f4f6;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Pricing elements
    const fullPrice = document.getElementById('fullprice');
    const discount = document.getElementById('discount');
    const salePrice = document.getElementById('price');
    const isSale = document.getElementById('is_sale');

    const originalDisplay = document.getElementById('original_price_display');
    const discountDisplay = document.getElementById('discount_amount');
    const saleDisplay = document.getElementById('sale_price_display');
    const savingsDisplay = document.getElementById('savings_percent');

    const money = value => 'Rs. ' + value.toLocaleString('en-IN', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });

    function calculatePrice() {
        const original = Math.max(0, Number(fullPrice.value) || 0);
        const requestedDiscount = Math.min(
            100,
            Math.max(0, Number(discount.value) || 0)
        );

        // Apply a discount only when sale is explicitly enabled.
        const effectiveDiscount = isSale.checked ? requestedDiscount : 0;
        const discountAmount = original * effectiveDiscount / 100;
        const finalPrice = original - discountAmount;

        salePrice.value = fullPrice.value !== ''
            ? finalPrice.toFixed(2)
            : '';

        originalDisplay.textContent = money(original);
        discountDisplay.textContent = money(discountAmount);
        saleDisplay.textContent = money(finalPrice);
        savingsDisplay.textContent =
            effectiveDiscount.toFixed(2).replace(/\.?0+$/, '') + '%';
    }

    fullPrice.addEventListener('input', calculatePrice);
    discount.addEventListener('input', calculatePrice);
    isSale.addEventListener('change', calculatePrice);

    // Jewelry elements
    const jewelryType = document.getElementById('jewelry_type');
    const purity = document.getElementById('jewelry_purity');
    const purityHelp = document.getElementById('purity_help');
    const weightUnit = document.getElementById('weight_unit');
    const goldColorGroup = document.getElementById('gold_color_group');
    const goldColor = document.getElementById('gold_color');

    const jewelrySettings = {
        gold: {
            placeholder: 'e.g. 18 or 22',
            help: 'Enter gold purity in karats, such as 18 or 22.',
            unit: 'g'
        },
        silver: {
            placeholder: 'e.g. 925 or 999',
            help: 'Enter silver fineness, such as 925 or 999.',
            unit: 'g'
        },
        diamond: {
            placeholder: 'Optional grade',
            help: 'Enter a grade if applicable. Diamond weight is commonly measured in carats.',
            unit: 'ct'
        },
        platinum: {
            placeholder: 'e.g. 950 or 999',
            help: 'Enter platinum fineness, such as 950 or 999.',
            unit: 'g'
        },
        other: {
            placeholder: 'Enter purity or grade',
            help: 'Enter the applicable purity or grade, if known.',
            unit: 'g'
        }
    };

    function updateJewelryFields(changeType = false) {
        const selectedType = jewelryType.value;
        const settings = jewelrySettings[selectedType];

        purity.placeholder = settings
            ? settings.placeholder
            : 'Select jewelry type';

        purityHelp.textContent = settings
            ? settings.help
            : 'Select a jewelry type for guidance.';

        const isGold = selectedType === 'gold';

        goldColorGroup.classList.toggle('hidden', !isGold);
        goldColor.required = isGold;

        if (!isGold) {
            goldColor.value = '';
        }

        // Set a default unit when the user changes jewelry type.
        // Preserve the user's saved/old unit during initial page load.
        if (changeType && settings) {
            weightUnit.value = settings.unit;
        }
    }

    jewelryType.addEventListener('change', function () {
        updateJewelryFields(true);
    });

    updateJewelryFields();

    // Basic client-side image checks; server validation remains authoritative.
    const imageInput = document.getElementById('image');
    const imageError = document.getElementById('image_error');
    const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif'];

    imageInput.addEventListener('change', function () {
        const file = imageInput.files[0];
        imageError.classList.add('hidden');

        if (!file) {
            return;
        }

        const extension = file.name.split('.').pop().toLowerCase();
        const validType = allowedExtensions.includes(extension);
        const validSize = file.size <= 2 * 1024 * 1024;

        if (!validType || !validSize) {
            imageError.classList.remove('hidden');
            imageInput.value = '';
        }
    });

    // Initialize the price summary using old form values, if present.
    calculatePrice();
});
</script>

@endsection

@extends('layouts.app')

@section('adminContent')

<section class="mx-auto max-w-6xl px-4 py-8">

    {{-- Header --}}
    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Edit Collection</h1>
            <p class="mt-1 text-sm text-gray-500">
                Update jewelry collection details, pricing, and inventory.
            </p>
        </div>

        <a href="{{ route('admin.collections.index') }}" class="btn-secondary">
            Back to Collections
        </a>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

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
        action="{{ route('admin.collections.update', $collection->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >
        @csrf
        @method('PUT')

        {{-- Basic Information --}}
        <div class="form-card">
            <h2 class="section-title">Basic Information</h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="name" class="form-label">Collection Name *</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $collection->name) }}"
                        maxlength="255"
                        required
                        class="form-input"
                        placeholder="e.g. Diamond Ring"
                    >
                </div>

                <div>
                    <label for="sku" class="form-label">SKU *</label>
                    <input
                        type="text"
                        name="sku"
                        id="sku"
                        value="{{ old('sku', $collection->sku) }}"
                        maxlength="255"
                        required
                        class="form-input"
                        placeholder="e.g. RING-001"
                    >
                </div>

                <div>
                    <label for="category" class="form-label">Category</label>
                    <input
                        type="text"
                        name="category"
                        id="category"
                        value="{{ old('category', $collection->category) }}"
                        maxlength="255"
                        class="form-input"
                        placeholder="e.g. Rings"
                    >
                </div>

                {{-- Image Upload --}}
                <div>
                    <label for="image" class="form-label">Product Image</label>

                    @if ($collection->image)
                        <div id="current_image_wrapper" class="mb-3">
                            <img
                                src="{{ asset('storage/' . $collection->image) }}"
                                alt="{{ $collection->name }}"
                                class="h-36 w-36 rounded-xl border border-gray-200 bg-gray-50 object-cover"
                                onerror="this.style.display='none';"
                            >
                            <p class="mt-2 text-xs text-gray-500">
                                Current image. Upload a new image to replace it.
                            </p>
                        </div>
                    @endif

                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept=".jpg,.jpeg,.png,.gif,.webp,.avif,image/*"
                        class="form-input bg-white text-sm"
                    >

                    <p class="mt-1 text-xs text-gray-500">
                        JPG, PNG, GIF, WebP, or AVIF. Maximum 2 MB.
                    </p>

                    <p id="image_error" class="mt-1 hidden text-xs text-red-600"></p>

                    <div id="image_preview_wrapper" class="mt-3 hidden">
                        <p class="mb-2 text-xs font-medium text-gray-600">
                            New image preview
                        </p>
                        <img
                            id="image_preview"
                            src=""
                            alt="New image preview"
                            class="h-36 w-36 rounded-xl border border-gray-200 object-cover"
                        >
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="form-input"
                        placeholder="Describe the collection..."
                    >{{ old('description', $collection->description) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Pricing --}}
        <div class="form-card">
            <h2 class="section-title">Pricing</h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <div>
                    <label for="fullprice" class="form-label">Original Price (Rs.) *</label>
                    <input
                        type="number"
                        name="fullprice"
                        id="fullprice"
                        value="{{ old('fullprice', $collection->fullprice) }}"
                        step="0.01"
                        min="0"
                        required
                        class="form-input"
                        placeholder="10000.00"
                    >
                </div>

                <div>
                    <label for="discount" class="form-label">Discount (%)</label>
                    <input
                        type="number"
                        name="discount"
                        id="discount"
                        value="{{ old('discount', $collection->discount ?? 0) }}"
                        step="0.01"
                        min="0"
                        max="100"
                        required
                        class="form-input"
                    >
                </div>

                <div>
                    <label for="price" class="form-label">Final Price (Rs.)</label>
                    <input
                        type="number"
                        id="price"
                        value="{{ old('price', $collection->price) }}"
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

            <label for="is_sale" class="mt-5 flex cursor-pointer items-start gap-3 rounded-xl border border-gray-200 p-4 transition hover:bg-gray-50">
                <input
                    type="checkbox"
                    name="is_sale"
                    id="is_sale"
                    value="1"
                    @checked((string) old('is_sale', (int) $collection->is_sale) === '1')
                    class="mt-1 h-5 w-5 rounded border-gray-300"
                >
                <span>
                    <span class="block text-sm font-semibold text-gray-900">Enable Sale</span>
                    <span class="mt-1 block text-xs text-gray-500">
                        The discount applies only when this option is enabled.
                    </span>
                </span>
            </label>

            <div class="mt-5 space-y-3 rounded-xl bg-gray-50 p-4 text-sm">
                <div class="flex items-center justify-between gap-4">
                    <span class="text-gray-600">Original Price</span>
                    <span id="original_price_display" class="font-semibold text-gray-900">Rs. 0.00</span>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <span class="text-gray-600">Discount Amount</span>
                    <span id="discount_amount" class="font-semibold text-red-600">Rs. 0.00</span>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <span class="text-gray-600">Final Price</span>
                    <span id="sale_price_display" class="font-bold text-green-700">Rs. 0.00</span>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <span class="text-gray-600">Customer Savings</span>
                    <span id="savings_percent" class="font-semibold text-green-600">0%</span>
                </div>
            </div>
        </div>

        {{-- Jewelry Details --}}
        <div class="form-card">
            <h2 class="section-title">Jewelry Details</h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <div>
                    <label for="jewelry_type" class="form-label">Jewelry Type *</label>
                    <select name="jewelry_type" id="jewelry_type" required class="form-input bg-white">
                        <option value="">Select Type</option>
                        @foreach (['gold' => 'Gold', 'silver' => 'Silver', 'diamond' => 'Diamond', 'platinum' => 'Platinum', 'other' => 'Other'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('jewelry_type', $collection->jewelry_type) === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="jewelry_purity" class="form-label">Purity / Grade</label>
                    <input
                        type="number"
                        name="jewelry_purity"
                        id="jewelry_purity"
                        value="{{ old('jewelry_purity', $collection->jewelry_purity) }}"
                        step="0.01"
                        min="0"
                        class="form-input"
                        placeholder="e.g. 18, 925, 950"
                    >
                    <p id="purity_help" class="mt-1 text-xs text-gray-500">
                        Select a jewelry type for guidance.
                    </p>
                </div>

                <div>
                    <label for="jewelry_weight" class="form-label">Weight</label>
                    <div class="flex">
                        <input
                            type="number"
                            name="jewelry_weight"
                            id="jewelry_weight"
                            value="{{ old('jewelry_weight', $collection->jewelry_weight) }}"
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
                            @foreach (['g' => 'Grams (g)', 'mg' => 'Milligrams', 'ct' => 'Carats (ct)'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('weight_unit', $collection->weight_unit ?? 'g') === $value)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="gold_color_group" class="hidden">
                    <label for="gold_color" class="form-label">Gold Color *</label>
                    <select name="gold_color" id="gold_color" class="form-input bg-white">
                        <option value="">Select Color</option>
                        @foreach (['yellow' => 'Yellow Gold', 'white' => 'White Gold', 'rose' => 'Rose Gold'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('gold_color', $collection->gold_color) === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Inventory --}}
        <div class="form-card">
            <h2 class="section-title">Inventory</h2>

            <div class="max-w-md">
                <label for="stock_status" class="form-label">Stock Status *</label>
                <select name="stock_status" id="stock_status" required class="form-input bg-white">
                    @foreach (['in_stock' => 'In Stock', 'out_of_stock' => 'Out of Stock', 'pre_order' => 'Pre-Order'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('stock_status', $collection->stock_status) === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <a href="{{ route('admin.collections.index') }}" class="btn-secondary">
                Cancel
            </a>

            <button type="submit" class="rounded-xl bg-black px-6 py-3 text-sm font-semibold text-white transition hover:bg-gray-800">
                Save Changes
            </button>
        </div>
    </form>
</section>

<style>
    .form-card {
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        background: white;
        padding: 1.5rem;
        box-shadow: 0 1px 2px rgb(0 0 0 / 5%);
    }

    .section-title {
        margin-bottom: 1.25rem;
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
    }

    .form-label {
        display: block;
        margin-bottom: .5rem;
        font-size: .875rem;
        font-weight: 500;
        color: #374151;
    }

    .form-input {
        display: block;
        width: 100%;
        border: 1px solid #d1d5db;
        border-radius: .75rem;
        padding: .75rem 1rem;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .form-input:focus {
        border-color: #6b7280;
        box-shadow: 0 0 0 2px #f3f4f6;
    }

    .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #d1d5db;
        border-radius: .75rem;
        padding: .75rem 1.25rem;
        font-size: .875rem;
        font-weight: 500;
        color: #374151;
        text-decoration: none;
        transition: background-color .2s;
    }

    .btn-secondary:hover {
        background: #f9fafb;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const $ = id => document.getElementById(id);

    // Pricing
    const fullPrice = $('fullprice');
    const discount = $('discount');
    const salePrice = $('price');
    const isSale = $('is_sale');

    const money = value => 'Rs. ' + value.toLocaleString('en-IN', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });

    function calculatePrice() {
        const original = Math.max(0, Number(fullPrice.value) || 0);
        const percentage = Math.min(100, Math.max(0, Number(discount.value) || 0));
        const effectiveDiscount = isSale.checked ? percentage : 0;
        const amountSaved = original * effectiveDiscount / 100;
        const finalPrice = original - amountSaved;

        salePrice.value = fullPrice.value !== '' ? finalPrice.toFixed(2) : '';

        $('original_price_display').textContent = money(original);
        $('discount_amount').textContent = money(amountSaved);
        $('sale_price_display').textContent = money(finalPrice);
        $('savings_percent').textContent =
            effectiveDiscount.toFixed(2).replace(/\.?0+$/, '') + '%';
    }

    [fullPrice, discount].forEach(input =>
        input.addEventListener('input', calculatePrice)
    );
    isSale.addEventListener('change', calculatePrice);

    // Jewelry fields
    const jewelryType = $('jewelry_type');
    const purity = $('jewelry_purity');
    const weightUnit = $('weight_unit');
    const goldColor = $('gold_color');
    const goldColorGroup = $('gold_color_group');

    const settings = {
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
        const type = jewelryType.value;
        const config = settings[type];
        const isGold = type === 'gold';

        purity.placeholder = config ? config.placeholder : 'Select jewelry type';
        $('purity_help').textContent = config
            ? config.help
            : 'Select a jewelry type for guidance.';

        goldColorGroup.classList.toggle('hidden', !isGold);
        goldColor.required = isGold;

        if (!isGold) {
            goldColor.value = '';
        }

        if (changeType && config) {
            weightUnit.value = config.unit;
        }
    }

    jewelryType.addEventListener('change', () => updateJewelryFields(true));
    updateJewelryFields();

    // Image preview and validation
    const imageInput = $('image');
    const imageError = $('image_error');
    const previewWrapper = $('image_preview_wrapper');
    const preview = $('image_preview');

    const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif'];
    let previewUrl = null;

    imageInput.addEventListener('change', function () {
        const file = this.files[0];

        imageError.classList.add('hidden');
        imageError.textContent = '';
        previewWrapper.classList.add('hidden');

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

        if (!file) return;

        const extension = file.name.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(extension)) {
            imageError.textContent = 'Unsupported image format.';
        } else if (file.size > 2 * 1024 * 1024) {
            imageError.textContent = 'Image size must not exceed 2 MB.';
        } else if (!file.type.startsWith('image/')) {
            imageError.textContent = 'Please select a valid image file.';
        } else {
            previewUrl = URL.createObjectURL(file);
            preview.src = previewUrl;
            previewWrapper.classList.remove('hidden');
            return;
        }

        imageError.classList.remove('hidden');
        this.value = '';
    });

    calculatePrice();
});
</script>

@endsection
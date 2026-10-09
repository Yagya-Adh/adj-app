<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();

            // Basic information
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->string('image')->nullable();

            // Pricing
            $table->decimal('fullprice', 12, 2)->default(0);
            $table->decimal('discount', 5, 2)->default(0);
            $table->decimal('price', 12, 2)->default(0);
            $table->boolean('is_sale')->default(false);

            // Jewelry details
            $table->string('jewelry_type');
            $table->decimal('jewelry_purity', 8, 2)->nullable();
            $table->decimal('jewelry_weight', 10, 3)->nullable();
            $table->string('weight_unit', 5)->default('g');
            $table->string('gold_color')->nullable();

            // Inventory
            $table->string('stock_status')->default('in_stock');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
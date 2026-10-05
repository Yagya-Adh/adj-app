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

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->decimal('fullprice', 12, 2)->nullable();
            $table->decimal('discount', 12, 2)->nullable();
            $table->decimal('price', 12, 2)->nullable();

            $table->boolean('is_sale')->default(false);

            $table->string('category')->nullable();
            $table->string('sku')->unique();

            $table->decimal('gold_karats', 5, 2)->nullable();
            $table->decimal('diamond_weight', 8, 2)->nullable();

            $table->string('gold_color')->nullable();
            $table->string('stock_status')->default('in_stock');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
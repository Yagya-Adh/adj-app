<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Collection extends Model
{
    protected $fillable = [
        // Basic information
        'name',
        'slug',
        'sku',
        'description',
        'category',
        'image',

        // Pricing
        'fullprice',
        'discount',
        'price',
        'is_sale',

        // Jewelry details
        'jewelry_type',
        'jewelry_purity',
        'jewelry_weight',
        'weight_unit',
        'gold_color',

        // Inventory
        'stock_status',
    ];

    protected $casts = [
        'fullprice' => 'decimal:2',
        'discount' => 'decimal:2',
        'price' => 'decimal:2',
        'jewelry_purity' => 'decimal:2',
        'jewelry_weight' => 'decimal:3',
        'is_sale' => 'boolean',
    ];

    /**
     * Generate a slug when creating a collection
     * if one has not already been provided.
     */
    protected static function booted(): void
    {
        static::creating(function (Collection $collection): void {
            if (blank($collection->slug)) {
                $collection->slug = Str::slug($collection->name);
            }
        });
    }
}
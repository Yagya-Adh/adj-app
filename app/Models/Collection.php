<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Collection extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'fullprice',
        'discount',
        'price',
        'is_sale',
        'category',
        'sku',
        'gold_karats',
        'diamond_weight',
        'gold_color',
        'stock_status',
    ];

    protected $casts = [
        'fullprice' => 'decimal:2',
        'discount' => 'decimal:2',
        'price' => 'decimal:2',
        'diamond_weight' => 'decimal:2',
        'is_sale' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($collection) {
            if (!$collection->slug) {
                $collection->slug = Str::slug($collection->name);
            }
        });
    }
}
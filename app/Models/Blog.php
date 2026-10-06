<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'image',
        'slug',
        'description',
        'customer',
        'customer_image',
        'media',
    ];

    protected $casts = [
        'media' => 'array',
    ];
}
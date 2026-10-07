<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'image',
        'video',
        'slug',
        'description',
        'author',
        'author_image',
        'media',
    ];
}
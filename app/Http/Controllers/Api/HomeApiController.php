<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Collection;
use Illuminate\Http\JsonResponse;

class HomeApiController extends Controller
{
    public function index(): JsonResponse
    {
        $collections = Collection::latest()->paginate(4);
        $blogs = Blog::latest()->paginate(4);

        return response()->json([
            'success' => true,
            'message' => 'Home page data retrieved successfully.',
            'data' => [
                'collections' => $collections,
                'blogs' => $blogs,
            ],
        ]);
    }
}
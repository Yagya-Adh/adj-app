<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $collections = Collection::query()
            ->latest()
            ->paginate(10);

        $analytics = [
            'total' => Collection::count(),
            'today' => Collection::whereDate('created_at', today())->count(),
            'this_month' => Collection::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'latest' => Collection::latest()->first(),
        ];

        return view('dashboard', compact('collections', 'analytics'));
    }
}
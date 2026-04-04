<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\PortfolioItem;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get up to 4 active services ordered by sort_order
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        // Get up to 3 featured or latest active portfolio items
        $portfolioItems = PortfolioItem::with('category')
            ->where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        // Optional: Get 3 latest blog posts for a more dynamic home page
        $latestBlogPosts = BlogPost::where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('home', compact('services', 'portfolioItems', 'latestBlogPosts'));
    }
}

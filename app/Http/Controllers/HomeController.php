<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\PortfolioItem;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class HomeController extends Controller
{
    public function index()
    {
        $services = Cache::remember('home_services', now()->addHour(), function () {
            return Service::where('is_active', true)
                ->orderBy('sort_order')
                ->take(4)
                ->get();
        });

        $portfolioItems = Cache::remember('home_portfolio', now()->addHour(), function () {
            return PortfolioItem::with('category')
                ->where('is_active', true)
                ->latest()
                ->take(3)
                ->get();
        });

        $latestBlogPosts = Cache::remember('home_blog_posts', now()->addHour(), function () {
            return BlogPost::where('is_published', true)
                ->latest('published_at')
                ->take(3)
                ->get();
        });

        return view('home', compact('services', 'portfolioItems', 'latestBlogPosts'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PortfolioItem;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;


class PortfolioController extends Controller
{
    public function index()
    {
        $page = Request::get('page', 1);

        $categories = Cache::remember('portfolio_categories', now()->addHour(), function () {
            return Category::active()->ordered()->get();
        });

        $portfolioItems = Cache::remember("portfolio_items_page_{$page}", now()->addHour(), function () {
            return PortfolioItem::with('category')
                ->active()
                ->orderBy('shoot_date', 'desc')
                ->paginate(12);
        });

        $heroSettings = [
            'image' => SiteSetting::getValue('portfolio_hero_image'),
            'eyebrow' => SiteSetting::getValue('portfolio_hero_eyebrow', 'Our Work'),
            'title' => SiteSetting::getValue('portfolio_hero_title', 'Portfolio'),
            'subtitle' => SiteSetting::getValue('portfolio_hero_subtitle', 'Setiap karya adalah cerita — disimpan dalam satu bingkai.'),
        ];

        return view('portfolio.index', compact('categories', 'portfolioItems', 'heroSettings'));
    }


    public function show($slug)
    {
        $portfolioItem = Cache::remember("portfolio_item_{$slug}", now()->addHour(), function () use ($slug) {
            return PortfolioItem::with('category')
                ->where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        });

        $relatedItems = Cache::remember("related_portfolio_items_{$portfolioItem->id}", now()->addHour(), function () use ($portfolioItem) {
            return PortfolioItem::with('category')
                ->where('category_id', $portfolioItem->category_id)
                ->where('id', '!=', $portfolioItem->id)
                ->where('is_active', true)
                ->take(6)
                ->get();
        });

        return view('portfolio.show', compact('portfolioItem', 'relatedItems'));
    }

}

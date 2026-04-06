<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\ServicePackage;
use App\Models\TeamMember;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;


class ServiceController extends Controller
{
    public function index()
    {
        $categories = Cache::remember('service_categories', now()->addHour(), function () {
            return Category::active()->ordered()->get();
        });

        $services = Cache::remember('service_list', now()->addHour(), function () {
            return Service::with(['category', 'packages'])
                ->active()
                ->ordered()
                ->get();
        });

        $teamMembers = Cache::remember('team_members', now()->addHour(), function () {
            return TeamMember::active()->ordered()->get();
        });

        $hero = [
            'image' => SiteSetting::getValue('service_hero_image'),
            'title' => SiteSetting::getValue('service_hero_title', 'Layanan Kami'),
            'subtitle' => SiteSetting::getValue('service_hero_subtitle', 'Pilih paket dan layanan terbaik yang kami miliki untuk menyempurnakan hari istimewa Anda.'),
        ];

        return view('services.index', compact('categories', 'services', 'teamMembers', 'hero'));
    }

}

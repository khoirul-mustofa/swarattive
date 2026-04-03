<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\ServicePackage;
use App\Models\TeamMember;
use App\Models\SiteSetting;

class ServiceController extends Controller
{
    public function index()
    {
        $categories = Category::active()->ordered()->get();
        $services = Service::with(['category', 'packages'])
            ->active()
            ->ordered()
            ->get();
        $teamMembers = TeamMember::active()->ordered()->get();

        $hero = [
            'image' => SiteSetting::getValue('service_hero_image'),
            'title' => SiteSetting::getValue('service_hero_title', 'Layanan Kami'),
            'subtitle' => SiteSetting::getValue('service_hero_subtitle', 'Pilih paket dan layanan terbaik yang kami miliki untuk menyempurnakan hari istimewa Anda.'),
        ];

        return view('services.index', compact('categories', 'services', 'teamMembers', 'hero'));
    }
}

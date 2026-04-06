<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\SiteSetting;
use App\Models\Category;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $footerSettings = Cache::remember('footer_settings', now()->addHours(24), function () {
                return [
                    'description' => SiteSetting::getValue('site_description', 'Layanan fotografi profesional untuk setiap momen berharga Anda.'),
                    'phone' => SiteSetting::getValue('contact_phone', '+62 812 3456 7890'),
                    'email' => SiteSetting::getValue('contact_email', 'hello@swarattive.com'),
                    'address' => SiteSetting::getValue('contact_address', 'Jakarta, Indonesia'),
                    'categories' => Category::active()->ordered()->take(4)->get(),
                ];
            });

            $view->with('footerSettings', $footerSettings);
        });
    }

}

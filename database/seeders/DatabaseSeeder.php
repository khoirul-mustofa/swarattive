<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin Swarattive',
            'email' => 'admin@swarattive.com',
            'password' => Hash::make('password'),
        ]);

        // Seed categories
        $categories = [
            ['name' => 'Wedding Photography', 'slug' => 'wedding-photography', 'description' => 'Professional wedding photography services', 'sort_order' => 1],
            ['name' => 'Pre-Wedding', 'slug' => 'pre-wedding', 'description' => 'Pre-wedding photo sessions', 'sort_order' => 2],
            ['name' => 'Portrait', 'slug' => 'portrait', 'description' => 'Professional portrait photography', 'sort_order' => 3],
            ['name' => 'Commercial', 'slug' => 'commercial', 'description' => 'Commercial and product photography', 'sort_order' => 4],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                ...$category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed services
        $services = [
            [
                'category_id' => 1,
                'name' => 'Wedding Package Premium',
                'slug' => 'wedding-package-premium',
                'description' => 'Complete wedding photography package with premium features',
                'base_price' => 15000000,
                'duration_minutes' => 480,
                'sort_order' => 1,
            ],
            [
                'category_id' => 2,
                'name' => 'Pre-Wedding Studio',
                'slug' => 'pre-wedding-studio',
                'description' => 'Studio pre-wedding photography session',
                'base_price' => 3500000,
                'duration_minutes' => 180,
                'sort_order' => 1,
            ],
            [
                'category_id' => 3,
                'name' => 'Portrait Session',
                'slug' => 'portrait-session',
                'description' => 'Professional portrait photography session',
                'base_price' => 2000000,
                'duration_minutes' => 120,
                'sort_order' => 1,
            ],
        ];

        foreach ($services as $service) {
            DB::table('services')->insert([
                ...$service,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed service packages
        $packages = [
            [
                'service_id' => 1,
                'name' => 'Basic Package',
                'description' => '8 hours coverage, 200 edited photos',
                'price' => 15000000,
                'features' => json_encode(['8 hours coverage', '200 edited photos', 'Online gallery', 'All raw files']),
                'is_featured' => true,
            ],
            [
                'service_id' => 1,
                'name' => 'Premium Package',
                'description' => '12 hours coverage, 400 edited photos, video',
                'price' => 25000000,
                'features' => json_encode(['12 hours coverage', '400 edited photos', 'Video highlight', 'Album', 'Online gallery']),
                'is_featured' => false,
            ],
        ];

        foreach ($packages as $package) {
            DB::table('service_packages')->insert([
                ...$package,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed team members
        $teamMembers = [
            [
                'name' => 'Andi Prasetyo',
                'role' => 'Lead Photographer',
                'bio' => 'Professional photographer with 10+ years of experience',
                'image_url' => 'images/team/andi.jpg',
                'social_links' => json_encode(['instagram' => '@andiprasetyo', 'facebook' => 'andi.prasetyo']),
                'sort_order' => 1,
            ],
            [
                'name' => 'Dewi Kusuma',
                'role' => 'Creative Director',
                'bio' => 'Creative director specializing in wedding photography',
                'image_url' => 'images/team/dewi.jpg',
                'social_links' => json_encode(['instagram' => '@dewikusuma']),
                'sort_order' => 2,
            ],
            [
                'name' => 'Rina Wulandari',
                'role' => 'Photo Editor',
                'bio' => 'Expert photo editor with attention to detail',
                'image_url' => 'images/team/rina.jpg',
                'social_links' => json_encode(['instagram' => '@rinawulandari']),
                'sort_order' => 3,
            ],
        ];

        foreach ($teamMembers as $member) {
            DB::table('team_members')->insert([
                ...$member,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed payment methods
        $paymentMethods = [
            [
                'name' => 'Bank Mandiri',
                'type' => 'bank',
                'details' => json_encode(['account_number' => '123-456-789-0', 'account_name' => 'PT Swarattive Photography']),
            ],
            [
                'name' => 'BCA',
                'type' => 'bank',
                'details' => json_encode(['account_number' => '098-765-432-1', 'account_name' => 'PT Swarattive Photography']),
            ],
            [
                'name' => 'OVO / DANA',
                'type' => 'ewallet',
                'details' => json_encode(['phone_number' => '0812-3456-7890', 'account_name' => 'Swarattive Photography']),
            ],
        ];

        foreach ($paymentMethods as $method) {
            DB::table('payment_methods')->insert([
                ...$method,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed site settings
        $siteSettings = [
            ['key' => 'site_name', 'value' => json_encode('Swarattive Photography'), 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => json_encode('Professional photography services for your special moments'), 'type' => 'text', 'group' => 'general'],
            ['key' => 'contact_phone', 'value' => json_encode('+62 812 3456 7890'), 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_email', 'value' => json_encode('hello@swarattive.com'), 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => json_encode('Jakarta, Indonesia'), 'type' => 'text', 'group' => 'contact'],
            ['key' => 'social_links', 'value' => json_encode(['instagram' => '@swarattive', 'facebook' => 'swarattive.official']), 'type' => 'json', 'group' => 'social'],
        ];

        foreach ($siteSettings as $setting) {
            DB::table('site_settings')->insert([
                ...$setting,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->call([
            AboutSeeder::class,
            ContactSettingSeeder::class,
            BlogPostSeeder::class,
        ]);

        $this->command->info('Database seeded successfully!');
    }
}

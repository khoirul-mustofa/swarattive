<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::factory()->create([
            'name' => 'Swarattive Admin',
            'email' => 'admin@swarattive.com',
            'password' => Hash::make('password'),
        ]);

        // Kategori
        $categories = [
            ['name' => 'Pernikahan', 'slug' => 'pernikahan', 'description' => 'Abadikan hari sakral Anda dengan keindahan yang abadi dan penuh emosi.', 'sort_order' => 1],
            ['name' => 'Pre-Wedding', 'slug' => 'pre-wedding', 'description' => 'Ceritakan kisah cinta Anda melalui sesi foto artistik yang eksklusif.', 'sort_order' => 2],
            ['name' => 'Potret', 'slug' => 'potret', 'description' => 'Fotografi potret profesional untuk identitas diri dan keluarga.', 'sort_order' => 3],
            ['name' => 'Komersial', 'slug' => 'komersial', 'description' => 'Layanan fotografi profesional untuk produk, korporat, dan kebutuhan industri.', 'sort_order' => 4],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                ...$category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Layanan
        $services = [
            [
                'category_id' => 1,
                'name' => 'Paket Pernikahan Eksklusif',
                'slug' => 'pernikahan-eksklusif',
                'description' => 'Dokumentasi pernikahan menyeluruh dengan teknik sinematik dan artistik terbaik di kelasnya.',
                'base_price' => 18500000,
                'duration_minutes' => 600,
                'sort_order' => 1,
            ],
            [
                'category_id' => 2,
                'name' => 'Sesi Pre-Wedding Studio',
                'slug' => 'pre-wedding-studio',
                'description' => 'Sesi foto intim di studio dengan berbagai konsep kreatif yang dirancang khusus untuk Anda.',
                'base_price' => 5500000,
                'duration_minutes' => 180,
                'sort_order' => 1,
            ],
            [
                'category_id' => 3,
                'name' => 'Potret Personal & Keluarga',
                'slug' => 'potret-personal-keluarga',
                'description' => 'Abadikan karakter dan kehangatan keluarga dalam sesi foto berkualitas tinggi.',
                'base_price' => 2500000,
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

        // Paket Layanan
        $packages = [
            [
                'service_id' => 1,
                'name' => 'Magnolia Package',
                'description' => 'Ideal untuk acara intim. Dokumentasi berkualitas tinggi dengan sentuhan personal.',
                'price' => 18500000,
                'features' => json_encode([
                    '8 Jam Dokumentasi Hari-H',
                    '2 Fotografer Profesional',
                    '250++ Foto Hasil Kurasi & Edit',
                    '1 Album Kolase Eksklusif (20x30 cm)',
                    'Semua File Digital via Cloud Storage',
                    'Kotak USB Berbahan Kayu Mewah'
                ]),
                'is_featured' => true,
            ],
            [
                'service_id' => 1,
                'name' => 'Royal Orchid Package',
                'description' => 'Paket terlengkap untuk momen sekali seumur hidup yang tak terlupakan.',
                'price' => 35000000,
                'features' => json_encode([
                    'Dokumentasi Seharian Penuh',
                    '3 Fotografer & 1 Videografer',
                    'Video Cinematic Highlight (3-5 Menit)',
                    '500++ Foto Hasil Kurasi & Edit',
                    '2 Album Kolase Premium (30x40 cm)',
                    '2 Cetak Kanvas Besar dengan Bingkai Mewah',
                    'Kotak Presentasi Khusus & USB Flashdisk'
                ]),
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

        // Tim
        $teamMembers = [
            [
                'name' => 'Adi Santoso',
                'role' => 'Lead Photographer / Founder',
                'bio' => 'Berpengalaman lebih dari 12 tahun di dunia fotografi pernikahan dan komersial dengan penghargaan internasional.',
                'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=400',
                'social_links' => json_encode(['instagram' => '@adi_swarattive', 'facebook' => 'adi.santoso.photo']),
                'sort_order' => 1,
            ],
            [
                'name' => 'Maya Indrawati',
                'role' => 'Creative & Digital Editor',
                'bio' => 'Seniman digital dengan mata tajam untuk pewarnaan dan komposisi, memastikan setiap foto memiliki jiwa dan estetika yang konsisten.',
                'image_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=400',
                'social_links' => json_encode(['instagram' => '@maya_editor']),
                'sort_order' => 2,
            ],
            [
                'name' => 'Dimas Prayoga',
                'role' => 'Senior Portrait Photographer',
                'bio' => 'Spesialis fotografi potret dan kecantikan yang mampu menangkap sisi terbaik dan emosi paling jujur dari setiap subjek.',
                'image_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=400',
                'social_links' => json_encode(['instagram' => '@dimas_portraits']),
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

        // Pembayaran
        $paymentMethods = [
            [
                'name' => 'Bank Central Asia (BCA)',
                'type' => 'bank',
                'details' => json_encode(['account_number' => '8720-xxxx-xxxx', 'account_name' => 'Adi Santoso (SWARATTIVE)']),
            ],
            [
                'name' => 'Bank Mandiri',
                'type' => 'bank',
                'details' => json_encode(['account_number' => '123-00-xxxx-xxxx', 'account_name' => 'Adi Santoso (SWARATTIVE)']),
            ],
        ];

        foreach ($paymentMethods as $method) {
            DB::table('payment_methods')->insert([
                ...$method,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Pengaturan Situs
        $siteSettings = [
            ['key' => 'site_name', 'value' => json_encode('Swarattive Photography'), 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => json_encode('Setiap Detik Memiliki Kisah Sendiri'), 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => json_encode('Studio fotografi eksklusif di Jakarta yang berfokus pada dokumentasi pernikahan, pre-wedding, dan potret dengan pendekatan artistik dan sinematik.'), 'type' => 'text', 'group' => 'general'],
            ['key' => 'contact_phone', 'value' => json_encode('+62 812-9900-xxxx'), 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_email', 'value' => json_encode('info@swarattive.com'), 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => json_encode('Kemang Raya No. 45, Jakarta Selatan, 12730'), 'type' => 'text', 'group' => 'contact'],
            ['key' => 'social_links', 'value' => json_encode(['instagram' => '@swarattive', 'facebook' => 'swarattive.photography']), 'type' => 'json', 'group' => 'social'],
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
            PortfolioItemSeeder::class,
            HeroSlideSeeder::class,
        ]);

        $this->command->info('Database telah diisi dengan data standar produksi!');
    }
}

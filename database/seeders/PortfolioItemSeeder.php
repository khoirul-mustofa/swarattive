<?php

namespace Database\Seeders;

use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // PERNIKAHAN (ID 1)
            [
                'category_id' => 1,
                'title' => 'The Kemang Connection: Ardi & Sari',
                'description' => 'Dokumentasi pernikahan intim di area Kemang yang menggabungkan nuansa modern dan sentuhan tradisional.',
                'image_url' => 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80&w=1200',
                'tags' => ['Intimate', 'Modern', 'Garden'],
                'is_featured' => true,
                'client_name' => 'Ardi & Sari',
                'shoot_date' => '2025-10-12',
            ],
            [
                'category_id' => 1,
                'title' => 'Royal Heritage Wedding: Putri & Bayu',
                'description' => 'Kemegahan adat keraton yang dikemas dengan sinematografi kelas dunia.',
                'image_url' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&q=80&w=1200',
                'tags' => ['Traditional', 'Royal', 'Ballroom'],
                'is_featured' => false,
                'client_name' => 'Putri & Bayu',
                'shoot_date' => '2025-08-20',
            ],
            [
                'category_id' => 1,
                'title' => 'Minimalist Vows: Linda & Kevin',
                'description' => 'Keindahan dalam kesederhanaan. Sesi dokumentasi yang fokus pada detail dan emosi murni.',
                'image_url' => 'https://images.unsplash.com/photo-1519221609281-713fe5d5e853?auto=format&fit=crop&q=80&w=1200',
                'tags' => ['Minimalist', 'Black & White', 'Emotion'],
                'is_featured' => false,
                'client_name' => 'Linda & Kevin',
                'shoot_date' => '2025-12-05',
            ],

            // PRE-WEDDING (ID 2)
            [
                'category_id' => 2,
                'title' => 'Urban Love Story: Budi & Nia',
                'description' => 'Sesi pre-wedding bertema urban di jantung ibu kota Jakarta.',
                'image_url' => 'https://images.unsplash.com/photo-1449130017114-1d980ed548f0?auto=format&fit=crop&q=80&w=1200',
                'tags' => ['Urban', 'Cityscape', 'Casual'],
                'is_featured' => true,
                'client_name' => 'Budi & Nia',
                'shoot_date' => '2025-11-15',
            ],
            [
                'category_id' => 2,
                'title' => 'Golden Sunset at Uluwatu: Rian & Siska',
                'description' => 'Momen keemasan di atas tebing Bali yang memanjakan mata.',
                'image_url' => 'https://images.unsplash.com/photo-1549416809-5696d5e08920?auto=format&fit=crop&q=80&w=1200',
                'tags' => ['Bali', 'Cliffside', 'Sunset'],
                'is_featured' => false,
                'client_name' => 'Rian & Siska',
                'shoot_date' => '2026-01-10',
            ],
            [
                'category_id' => 2,
                'title' => 'Serenity in the Woods: Maya & Adi',
                'description' => 'Keheningan hutan yang memberikan nuansa mistis namun romantis.',
                'image_url' => 'https://images.unsplash.com/photo-1532712938310-34cb3982ef74?auto=format&fit=crop&q=80&w=1200',
                'tags' => ['Nature', 'Whimsical', 'Rustic'],
                'is_featured' => false,
                'client_name' => 'Maya & Adi',
                'shoot_date' => '2025-09-30',
            ],

            // POTRET / KOMERSIAL (ID 3 / 4)
            [
                'category_id' => 3,
                'title' => 'Professional Branding: Dr. Sarah',
                'description' => 'Sesi potret personal untuk meningkatkan citra profesional di bidang medis.',
                'image_url' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=1200',
                'tags' => ['Headshot', 'Professional', 'Branding'],
                'is_featured' => true,
                'client_name' => 'Dr. Sarah',
                'shoot_date' => '2026-02-14',
            ],
            [
                'category_id' => 3,
                'title' => 'Family Legacy: The Santosos',
                'description' => 'Setiap keluarga memiliki cerita, dan kami mengabadikannya dalam satu potret abadi.',
                'image_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=1200',
                'tags' => ['Family', 'Studio', 'Warm'],
                'is_featured' => false,
                'client_name' => 'Keluarga Santoso',
                'shoot_date' => '2025-12-25',
            ],
            [
                'category_id' => 4,
                'title' => 'Luxe Watch Campaign',
                'description' => 'Fotografi produk untuk kampanye merk jam tangan mewah lokal.',
                'image_url' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&q=80&w=1200',
                'tags' => ['Product', 'Luxury', 'Commercial'],
                'is_featured' => false,
                'client_name' => 'Local Watch Brand',
                'shoot_date' => '2026-03-01',
            ],
        ];

        foreach ($items as $item) {
            PortfolioItem::create([
                'category_id' => $item['category_id'],
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'description' => $item['description'],
                'image_url' => $item['image_url'],
                'gallery_images' => [
                    $item['image_url'],
                    'https://images.unsplash.com/photo-1537633552985-df8429e8048b?auto=format&fit=crop&q=80&w=800',
                    'https://images.unsplash.com/photo-1510076857177-74700760be49?auto=format&fit=crop&q=80&w=800'
                ],
                'tags' => $item['tags'],
                'is_featured' => $item['is_featured'],
                'is_active' => true,
                'shoot_date' => $item['shoot_date'],
                'client_name' => $item['client_name'],
            ]);
        }
    }
}

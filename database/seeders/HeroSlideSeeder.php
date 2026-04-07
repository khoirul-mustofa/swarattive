<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\HeroSlide::insert([
            [
                'image' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80',
                'title' => 'Abadikan Momen Berharga Anda',
                'description' => 'Kami percaya setiap momen memiliki cerita. Biarkan kami mengabadikan cerita Anda dalam karya seni natural dan elegan.',
                'button_text' => 'Pesan Sekarang',
                'button_url' => '/booking',
                'order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80',
                'title' => 'The Art of Wedding',
                'description' => 'Pernikahan adalah sekali seumur hidup. Kami memberikan detail terbaik pada hari spesial Anda.',
                'button_text' => 'Lihat Portfolio',
                'button_url' => '/portfolio',
                'order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&q=80',
                'title' => 'Event & Corporate',
                'description' => 'Dokumentasi profesional untuk setiap acara penting perusahaan dan perayaan Anda.',
                'button_text' => 'Hubungi Kami',
                'button_url' => '/contact',
                'order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

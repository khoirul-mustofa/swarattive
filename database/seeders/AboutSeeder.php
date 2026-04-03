<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\About;
use App\Enums\PageStatusEnum;
use App\Enums\BtsStageEnum;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::updateOrCreate(
            ['id' => 1],
            [
                'status' => PageStatusEnum::PUBLISHED,
                'page_banner_image_url' => null, // Provide default or leave null, user will upload
                'story_title' => 'Our Story',
                'story_content' => '<p>SWARATTIVE Photography lahir dari hasrat mendalam untuk mengabadikan keindahan dalam setiap momen kehidupan. Dimulai dari sebuah kamera sederhana dan mimpi besar, kami tumbuh menjadi studio fotografi yang dipercaya oleh ratusan pasangan dan brand.</p><p>Dengan pengalaman lebih dari 8 tahun di industri fotografi, kami memahami bahwa setiap klien memiliki cerita unik yang layak diabadikan dengan cara yang istimewa. Kami menggabungkan seni visual dengan teknologi terkini untuk menciptakan karya yang timeless.</p><p>Filosofi kami sederhana: setiap foto harus mampu membangkitkan emosi dan menceritakan kisah yang tak terlupakan.</p>',
                'story_image_url' => null,
                'bts_title' => 'Behind The Scenes',
                'bts_subtitle' => 'Proses kreatif di balik setiap sesi foto kami.',
                'bts_items' => [
                    [
                        'stage' => BtsStageEnum::PRE_PRODUCTION->value,
                        'image_url' => null,
                        'description' => 'Concept & Planning',
                    ],
                    [
                        'stage' => BtsStageEnum::ON_LOCATION->value,
                        'image_url' => null,
                        'description' => 'Shooting Day',
                    ],
                    [
                        'stage' => BtsStageEnum::POST_PRODUCTION->value,
                        'image_url' => null,
                        'description' => 'Editing & Delivery',
                    ],
                ]
            ]
        );
    }
}

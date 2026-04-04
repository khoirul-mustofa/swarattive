<?php

namespace Database\Seeders;

use App\Enums\PageStatusEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('abouts')->truncate();

        DB::table('abouts')->insert([
            'status' => PageStatusEnum::PUBLISHED->value,
            'page_banner_image_url' => 'https://images.unsplash.com/photo-1492691523567-6170c2465fb7?auto=format&fit=crop&q=80&w=1920',
            'story_title' => 'Keaslian di Balik Lensa',
            'story_content' => '
                <p>Di Swarattive, kami percaya bahwa setiap detik memiliki frekuensi dan narasinya sendiri. Nama "Swarattive" berasal dari gabungan "Swara" (suara/jiwa) dan "Narrative" (cerita). Kami tidak hanya mengambil gambar; kami menangkap getaran emosi, kerling mata yang jujur, dan gelak tawa yang tak tertahankan.</p>
                <p>Berawal dari obsesi untuk membekukan keindahan yang fana, kami kini berkembang menjadi kolektif kreatif yang mendedikasikan diri untuk merayakan perjalanan hidup setiap pasangan dan individu. Pendekatan kami adalah <i>artistic-documentary</i>—di mana kejujuran momen bertemu dengan estetika sinematik yang elegan.</p>
                <p>Kami memahami bahwa kenyamanan adalah kunci dari hasil foto yang natural. Oleh karena itu, tim kami bekerja dengan pendekatan yang personal dan intim, memastikan setiap subjek merasa bebas untuk menjadi diri mereka sendiri di depan kamera.</p>
            ',
            'story_image_url' => 'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?auto=format&fit=crop&q=80&w=1200',
            'bts_title' => 'Di Balik Layar',
            'bts_subtitle' => 'Proses kreatif kami dalam menciptakan keabadian.',
            'bts_items' => json_encode([
                [
                    'stage' => \App\Enums\BtsStageEnum::PRE_PRODUCTION->value,
                    'description' => 'Perencanaan Konsep: Kami mendengarkan cerita Anda untuk menyusun konsep visual yang personal dan unik.',
                    'image_url' => 'https://images.unsplash.com/photo-1493723843671-1d655e7d98f0?auto=format&fit=crop&q=80&w=600'
                ],
                [
                    'stage' => \App\Enums\BtsStageEnum::ON_LOCATION->value,
                    'description' => 'Sesi Dokumentasi: Menggunakan peralatan kelas atas dengan teknik pencahayaan yang dramatis namun natural.',
                    'image_url' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&q=80&w=600'
                ],
                [
                    'stage' => \App\Enums\BtsStageEnum::POST_PRODUCTION->value,
                    'description' => 'Proses Kurasi & Edit: Setiap foto melalui proses pewarnaan tangan (hand-colored) untuk mencapai estetika emosional.',
                    'image_url' => 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?auto=format&fit=crop&q=80&w=600'
                ]
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

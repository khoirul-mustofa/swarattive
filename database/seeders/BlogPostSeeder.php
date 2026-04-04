<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = User::first();

        $posts = [
            [
                'title' => '5 Tips for Pre-Wedding Shoots',
                'excerpt' => 'Dapatkan hasil foto pre-wedding yang memukau dengan persiapan yang tepat. Dari pemilihan lokasi hingga outfit yang cocok.',
                'content' => '<p>Dapatkan hasil foto pre-wedding yang memukau dengan persiapan yang tepat. Dari pemilihan lokasi hingga outfit yang cocok.</p><p>Persiapan adalah kunci utama untuk mendapatkan hasil foto yang maksimal. Pastikan Anda mendiskusikan konsep dengan fotografer jauh-jauh hari.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=800',
                'tags' => ['Photography Tips', 'Wedding'],
            ],
            [
                'title' => 'The Art of Light in Portraits',
                'excerpt' => 'Pelajari bagaimana pencahayaan alami dan buatan dapat mengubah foto portrait biasa menjadi karya seni yang luar biasa.',
                'content' => '<p>Pelajari bagaimana pencahayaan alami dan buatan dapat mengubah foto portrait biasa menjadi karya seni yang luar biasa.</p><p>Cahaya adalah elemen terpenting dalam fotografi. Memahami arah dan kualitas cahaya akan meningkatkan kualitas karya Anda secara drastis.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?auto=format&fit=crop&q=80&w=800',
                'tags' => ['Technique', 'Lighting'],
            ],
            [
                'title' => 'Commercial Photography for Small Businesses',
                'excerpt' => 'Kenapa investasi di fotografi komersial profesional penting untuk pertumbuhan bisnis kecil dan menengah.',
                'content' => '<p>Kenapa investasi di fotografi komersial profesional penting untuk pertumbuhan bisnis kecil dan menengah.</p><p>Foto produk yang berkualitas akan meningkatkan kepercayaan calon pembeli dan memperkuat brand identity usaha Anda.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?auto=format&fit=crop&q=80&w=800',
                'tags' => ['Business', 'Commercial'],
            ],
            [
                'title' => 'Best Wedding Venues in Jakarta',
                'excerpt' => 'Rekomendasi venue pernikahan terbaik di Jakarta yang sempurna untuk sesi foto wedding impian Anda.',
                'content' => '<p>Rekomendasi venue pernikahan terbaik di Jakarta yang sempurna untuk sesi foto wedding impian Anda.</p><p>Jakarta memiliki banyak pilihan venue, mulai dari ballroom hotel mewah hingga lokasi outdoor yang asri.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&q=80&w=800',
                'tags' => ['Inspiration', 'Jakarta'],
            ],
            [
                'title' => 'A Day in the Life of a Photographer',
                'excerpt' => 'Ikuti perjalanan sehari penuh bersama fotografer kami, dari persiapan hingga proses editing yang detail.',
                'content' => '<p>Ikuti perjalanan sehari penuh bersama fotografer kami, dari persiapan hingga proses editing yang detail.</p><p>Menjadi fotografer bukan hanya soal menekan tombol shutter, tapi juga soal koneksi dengan subjek dan ketelitian saat kurasi.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1554048665-27a3c3e80a06?auto=format&fit=crop&q=80&w=800',
                'tags' => ['Behind the Scenes', 'Life'],
            ],
            [
                'title' => 'Choosing the Right Photography Package',
                'excerpt' => 'Panduan lengkap memilih paket fotografi yang tepat sesuai kebutuhan dan budget Anda.',
                'content' => '<p>Panduan lengkap memilih paket fotografi yang tepat sesuai kebutuhan dan budget Anda.</p><p>Kami menawarkan berbagai tingkatan paket untuk memastikan setiap klien mendapatkan layanan terbaik sesuai skala acaranya.</p>',
                'image_url' => 'https://images.unsplash.com/photo-1627483262268-9c2b5b029273?auto=format&fit=crop&q=80&w=800',
                'tags' => ['Guide', 'Planning'],
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'excerpt' => $post['excerpt'],
                'content' => $post['content'],
                'image_url' => $post['image_url'],
                'tags' => $post['tags'],
                'is_published' => true,
                'published_at' => now()->subDays(rand(1, 60)),
                'author_id' => $author->id ?? null,
            ]);
        }
    }
}

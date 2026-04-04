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
                'title' => '5 Tips Mempersiapkan Foto Pre-Wedding yang Tak Terlupakan',
                'excerpt' => 'Mempersiapkan sesi foto pre-wedding memerlukan perencanaan yang matang agar hasilnya maksimal dan bercerita.',
                'content' => '
                    <p>Sesi foto pre-wedding bukan sekadar tentang berdiri di depan kamera dengan pakaian bagus. Ini adalah kesempatan untuk menceritakan kisah Anda sebagai pasangan sebelum melangkah ke jenjang pernikahan. Berikut adalah 5 tips esensial dari Swarattive:</p>
                    <h2>1. Pilih Lokasi yang Memiliki Makna Personal</h2>
                    <p>Jangan hanya memilih lokasi karena sedang tren. Pilih tempat di mana Anda pertama kali bertemu, atau lokasi yang mencerminkan hobi bersama.</p>
                    <h2>2. Koordinasikan Busana, Bukan Sekadar Seragam</h2>
                    <p>Pilih palet warna yang saling melengkapi daripada memakai pakaian yang benar-benar sama persis. Pastikan busana sesuai dengan atmosfer lokasi.</p>
                    <h2>3. Waktu adalah Segalanya (The Golden Hour)</h2>
                    <p>Cahaya alami di pagi hari atau sore hari menjelang matahari terbenam memberikan efek dramatis dan romantis yang tak bisa digantikan oleh lampu studio.</p>
                    <ul>
                        <li>Pastikan Anda sudah siap di lokasi 30 menit sebelum momen ini tiba.</li>
                        <li>Gunakan waktu ini untuk mendapatkan "mood" yang hangat.</li>
                    </ul>
                    <h2>4. Bangun Kedekatan dengan Fotografer</h2>
                    <p>Bertemu dan mengobrol dengan fotografer sebelum hari-H sangat penting agar Anda merasa nyaman dan tidak kaku saat berpose.</p>
                    <h2>5. Jadilah Diri Sendiri</h2>
                    <p>Tips terpenting adalah jangan terlalu memaksakan pose yang bukan karakter Anda. Biarkan interaksi alami kalian yang menjadi bintang utama.</p>
                ',
                'image_url' => 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80&w=1200',
                'tags' => ['Pre-Wedding', 'Tips', 'Edukasi'],
            ],
            [
                'title' => 'Tren Fotografi Pernikahan 2026: Kembali ke Klasik dan Intim',
                'excerpt' => 'Di tahun 2026, tren fotografi pernikahan bergeser menjadi lebih dokumenter, jujur, dan hangat dengan skala yang lebih kecil.',
                'content' => '
                    <p>Dunia fotografi pernikahan terus berkembang, namun ada satu hal yang tetap abadi: emosi yang nyata. Tahun 2026 membawa kita kembali ke akar di mana momen intim lebih dihargai daripada kemegahan yang kaku.</p>
                    <h2>Documentary Style Photography</h2>
                    <p>Banyak pasangan kini lebih menyukai foto yang diambil tanpa arahan pose (candid). Mereka ingin melihat air mata haru ayah, tawanya sahabat, atau canggungnya saat pertama kali melihat pasangan di pagi hari pernikahan.</p>
                    <h2>Warm & Moody Tones</h2>
                    <p>Pewarnaan foto yang hangat dengan sedikit nuansa "film look" menjadi primadona. Ini memberikan kesan nostalgia yang kuat setiap kali kita melihatnya kembali bertahun-tahun kemudian.</p>
                    <blockquote>"Fotografi bukan tentang apa yang kita lihat, tapi tentang apa yang kita rasakan."</blockquote>
                    <p>Di Swarattive, kami selalu mengedepankan kualitas daripada kuantitas. Kami percaya bahwa satu foto yang memiliki jiwa jauh lebih berharga daripada ribuan foto yang hanya menampilkan wajah tanpa ekspresi.</p>
                ',
                'image_url' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=1200',
                'tags' => ['Pernikahan', 'Tren', 'Inspirasi'],
            ],
            [
                'title' => 'Pentingnya Memilih Fotografer yang Sesuai Karakter Anda',
                'excerpt' => 'Setiap fotografer memiliki tanda tangan visualnya masing-masing. Memastikan selera Anda sejalan adalah kunci kepuasan hasil akhir.',
                'content' => '
                    <p>Memilih fotografer adalah salah satu keputusan terpenting dalam perencanaan acara besar. Berikut beberapa alasan mengapa kecocokan karakter sangat krusial:</p>
                    <ul>
                        <li><b>Konsistensi Estetika:</b> Pastikan portofolio mereka memiliki gaya yang Anda sukai, baik itu dari segi komposisi maupun warna.</li>
                        <li><b>Kenyamanan Emosional:</b> Fotografer adalah orang yang akan berada di dekat Anda sepanjang hari. Kenyamanan akan terpancar di hasil foto.</li>
                        <li><b>Pemahaman Nilai:</b> Jika Anda menghargai detail-detail kecil, pastikan fotografer Anda juga memiliki ketelitian yang sama.</li>
                    </ul>
                ',
                'image_url' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&q=80&w=1200',
                'tags' => ['Edukasi', 'Tips', 'Perencanaan'],
            ],
            [
                'title' => 'Mengapa Potret Profesional Bisa Meningkatkan Personal Branding Anda',
                'excerpt' => 'Di era digital, wajah Anda adalah gerbang pertama karier dan bisnis Anda. Satu potret berkualitas tinggi dapat mengubah persepsi orang.',
                'content' => '
                    <p>Kita hidup di dunia visual di mana kesan pertama sering kali terbentuk dalam hitungan detik melalui layar smartphone. Sebuah potret atau "headshot" profesional bukan sekadar foto untuk LinkedIn; itu adalah investasi pada reputasi Anda.</p>
                    <p>Potret yang baik harus menonjolkan profesionalisme sekaligus aksesibilitas. Teknik pencahayaan yang tepat dan arahan pose yang natural dari Swarattive akan membantu Anda terlihat percaya diri tanpa terlihat kaku atau berlebihan.</p>
                ',
                'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=1200',
                'tags' => ['Potret', 'Bisnis', 'Personal Branding'],
            ],
            [
                'title' => 'Filosofi Black & White dalam Fotografi Momen',
                'excerpt' => 'Menghilangkan warna terkadang justru membuat foto menjadi lebih "berwarna" secara emosi.',
                'content' => '
                    <p>Foto hitam putih memiliki keajaiban tersendiri. Dengan menghilangkan distraksi warna, kita dipaksa untuk fokus pada bentuk, kontras, bayangan, dan yang terpenting: emosi.</p>
                    <p>Sering kali, momen-momen yang paling emosional di pernikahan terlihat jauh lebih kuat dalam format monokrom. Ini adalah teknik klasik yang takkan pernah terlihat kuno.</p>
                ',
                'image_url' => 'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?auto=format&fit=crop&q=80&w=1200',
                'tags' => ['Inspirasi', 'Seni', 'Teknik'],
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
                'published_at' => now()->subDays(rand(1, 45)),
                'author_id' => $author->id ?? null,
            ]);
        }
    }
}

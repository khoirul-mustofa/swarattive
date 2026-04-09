# Issue: Bug Edit Gambar via URL Eksternal Tidak Tersimpan

## Deskripsi Masalah
Saat admin mengubah gambar *Hero Section* dengan memasukkan link eksternal baru lalu melakukan "Save", perubahan tidak tercermin baik di *Admin Panel* maupun di *Frontend*. Database tetap mempertahankan URL gambar lama (default dari Seeder Unsplash).

## Analisis Akar Masalah
Masalah berasal dari siklus hidup (*lifecycle*) komponen Form Laravel Filament, khususnya pada komponen `Select` (Sumber Gambar / `image_source`).

Komponen `image_source` diatur sebagai _virtual field_ (dengan `dehydrated(false)`) karena tidak ada di kolom database. Saat kita membuka halaman **Create**, method `->default(...)` berfungsi dengan baik untuk memberi nilai awal. Namun, saat membuka halaman **Edit**, method `->default()` akan **diabaikan** oleh Filament V3. 

Karena `image_source` menjadi kosong/null saat mode *Edit*, rule `->visible()` pada field `image_url` dan `image_path` akan menghasilkan `false` (tak kasat mata secara komputasional). Filament secara otomatis **mengabaikan/tidak menyimpan** komponen yang berada di luar *visibility scope* (tidak terlihat/hidden) walau di layar UI kadang masih nampak interaktif. Inilah mengapa URL baru tidak pernah dikirimkan saat di-_save_.

## Panduan Perbaikan

Untuk junior dev atau AI, perbaikannya murni di kode *Form Schema* Filament, jangan modifikasi struktur database API atau Model terkait.

### Tahapan Implementasi:

1. **Buka Form Schema Hero Slide**
   Lokasi file: `app/Filament/Resources/HeroSlides/Schemas/HeroSlideForm.php`.

2. **Perbaiki Inisialisasi Field `image_source`**
   Cari komponen `Select::make('image_source')`. Hapus atau lengkapi fungsi `->default()` dengan fungsi inisialisasi state milik Filament seperti `->formatStateUsing()`. Tujuannya agar saat rekaman (record) dimuat dalam status Edit, nilai dropdown `image_source` dikalkulasi dengan valid.

   *Contoh Pendekatan Logika:*
   ```php
   Select::make('image_source')
       // ... konfigurasi lainnya ...
       ->formatStateUsing(fn ($record) => $record?->image_path ? 'upload' : 'url')
       ->live()
   ```
   *Catatan: Parameter `$record` merepresentasikan Model database saat mode Edit, dan akan bernilai `null` saat mode Create.*

3. **Perbaiki Model Blog (Wajib Diperiksa)**
   Sistem kita menerapkan skema duplikat di Blog. Buka file `app/Filament/Resources/BlogPost/Schemas/BlogPostForm.php` dan pastikan komponen `image_source` di sana juga diperbaiki menggunakan cara yang sama untuk mencegah _side-effect_ bug di halaman manajemen artikel.

4. **Testing**
   - Pastikan Anda menghapus *cache* Laravel (`php artisan optimize:clear`).
   - Masuk ke Admin Panel > Hero Slides.
   - Edit *slide* kedua/ketiga yang memakai tautan Unsplash bawaan, lalu ubah tautannya ke gambar lain.
   - Tekan simpan dan pastikan datanya benar-benar diperbarui di *database* dan tampil di *frontend*.

Lakukan dengan hati-hati. Ini adalah bug UI state management yang krusial untuk pengalaman admin.

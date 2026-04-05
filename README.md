# Swarattive Photography Platform

<p align="center">
  <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel" width="50">
  <img src="https://filamentphp.com/images/logomark.svg" alt="Filament" width="50">
</p>

Swarattive adalah platform manajemen studio fotografi profesional yang dirancang untuk menangani portofolio artistik, sistem reservasi (*booking*) terintegrasi, dan pengelolaan konten blog dalam satu ekosistem yang modern dan efisien.

---

## 🚀 Fitur Utama

- **Digital Portfolio**: Etalase karya foto profesional yang dikategorikan secara dinamis (Pernikahan, Pre-Wedding, Potret, dll).
- **Integrated Booking System**: Flow reservasi layanan fotografi lengkap dengan pemilihan paket, fotografer, dan jadwal.
- **Content Management System (CMS)**: Manajemen artikel dan jurnal fotografi untuk kebutuhan marketing dan SEO.
- **Powerful Admin Dashboard**: Panel administrasi berbasis Filament yang dikelompokkan secara logis untuk efisiensi operasional.
- **Static Assets Management**: Sistem penyimpanan aset gambar statis yang persisten dan terlacak oleh repositori.

---

## 🛠️ Tech Stack

Platform ini dibangun menggunakan teknologi mutakhir dalam ekosistem PHP dan JavaScript:

- **Framework**: [Laravel 12.x](https://laravel.com)
- **Admin Panel**: [Filament PHP v5](https://filamentphp.com) (TALL Stack: Tailwind, Alpine, Laravel, Livewire)
- **Styling**: [Tailwind CSS](https://tailwindcss.com)
- **Frontend Interactivity**: [Alpine.js](https://alpinejs.dev) & [Livewire v3](https://livewire.laravel.com)
- **Database**: MySQL / MariaDB

---

## 📋 Prasyarat Sistem

Sebelum menginstal, pastikan komputer Anda telah terpasang:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL / MariaDB

---

## ⚙️ Panduan Instalasi (Development)

Ikuti langkah-langkah berikut untuk menjalankan proyek di lingkungan pengembangan lokal:

1. **Clone Repositori**:
   ```bash
   git clone <url-repository>
   cd swarattive
   ```

2. **Instal Dependensi**:
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Lingkungan**:
   Salin `.env.example` menjadi `.env` dan atur detail database Anda.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Tautkan Penyimpanan Media**:
   Sangat penting untuk menjalankan perintah ini agar aset yang diunggah dapat di akses oleh publik:
   ```bash
   php artisan storage:link
   ```

5. **Migrasi & Seed Database**:
   Jalankan perintah ini untuk membuat struktur tabel dan mengisi data awal (termasuk admin).
   ```bash
   php artisan migrate --seed
   ```

---

## 🖥️ Menjalankan Aplikasi

Jalankan dua terminal secara bersamaan selama proses pengembangan:

**Terminal 1 (Backend Server):**
```bash
php artisan serve
```

**Terminal 2 (Frontend Assets Compiler):**
```bash
npm run dev
```

Aplikasi dapat diakses melalui browser di: `http://localhost:8000`

---

## 🔐 Akses Admin (Local Development)

Setelah menjalankan `php artisan db:seed`, Anda dapat masuk ke panel admin dengan kredensial berikut:

- **URL**: `http://localhost:8000/admin`
- **Email**: `admin@swarattive.com`
- **Password**: `password`

---

## 📂 Manajemen Aset Statis

Aset internal aplikasi (Logo, Placeholder, Fallback Images) disimpan di direktori `public/images/`. Folder ini **tidak** masuk dalam `.gitignore` untuk memastikan konsistensi tampilan antar lingkungan pengembangan. Anda hanya perlu menimpa (*overwrite*) file di folder tersebut dengan nama yang sama untuk memperbarui aset statis.

---

## 📄 Lisensi

Proyek ini merupakan properti eksklusif dari **Swarattive Photography**. Semua hak cipta dilindungi undang-undang.

# AI Rules — Laravel 12 + Filament v5 + Livewire v4

## Tech Stack (WAJIB DIIKUTI)

* Laravel 12 (Backend & API)
* Filament v5 (Admin Panel)
* Livewire v4 (Reactive Component)
* TailwindCSS v4 (Styling)
* Vite (Asset bundler)

---

## Global Principles

* Selalu gunakan best practice Laravel modern
* Hindari kode deprecated atau versi lama
* Prioritaskan clean code, readability, dan scalability
* Semua solusi harus production-ready (bukan sekadar contoh sederhana)
* Gunakan pendekatan modular dan reusable

---

## Laravel Rules

### Struktur & Arsitektur

* Gunakan MVC pattern dengan benar
* Gunakan Resource Controller jika memungkinkan
* Gunakan Service Layer untuk logic kompleks
* Pisahkan logic bisnis dari controller

### Database

* Jangan gunakan nullable jika tidak diperlukan
* Selalu gunakan default value untuk field penting
* Gunakan migration yang clean & reversible
* Gunakan enum untuk field seperti status

### Validasi

* Gunakan Form Request (WAJIB untuk validasi kompleks)
* Jangan validasi di controller secara langsung
* Gunakan rule yang eksplisit dan aman

### Eloquent

* Gunakan relasi dengan benar (hasMany, belongsTo, dll)
* Hindari N+1 query (gunakan eager loading)
* Gunakan accessor & mutator jika perlu

---

## ⚡ Filament v5 Rules (SANGAT PENTING)

### Form & Schema

* Gunakan Schema API (BUKAN Forms lama)
* Semua form harus menggunakan struktur:

  * Section
  * Grid
  * Components (TextInput, Select, dll)

### Utilities (WAJIB V5)

Gunakan:

* Filament\Schemas\Components\Utilities\Set
* Filament\Schemas\Components\Utilities\Get

JANGAN gunakan:

* Filament\Forms\Set (deprecated)

---

### Form Behavior

* Gunakan `afterStateUpdated()` untuk reactive logic
* Gunakan `live()` hanya jika diperlukan
* Hindari logic berat di form (pindahkan ke backend jika perlu)

---

### Table

* Gunakan Table Column sesuai kebutuhan
* SelectColumn tidak memiliki required()
* Untuk non-null:

  * gunakan `disablePlaceholderSelection()`
* Gunakan sortable() dan searchable() jika relevan

---

### UX Admin Panel

* Gunakan warna status (success, danger, warning)
* Gunakan label yang jelas dan user-friendly
* Hindari field kosong tanpa default

---

## Livewire Rules

* Gunakan Livewire untuk interaksi dinamis
* Jangan overuse (gunakan hanya jika perlu)
* Pisahkan logic ke method yang jelas
* Hindari logic kompleks di Blade

---

## UI / UX Rules

* Gunakan Tailwind utility secara konsisten
* Gunakan spacing yang rapi (p-4, gap-6, dll)
* Hindari tampilan default yang “kasar”
* UI harus terasa modern & clean

---

## Security Rules

* Selalu validasi input user
* Gunakan CSRF protection
* Jangan expose data sensitif
* Gunakan authorization (Policy / Gate)

---

## Performance Rules

* Gunakan eager loading
* Hindari query berulang
* Gunakan caching jika perlu
* Optimalkan asset (Vite build)

---

## Code Quality

* Gunakan nama variable yang jelas
* Hindari magic string
* Gunakan helper Laravel (Str, Arr, dll)
* Gunakan type hint jika memungkinkan

---

## Reusable Pattern

Gunakan pola berikut:

* Form → Schema + Section + Grid
* Table → Column + Filter + Action
* Logic → Service Class
* Validation → Form Request

---

## Hal yang DILARANG

* Menggunakan syntax Filament versi lama
* Menulis kode tanpa validasi
* Membuat field nullable tanpa alasan jelas
* Menulis logic bisnis di Blade
* Menulis kode yang tidak scalable

---

## Output Expectation dari AI

Setiap jawaban harus:

* Menggunakan stack Laravel 12 + Filament v5 + Livewire v4
* Menggunakan API terbaru
* Clean, rapi, dan siap production
* Tidak menggunakan cara lama/deprecated
* Memberikan solusi yang scalable

---

## Context Awareness

AI harus mengasumsikan:

* Project adalah aplikasi modern
* Digunakan untuk production (bukan latihan)
* Memerlukan performa, keamanan, dan UX yang baik

---

## Optional Enhancement (Jika relevan)

* Gunakan enum untuk status
* Gunakan slug untuk SEO
* Gunakan event / listener untuk automation
* Gunakan queue untuk proses berat

---

## Goal

AI harus bertindak sebagai:

> Senior Laravel Developer yang berpengalaman dalam Filament v5 dan Livewire

dan selalu memberikan solusi yang:

* cepat
* tepat
* scalable
* profesional

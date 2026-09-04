<<<<<<< HEAD
# Testing-web
=======
# Website Sekolah dengan CMS (Laravel)

Website sekolah yang dinamis lengkap dengan panel CMS (Content Management System) untuk mengelola berita, pengumuman, galeri foto, data guru, pesan dari pengunjung, dan pengaturan umum situs — tanpa perlu menyentuh kode sama sekali.

## Fitur

**Halaman Publik**
- Beranda dengan hero section, statistik sekolah, berita terbaru, pengumuman berjalan, galeri, dan tim guru
- Profil Sekolah (Visi, Misi, Sejarah, statistik)
- Berita & Kegiatan (dengan kategori dan halaman detail)
- Pengumuman resmi (dengan lampiran file)
- Galeri Foto
- Data Guru & Staff
- Halaman Kontak (dengan formulir pesan)

**Panel Admin (CMS)** — akses di `/login`
- Dashboard ringkasan statistik & aktivitas terbaru
- Kelola Berita (tulis, edit, hapus, upload thumbnail, kategori, status draft/publish)
- Kelola Kategori Berita
- Kelola Pengumuman (dengan lampiran file)
- Kelola Galeri Foto
- Kelola Data Guru & Staff
- Kelola Pesan Masuk dari pengunjung
- Pengaturan Situs (nama sekolah, logo, visi-misi, sejarah, kontak, media sosial, Google Maps)

## Teknologi

- **Laravel 10** (PHP Framework)
- **Blade** templating
- **Tailwind CSS** (via CDN, tanpa perlu build tools)
- **Alpine.js** untuk interaktivitas ringan (menu mobile, sidebar admin)
- MySQL / MariaDB sebagai database

## Cara Menjalankan di Komputer Lokal

### 1. Persyaratan
- PHP >= 8.1
- Composer ([getcomposer.org](https://getcomposer.org))
- MySQL / MariaDB (atau gunakan SQLite untuk uji coba cepat)

### 2. Instalasi

```bash
# 1. Ekstrak file zip, lalu masuk ke folder project
cd sekolah

# 2. Install dependency PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Buat database MySQL kosong bernama "sekolah_cms"
#    lalu sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD di file .env

# 6. Jalankan migrasi + isi data contoh (admin, berita, dsb)
php artisan migrate --seed

# 7. Buat symbolic link storage (agar gambar upload bisa diakses browser)
php artisan storage:link

# 8. Jalankan server pengembangan
php artisan serve
```

Buka **http://localhost:8000** untuk melihat website, dan **http://localhost:8000/login** untuk masuk ke panel admin.

### 3. Akun Admin Default

```
Email    : admin@sekolah.sch.id
Password : admin123
```

**Segera ganti password ini setelah login pertama kali** (lewat `php artisan tinker` atau buat halaman ganti password sendiri).

### Alternatif: Uji Coba Cepat dengan SQLite (tanpa install MySQL)

```bash
touch database/database.sqlite
```
Lalu ubah baris berikut di `.env`:
```
DB_CONNECTION=sqlite
```
(hapus/abaikan baris `DB_HOST`, `DB_DATABASE`, dst.) kemudian lanjutkan dari langkah `php artisan migrate --seed`.

## Struktur Data (Model CMS)

| Model | Deskripsi |
|---|---|
| `Berita` | Artikel berita/kegiatan, dengan kategori, thumbnail, status draft/publish |
| `KategoriBerita` | Kategori untuk mengelompokkan berita |
| `Pengumuman` | Pengumuman resmi dengan opsi lampiran file |
| `Galeri` | Foto dokumentasi sekolah |
| `Guru` | Data guru & staff (nama, jabatan, mapel, foto) |
| `Pesan` | Pesan masuk dari formulir kontak |
| `Pengaturan` | Data pengaturan situs (satu baris): nama sekolah, visi-misi, kontak, dll |

## Kustomisasi

- **Warna & tipografi**: atur di `resources/views/layouts/app.blade.php` bagian `tailwind.config` (palet warna `ink` untuk navy dan `gold` untuk aksen emas).
- **Logo, foto hero, visi-misi, kontak, sosial media**: semua bisa diubah lewat menu **Pengaturan Situs** di panel admin, tidak perlu edit kode.
- **Menambah halaman baru**: buat controller + view baru, lalu daftarkan route di `routes/web.php`.

## Catatan Keamanan Produksi

Sebelum deploy ke server produksi:
1. Set `APP_ENV=production` dan `APP_DEBUG=false` di `.env`.
2. Ganti password admin default.
3. Gunakan HTTPS.
4. Jalankan `php artisan config:cache` dan `php artisan route:cache` untuk performa.
>>>>>>> 183d915 (Initial commit: sekolah CMS + static site)

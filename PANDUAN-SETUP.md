# Panduan Setup Lengkap — Website Sekolah CMS (Laravel)

Panduan ini ditulis untuk pemula: mulai dari instalasi tools dari nol, sampai website berjalan di komputer sendiri, hingga opsional deploy ke hosting.

---

## Daftar Isi
1. [Persyaratan](#1-persyaratan)
2. [Opsi A — Windows dengan Laragon (paling mudah)](#2-opsi-a--windows-dengan-laragon-paling-mudah)
3. [Opsi B — Windows dengan XAMPP](#3-opsi-b--windows-dengan-xampp)
4. [Opsi C — macOS](#4-opsi-c--macos)
5. [Opsi D — Linux (Ubuntu/Debian)](#5-opsi-d--linux-ubuntudebian)
6. [Menyiapkan Project](#6-menyiapkan-project)
7. [Konfigurasi Database](#7-konfigurasi-database)
8. [Menjalankan Migrasi & Data Contoh](#8-menjalankan-migrasi--data-contoh)
9. [Menjalankan Website](#9-menjalankan-website)
10. [Login & Mengganti Password Admin](#10-login--mengganti-password-admin)
11. [Struktur Folder — Apa yang Boleh Diubah](#11-struktur-folder--apa-yang-boleh-diubah)
12. [Troubleshooting (Masalah Umum)](#12-troubleshooting-masalah-umum)
13. [Deploy ke Hosting/Server Produksi](#13-deploy-ke-hostingserver-produksi)
14. [Checklist Keamanan Sebelum Live](#14-checklist-keamanan-sebelum-live)

---

## 1. Persyaratan

Agar website Laravel ini bisa jalan, komputer Anda butuh 3 hal:

| Kebutuhan | Versi Minimal | Fungsi |
|---|---|---|
| **PHP** | 8.1 ke atas | Menjalankan kode Laravel |
| **Composer** | versi terbaru | Mengunduh library/paket Laravel |
| **MySQL / MariaDB** | 5.7+ / 10.3+ | Database (bisa juga pakai SQLite untuk uji coba) |

Pilih salah satu cara instalasi di bawah sesuai sistem operasi Anda, lalu lanjut ke **Bagian 6**.

> 💡 **Cara tercepat untuk pemula**: gunakan **Laragon** (Windows) atau **Laravel Herd** (macOS) — keduanya sudah membundel PHP, Composer, dan MySQL sekaligus, tinggal install satu aplikasi.

---

## 2. Opsi A — Windows dengan Laragon (paling mudah)

1. Unduh Laragon di **https://laragon.org/download/** (pilih versi Full).
2. Install seperti aplikasi biasa (Next → Next → Finish).
3. Buka Laragon, klik tombol **Start All** — ini otomatis menjalankan Apache/Nginx dan MySQL.
4. Laragon sudah menyertakan PHP dan Composer secara otomatis. Cek dengan membuka **Terminal** di dalam Laragon (klik menu Terminal), lalu ketik:
   ```bash
   php -v
   composer -v
   ```
   Jika muncul nomor versi, berarti sudah siap.
5. Folder project sebaiknya diletakkan di `C:\laragon\www\`.

Lanjut ke [Bagian 6](#6-menyiapkan-project).

---

## 3. Opsi B — Windows dengan XAMPP

1. Unduh XAMPP di **https://www.apachefriends.org/** (pilih versi dengan PHP 8.1 ke atas).
2. Install, lalu buka **XAMPP Control Panel** dan klik **Start** pada modul **Apache** dan **MySQL**.
3. Tambahkan PHP ke PATH Windows agar bisa dipanggil dari terminal:
   - Buka **Edit the system environment variables** → **Environment Variables**.
   - Pada bagian **Path**, klik **Edit** → **New**, lalu masukkan folder PHP XAMPP, misalnya `C:\xampp\php`.
   - Klik OK, lalu **restart Command Prompt/PowerShell**.
4. Cek dengan `php -v` di Command Prompt.
5. Install Composer secara terpisah: unduh installer di **https://getcomposer.org/Composer-Setup.exe** dan jalankan (installer akan otomatis mendeteksi PHP XAMPP Anda).
6. Letakkan folder project di `C:\xampp\htdocs\`.

Lanjut ke [Bagian 6](#6-menyiapkan-project).

---

## 4. Opsi C — macOS

Cara termudah pakai **Homebrew**:

```bash
# Install Homebrew jika belum ada (lihat brew.sh)
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Install PHP, Composer, dan MySQL
brew install php composer mysql

# Jalankan MySQL
brew services start mysql
```

Cek instalasi:
```bash
php -v
composer -v
mysql --version
```

Alternatif yang lebih praktis: gunakan **Laravel Herd** (https://herd.laravel.com) — aplikasi khusus macOS yang membundel PHP + Nginx + tools Laravel dalam satu klik install.

Lanjut ke [Bagian 6](#6-menyiapkan-project).

---

## 5. Opsi D — Linux (Ubuntu/Debian)

```bash
# Update daftar paket
sudo apt update

# Install PHP dan ekstensi yang dibutuhkan Laravel
sudo apt install -y php php-cli php-mbstring php-xml php-mysql php-curl php-zip unzip curl

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install MySQL Server
sudo apt install -y mysql-server
sudo systemctl start mysql
sudo systemctl enable mysql
```

Cek instalasi:
```bash
php -v
composer -v
mysql --version
```

Lanjut ke [Bagian 6](#6-menyiapkan-project).

---

## 6. Menyiapkan Project

1. **Ekstrak** file `sekolah-cms-laravel.zip` yang sudah diunduh. Anda akan mendapat folder bernama `sekolah`.
2. Pindahkan folder tersebut ke lokasi yang sesuai environment Anda:
   - Laragon → `C:\laragon\www\sekolah`
   - XAMPP → `C:\xampp\htdocs\sekolah`
   - macOS/Linux → folder mana saja, misalnya `~/Sites/sekolah`
3. Buka **Terminal / Command Prompt**, masuk ke folder project:
   ```bash
   cd sekolah
   ```
4. Install seluruh library Laravel via Composer (proses ini butuh koneksi internet dan bisa memakan waktu 1–3 menit):
   ```bash
   composer install
   ```
   Jika muncul pertanyaan konfirmasi, tekan **Enter**/pilih **yes**.
5. Salin file environment:
   ```bash
   cp .env.example .env
   ```
   *(Di Windows Command Prompt, gunakan `copy .env.example .env`)*
6. Generate kunci aplikasi (wajib, untuk enkripsi):
   ```bash
   php artisan key:generate
   ```
   Anda akan melihat pesan `Application key set successfully.`

---

## 7. Konfigurasi Database

Anda punya dua pilihan: **MySQL** (direkomendasikan, sesuai untuk pemakaian jangka panjang) atau **SQLite** (paling cepat untuk sekadar uji coba, tanpa perlu bikin database manual).

### Pilihan 1 — MySQL

1. Buat database kosong bernama `sekolah_cms`:
   - **Via phpMyAdmin** (Laragon/XAMPP menyediakan ini di `http://localhost/phpmyadmin`): klik **New**, ketik nama database `sekolah_cms`, pilih collation `utf8mb4_unicode_ci`, klik **Create**.
   - **Via terminal**:
     ```bash
     mysql -u root -p
     ```
     ```sql
     CREATE DATABASE sekolah_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
     EXIT;
     ```
2. Buka file `.env` di editor teks (VS Code, Sublime, Notepad++, dll), lalu sesuaikan baris berikut:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sekolah_cms
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   Isi `DB_USERNAME` dan `DB_PASSWORD` sesuai kredensial MySQL Anda (default XAMPP/Laragon biasanya username `root` tanpa password).

### Pilihan 2 — SQLite (lebih simpel, tanpa perlu server database)

1. Buat file database kosong:
   ```bash
   # macOS/Linux
   touch database/database.sqlite

   # Windows (Command Prompt)
   type nul > database\database.sqlite
   ```
2. Di file `.env`, ubah baris koneksi database menjadi:
   ```env
   DB_CONNECTION=sqlite
   ```
   Baris `DB_HOST`, `DB_DATABASE`, dll di bawahnya boleh dibiarkan atau dihapus — tidak akan digunakan.

---

## 8. Menjalankan Migrasi & Data Contoh

Perintah ini akan membuat seluruh tabel database (berita, pengumuman, galeri, guru, dst) **sekaligus mengisi data contoh** (1 akun admin + beberapa berita/pengumuman/guru dummy agar Anda langsung bisa lihat tampilannya):

```bash
php artisan migrate --seed
```

Jika berhasil, akan muncul daftar tabel yang dibuat tanpa pesan error.

Buat symbolic link folder storage agar foto yang diunggah (thumbnail berita, foto guru, galeri, dll) bisa diakses lewat browser:

```bash
php artisan storage:link
```

> ⚠️ Jika Anda hanya ingin membuat tabel **tanpa** data contoh (database benar-benar kosong), jalankan `php artisan migrate` saja (tanpa `--seed`). Tapi perlu diingat: tanpa seeder, **akun admin juga tidak akan dibuat**, jadi Anda tidak akan bisa login ke panel CMS. Disarankan tetap pakai `--seed` lalu hapus data contohnya nanti dari panel admin.

---

## 9. Menjalankan Website

Jalankan server pengembangan bawaan Laravel:

```bash
php artisan serve
```

Anda akan melihat pesan seperti:
```
INFO  Server running on [http://127.0.0.1:8000].
```

Buka browser dan akses:
- **Website publik**: http://127.0.0.1:8000
- **Login admin/CMS**: http://127.0.0.1:8000/login

> 💡 Jika Anda pakai Laragon/XAMPP dan project sudah diletakkan di folder `www`/`htdocs`, Anda juga bisa mengaksesnya lewat `http://localhost/sekolah/public` tanpa perlu menjalankan `php artisan serve`.

Biarkan jendela terminal tetap terbuka selama Anda menggunakan website (server berhenti jika terminal ditutup atau ditekan `Ctrl + C`).

---

## 10. Login & Mengganti Password Admin

Akun admin default (dibuat otomatis oleh seeder):

```
Email    : admin@sekolah.sch.id
Password : admin123
```

**Segera ganti password ini.** Karena panel CMS belum memiliki halaman "ganti password" bawaan, cara tercepat adalah lewat Tinker (konsol interaktif Laravel):

```bash
php artisan tinker
```

Lalu di dalam Tinker, jalankan:

```php
$user = App\Models\User::where('email', 'admin@sekolah.sch.id')->first();
$user->password = Hash::make('password-baru-anda');
$user->save();
exit
```

Anda juga bisa mengganti **email** admin dengan cara yang sama (`$user->email = 'email-baru@sekolah.sch.id'; $user->save();`).

Setelah login, buka menu **Pengaturan Situs** di sidebar untuk mengisi data sekolah Anda yang sebenarnya (nama, logo, alamat, visi-misi, sejarah, kontak, media sosial), lalu masuk ke menu **Berita**, **Pengumuman**, **Galeri**, dan **Guru & Staff** untuk menghapus data contoh dan menggantinya dengan data asli.

---

## 11. Struktur Folder — Apa yang Boleh Diubah

| Folder/File | Isi | Aman diubah? |
|---|---|---|
| `resources/views/` | Semua tampilan halaman (Blade) | ✅ Ya, ini yang Anda edit untuk ubah tampilan |
| `app/Models/` | Definisi data (Berita, Guru, dll) | ⚠️ Hati-hati, sesuaikan dengan migrasi |
| `app/Http/Controllers/` | Logika halaman & CMS | ⚠️ Untuk developer, ubah sesuai kebutuhan fitur |
| `routes/web.php` | Daftar alamat URL website | ⚠️ Tambahkan rute baru di sini jika bikin halaman baru |
| `database/migrations/` | Struktur tabel database | ⚠️ Jangan edit migrasi yang sudah dijalankan; buat migrasi baru untuk perubahan |
| `public/storage/` | File hasil upload (otomatis, dari `storage:link`) | ❌ Jangan diedit manual |
| `.env` | Konfigurasi rahasia (password DB, dll) | ⚠️ Jangan pernah dibagikan/diupload ke publik |
| `vendor/` | Library pihak ketiga (hasil `composer install`) | ❌ Jangan diedit sama sekali |

---

## 12. Troubleshooting (Masalah Umum)

**"Class 'PDO' not found" atau error koneksi database**
→ Ekstensi PHP untuk MySQL belum aktif. Di `php.ini`, pastikan baris `extension=pdo_mysql` tidak diberi tanda `;` di depannya, lalu restart Apache/PHP.

**Halaman blank putih / error 500**
→ Jalankan `php artisan config:clear` dan `php artisan cache:clear`, lalu cek isi file log di `storage/logs/laravel.log` untuk detail errornya.

**"could not find driver" saat migrate**
→ Ekstensi database PHP belum terpasang. Untuk MySQL: install/aktifkan `php-mysql` (Linux) atau `pdo_mysql` di `php.ini` (Windows). Untuk SQLite: install/aktifkan `php-sqlite3`.

**Foto/gambar tidak muncul setelah upload**
→ Anda lupa menjalankan `php artisan storage:link`, atau hosting Anda tidak mendukung symbolic link (lihat solusi hosting di Bagian 13).

**"419 Page Expired" saat submit form**
→ Sesi/cookie kadaluwarsa. Refresh halaman dan coba lagi. Jika sering terjadi, cek `SESSION_DRIVER` di `.env` dan pastikan folder `storage/framework/sessions` bisa ditulis (writable).

**Error "The stream or file could not be opened... Permission denied" (Linux/macOS)**
→ Folder `storage/` dan `bootstrap/cache/` perlu izin tulis:
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

**`composer install` gagal / lambat**
→ Pastikan koneksi internet stabil. Jika masih gagal, coba `composer install --prefer-dist` atau ganti mirror Composer ke Indonesia: `composer config -g repos.packagist composer https://packagist.org`.

---

## 13. Deploy ke Hosting/Server Produksi

### Opsi A — Shared Hosting (cPanel, umum di Indonesia)

1. Pastikan hosting mendukung PHP 8.1+ dan MySQL, serta bisa akses **SSH** atau minimal **Composer via cPanel**.
2. Upload seluruh folder project (kecuali `vendor/` jika ingin lebih cepat, lalu jalankan `composer install` di server) ke luar folder `public_html`, misalnya ke `~/sekolah`.
3. Buat database MySQL beserta usernya lewat **MySQL Databases** di cPanel, lalu masukkan kredensialnya ke `.env` di server.
4. Arahkan **domain/subdomain** Anda supaya document root-nya menunjuk ke folder `~/sekolah/public` (bukan ke folder `sekolah` itu sendiri). Ini biasanya diatur lewat menu **Domains** atau file `.htaccess` redirect di `public_html`.
5. Jalankan via SSH atau Terminal cPanel:
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan key:generate
   php artisan migrate --seed
   php artisan storage:link
   php artisan config:cache
   php artisan route:cache
   ```
6. Jika hosting tidak mendukung symbolic link (`storage:link` gagal), gunakan alternatif: salin manual isi `storage/app/public` ke `public/storage`, atau gunakan paket `artisan storage:link` versi hosting (banyak panel cPanel modern sudah mendukungnya).

### Opsi B — VPS (DigitalOcean, Vultr, dsb.)

Gunakan Nginx/Apache + PHP-FPM + MySQL. Ikuti langkah yang sama seperti di atas, dengan document root web server diarahkan ke folder `public/`. Disarankan menggunakan **Laravel Forge** atau setup manual dengan `supervisor` untuk queue worker jika nanti menambahkan fitur email/notifikasi.

### Opsi C — Platform seperti Railway / Render

Kedua platform ini mendukung deploy Laravel langsung dari repository Git (GitHub) dengan build otomatis mendeteksi `composer.json`. Push project Anda ke GitHub terlebih dahulu, lalu hubungkan repo tersebut ke platform pilihan dan tambahkan environment variables sesuai isi `.env`.

---

## 14. Checklist Keamanan Sebelum Live

- [ ] `APP_ENV=production` dan `APP_DEBUG=false` di `.env` (mencegah pesan error teknis terlihat pengunjung)
- [ ] Password akun admin sudah diganti dari default
- [ ] Domain sudah menggunakan **HTTPS** (SSL aktif)
- [ ] File `.env` **tidak** ikut ter-upload ke folder publik/GitHub
- [ ] Jalankan `php artisan config:cache` dan `php artisan route:cache` untuk performa
- [ ] Backup database secara berkala (via cPanel Backup Wizard atau `mysqldump`)
- [ ] Data contoh (berita/pengumuman/guru dummy dari seeder) sudah dihapus atau diganti data asli

---

Jika ada langkah yang error atau kurang jelas, sampaikan pesan errornya (screenshot atau teks) supaya bisa dibantu ditelusuri lebih lanjut.

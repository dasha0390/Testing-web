# Panduan Setup — MacBook Intel 2020

Panduan ini khusus untuk **MacBook (Intel, chip Intel Core, bukan Apple Silicon/M1-M3)** menjalankan macOS. Semua perintah di bawah sudah disesuaikan untuk arsitektur Intel (folder Homebrew di `/usr/local`, bukan `/opt/homebrew` seperti di Mac M-series).

---

## Daftar Isi
1. [Cek Versi macOS](#1-cek-versi-macos)
2. [Install Xcode Command Line Tools](#2-install-xcode-command-line-tools)
3. [Install Homebrew](#3-install-homebrew)
4. [Install PHP, Composer, MySQL](#4-install-php-composer-mysql)
5. [Menyiapkan Project](#5-menyiapkan-project)
6. [Setup Database MySQL](#6-setup-database-mysql)
7. [Migrasi & Data Contoh](#7-migrasi--data-contoh)
8. [Menjalankan Website](#8-menjalankan-website)
9. [Login & Ganti Password Admin](#9-login--ganti-password-admin)
10. [Tools Tambahan yang Berguna](#10-tools-tambahan-yang-berguna)
11. [Troubleshooting Khusus Mac](#11-troubleshooting-khusus-mac)
12. [Perintah Harian (Cheat Sheet)](#12-perintah-harian-cheat-sheet)

---

## 1. Cek Versi macOS

Klik logo Apple (kiri atas) → **About This Mac**, pastikan versi macOS Anda **Big Sur (11) ke atas**. MacBook Intel 2020 biasanya sudah bisa update sampai macOS Sonoma (14) atau Sequoia (15), jadi seharusnya aman.

Buka **Terminal**: tekan `Cmd + Space`, ketik `Terminal`, tekan Enter. Semua perintah di panduan ini dijalankan di Terminal.

---

## 2. Install Xcode Command Line Tools

Ini diperlukan sebelum Homebrew bisa dipakai (menyediakan compiler dasar seperti `git`, `make`, dll).

```bash
xcode-select --install
```

Jendela pop-up akan muncul → klik **Install** → tunggu proses selesai (5–15 menit tergantung koneksi). Jika muncul pesan "command line tools are already installed", berarti sudah ada, lanjut saja ke langkah berikutnya.

---

## 3. Install Homebrew

Homebrew adalah "app store" via terminal untuk install PHP, MySQL, dll di Mac.

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

Ikuti instruksi di layar (biasanya cukup tekan Enter dan masukkan password Mac Anda saat diminta).

**Penting untuk Mac Intel**: di akhir instalasi, Homebrew akan menampilkan pesan seperti ini — **jalankan dua baris yang ditampilkan** (biasanya seperti di bawah, tapi ikuti persis yang muncul di terminal Anda):

```bash
echo 'eval "$(/usr/local/bin/brew shellenv)"' >> ~/.zprofile
eval "$(/usr/local/bin/brew shellenv)"
```

Ini menambahkan Homebrew ke PATH agar bisa dipanggil dari terminal manapun. Tutup dan buka ulang Terminal, lalu cek:

```bash
brew --version
```

Jika muncul nomor versi, Homebrew sudah siap.

---

## 4. Install PHP, Composer, MySQL

```bash
brew install php composer mysql
```

Proses ini bisa memakan waktu 5–10 menit. Setelah selesai, jalankan MySQL sebagai service background:

```bash
brew services start mysql
```

Cek semua sudah terpasang dengan benar:

```bash
php -v
composer -v
mysql --version
```

Anda akan melihat PHP versi 8.x, Composer versi 2.x, dan MySQL versi 8.x/9.x.

> 💡 **Set password root MySQL (opsional tapi disarankan)**: instalasi Homebrew MySQL secara default tidak memberi password ke user `root`. Untuk mengatur password:
> ```bash
> mysql_secure_installation
> ```
> Ikuti wizard-nya. Jika Anda skip langkah ini, gunakan saja password kosong di `.env` nanti (`DB_PASSWORD=`).

---

## 5. Menyiapkan Project

1. Cari file `sekolah-cms-laravel.zip` yang sudah diunduh (biasanya ada di folder **Downloads**).
2. Klik dua kali untuk mengekstraknya — akan muncul folder `sekolah`.
3. Pindahkan folder tersebut ke lokasi kerja Anda, misalnya ke folder Home:
   ```bash
   mv ~/Downloads/sekolah ~/sekolah
   cd ~/sekolah
   ```
4. Install seluruh library Laravel:
   ```bash
   composer install
   ```
   Tunggu sampai selesai (biasanya 1–3 menit).
5. Salin file environment dan generate application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Pastikan muncul pesan `Application key set successfully.`

---

## 6. Setup Database MySQL

1. Masuk ke MySQL lewat terminal:
   ```bash
   mysql -u root -p
   ```
   (Tekan Enter tanpa mengetik apa pun jika Anda belum set password, atau masukkan password yang Anda buat di langkah 4.)bre

2. Buat database untuk project:
   ```sql
   CREATE DATABASE sekolah_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   EXIT;
   ```

3. Buka file `.env` di dalam folder project menggunakan editor pilihan Anda:
   ```bash
   open -e .env
   ```
   *(Ini membuka file dengan TextEdit. Kalau Anda punya VS Code, bisa juga jalankan `code .env`.)*

4. Sesuaikan bagian koneksi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sekolah_cms
   DB_USERNAME=root
   DB_PASSWORD=isi_password_anda_atau_kosongkan
   ```
   Simpan file (`Cmd + S`).

---

## 7. Migrasi & Data Contoh

Kembali ke Terminal, di dalam folder `~/sekolah`, jalankan:

```bash
php artisan migrate --seed
```

Ini membuat semua tabel database sekaligus mengisi 1 akun admin + data contoh (berita, pengumuman, guru dummy).

Lalu buat symbolic link agar gambar yang diunggah bisa tampil di browser:

```bash
php artisan storage:link
```

---

## 8. Menjalankan Website

```bash
php artisan serve
```

Anda akan melihat:
```
INFO  Server running on [http://127.0.0.1:8000].
```

Buka Safari/Chrome dan akses:
- **Website**: http://127.0.0.1:8000
- **Login Admin**: http://127.0.0.1:8000/login

Biarkan jendela Terminal tetap terbuka selama Anda memakai website. Untuk menghentikan server, tekan `Control + C` di Terminal (bukan `Cmd + C`).

> 💡 Tips: buka **Terminal baru** (Cmd + T untuk tab baru) jika ingin menjalankan perintah lain seperti `php artisan tinker` sambil server tetap jalan di tab yang lama.

---

## 9. Login & Ganti Password Admin

Akun default:
```
Email    : admin@sekolah.sch.id
Password : admin123
```

Segera ganti lewat Tinker. Di Terminal (tab baru), masuk ke folder project lalu:

```bash
cd ~/sekolah
php artisan tinker
```

Di dalam Tinker:
```php
$user = App\Models\User::where('email', 'admin@sekolah.sch.id')->first();
$user->password = Hash::make('password-baru-anda');
$user->save();
exit
```

---

## 10. Tools Tambahan yang Berguna

- **Editor kode**: [Visual Studio Code](https://code.visualstudio.com/) (gratis) — setelah install, buka project dengan:
  ```bash
  cd ~/sekolah
  code .
  ```
- **Aplikasi database visual** (pengganti phpMyAdmin, lebih nyaman di Mac): [TablePlus](https://tableplus.com/) atau [Sequel Ace](https://apps.apple.com/app/sequel-ace/id1518036000) (gratis, dari App Store) — untuk melihat/isi data database lewat tampilan grafis, bukan lewat terminal.
- **Melihat isi database via terminal** tanpa app tambahan:
  ```bash
  mysql -u root -p sekolah_cms
  SHOW TABLES;
  ```

---

## 11. Troubleshooting Khusus Mac

**`brew: command not found` setelah install Homebrew**
→ PATH belum aktif di sesi terminal Anda. Jalankan:
```bash
eval "$(/usr/local/bin/brew shellenv)"
```
Lalu tutup dan buka ulang Terminal.

**`php -v` masih menunjukkan versi lama (PHP bawaan macOS)**
→ macOS punya PHP bawaan versi lama yang kadang bentrok. Cek dulu:
```bash
which php
```
Jika hasilnya `/usr/bin/php` (bukan `/usr/local/bin/php` atau `/usr/local/opt/php/bin/php`), berarti masih memakai PHP bawaan sistem. Tambahkan baris ini ke `~/.zprofile`:
```bash
echo 'export PATH="/usr/local/opt/php/bin:$PATH"' >> ~/.zprofile
source ~/.zprofile
```

**Error `Access denied for user 'root'@'localhost'`**
→ Password di `.env` tidak cocok dengan password MySQL Anda. Reset password MySQL:
```bash
mysql_secure_installation
```
atau kosongkan `DB_PASSWORD=` di `.env` jika Anda tidak pernah set password.

**MySQL tidak mau start / port 3306 sudah dipakai**
→ Kemungkinan ada instalasi MySQL lain (misalnya dari XAMPP/MAMP yang pernah diinstal sebelumnya) yang masih berjalan. Cek dan hentikan:
```bash
brew services list
sudo lsof -i :3306
```
Matikan service yang bentrok, lalu jalankan ulang `brew services start mysql`.

**`Permission denied` saat Laravel menulis file (storage/logs, cache, dll)**
→ Berikan izin tulis ke folder storage:
```bash
cd ~/sekolah
chmod -R 775 storage bootstrap/cache
```

**Terminal menampilkan `zsh: command not found: php` meski sudah install**
→ Coba install ulang link PHP dan restart terminal:
```bash
brew link php --force
exec zsh
```

**Gagal `composer install` karena masalah SSL/koneksi**
→ Pastikan Wi-Fi stabil. Jika masih gagal, update Composer dulu:
```bash
composer self-update
```

---

## 12. Perintah Harian (Cheat Sheet)

Setelah setup awal selesai, ini perintah yang akan sering Anda pakai tiap kali membuka project lagi:

```bash
# Masuk ke folder project
cd ~/sekolah

# Pastikan MySQL jalan (biasanya sudah auto-start, tapi jika belum)
brew services start mysql

# Jalankan website
php artisan serve
```

Lalu buka browser ke **http://127.0.0.1:8000**.

Untuk menghentikan semuanya saat selesai kerja:
```bash
# Di terminal yang menjalankan artisan serve, tekan Control + C

# Jika ingin mematikan MySQL juga (opsional, biasanya boleh dibiarkan jalan)
brew services stop mysql
```

---

Jika ada perintah yang error di tengah jalan, salin pesan errornya dan tanyakan — bisa dibantu telusuri penyebabnya sesuai konfigurasi Mac Anda.

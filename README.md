<h1 align="center">Seatify – Aplikasi Reservasi dan Pemesanan Photo Studio Berbasis Web </h1>

<h2 align="center">Aplikasi web Laravel untuk sistem reservasi dan pemesanan photo studio oleh pelanggan dan staf studio.</h2>

## 📄 Laporan

-   [Video Presentasi](https://www.youtube.com/watch?v=sdKcxGfGTtQ&ab_channel=DEKAAA)
-   [Video Demo](https://www.youtube.com/watch?v=KH9iqQYzX1E&ab_channel=DEKAAA)
-   [Laporan Akhir PBL Kelompok 7 – Aplikasi Reservasi dan Pemesanan Restaurant Berbasis Web](LaporanAAS_KelasPagi_Kelp7_Aplikasi_Reservasi_dan_Pemesanan_PhotoStudio_Berbasis_Web.pdf)

## 👥 TEAM

-   Zidan Masadita Pramudia - 3312401083
-   Rafi Akhbar Dirgahayuri - 3312401065
-   Dewi Maharani Khairunisa - 3312401063
-   Cahya Sifa Nazwa - 3312401080

## 📌 Fitur Aplikasi

-   Login untuk staf & pelanggan
-   CRUD studio
-   Pemesanan studio oleh pelanggan
-   Persetujuan reservasi oleh staf studio
-   Riwayat transaksi dan pembayaran
-   Dashboard statistik staf studio

## 🧑‍💻 Akun default

#### staf

-   username : admin
-   password : password

#### pelanggan

-   username : masadita
-   password : zzzzzzzz1

## 💻 Cara Instalasi

**Clone Repository**

```bash
 git clone https://github.com/Deka20/PBL_SMT2
 cd pbl_smt2
```

## Buka Terminal Di kode Editor

**Install Dependensi**

```bash
  composer install
  composer dump-autoload
  composer update
```

**Storage Link**

```bash
  php artisan storage:link
```

**Atur Env**

Buat file `.env` baru di root proyek dan isi dengan konfigurasi berikut:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:XHhfUFSvHWsf1ejlUfGSUj0VmEZMuHlow/SurrNMZvI=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pbl_smt2
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tifannyardila8@gmail.com
MAIL_PASSWORD="yvij fqve reat dyae"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tifannyardila8@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

Setelah file `.env` terbuat, ubah informasi sensitif berikut:

1. Konfigurasi email untuk OTP:

    - `MAIL_USERNAME=email@gmail.com` -> Ganti dengan email Gmail Anda
    - `MAIL_PASSWORD=app_password` -> Ganti dengan App Password dari Gmail
    - `MAIL_FROM_ADDRESS=email@gmail.com` -> Ganti dengan email Gmail Anda

2. Konfigurasi database (opsional):
    - `DB_DATABASE=dbreservasirestoran` -> Nama database bisa disesuaikan
    - `DB_USERNAME=root` -> Username database bisa disesuaikan
    - `DB_PASSWORD=` -> Password database jika ada

Terakhir, generate app key baru:

```bash
php artisan key:generate
```

## Cara Mendapatkan Gmail App Password

1. Buka [Google Account Settings](https://myaccount.google.com/)
2. Pilih "Security"
3. Aktifkan "2-Step Verification"
4. Kembali ke Security, pilih "App passwords"
5. Generate App Password untuk aplikasi baru misalnya "Laravel"
6. Salin password yang digenerate ke MAIL_PASSWORD di .env

## Jalankan Web

```bash
  php artisan serve
```

<div align="center">
  <p><sub>Copyright © 2025 Potretine – All rights reserved.</sub></p>
</div>

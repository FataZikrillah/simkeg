<p align="center">
  <img src="public/images/logo.png" alt="SIMKEG Logo" width="120">
</p>

<h1 align="center">SIMKEG</h1>
<h3 align="center">Sistem Informasi Manajemen Kegiatan</h3>

<p align="center">
  <strong>Platform digitalisasi manajemen kegiatan organisasi yang modern, aman, dan mudah digunakan</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/SQLite-Database-003B57?style=for-the-badge&logo=sqlite&logoColor=white" alt="SQLite">
</p>

---

## 📋 Daftar Isi

1. [Tentang Project](#-tentang-project)
2. [Fitur Utama](#-fitur-utama)
3. [Arsitektur Sistem](#-arsitektur-sistem)
4. [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
5. [Struktur Direktori](#-struktur-direktori)
6. [Persyaratan Sistem](#-persyaratan-sistem)
7. [Panduan Instalasi](#-panduan-instalasi)
8. [Konfigurasi Environment](#-konfigurasi-environment)
9. [Database & Migrasi](#-database--migrasi)
10. [Menjalankan Aplikasi](#-menjalankan-aplikasi)
11. [Sistem Role & Akses](#-sistem-role--akses)
12. [Modul-Modul Aplikasi](#-modul-modul-aplikasi)
13. [Web Routes](#-web-routes)
14. [Troubleshooting](#-troubleshooting)
15. [FAQ](#-faq)
16. [Kontribusi](#-kontribusi)
17. [Lisensi](#-lisensi)

---

## 📖 Tentang Project

**SIMKEG (Sistem Informasi Manajemen Kegiatan)** adalah aplikasi web berbasis Laravel yang dirancang untuk mendigitalisasi proses perencanaan, pelaksanaan, dokumentasi, dan pelaporan kegiatan dalam sebuah organisasi atau instansi.

### Latar Belakang

Di era digital saat ini, banyak organisasi masih mengelola kegiatan mereka secara manual menggunakan spreadsheet, dokumen fisik, atau sistem yang tidak terintegrasi. Hal ini menyebabkan:

- ❌ Kesulitan dalam melacak progress kegiatan
- ❌ Data anggaran yang tidak akurat
- ❌ Dokumentasi yang tersebar dan sulit diakses
- ❌ Proses persetujuan yang lambat
- ❌ Laporan yang tidak konsisten

**SIMKEG** hadir sebagai solusi komprehensif untuk mengatasi masalah-masalah tersebut dengan menyediakan:

- ✅ Dashboard terpusat untuk monitoring kegiatan
- ✅ Sistem manajemen anggaran yang transparan
- ✅ Penyimpanan dokumentasi yang terorganisir
- ✅ Workflow persetujuan digital
- ✅ Ekspor laporan dalam format profesional

### Tujuan Pengembangan

1. **Efisiensi Operasional**: Mengurangi waktu yang dibutuhkan untuk mengelola kegiatan hingga 70%
2. **Transparansi**: Memberikan visibilitas penuh terhadap status dan anggaran kegiatan
3. **Akuntabilitas**: Mencatat setiap aktivitas dengan timestamp dan user yang bertanggung jawab
4. **Aksesibilitas**: Dapat diakses dari mana saja melalui browser web
5. **Skalabilitas**: Dapat digunakan oleh organisasi kecil hingga besar

---

## ✨ Fitur Utama

### 🔐 Sistem Multi-Role

SIMKEG menggunakan sistem role-based access control (RBAC) dengan tiga tingkatan akses:

#### 1. Admin (Super User)
```
Akses: /admin/*
```
- Manajemen pengguna (CRUD)
- Kontrol anggaran global
- Audit trail semua aktivitas
- Dashboard statistik organisasi
- Konfigurasi sistem

#### 2. Pimpinan (Manajerial)
```
Akses: /pimpinan/*
```
- Persetujuan/penolakan laporan
- Monitoring kegiatan real-time
- Ekspor laporan PDF profesional
- Review dokumentasi kegiatan

#### 3. Staff (Operasional)
```
Akses: /staff/*
```
- Input kegiatan baru
- Manajemen anggaran kegiatan
- Upload dokumentasi
- Pembuatan laporan
- Filter data dengan AJAX

### 📊 Dashboard Interaktif

Setiap role memiliki dashboard yang disesuaikan dengan kebutuhannya:

**Dashboard Admin:**
- Total kegiatan aktif
- Grafik penggunaan anggaran
- Statistik pengguna
- Activity log terbaru

**Dashboard Pimpinan:**
- Kegiatan pending approval
- Ringkasan anggaran per periode
- Status kegiatan (chart)
- Notifikasi laporan baru

**Dashboard Staff:**
- Kegiatan yang ditugaskan
- Progress kegiatan pribadi
- Reminder deadline
- Quick actions

### 📅 Manajemen Kegiatan

Fitur lengkap untuk mengelola siklus hidup kegiatan:

| Fitur | Deskripsi |
|-------|-----------|
| **Create** | Membuat kegiatan baru dengan detail lengkap |
| **Read** | Melihat daftar dan detail kegiatan |
| **Update** | Mengubah informasi kegiatan |
| **Delete** | Menghapus kegiatan (soft delete) |
| **Filter** | Filter berdasarkan status, prioritas, tanggal |
| **Search** | Pencarian kegiatan berdasarkan judul |
| **Pagination** | Navigasi data dengan pagination AJAX |

### 💰 Manajemen Anggaran

Sistem anggaran yang terintegrasi dengan kegiatan:

- **Input Anggaran**: Mencatat nominal anggaran per kegiatan
- **Kategorisasi**: Mengelompokkan anggaran berdasarkan jenis
- **Tracking**: Melacak realisasi vs rencana
- **Reporting**: Laporan anggaran otomatis

### 📸 Manajemen Dokumentasi

Fitur upload dan pengelolaan dokumentasi:

- **Multi Upload**: Upload banyak file sekaligus
- **Preview**: Preview gambar sebelum upload
- **Gallery View**: Tampilan galeri untuk dokumentasi
- **Modal Detail**: Detail dokumentasi dalam modal
- **Soft Delete**: Penghapusan aman dengan recovery

### 📝 Sistem Laporan

Workflow pelaporan yang terstruktur:

1. **Draft**: Staff membuat draft laporan
2. **Submitted**: Laporan dikirim untuk review
3. **Pending**: Menunggu persetujuan pimpinan
4. **Approved**: Laporan disetujui
5. **Rejected**: Laporan ditolak dengan catatan

### 🖨️ Ekspor PDF

Fitur ekspor laporan ke format PDF dengan tampilan profesional:

- **Kop Surat**: Header institusi yang formal
- **Tabel Data**: Data kegiatan dalam format tabel
- **Filter Dinamis**: PDF mengikuti filter yang aktif
- **Tanda Tangan**: Area tanda tangan pimpinan
- **Print Fallback**: Alternatif cetak via browser

### 🔍 Filter AJAX

Sistem filter real-time tanpa reload halaman:

- Filter berdasarkan status
- Filter berdasarkan prioritas
- Filter berdasarkan rentang tanggal
- Kombinasi multiple filter
- Loading indicator

### 👤 Manajemen Profil

Setiap pengguna dapat mengelola profilnya:

- Update informasi pribadi
- Upload foto profil
- Ganti password
- Lihat statistik aktivitas (Staff)

---

## 🏗️ Arsitektur Sistem

### Diagram Arsitektur

```
┌─────────────────────────────────────────────────────────────┐
│                        CLIENT LAYER                         │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────────────┐  │
│  │   Browser   │  │   Mobile    │  │   Desktop Browser   │  │
│  └──────┬──────┘  └──────┬──────┘  └──────────┬──────────┘  │
└─────────┼────────────────┼────────────────────┼─────────────┘
          │                │                    │
          └────────────────┼────────────────────┘
                           │ HTTP/HTTPS
                           ▼
┌─────────────────────────────────────────────────────────────┐
│                     APPLICATION LAYER                        │
│  ┌─────────────────────────────────────────────────────┐    │
│  │                   Laravel 12                         │    │
│  │  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐  │    │
│  │  │   Routes    │  │ Controllers │  │   Models    │  │    │
│  │  └─────────────┘  └─────────────┘  └─────────────┘  │    │
│  │  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐  │    │
│  │  │ Middleware  │  │    Views    │  │  Services   │  │    │
│  │  └─────────────┘  └─────────────┘  └─────────────┘  │    │
│  └─────────────────────────────────────────────────────┘    │
└─────────────────────────────────────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────────┐
│                      DATA LAYER                              │
│  ┌─────────────────────────────────────────────────────┐    │
│  │                    SQLite                            │    │
│  │  ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌───────────┐  │    │
│  │  │  Users  │ │Kegiatan │ │Anggaran │ │Dokumentasi│  │    │
│  │  └─────────┘ └─────────┘ └─────────┘ └───────────┘  │    │
│  │  ┌─────────┐ ┌─────────┐                            │    │
│  │  │ Laporan │ │Sessions │                            │    │
│  │  └─────────┘ └─────────┘                            │    │
│  └─────────────────────────────────────────────────────┘    │
└─────────────────────────────────────────────────────────────┘
```

### Pola Desain yang Digunakan

1. **MVC (Model-View-Controller)**
   - Model: Representasi data dan business logic
   - View: Tampilan menggunakan Blade templates
   - Controller: Penghubung antara Model dan View

2. **Repository Pattern** (Parsial)
   - Abstraksi akses data
   - Memudahkan testing

3. **Middleware Pattern**
   - Autentikasi pengguna
   - Otorisasi berdasarkan role
   - CSRF protection

4. **Observer Pattern**
   - Event handling untuk logging
   - Notifikasi perubahan status

---

## 🛠️ Teknologi yang Digunakan

### Backend

| Teknologi | Versi | Kegunaan |
|-----------|-------|----------|
| **PHP** | 8.2+ | Bahasa pemrograman server-side |
| **Laravel** | 12.x | Framework PHP modern |
| **Eloquent ORM** | - | Object-Relational Mapping |
| **Blade** | - | Template engine |
| **Artisan** | - | CLI untuk Laravel |

### Frontend

| Teknologi | Versi | Kegunaan |
|-----------|-------|----------|
| **TailwindCSS** | 3.x | Utility-first CSS framework |
| **Alpine.js** | - | Lightweight JavaScript framework |
| **Vite** | 5.x | Build tool dan dev server |
| **Font Awesome** | 6.x | Icon library |

### Database

| Teknologi | Kegunaan |
|-----------|----------|
| **SQLite** | Database file-based (default) |
| **MySQL** | Alternatif untuk production |
| **PostgreSQL** | Alternatif untuk production |

### Packages & Libraries

| Package | Kegunaan |
|---------|----------|
| **barryvdh/laravel-dompdf** | Generasi PDF |
| **laravel/tinker** | REPL untuk debugging |
| **laravel/pail** | Log viewer |

### Development Tools

| Tool | Kegunaan |
|------|----------|
| **Laravel Pint** | PHP code formatter |
| **PHPUnit** | Testing framework |
| **Mockery** | Mocking library |
| **Faker** | Data generator untuk testing |

---

## 📁 Struktur Direktori

```
simkeg/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── AnggaranController.php
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── DokumentasiController.php
│   │   │   │   ├── KegiatanController.php
│   │   │   │   ├── LaporanController.php
│   │   │   │   ├── ProfileController.php
│   │   │   │   └── UserController.php
│   │   │   ├── Pimpinan/
│   │   │   │   ├── AnggaranController.php
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── KegiatanController.php
│   │   │   │   ├── LaporanController.php
│   │   │   │   └── ProfileController.php
│   │   │   ├── Staff/
│   │   │   │   ├── AnggaranController.php
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── DokumentasiController.php
│   │   │   │   ├── KegiatanController.php
│   │   │   │   ├── LaporanController.php
│   │   │   │   └── ProfileController.php
│   │   │   └── AuthController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
│       ├── Anggaran.php
│       ├── Dokumentasi.php
│       ├── Kegiatan.php
│       ├── Laporan.php
│       └── User.php
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── database.php
│   └── ...
├── database/
│   ├── factories/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── xxxx_create_kegiatan_table.php
│   │   ├── xxxx_create_anggaran_table.php
│   │   ├── xxxx_create_dokumentasi_table.php
│   │   └── xxxx_create_laporan_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── public/
│   ├── images/
│   │   └── logo.png
│   ├── css/
│   └── js/
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   └── app.js
│   └── views/
│       ├── auth/
│       │   └── login.blade.php
│       ├── layouts/
│       │   └── app.blade.php
│       ├── page/
│       │   ├── admin/
│       │   │   ├── anggaran/
│       │   │   ├── dashboard.blade.php
│       │   │   ├── dokumentasi/
│       │   │   ├── kegiatan/
│       │   │   ├── laporan/
│       │   │   ├── pengguna/
│       │   │   └── profile/
│       │   ├── pimpinan/
│       │   │   ├── anggaran/
│       │   │   ├── dashboard.blade.php
│       │   │   ├── kegiatan/
│       │   │   ├── laporan/
│       │   │   └── profile/
│       │   └── staff/
│       │       ├── anggaran/
│       │       ├── dashboard.blade.php
│       │       ├── dokumentasi/
│       │       ├── kegiatan/
│       │       ├── laporan/
│       │       └── profile/
│       └── partials/
│           ├── header.blade.php
│           ├── nav-links.blade.php
│           └── sidebar.blade.php
├── routes/
│   └── web.php
├── storage/
│   ├── app/
│   │   └── public/
│   ├── framework/
│   └── logs/
├── tests/
├── .env.example
├── artisan
├── composer.json
├── package.json
├── tailwind.config.js
├── vite.config.js
└── README.md
```

---

## 💻 Persyaratan Sistem

### Minimum Requirements

| Komponen | Versi Minimum |
|----------|---------------|
| **PHP** | 8.2 |
| **Composer** | 2.0 |
| **Node.js** | 18.0 |
| **NPM** | 8.0 |

### PHP Extensions Required

```
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
```

### Recommended Development Environment

- **XAMPP** 8.2+ (Windows)
- **Laragon** (Windows - Recommended)
- **Laravel Valet** (macOS)
- **Docker** dengan Laravel Sail (Cross-platform)

---

## 📥 Panduan Instalasi

### Metode 1: Git Clone (Recommended)

#### Step 1: Clone Repository

```bash
# Clone repository ke folder lokal
git clone https://github.com/[USERNAME]/simkeg.git

# Masuk ke direktori project
cd simkeg
```

#### Step 2: Install PHP Dependencies

```bash
# Install dependencies menggunakan Composer
composer install
```

> ⚠️ **Catatan**: Jika terjadi error saat instalasi, lihat bagian [Troubleshooting](#-troubleshooting)

#### Step 3: Install JavaScript Dependencies

```bash
# Install dependencies menggunakan NPM
npm install
```

#### Step 4: Setup Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### Step 5: Setup Database

```bash
# Untuk SQLite (default), pastikan file database ada
touch database/database.sqlite

# Jalankan migrasi database
php artisan migrate

# (Opsional) Jalankan seeder untuk data dummy
php artisan db:seed
```

#### Step 6: Setup Storage Link

```bash
# Buat symbolic link untuk storage
php artisan storage:link
```

#### Step 7: Build Assets

```bash
# Build assets untuk development
npm run dev

# ATAU build untuk production
npm run build
```

#### Step 8: Jalankan Aplikasi

```bash
# Jalankan development server
php artisan serve
```

Buka browser dan akses: `http://localhost:8000`

### Metode 2: Laravel Installer

```bash
# Install Laravel Installer (jika belum)
composer global require laravel/installer

# Clone dan setup
git clone https://github.com/[USERNAME]/simkeg.git
cd simkeg

# Jalankan script setup otomatis
composer run-script setup
```

### Metode 3: Docker dengan Laravel Sail

```bash
# Clone repository
git clone https://github.com/[USERNAME]/simkeg.git
cd simkeg

# Copy environment
cp .env.example .env

# Install dependencies (dalam container)
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

# Jalankan dengan Sail
./vendor/bin/sail up -d

# Setup database
./vendor/bin/sail artisan migrate --seed
```

---

## ⚙️ Konfigurasi Environment

### File .env

Berikut adalah konfigurasi penting dalam file `.env`:

```env
# Application Settings
APP_NAME=SIMKEG
APP_ENV=local
APP_KEY=base64:GENERATED_KEY_HERE
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=simkeg
# DB_USERNAME=root
# DB_PASSWORD=

# Session Configuration
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Cache Configuration
CACHE_DRIVER=file

# Queue Configuration
QUEUE_CONNECTION=sync

# Filesystem Configuration
FILESYSTEM_DISK=local

# Mail Configuration (Opsional)
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Konfigurasi Database Alternatif

#### Menggunakan MySQL

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simkeg
DB_USERNAME=root
DB_PASSWORD=your_password
```

#### Menggunakan PostgreSQL

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=simkeg
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

---

## 🗄️ Database & Migrasi

### Entity Relationship Diagram

```
┌─────────────┐       ┌─────────────┐       ┌─────────────┐
│    Users    │       │  Kegiatan   │       │  Anggaran   │
├─────────────┤       ├─────────────┤       ├─────────────┤
│ id          │───┐   │ id          │───┐   │ id          │
│ name        │   │   │ judul       │   │   │ kegiatan_id │──┐
│ email       │   │   │ deskripsi   │   │   │ nominal     │  │
│ password    │   │   │ tanggal     │   │   │ keterangan  │  │
│ role        │   │   │ lokasi      │   │   │ created_at  │  │
│ phone       │   │   │ prioritas   │   │   │ updated_at  │  │
│ bio         │   │   │ status      │   │   └─────────────┘  │
│ photo       │   └──►│ user_id     │◄──────────────────────┘
│ created_at  │       │ image       │
│ updated_at  │       │ created_at  │       ┌─────────────┐
└─────────────┘       │ updated_at  │       │ Dokumentasi │
                      └──────┬──────┘       ├─────────────┤
                             │              │ id          │
                             │              │ kegiatan_id │──┐
                             │              │ judul       │  │
                             │              │ file_path   │  │
                             │              │ keterangan  │  │
                             │              │ created_at  │  │
                             │              │ updated_at  │  │
                             │              └─────────────┘  │
                             │                               │
                             └───────────────────────────────┘
                             
                      ┌─────────────┐
                      │   Laporan   │
                      ├─────────────┤
                      │ id          │
                      │ kegiatan_id │
                      │ user_id     │
                      │ judul       │
                      │ isi         │
                      │ status      │
                      │ catatan     │
                      │ created_at  │
                      │ updated_at  │
                      └─────────────┘
```

### Tabel Database

#### Tabel `users`

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT | Primary key |
| name | VARCHAR(255) | Nama lengkap |
| email | VARCHAR(255) | Email (unique) |
| password | VARCHAR(255) | Password (hashed) |
| role | ENUM | 'admin', 'pimpinan', 'staff' |
| phone | VARCHAR(20) | Nomor telepon |
| bio | TEXT | Biografi singkat |
| photo | VARCHAR(255) | Path foto profil |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

#### Tabel `kegiatan`

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT | Primary key |
| judul | VARCHAR(255) | Judul kegiatan |
| deskripsi | TEXT | Deskripsi lengkap |
| tanggal | DATE | Tanggal pelaksanaan |
| waktu_mulai | TIME | Waktu mulai |
| lokasi | VARCHAR(255) | Lokasi kegiatan |
| prioritas | ENUM | 'tinggi', 'sedang', 'rendah' |
| status | ENUM | 'pending', 'disetujui', 'ditolak', 'selesai' |
| user_id | BIGINT | Foreign key ke users |
| image | VARCHAR(255) | Path gambar kegiatan |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

#### Tabel `anggaran`

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT | Primary key |
| kegiatan_id | BIGINT | Foreign key ke kegiatan |
| nominal | DECIMAL(15,2) | Jumlah anggaran |
| keterangan | TEXT | Keterangan anggaran |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

#### Tabel `dokumentasi`

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT | Primary key |
| kegiatan_id | BIGINT | Foreign key ke kegiatan |
| judul | VARCHAR(255) | Judul dokumentasi |
| file_path | VARCHAR(255) | Path file |
| keterangan | TEXT | Keterangan |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

#### Tabel `laporan`

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT | Primary key |
| kegiatan_id | BIGINT | Foreign key ke kegiatan |
| user_id | BIGINT | Foreign key ke users |
| judul | VARCHAR(255) | Judul laporan |
| isi | TEXT | Isi laporan |
| status | ENUM | 'pending', 'approved', 'rejected' |
| catatan | TEXT | Catatan reviewer |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### Menjalankan Migrasi

```bash
# Menjalankan semua migrasi
php artisan migrate

# Menjalankan migrasi dengan seeder
php artisan migrate --seed

# Rollback migrasi terakhir
php artisan migrate:rollback

# Reset semua migrasi
php artisan migrate:reset

# Refresh migrasi (rollback + migrate)
php artisan migrate:refresh

# Fresh install (drop all tables + migrate)
php artisan migrate:fresh --seed
```

---

## 🚀 Menjalankan Aplikasi

### Development Mode

Untuk pengembangan, jalankan dua terminal secara bersamaan:

**Terminal 1 - Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 - Vite Dev Server:**
```bash
npm run dev
```

### Production Mode

```bash
# Build assets untuk production
npm run build

# Optimize aplikasi
php artisan optimize

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Cache config
php artisan config:cache
```

### Menggunakan Composer Script

Project ini menyediakan script otomatis:

```bash
# Development mode (menjalankan semua service)
composer run-script dev
```

Script ini akan menjalankan:
- `php artisan serve` - Web server
- `php artisan queue:listen` - Queue worker
- `php artisan pail` - Log viewer
- `npm run dev` - Vite dev server

---

## 👥 Sistem Role & Akses

### Definisi Role

| Role | Deskripsi | Akses Menu |
|------|-----------|------------|
| **Admin** | Administrator sistem dengan akses penuh | Semua menu + User Management |
| **Pimpinan** | Level manajerial untuk approval dan monitoring | Dashboard, Kegiatan (View), Anggaran, Laporan (Approve), Profile |
| **Staff** | Level operasional untuk input dan pengelolaan data | Dashboard, Kegiatan (CRUD), Anggaran, Dokumentasi, Laporan, Profile |

### Middleware Role

File: `app/Http/Middleware/RoleMiddleware.php`

```php
public function handle(Request $request, Closure $next, ...$roles)
{
    if (!Auth::check()) {
        return redirect('login');
    }

    if (!in_array(Auth::user()->role, $roles)) {
        abort(403, 'Unauthorized action.');
    }

    return $next($request);
}
```

### Penggunaan dalam Routes

```php
// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // ...
});

// Pimpinan routes
Route::middleware(['auth', 'role:pimpinan'])->prefix('pimpinan')->group(function () {
    // ...
});

// Staff routes
Route::middleware(['auth', 'role:staff'])->prefix('staff')->group(function () {
    // ...
});
```

### Akun Default untuk Testing

Setelah menjalankan seeder, gunakan akun berikut:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@simkeg.com | password |
| Pimpinan | pimpinan@simkeg.com | password |
| Staff | staff@simkeg.com | password |

---

## 📦 Modul-Modul Aplikasi

### 1. Modul Autentikasi

**Controller:** `AuthController.php`

**Fitur:**
- Login dengan email & password
- Logout
- Remember me
- Session management

**Routes:**
```
GET  /login          - Halaman login
POST /login          - Proses login
POST /logout         - Proses logout
```

### 2. Modul Dashboard

**Controllers:**
- `Admin/DashboardController.php`
- `Pimpinan/DashboardController.php`
- `Staff/DashboardController.php`

**Fitur:**
- Statistik kegiatan
- Grafik anggaran
- Activity log
- Quick actions

### 3. Modul Kegiatan

**Controllers:**
- `Admin/KegiatanController.php`
- `Pimpinan/KegiatanController.php`
- `Staff/KegiatanController.php`

**Fitur:**
- CRUD kegiatan
- Filter AJAX
- Pagination
- Export PDF
- Status management

**Routes Staff:**
```
GET    /staff/kegiatan              - Daftar kegiatan
GET    /staff/kegiatan/create       - Form tambah
POST   /staff/kegiatan              - Simpan kegiatan
GET    /staff/kegiatan/{id}         - Detail kegiatan
GET    /staff/kegiatan/{id}/edit    - Form edit
PUT    /staff/kegiatan/{id}         - Update kegiatan
DELETE /staff/kegiatan/{id}         - Hapus kegiatan
```

### 4. Modul Anggaran

**Controllers:**
- `Admin/AnggaranController.php`
- `Pimpinan/AnggaranController.php`
- `Staff/AnggaranController.php`

**Fitur:**
- Input anggaran per kegiatan
- Kategorisasi anggaran
- Laporan realisasi
- Grafik penggunaan

### 5. Modul Dokumentasi

**Controllers:**
- `Admin/DokumentasiController.php`
- `Staff/DokumentasiController.php`

**Fitur:**
- Upload gambar/dokumen
- Preview sebelum upload
- Gallery view
- Modal detail
- Soft delete

### 6. Modul Laporan

**Controllers:**
- `Admin/LaporanController.php`
- `Pimpinan/LaporanController.php`
- `Staff/LaporanController.php`

**Fitur:**
- Pembuatan laporan
- Workflow approval
- Catatan reviewer
- History status

### 7. Modul User Management

**Controller:** `Admin/UserController.php`

**Fitur:**
- CRUD pengguna
- Assign role
- Reset password
- Aktivasi/deaktivasi

### 8. Modul Profile

**Controllers:**
- `Admin/ProfileController.php`
- `Pimpinan/ProfileController.php`
- `Staff/ProfileController.php`

**Fitur:**
- Update informasi pribadi
- Upload foto profil
- Ganti password
- Statistik aktivitas

---

## 🌐 Web Routes

### Daftar Route Lengkap

Aplikasi ini menggunakan **web routes** (bukan REST API) untuk semua fitur. Berikut adalah daftar lengkap route yang tersedia:

```
+--------+----------------------------------------+------------------------------------------+
| Method | URI                                    | Action                                   |
+--------+----------------------------------------+------------------------------------------+
| GET    | /                                      | Redirect to /login                       |
| GET    | /login                                 | AuthController@showLogin                 |
| POST   | /login                                 | AuthController@login                     |
| POST   | /logout                                | AuthController@logout                    |
+--------+----------------------------------------+------------------------------------------+
|                              ADMIN ROUTES                                              |
+--------+----------------------------------------+------------------------------------------+
| GET    | /admin/dashboard                       | Admin\DashboardController@index          |
| GET    | /admin/kegiatan                        | Admin\KegiatanController@index           |
| GET    | /admin/kegiatan/create                 | Admin\KegiatanController@create          |
| POST   | /admin/kegiatan                        | Admin\KegiatanController@store           |
| GET    | /admin/kegiatan/{id}                   | Admin\KegiatanController@show            |
| GET    | /admin/kegiatan/{id}/edit              | Admin\KegiatanController@edit            |
| PUT    | /admin/kegiatan/{id}                   | Admin\KegiatanController@update          |
| DELETE | /admin/kegiatan/{id}                   | Admin\KegiatanController@destroy         |
| GET    | /admin/kegiatan/{id}/export            | Admin\KegiatanController@export          |
| GET    | /admin/anggaran                        | Admin\AnggaranController@index           |
| ...    | ...                                    | ...                                       |
| GET    | /admin/pengguna                        | Admin\UserController@index               |
| GET    | /admin/pengguna/create                 | Admin\UserController@create              |
| POST   | /admin/pengguna                        | Admin\UserController@store               |
| GET    | /admin/pengguna/{id}/edit              | Admin\UserController@edit                |
| PUT    | /admin/pengguna/{id}                   | Admin\UserController@update              |
| DELETE | /admin/pengguna/{id}                   | Admin\UserController@destroy             |
| GET    | /admin/profile                         | Admin\ProfileController@index            |
| PUT    | /admin/profile                         | Admin\ProfileController@update           |
| PUT    | /admin/profile/password                | Admin\ProfileController@updatePassword   |
+--------+----------------------------------------+------------------------------------------+
|                            PIMPINAN ROUTES                                             |
+--------+----------------------------------------+------------------------------------------+
| GET    | /pimpinan/dashboard                    | Pimpinan\DashboardController@index       |
| GET    | /pimpinan/kegiatan                     | Pimpinan\KegiatanController@index        |
| GET    | /pimpinan/kegiatan/{id}                | Pimpinan\KegiatanController@show         |
| GET    | /pimpinan/kegiatan/export-pdf          | Pimpinan\KegiatanController@exportPdf    |
| GET    | /pimpinan/anggaran                     | Pimpinan\AnggaranController@index        |
| ...    | ...                                    | ...                                       |
| PATCH  | /pimpinan/laporan/{id}/approve         | Pimpinan\LaporanController@approve       |
| GET    | /pimpinan/profile                      | Pimpinan\ProfileController@index         |
| PUT    | /pimpinan/profile                      | Pimpinan\ProfileController@update        |
| PUT    | /pimpinan/profile/password             | Pimpinan\ProfileController@updatePassword|
+--------+----------------------------------------+------------------------------------------+
|                              STAFF ROUTES                                              |
+--------+----------------------------------------+------------------------------------------+
| GET    | /staff/dashboard                       | Staff\DashboardController@index          |
| GET    | /staff/kegiatan                        | Staff\KegiatanController@index           |
| GET    | /staff/kegiatan/create                 | Staff\KegiatanController@create          |
| POST   | /staff/kegiatan                        | Staff\KegiatanController@store           |
| GET    | /staff/kegiatan/{id}                   | Staff\KegiatanController@show            |
| GET    | /staff/kegiatan/{id}/edit              | Staff\KegiatanController@edit            |
| PUT    | /staff/kegiatan/{id}                   | Staff\KegiatanController@update          |
| DELETE | /staff/kegiatan/{id}                   | Staff\KegiatanController@destroy         |
| GET    | /staff/anggaran                        | Staff\AnggaranController@index           |
| ...    | ...                                    | ...                                       |
| GET    | /staff/dokumentasi                     | Staff\DokumentasiController@index        |
| POST   | /staff/dokumentasi                     | Staff\DokumentasiController@store        |
| DELETE | /staff/dokumentasi/{id}                | Staff\DokumentasiController@destroy      |
| GET    | /staff/laporan                         | Staff\LaporanController@index            |
| POST   | /staff/laporan                         | Staff\LaporanController@store            |
| GET    | /staff/profile                         | Staff\ProfileController@index            |
| PUT    | /staff/profile                         | Staff\ProfileController@update           |
| PUT    | /staff/profile/password                | Staff\ProfileController@updatePassword   |
+--------+----------------------------------------+------------------------------------------+
```

---

## 🔧 Troubleshooting

### Masalah Umum dan Solusinya

#### 1. Error: "Class Barryvdh\DomPDF\Facade\Pdf not found"

**Penyebab:**
Library `barryvdh/laravel-dompdf` belum terinstal dengan benar.

**Solusi:**

```bash
# Langkah 1: Pastikan package ada di composer.json
# Cek bagian "require" harus ada:
# "barryvdh/laravel-dompdf": "^3.1"

# Langkah 2: Jalankan update
composer update barryvdh/laravel-dompdf --no-scripts

# Langkah 3: Clear cache
php artisan optimize:clear

# Langkah 4: Restart server
php artisan serve
```

**Solusi Alternatif (Jika tetap error):**

```bash
# Hapus vendor dan composer.lock
rm -rf vendor
rm composer.lock

# Install ulang semua dependencies
composer install

# Jika masih error, coba dengan flag ignore
composer install --ignore-platform-reqs
```

**Fallback Solution:**
Aplikasi telah dilengkapi dengan fallback browser print. Jika DomPDF tidak terinstal, sistem akan otomatis membuka halaman print-friendly yang bisa disimpan sebagai PDF melalui browser.

#### 2. Error: "SQLSTATE[HY000]: General error: 1 no such table"

**Penyebab:**
Migrasi database belum dijalankan atau file SQLite tidak ada.

**Solusi:**

```bash
# Buat file database SQLite
touch database/database.sqlite

# Jalankan migrasi
php artisan migrate

# Jika perlu fresh install
php artisan migrate:fresh --seed
```

#### 3. Error: "The Mix manifest does not exist"

**Penyebab:**
Assets belum di-build atau menggunakan konfigurasi lama.

**Solusi:**

```bash
# Install npm dependencies
npm install

# Build assets
npm run build

# Atau untuk development
npm run dev
```

#### 4. Error: "Permission denied" saat upload file

**Penyebab:**
Folder storage tidak memiliki permission yang benar.

**Solusi:**

```bash
# Linux/macOS
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Buat symbolic link storage
php artisan storage:link
```

#### 5. Error: "Session store not set on request"

**Penyebab:**
Session tidak dikonfigurasi dengan benar.

**Solusi:**

```bash
# Clear session
php artisan session:table
php artisan migrate

# Atau ubah SESSION_DRIVER di .env
SESSION_DRIVER=file

# Clear cache
php artisan config:clear
```

#### 6. Halaman blank tanpa error

**Penyebab:**
APP_DEBUG = false tanpa log yang jelas.

**Solusi:**

```bash
# Ubah di .env
APP_DEBUG=true

# Cek log
tail -f storage/logs/laravel.log

# Clear semua cache
php artisan optimize:clear
```

#### 7. Error: "Route not found"

**Penyebab:**
Route cache yang outdated.

**Solusi:**

```bash
# Clear route cache
php artisan route:clear

# List semua routes
php artisan route:list
```

#### 8. Error saat composer install: "Your requirements could not be resolved"

**Penyebab:**
Konflik versi PHP atau package.

**Solusi:**

```bash
# Update composer
composer self-update

# Install dengan flag
composer install --ignore-platform-reqs

# Atau update dependency lock
composer update --with-all-dependencies
```

#### 9. Gambar/file tidak tampil

**Penyebab:**
Storage link belum dibuat atau path salah.

**Solusi:**

```bash
# Buat storage link
php artisan storage:link

# Verifikasi
ls -la public/storage
```

#### 10. AJAX request gagal (419 error)

**Penyebab:**
CSRF token tidak valid atau expired.

**Solusi:**

```javascript
// Pastikan header CSRF ada di request
fetch(url, {
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'X-Requested-With': 'XMLHttpRequest'
    }
});
```

---

## ❓ FAQ

### Q: Bagaimana cara menambah role baru?

**A:** 
1. Update kolom `role` di migrasi users
2. Buat middleware baru atau update `RoleMiddleware`
3. Buat controller dan routes untuk role tersebut
4. Buat views sesuai kebutuhan

### Q: Bagaimana mengubah database ke MySQL?

**A:**
1. Install MySQL server
2. Buat database baru
3. Update `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simkeg
DB_USERNAME=root
DB_PASSWORD=your_password
```
4. Jalankan `php artisan migrate:fresh --seed`

### Q: Bagaimana deploy ke production?

**A:**
1. Setup server (Apache/Nginx + PHP-FPM)
2. Clone repository ke server
3. Set `APP_ENV=production` dan `APP_DEBUG=false`
4. Jalankan optimisasi:
```bash
composer install --no-dev --optimize-autoloader
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Q: Bagaimana menambah fitur notifikasi email?

**A:**
1. Konfigurasi SMTP di `.env`
2. Buat notification class: `php artisan make:notification KegiatanCreated`
3. Implement interface `Notifiable` di model User
4. Gunakan `$user->notify(new KegiatanCreated($kegiatan))`

### Q: Apakah bisa diakses dari mobile?

**A:** Ya, aplikasi ini responsive dan dapat diakses dari perangkat mobile melalui browser.

### Q: Bagaimana cara backup database?

**A:**
```bash
# SQLite
cp database/database.sqlite database/backup_$(date +%Y%m%d).sqlite

# MySQL
mysqldump -u root -p simkeg > backup.sql
```

---

## 🤝 Kontribusi

Kami menerima kontribusi dari siapa saja. Berikut cara berkontribusi:

### 1. Fork Repository

Klik tombol "Fork" di GitHub untuk membuat copy repository.

### 2. Clone Fork Anda

```bash
git clone https://github.com/[YOUR_USERNAME]/simkeg.git
cd simkeg
```

### 3. Buat Branch Baru

```bash
git checkout -b feature/nama-fitur-baru
```

### 4. Lakukan Perubahan

Ikuti coding standards:
- PSR-12 untuk PHP
- Blade directive standards
- JavaScript ES6+

### 5. Commit Perubahan

```bash
git add .
git commit -m "feat: menambahkan fitur X"
```

Format commit message:
- `feat:` untuk fitur baru
- `fix:` untuk bug fix
- `docs:` untuk dokumentasi
- `style:` untuk formatting
- `refactor:` untuk refactoring
- `test:` untuk testing

### 6. Push ke GitHub

```bash
git push origin feature/nama-fitur-baru
```

### 7. Buat Pull Request

Buka GitHub dan buat Pull Request dari branch Anda ke `main`.

---

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

```
MIT License

Copyright (c) 2026 SIMKEG Team

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

## 📞 Kontak & Support

- **Email**: support@simkeg.com
- **Website**: https://www.simkeg.com
- **GitHub Issues**: [Laporkan Bug](https://github.com/[USERNAME]/simkeg/issues)

---

<p align="center">
  <strong>© 2026 SIMKEG Team. Built with ❤️ for better activity management.</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Made%20with-Laravel-FF2D20?style=flat-square&logo=laravel" alt="Made with Laravel">
  <img src="https://img.shields.io/badge/Styled%20with-TailwindCSS-06B6D4?style=flat-square&logo=tailwindcss" alt="Styled with TailwindCSS">
</p>

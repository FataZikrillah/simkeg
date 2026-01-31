# SIMKEG - Sistem Informasi Manajemen Kegiatan

SIMKEG adalah aplikasi platform manajemen internal yang dirancang untuk mendigitalisasi proses perencanaan, pelaksanaan, dan pelaporan kegiatan. Aplikasi ini menekankan pada kemudahan pemantauan anggaran serta keteraturan dokumentasi di setiap tahap kegiatan.

## 🚀 Fitur Utama Berdasarkan Peran

Aplikasi ini menggunakan sistem Multi-Role yang terbagi menjadi tiga tingkatan akses:

### 1. 🛡️ Admin (Super User)
*   **Manajemen User**: Menambah, mengubah, dan menonaktifkan akun Staff maupun Pimpinan.
*   **Kontrol Anggaran Global**: Memantau seluruh arus kas anggaran kegiatan di sistem.
*   **Audit Laporan**: Memiliki akses baca ke seluruh laporan yang dikirimkan.
*   **Premium Dashboard**: Grafik statistik performa organisasi dan rekapitulasi data.

### 2. 👨‍💼 Pimpinan (Manajerial)
*   **Approval System**: Melakukan persetujuan (Approve) atau penolakan (Reject) terhadap laporan kegiatan staff.
*   **Ekspor Laporan PDF**: Fitur ekspor daftar kegiatan ke format PDF yang rapi, didukung dengan filter dinamis (status, prioritas, tanggal).
*   **Monitoring Real-time**: Memantau progress kegiatan yang sedang berlangsung dan penggunaan anggarannya.

### 3. 🧑‍💻 Staff (Operasional)
*   **Input Kegiatan**: Membuat entri kegiatan baru dengan atribut prioritas dan jadwal.
*   **Manajemen Anggaran & Dokumentasi**: Mencatat pengeluaran anggaran dan mengunggah foto bukti kegiatan secara detail.
*   **Pelaporan AJAX**: Filter data kegiatan yang cepat tanpa reload halaman menggunakan teknologi AJAX Fetch.
*   **Submission Laporan**: Mengirimkan laporan akhir kegiatan untuk direview oleh Pimpinan.

## 🛠️ Teknologi yang Digunakan
*   **Backend**: Laravel 12 (PHP 8.2+)
*   **Database**: SQLite (Ringan & Cepat)
*   **Frontend**: Tailwind CSS (Desain Premium & Responsive)
*   **Interaktivitas**: JavaScript Vanilla (AJAX Fetch API)
*   **Reporting**: barryvdh/laravel-dompdf

## 📥 Panduan Instalasi (Git Clone)

Ikuti langkah-langkah di bawah ini untuk menjalankan project di lingkungan lokal Anda:

1.  **Clone Repositori**:
    ```bash
    git clone [URL_REPO_ANDA]
    cd Simkeg/simkeg
    ```

2.  **Instal PHP Dependencies**:
    ```bash
    composer install
    ```

3.  **Instal Front-end Dependencies**:
    ```bash
    npm install
    ```

4.  **Konfigurasi Environment**:
    Salin file contoh konfigurasi ke `.env`:
    ```bash
    cp .env.example .env
    ```
    Buka file `.env` dan pastikan pengaturan database mengarah ke SQLite (default):
    `DB_CONNECTION=sqlite`

5.  **Generate App Key & Database**:
    ```bash
    php artisan key:generate
    php artisan migrate --seed
    ```

6.  **Jalankan Aplikasi**:
    Buka dua terminal dan jalankan perintah berikut:
    *   Terminal 1: `php artisan serve`
    *   Terminal 2: `npm run dev`

---

## ⚠️ Troubleshooting: Masalah DomPDF

Salah satu kendala umum saat instalasi adalah error:
`Class "Barryvdh\DomPDF\Facade\Pdf" not found` atau error saat `composer install`.

### Masalah
Hal ini terjadi karena library `dompdf` gagal diunduh atau diekstrak secara sempurna oleh Composer karena kendala jaringan atau pembatasan sistem (timeout).

### Solusi Cepat
Jika Anda menemui error tersebut, jalankan perintah perintah "Force Install" berikut di terminal Anda:

```bash
composer update barryvdh/laravel-dompdf --no-scripts
```

**Jika cara di atas gagal:**
1.  Hapus folder `vendor/` dan file `composer.lock`.
2.  Jalankan `composer install --no-scripts`.
3.  Jalankan `php artisan optimize:clear`.

---
© 2026 **SIMKEG Team**. Built with ❤️ for better activity management.

# Mou-Makan (Bicara Kopi) - POS & Restaurant Management System

[![PHP Version](https://img.shields.io/badge/PHP-5.6%20--%208.4+-777BB4?logo=php&logoColor=white)](https://php.net/)
[![Framework](https://img.shields.io/badge/CodeIgniter-3.1.13-EE4326?logo=codeigniter&logoColor=white)](https://codeigniter.com/)
[![Database](https://img.shields.io/badge/MySQL%20%2F%20MariaDB-00618A?logo=mysql&logoColor=white)](https://mariadb.org/)
[![UI Template](https://img.shields.io/badge/AdminLTE-2.3.8-3c8dbc?logo=bootstrap&logoColor=white)](https://adminlte.io/)

**Mou-Makan (Bicara Kopi)** adalah aplikasi *Point of Sale* (POS) dan manajemen restoran/kafe berbasis web. Sistem ini mencakup pengelolaan pesanan meja, reservasi meja (booking), transaksi kasir, manajemen modal & pajak harian, absensi karyawan, hingga pelaporan dan analitik penjualan dengan ekspor Excel.

Aplikasi ini telah diperbarui sehingga **kompatibel penuh dari PHP 5.6 hingga PHP 8.4+** dan dapat dijalankan langsung di luar folder `htdocs` tanpa kendala.

---

## 📑 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Hak Akses Pengguna](#-hak-akses-pengguna)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Panduan Instalasi & Database](#-panduan-instalasi--database)
- [Cara Menjalankan Project (Di Luar Htdocs)](#-cara-menjalankan-project-di-luar-htdocs)
  - [Opsi 1: PHP Built-in Server (Rekomendasi)](#opsi-1-php-built-in-server-rekomendasi-paling-mudah)
  - [Opsi 2: Directory Junction / Symlink ke Htdocs](#opsi-2-directory-junction--symlink-ke-htdocs)
  - [Opsi 3: Apache VirtualHost](#opsi-3-apache-virtualhost-domain-lokal)
- [Akun Demo / Kredensial Default](#-akun-demo--kredensial-default)
- [Struktur Folder](#-struktur-folder)
- [Pembaruan & Kompatibilitas PHP 8.x](#-pembaruan--kompatibilitas-php-8x)

---

## 🚀 Fitur Utama

- 📊 **Dashboard & Grafik Penjualan**: Visualisasi omset transaksi harian dan tren penjualan resto.
- 🍽️ **Manajemen Menu & Kategori**: Kelola daftar hidangan, harga, foto makanan/minuman, dan kategori dapur.
- 🪑 **Manajemen Meja & Reservasi (Booking)**: Pemetaan nomor meja, penandaan status aktif/kosong/terpakai, dan reservasi pelanggan.
- 💵 **Transaksi Kasir (POS)**:
  - Input pesanan langsung atau berdasarkan meja.
  - Perhitungan subtotal, diskon (opsional), dan pajak resto otomatis.
  - Pencatatan modal awal shift kasir.
  - Cetak struk/nota pembayaran kasir.
- 🕒 **Sistem Absensi Karyawan**: Rekap jam masuk (*in*) dan pulang (*out*) karyawan per shift kerja beserta fitur auto-checkout.
- 📈 **Pelaporan & Ekspor**: Laporan penjualan per periode (harian, mingguan, bulanan) dengan ekspor ke format Microsoft Excel modern (`.xlsx`) menggunakan **PhpSpreadsheet**.

---

## 👥 Hak Akses Pengguna

Aplikasi memiliki 3 level hak akses utama:

| Peran | Pilihan Dropdown | Deskripsi & Wewenang |
| :--- | :--- | :--- |
| **Admin** | `Administrasi` | Akses penuh: manajemen menu, meja, data karyawan, modal/pajak, grafik penjualan, dan ekspor seluruh laporan keuangan. |
| **Kasir** | `Karyawan` | Melakukan pembukuan modal awal, memproses pembayaran pelanggan, mencetak struk, dan memeriksa antrean pesanan. |
| **Pramusaji** | `Karyawan` | Menerima pesanan pelanggan langsung per meja, reservasi/booking meja, dan melihat status hidangan. |

---

## 💻 Persyaratan Sistem

- **PHP**: Versi 5.6 s/d **PHP 8.4+** *(PHP 8.1, 8.2, 8.3, 8.4 didukung penuh)*
- **Database**: MySQL 5.7+ atau MariaDB 10.3+
- **Ekstensi PHP yang Diperlukan**:
  - `mysqli`
  - `mbstring`
  - `gd`
  - `zip`
  - `xml`
- **Web Server**: Apache (XAMPP / WAMP / Laragon) atau PHP CLI Built-in Web Server.

---

## 📦 Panduan Instalasi & Database

### 1. Persiapan Database
1. Buka **phpMyAdmin** (`http://localhost/phpmyadmin`) atau gunakan MySQL CLI.
2. Buat database baru bernama `insta`:
   ```sql
   CREATE DATABASE IF NOT EXISTS `insta`;
   ```
3. Import file database yang tersedia di:
   ```
   database paling terbaru/insta (2).sql
   ```

### 2. Konfigurasi Database (Jika Diperlukan)
Konfigurasi database berada di file `application/config/database.php`:
```php
'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'insta',
'dbdriver' => 'mysqli',
```
*Sesuaikan `username` dan `password` jika MySQL Anda menggunakan kata sandi.*

---

## 🌐 Cara Menjalankan Project (Di Luar Htdocs)

Jika file project berada di lokasi seperti `D:\Project\Mou-Makan-PHP-8.1`, Anda tidak perlu memindahkan file fisik ke `C:\xampp\htdocs`. Pilih salah satu opsi di bawah:

### Opsi 1: PHP Built-in Server *(Rekomendasi - Paling Mudah)*
Project ini telah dilengkapi file router [server.php](server.php) yang menangani rewrite URL CodeIgniter dan file statis secara otomatis.

1. Buka PowerShell atau Command Prompt di folder project:
   ```powershell
   cd D:\Project\Mou-Makan-PHP-8.1
   ```
2. Pastikan layanan MySQL di XAMPP sudah berjalan (*running*).
3. Jalankan server:
   ```bash
   php -S localhost:8000 server.php
   ```
4. Buka browser Anda: **http://localhost:8000**

---

### Opsi 2: Directory Junction / Symlink ke Htdocs
Metode ini memungkinkan Anda tetap menggunakan web server Apache XAMPP tanpa menduplikasi atau memindahkan folder proyek asli.

1. Buka **PowerShell** (atau Command Prompt) sebagai **Administrator**.
2. Jalankan perintah pembuatan link:
   - **PowerShell:**
     ```powershell
     New-Item -ItemType Junction -Path "C:\xampp\htdocs\Mou-Makan" -Target "D:\Project\Mou-Makan-PHP-8.1"
     ```
   - **Command Prompt (CMD):**
     ```cmd
     mklink /J "C:\xampp\htdocs\Mou-Makan" "D:\Project\Mou-Makan-PHP-8.1"
     ```
3. Start **Apache** dan **MySQL** di XAMPP Control Panel.
4. Akses melalui browser: **http://localhost/Mou-Makan**

---

### Opsi 3: Apache VirtualHost (Domain Lokal)
Untuk menjalankan dengan nama domain kustom (contoh: `http://moumakan.test`):

1. Buka file `C:\xampp\apache\conf\extra\httpd-vhosts.conf` dan tambahkan:
   ```apache
   <VirtualHost *:80>
       ServerName moumakan.test
       DocumentRoot "D:/Project/Mou-Makan-PHP-8.1"
       <Directory "D:/Project/Mou-Makan-PHP-8.1">
           Options Indexes FollowSymLinks
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```
2. Buka file `C:\Windows\System32\drivers\etc\hosts` menggunakan Notepad (*Run as Administrator*), tambahkan baris:
   ```text
   127.0.0.1 moumakan.test
   ```
3. Restart Apache di XAMPP, lalu akses: **http://moumakan.test**

---

## 🔑 Akun Demo / Kredensial Default

Halaman login dapat diakses di `/login`. Gunakan data berikut:

| Peran (Role) | Username | Password | Pilihan Akses di Form | Halaman Tujuan Awal |
| :--- | :--- | :--- | :--- | :--- |
| **Administrator** | `admin` | `admin` | **Administrasi** | Dashboard / Grafik Penjualan |
| **Kasir** | `00024` | `123456` | **Karyawan** | Absensi ➡️ Panel Kasir POS |
| **Pramusaji** | `00008` | `123456` | **Karyawan** | Absensi ➡️ Pemesanan Meja |

> **Catatan Login Karyawan:**
> Saat login sebagai Karyawan (Kasir atau Pramusaji), sistem akan mengarahkan terlebih dahulu ke halaman Absensi untuk menekan tombol **Absen Masuk (In)** sebelum masuk ke panel operasional.

---

## 📁 Struktur Folder

```text
Mou-Makan-PHP-8.1/
├── application/           # Modul logika CodeIgniter (MVC)
│   ├── config/            # Konfigurasi database, route, base_url
│   ├── controllers/       # Controller: Admin, Kasir, Pramusaji, Report, dll.
│   ├── models/            # Model query database
│   ├── views/             # Tampilan (AdminLTE, form login, invoice, dll.)
│   └── libraries/         # Template engine & utility
├── assets/                # File statis (CSS, JS, AdminLTE, Bootstrap, Images)
├── database paling terbaru/ # File dump database MySQL/MariaDB (insta (2).sql)
├── system/                # CodeIgniter 3.1.13 Core Engine (PHP 8.4 patched)
├── .htaccess              # Konfigurasi Apache mod_rewrite
├── index.php              # Front controller CodeIgniter
├── server.php             # Router untuk PHP Built-in Server (CLI)
└── README.md              # Dokumentasi proyek
```

---

## 🛠️ Pembaruan & Kompatibilitas PHP 8.x

Aplikasi ini telah diperbarui dari versi lawas agar berjalan mulus pada lingkungan PHP modern tanpa mengorbankan kompatibilitas ke versi sebelumnya (*backward-compatible*):

1. **Atribut Dynamic Properties (`#[\AllowDynamicProperties]`)**:
   Diterapkan pada kelas Controller, Model, Loader, Router, Session, Cart, dan Database Driver untuk mencegah *Deprecation Notice* pada PHP 8.2+ dan Fatal Error di PHP 9.0. Menggunakan sintaks atribut PHP 8 `#` yang aman dibaca sebagai komentar oleh PHP 5/7.
2. **Modernisasi Ekspor Excel**:
   Menggantikan library lawas `PHPExcel` yang sudah usang dengan **`PhpOffice\PhpSpreadsheet`** untuk pembuatan laporan `.xlsx`.
3. **Null-Safety & Strict Error Handling**:
   - Pengecekan aman terhadap parameter nullable di modul enkripsi dan helper.
   - Pengecekan aman terhadap environment `HTTP_HOST` di `config.php` untuk kompatibilitas CLI/Cron.
4. **Perbaikan Model & Controller**:
   - Memperbaiki pemanggilan model pada controller pesanan (`Model_meja`).
   - Menyediakan fallback variabel `$user` pada header template.
5. **Dukungan Built-in CLI Server**:
   Penyediaan script `server.php` sehingga developer tidak wajib menginstal Apache/XAMPP hanya untuk menjalankan dan menguji aplikasi.

---

## 📄 Lisensi

Proyek ini dibangun menggunakan framework [CodeIgniter](https://codeigniter.com/) di bawah lisensi MIT. Silakan digunakan dan dikembangkan untuk keperluan manajemen restoran, kafe, maupun riset edukasi.

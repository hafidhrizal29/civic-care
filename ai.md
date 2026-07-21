# AI.md

# Project
CivicCare - Sistem Pengaduan Masyarakat

## Objective

Bangun aplikasi web **CivicCare** menggunakan **Laravel 13**, **PHP 8.4**, **MySQL**, dan **Tailwind CSS**. Aplikasi digunakan untuk menerima, mengelola, memproses, dan memantau pengaduan masyarakat secara digital.

Aplikasi terdiri dari dua bagian utama:

- **Landing Page** (Public Website)
- **Dashboard Admin** (Complaint Management System)

Project ini merupakan aplikasi CRUD modern yang menerapkan **Laravel Best Practices**, sehingga mudah dikembangkan menjadi aplikasi e-Government atau Helpdesk Ticketing System.

---

# Tech Stack

- Laravel 13
- PHP 8.4
- MySQL 8+
- Tailwind CSS 4
- Laravel Breeze (Blade)
- Vite
- Eloquent ORM
- Carbon

---

# Development Rules

Gunakan standar Laravel terbaru.

Gunakan:

- MVC Architecture
- Resource Controller
- Form Request Validation
- Route Model Binding
- Resource Route
- Eloquent ORM
- Migration
- Seeder
- Factory
- Soft Delete
- Blade Components
- Pagination
- Eager Loading

Hindari Raw SQL apabila dapat menggunakan Eloquent.

Seluruh tampilan menggunakan Blade + Tailwind CSS.

---

# Authentication

Gunakan Laravel Breeze.

Fitur:

- Login
- Logout
- Register
- Forgot Password

Tidak diperlukan:

- Email Verification
- Multi Role

Semua halaman dashboard menggunakan middleware:

```php
auth
```

Landing page dapat diakses tanpa login.

---

# Landing Page

Landing page berfungsi sebagai portal informasi layanan pengaduan masyarakat.

## Navbar

Menu:

- Home
- Services
- Categories
- FAQ
- Contact
- Login

Navbar sticky.

---

## Hero Section

Menampilkan:

- Nama aplikasi
- Tagline
- Deskripsi singkat
- Tombol "Buat Pengaduan"
- Tombol "Login Dashboard"

Tambahkan ilustrasi pelayanan publik sebagai placeholder.

---

## Complaint Categories

Tampilkan kategori layanan.

Contoh:

- Infrastruktur
- Kebersihan
- Keamanan
- Lingkungan
- Pelayanan Publik
- Lainnya

---

## Features

Tampilkan 6 fitur utama.

- Pengaduan Online
- Tracking Status
- Dashboard Monitoring
- Manajemen Kategori
- Tanggapan Admin
- Laporan Statistik

---

## Complaint Workflow

```text
Buat Pengaduan

↓

Verifikasi

↓

Diproses

↓

Selesai
```

---

## Statistics

Menampilkan:

- Total Pengaduan
- Pengaduan Diproses
- Pengaduan Selesai
- Total Kategori

---

## Testimonials

3 kartu testimonial dummy.

---

## FAQ

Minimal 5 pertanyaan menggunakan accordion.

---

## CTA

Button:

```
Laporkan Sekarang
```

---

## Footer

Berisi:

- Logo
- Kontak
- Email
- Social Media Placeholder

---

# Dashboard

Dashboard merupakan halaman utama setelah login.

Statistik:

- Total Pengaduan
- Pengaduan Baru
- Sedang Diproses
- Selesai
- Ditolak
- Pengaduan Hari Ini

Widget:

- Pengaduan Terbaru
- Kategori Terbanyak
- Aktivitas Terakhir

Grafik:

- Pengaduan per Bulan
- Status Pengaduan

---

# Modules

---

# Kategori Pengaduan

CRUD lengkap.

Field:

- Nama Kategori
- Deskripsi

Relationship:

Category hasMany Complaint

---

# Pengaduan

CRUD lengkap.

Field:

- Nomor Tiket
- Judul
- Kategori
- Nama Pelapor
- Email
- Nomor Telepon
- Lokasi
- Deskripsi
- Foto Bukti
- Status

Status:

- Baru
- Diproses
- Selesai
- Ditolak

Upload foto menggunakan Laravel Storage.

Relationship:

Complaint belongsTo Category

Complaint hasMany Response

Business Rules:

- Nomor tiket dibuat otomatis.
- Status awal adalah **Baru**.
- Foto bersifat opsional.

---

# Tanggapan

CRUD lengkap.

Field:

- Pengaduan
- Isi Tanggapan
- Admin
- Tanggal

Relationship:

Response belongsTo Complaint

Response belongsTo User

Business Rules:

- Setelah tanggapan pertama dibuat, status pengaduan berubah menjadi **Diproses**.
- Admin dapat mengubah status menjadi **Selesai** atau **Ditolak**.

---

# Tracking Pengaduan

Halaman pencarian berdasarkan nomor tiket.

Menampilkan:

- Detail Pengaduan
- Status
- Timeline Proses
- Seluruh Tanggapan

Halaman ini dapat diakses tanpa login.

---

# Reports

Filter:

- Rentang Tanggal
- Kategori
- Status

Statistik:

- Total Pengaduan
- Penyelesaian
- Kategori Terbanyak
- Rata-rata Waktu Penyelesaian

Fitur:

- Search
- Pagination
- Export CSV
- Print

---

# Database

## users

```text
id
name
email
password
remember_token
timestamps
```

---

## complaint_categories

```text
id
nama
deskripsi
deleted_at
timestamps
```

---

## complaints

```text
id
complaint_category_id
nomor_tiket
judul
nama_pelapor
email
telepon
lokasi
deskripsi
foto
status
deleted_at
timestamps
```

---

## responses

```text
id
complaint_id
user_id
isi
created_at
updated_at
```

---

# Relationships

ComplaintCategory

```php
hasMany(Complaint)
```

Complaint

```php
belongsTo(ComplaintCategory)

hasMany(Response)
```

Response

```php
belongsTo(Complaint)

belongsTo(User)
```

User

```php
hasMany(Response)
```

---

# Navigation

```text
Dashboard

Master Data
    Kategori

Pengaduan

Tanggapan

Tracking

Laporan

Logout
```

---

# UI Requirements

Gunakan Tailwind CSS sepenuhnya.

Dashboard memiliki:

- Responsive Sidebar
- Responsive Navbar
- Breadcrumb
- Flash Notification
- Loading State
- Empty State

Gunakan Heroicons.

Semua tabel memiliki:

- Search
- Pagination
- Sorting
- Filter

Semua form memiliki:

- Validation Error
- Save
- Cancel
- Required Indicator

Gunakan desain modern dengan:

- rounded-xl
- soft shadow
- responsive grid
- smooth hover effect

---

# Dashboard Components

Dashboard minimal memiliki:

- Statistics Cards
- Complaint Status Chart
- Monthly Complaint Chart
- Recent Complaints
- Recent Responses
- Complaint Timeline

---

# Landing Page Design

Gunakan warna dominan:

- White
- Slate
- Blue

Accent:

- Orange

Layout:

```text
Navbar

Hero

Categories

Features

Workflow

Statistics

Testimonials

FAQ

CTA

Footer
```

Landing page harus mobile-friendly.

---

# Validation Rules

Category

```text
nama required
unique
```

Complaint

```text
judul required

kategori required

nama_pelapor required

email email

lokasi required

deskripsi required
```

Response

```text
complaint required

isi required
```

---

# Seeder

Generate menggunakan Factory.

Kategori

```text
8 data
```

Pengaduan

```text
300 data
```

Tanggapan

```text
500 data
```

Admin

```text
Email

admin@example.com

Password

password
```

---

# Folder Structure

```text
app/

    Models/

    Http/
        Controllers/
        Requests/

database/

    migrations/
    factories/
    seeders/

resources/

    views/

        layouts/

        landing/

        dashboard/

        complaint-categories/

        complaints/

        responses/

        tracking/

        reports/

        components/
```

---

# Workflow

Landing Page

```text
Visitor

↓

Melihat Informasi

↓

Membuat Pengaduan

↓

Mendapat Nomor Tiket

↓

Melacak Status Pengaduan
```

Dashboard

```text
Login

↓

Kelola Kategori

↓

Verifikasi Pengaduan

↓

Memberikan Tanggapan

↓

Status Berubah

↓

Laporan Terupdate
```

---

# Deliverables

Project harus menghasilkan aplikasi Laravel lengkap dengan fitur:

- Landing Page modern
- Authentication (Laravel Breeze)
- Dashboard Admin
- CRUD Kategori Pengaduan
- CRUD Pengaduan
- Upload Foto Bukti
- CRUD Tanggapan
- Tracking Pengaduan berdasarkan Nomor Tiket
- Dashboard Statistik
- Grafik Pengaduan
- Timeline Status
- Search
- Pagination
- Sorting
- Filtering
- Soft Delete
- Export CSV
- Print
- Seeder
- Factory
- Responsive Tailwind CSS
- Validasi lengkap
- Struktur kode mengikuti Laravel Best Practices

---

# Run Instructions

Project harus dapat dijalankan dengan:

```bash
composer install

cp .env.example .env

php artisan key:generate

php artisan migrate --seed

npm install

npm run build

php artisan serve
```

Setelah mengatur koneksi database pada file `.env`, aplikasi dapat langsung dijalankan tanpa konfigurasi tambahan.
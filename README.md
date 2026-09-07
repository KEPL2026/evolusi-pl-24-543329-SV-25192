# evolusi-pl-24-543329-SV-25192

Repository pengumpulan tugas mata kuliah **Konstruksi &amp; Evolusi Perangkat Lunak** (Pertemuan 1: *Manajemen GitHub &amp; Prinsip CI*), Departemen Teknik Elektro dan Informatika, Sekolah Vokasi, Universitas Gadjah Mada (2026).

- **Nama**: Ahsani Fadhli Ilahi
- **NIM**: 24/543329/SV/25192
- **Program Studi**: Sarjana Terapan Pengembangan Perangkat Lunak Situs (PPLS) / Rekayasa Perangkat Lunak

---

## 📚 Deskripsi Aplikasi: Katalog Buku &amp; Referensi Kuliah

Aplikasi **Katalog Buku &amp; Referensi Kuliah** merupakan sistem manajemen inventaris dan sirkulasi buku referensi perkuliahan berbasis framework **Laravel 12**. Aplikasi ini mempermudah mahasiswa dan dosen dalam mendata buku teks, memeriksa ketersediaan koleksi, melakukan peminjaman buku, serta mengembalikan buku ke inventaris perpustakaan/lab.

### Struktur Modul Utama

| Berkas | Isi &amp; Tanggung Jawab |
|---|---|
| `app/Models/Book.php` | Model Eloquent dengan atribut buku, status (`tersedia`/`dipinjam`), dan logika peminjaman |
| `app/Services/BookCatalogService.php` | Logika bisnis kalkulasi ringkasan statistik dan daftar kategori referensi |
| `app/Http/Controllers/BookController.php` | Pengendali request HTTP untuk melihat daftar, menambah buku, meminjam, dan mengembalikan |
| `resources/views/books/index.blade.php` | Tampilan antarmuka berbasis Blade dengan kartu statistik dan desain responsif |
| `routes/web.php` | Definisi rute GET `/`, POST `/books`, POST `/books/{id}/borrow`, POST `/books/{id}/return` |
| `tests/Unit/BookCatalogServiceTest.php` | Pengujian unit mandiri untuk metode service dan helper model |
| `tests/Feature/BookCatalogTest.php` | Pengujian fitur endpoint HTTP, form submission, transaksi peminjaman, dan validasi |

---

## 🚀 Panduan Menjalankan Aplikasi &amp; Pengujian

### Prasyarat Sistem
- PHP 8.2 atau lebih tinggi (ekstensi `sqlite3`, `mbstring`, `xml`, `zip` aktif)
- Composer 2.x

### Menjalankan Pengujian Otomatis
```bash
# Validasi sintaks berkas konfigurasi Composer
composer validate

# Menjalankan seluruh test suite otomatis (Unit & Feature Tests)
php artisan test
```

### Menjalankan Server Pengembangan Lokal
```bash
# 1. Salin berkas lingkungan dan generate application key
cp .env.example .env
php artisan key:generate

# 2. Siapkan basis data SQLite dan jalankan migrasi
touch database/database.sqlite
php artisan migrate

# 3. Jalankan server lokal
php artisan serve
```
Akses aplikasi melalui peramban pada alamat `http://localhost:8000`.

---

## 🌿 Alur Percabangan (Git Branching Strategy)

Kode **tidak pernah** di-push langsung ke branch `main`. Seluruh pengembangan fitur baru dan integrasi mengikuti alur bertingkat berikut:

```
feature/<nama-fitur>  --PR 1-->  dev  --PR 2-->  main
     (pengembangan)            (integrasi)      (rilis / dinilai)
```

| Branch | Peran | Izin Push Langsung |
|---|---|---|
| `feature/<nama-fitur>` | Tempat pengerjaan fitur spesifik dengan rentang waktu singkat | Diizinkan |
| `dev` | Wadah integrasi seluruh fitur sebelum rilis resmi | Dilarang — Wajib melalui PR dari `feature/*` |
| `main` | Kondisi stabil, siap rilis, dan siap dinilai | Dilarang — Wajib melalui PR dari `dev` |

Branch default repository ini diatur ke `dev`, sehingga Pull Request baru secara otomatis menargetkan branch `dev`.

---

## ⚙️ Alur Continuous Integration (CI)

Berkas alur kerja GitHub Actions terletak pada [`.github/workflows/ci.yml`](.github/workflows/ci.yml) yang memuat **dua job paralel** pada setiap `push` dan `pull_request` ke branch `dev` maupun `main`:

1. **`lint` (Lint &amp; Sintaks)**:
   - Menyiapkan environment PHP 8.2.
   - Menjalankan `composer validate --strict` untuk memastikan dependensi dan lockfile valid.
   - Memeriksa integritas seluruh berkas sintaks PHP (`php -l`).
2. **`test` (Pengujian Unit &amp; Fitur)**:
   - Menyiapkan environment PHP 8.2 dengan ekstensi SQLite.
   - Memasang seluruh dependensi menggunakan Composer.
   - Menginisialisasi basis data SQLite dan menjalankan migrasi.
   - Menjalankan seluruh skenario pengujian otomatis (`php artisan test`).

Kedua job wajib berstatus **sukses (hijau)** sebelum Pull Request dapat digabungkan (*merge*).

---

## 📝 Konvensi Pesan Commit (Conventional Commits)

Format commit mengacu pada standar [Conventional Commits](https://www.conventionalcommits.org/):

```
feat:     menambahkan fitur baru ke aplikasi
fix:      memperbaiki bug atau kegagalan logika
test:     menambah atau memperbarui pengujian otomatis
ci:       perubahan pada berkas/konfigurasi alur kerja CI
docs:     penambahan atau pembaruan dokumentasi
chore:    tugas pemeliharaan rutin, konfigurasi, atau struktur dasar
refactor: penataan ulang struktur kode tanpa mengubah fungsi luar
```

---

## ✅ Checklist Pemenuhan Tugas (Pertemuan 1)

- [x] Repository publik di organisasi KEPL2026: `evolusi-pl-24-543329-SV-25192`
- [x] Minimal 5 commit bergaya Conventional Commits (tanpa commit 'update' polos)
- [x] Branch `feature/<sesuatu>` dengan satu perubahan nyata
- [x] Dua Pull Request bertingkat: `feature/*` &rarr; `dev`, lalu `dev` &rarr; `main`
- [x] Berkas [`.github/workflows/ci.yml`](.github/workflows/ci.yml) dengan minimal 2 job berstatus hijau
- [x] Branch protection rule pada branch `dev` dan `main` serta kolaborator dosen (peran Read)
- [x] Berkas `README.md` dan `.gitignore` lengkap dan rapi

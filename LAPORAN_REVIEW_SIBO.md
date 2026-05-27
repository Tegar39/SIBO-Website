# Laporan Review Proyek SIBO Laravel

## Ringkasan
Proyek SIBO sudah memiliki modul inti yang cukup kuat untuk tugas UAS Sistem Informasi: autentikasi, manajemen anggota, kategori, kegiatan, pendaftaran, absensi, galeri, laporan/export, notifikasi, API mobile, dan sertifikat. Namun ada beberapa blocker teknis yang perlu dibereskan supaya aplikasi bisa dijalankan, dimigrasikan dari awal, dan dipresentasikan dengan aman.

## Perbaikan yang Sudah Diterapkan pada ZIP Revisi

### 1. Memperbaiki `app/Exceptions/Handler.php`
File sebelumnya berisi potongan debug `dd()` dan tidak memiliki class Handler. Ini berisiko membuat aplikasi error ketika exception handler dipanggil.

### 2. Menambahkan alias middleware `role.pac`
Route PAC memakai middleware `role.pac`, tetapi aliasnya belum didaftarkan di `bootstrap/app.php`. Sekarang sudah ditambahkan.

### 3. Menambahkan `NotifikasiController`
Route anggota `/anggota/notifikasi` memakai `NotifikasiController`, tetapi controllernya belum ada. Sekarang sudah dibuat dengan fitur:
- menampilkan notifikasi anggota login;
- menandai notifikasi sebagai sudah dibaca;
- membatasi akses agar anggota hanya bisa mengubah notifikasinya sendiri.

### 4. Melengkapi model `Notifikasi`
Model sebelumnya kosong. Sekarang sudah dilengkapi:
- `$table = 'notifikasis'`;
- `$fillable`;
- cast `is_read` ke boolean;
- relasi ke `Anggota`.

### 5. Memperbaiki migration pendaftaran
File `2026_04_07_035055_create_pendaftarans_table.php` sebelumnya justru membuat tabel `certificates`, padahal nama dan kebutuhan sistemnya adalah tabel `pendaftarans`. Ini adalah blocker besar karena migration certificate juga sudah ada di file lain. Sekarang file tersebut sudah benar membuat tabel `pendaftarans`.

### 6. Menyamakan status kegiatan `tutup`
Kode memakai status `tutup`, tetapi enum database dan validasi controller belum mengizinkannya. Sekarang status kegiatan menjadi:
- `aktif`
- `tutup`
- `selesai`
- `batal`

Form create/edit kegiatan juga sudah diberi opsi `Tutup Pendaftaran`.

### 7. Memperbaiki nama route nested group
Di dalam group `admin.` dan `anggota.`, route jangan diberi nama `admin.absensi.show` atau `anggota.notifikasi` secara penuh, karena akan menjadi dobel prefix. Sekarang sudah dirapikan menjadi `absensi.show`, `absensi.export`, `notifikasi`, dan `notifikasi.read`.

### 8. Memperbaiki export absensi
`AbsensiController` memakai `$kegiatan->slug`, tetapi model/tabel kegiatan tidak punya kolom `slug`. Sekarang nama file export memakai `Str::slug($kegiatan->judul)`.

### 9. Merapikan generate sertifikat
Sertifikat sebelumnya dibuat saat pendaftaran disetujui. Secara logika sistem, sertifikat sebaiknya dibuat setelah peserta benar-benar hadir. Listener sekarang menunggu absensi hadir sebelum membuat sertifikat. `CertificateService` juga diperbaiki agar bisa memakai `display_name`, sehingga peserta non-anggota tetap bisa punya nama pada sertifikat.

## Masalah yang Masih Perlu Dicek Saat Menjalankan Lokal
Saya tidak menjalankan `php artisan migrate` dan `php artisan test` secara penuh karena folder `vendor/` tidak ada dan composer tidak tersedia di environment pengecekan ini. Setelah ZIP revisi dibuka di laptop, jalankan:

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate:fresh --seed
npm run build
php artisan serve
```

Jika memakai MySQL, pastikan konfigurasi database di `.env` sudah benar.

## Catatan Keamanan dan Kerapian

### 1. Jangan upload `.env`
ZIP asli masih menyertakan `.env`. Untuk pengumpulan tugas atau GitHub, jangan sertakan file ini. Gunakan `.env.example` saja.

### 2. Jangan simpan database asli di repository
File `database/database.sqlite` sebaiknya tidak dikumpulkan jika berisi data asli. Untuk demo, gunakan seeder dummy.

### 3. API CRUD anggota masih terlalu terbuka
Endpoint CRUD anggota di API belum memakai auth Sanctum. Untuk sistem informasi yang rapi, endpoint insert/update/delete anggota sebaiknya dilindungi oleh `auth:sanctum` dan role admin.

### 4. Default password API tidak aman
Pada API insert anggota, jika password kosong akan memakai `password123`. Lebih baik password wajib diisi atau dibuat random lalu dikirim melalui email/reset password.

### 5. Validasi file upload base64 perlu diperketat
API upload foto base64 sebaiknya membatasi ukuran file, mengecek MIME asli, dan menghindari upload payload besar.

## Rekomendasi Fitur Tambahan untuk Nilai UAS

### Prioritas Tinggi
1. Dashboard statistik dengan grafik: total anggota, kegiatan aktif, peserta per kegiatan, absensi hadir/alfa, anggota per PAC.
2. Role lebih lengkap: admin pusat, PAC, anggota.
3. Audit log: siapa menambah/mengubah/menghapus anggota, kegiatan, pendaftaran, dan absensi.
4. QR Code absensi: peserta scan QR saat kegiatan berlangsung.
5. Validasi kuota real-time dan daftar tunggu/waiting list.
6. Sertifikat dengan QR verifikasi publik.
7. Filter laporan berdasarkan tanggal, PAC, kategori, status kegiatan, dan status kehadiran.
8. Seeder demo lengkap agar dosen bisa langsung menjalankan sistem.

### Prioritas Menengah
1. Kalender kegiatan.
2. Reminder email/WhatsApp sebelum kegiatan.
3. Upload dokumentasi kegiatan multi-foto dengan cover utama.
4. Riwayat aktivitas anggota.
5. Export laporan per PAC.
6. Pencarian global.
7. Halaman profil organisasi dan struktur pengurus.

### Prioritas Tambahan / Bonus
1. Progressive Web App sederhana.
2. API mobile yang lebih lengkap.
3. Verifikasi nomor anggota.
4. Badge level keaktifan anggota.
5. Penilaian/feedback kegiatan.

## Saran Struktur Presentasi UAS

1. Latar belakang masalah.
2. Tujuan sistem.
3. Aktor sistem: admin, PAC, anggota, publik.
4. Use case utama.
5. ERD/database.
6. Alur proses: kegiatan → pendaftaran → approval → absensi → sertifikat → laporan.
7. Demo fitur.
8. Keamanan sistem.
9. Pengujian.
10. Kesimpulan dan pengembangan lanjutan.

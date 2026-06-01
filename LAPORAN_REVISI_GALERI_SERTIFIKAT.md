# Laporan Revisi Galeri dan Sertifikat SIBO

## Ringkasan Revisi
Revisi ini menyesuaikan tampilan galeri web dan API mobile agar dokumentasi tidak lagi ditampilkan sekaligus dalam satu halaman. Galeri sekarang dikelompokkan berdasarkan kegiatan seperti folder. Pengunjung memilih folder kegiatan terlebih dahulu, lalu melihat foto/video di dalam kegiatan tersebut.

## Perubahan Web
1. Halaman publik `/galeri` sekarang menampilkan folder berdasarkan kegiatan.
2. Ketika folder kegiatan diklik, halaman menampilkan dokumentasi kegiatan tersebut saja.
3. Halaman beranda publik juga menampilkan folder galeri, bukan semua foto sekaligus.
4. Admin galeri sekarang dapat mengunggah foto dan video dokumentasi.
5. File video didukung dengan format MP4, MOV, M4V, dan WEBM.
6. Template sertifikat diperbaiki agar logo SIBO ikut tampil melalui base64 image sehingga lebih stabil pada DomPDF.

## Perubahan Mobile
1. Halaman Galeri mobile sekarang menampilkan folder kegiatan terlebih dahulu.
2. Pengguna memilih folder kegiatan untuk membuka daftar foto/video dokumentasi.
3. Video dapat diputar dari aplikasi mobile menggunakan VideoView.
4. Aplikasi membaca field `cover_url`, `file_url`, `media_url`, dan `video_url` dari API Laravel.

## Catatan File yang Tidak Disentuh
Sesuai instruksi, revisi ini tidak mengubah:
- `.env`
- `resources/views/layouts/navigation.blade.php`
- `resources/views/auth/login.blade.php`

## Setelah Update
Jalankan:

```bash
php artisan migrate
php artisan optimize:clear
php artisan view:clear
php artisan storage:link
```

Untuk video di hosting, gunakan file MP4 berukuran kecil agar lebih aman untuk hosting gratis.

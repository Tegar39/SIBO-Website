# Revisi Template Sertifikat SIBO

Template sertifikat dibuat ulang dengan referensi visual sertifikat horizontal: bidang utama putih, aksen biru di kiri dan bawah, garis emas, logo SIBO di kanan atas, serta konten yang dipusatkan agar tidak terlalu melebar.

Perubahan utama:
- Tidak memakai watermark Polinema.
- Tidak memakai area tanda tangan pejabat.
- Tidak memakai footer absolut yang menimpa konten.
- Menggunakan logo SIBO dari `public/images/logo-sibo.png`.
- Layout tetap A4 landscape satu halaman.
- Area teks dibuat lebih ramping agar mirip komposisi sertifikat referensi.

File yang diganti:
- `resources/views/certificates/template.blade.php`

Setelah update:

```bash
php artisan optimize:clear
php artisan view:clear
php artisan storage:link
```

Download ulang sertifikat agar file PDF diregenerate dengan desain baru.

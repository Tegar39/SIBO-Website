# Laporan Revisi PDF Sertifikat SIBO

## Masalah yang diperbaiki
PDF sertifikat lama berpotensi terlihat berantakan karena layout menggunakan alur konten biasa dan flexbox. Pada DomPDF, flexbox tidak selalu stabil untuk layout sertifikat landscape sehingga bagian footer/tanda tangan dapat terdorong ke halaman kedua.

## Perbaikan yang diterapkan
1. Template sertifikat diubah menjadi layout A4 landscape fixed-size satu halaman.
2. Border, watermark, header instansi, nomor sertifikat, nama peserta, informasi kegiatan, kotak validasi, dan tanda tangan ditempatkan dengan ukuran yang lebih stabil untuk DomPDF.
3. CertificateService sekarang memaksa output PDF menggunakan A4 landscape.
4. Saat sertifikat lama diunduh, file PDF otomatis diregenerasi agar memakai desain terbaru.

## File yang diubah
- resources/views/certificates/template.blade.php
- app/Services/CertificateService.php
- app/Http/Controllers/CertificateController.php

## Catatan penggunaan
Setelah update, jalankan:

```bash
php artisan optimize:clear
php artisan storage:link
```

Sertifikat lama akan memakai desain baru saat diunduh kembali karena controller melakukan refresh file sebelum download.

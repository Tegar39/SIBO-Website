# Laporan Revisi Template Sertifikat SIBO

## Ringkasan
Template PDF sertifikat SIBO telah diganti dengan desain baru agar lebih stabil saat dirender oleh DomPDF dan tidak lagi pecah menjadi dua halaman.

## Perubahan Utama
1. Menghapus gambar/logo Polinema dari template sertifikat.
2. Menghapus watermark besar yang sebelumnya menyebabkan tampilan terlihat menimpa konten.
3. Menghapus area tanda tangan dan nama pejabat.
4. Mengganti identitas template menjadi sertifikat digital SIBO untuk PC DESBOR IPNU IPPNU Kabupaten Kediri.
5. Membuat desain A4 landscape satu halaman dengan header hijau, aksen emas, border sertifikat, area nama peserta, informasi kegiatan, dan kotak validasi digital.
6. Menggunakan CSS sederhana dan ukuran tetap agar lebih aman untuk DomPDF.

## File yang Diubah
- `resources/views/certificates/template.blade.php`

## Catatan Penggunaan
Sertifikat lama akan mengikuti template baru saat diunduh ulang karena `CertificateController` sebelumnya sudah dibuat untuk melakukan regenerate file sertifikat ketika download.

Jalankan setelah update:

```bash
php artisan optimize:clear
php artisan storage:link
```

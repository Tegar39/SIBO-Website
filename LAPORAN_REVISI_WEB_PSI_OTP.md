# Laporan Revisi Web SIBO - OTP Keamanan dan Kesiapan Fitur PSI

## Ringkasan
Revisi ini menyesuaikan halaman keamanan akun anggota agar memiliki verifikasi OTP sebelum ganti password. Sebelumnya halaman hanya menampilkan form password, sehingga alur pengamanan belum terlihat pada UI. Setelah revisi, anggota harus menekan tombol kirim OTP, memasukkan kode OTP, lalu form ganti password baru akan aktif.

## Perubahan Utama
1. Menambahkan blok verifikasi OTP pada halaman `anggota/profil/keamanan.blade.php`.
2. Menambahkan route OTP khusus halaman keamanan anggota:
   - `POST /anggota/keamanan/otp/request`
   - `POST /anggota/keamanan/otp/verify`
   - `POST /anggota/keamanan/otp/resend`
3. Menambahkan method OTP pada `AnggotaProfilController`.
4. Menonaktifkan form ganti password sampai OTP berhasil diverifikasi.
5. OTP menggunakan email akun dan berlaku mengikuti konfigurasi `LOGIN_OTP_EXPIRES_MINUTES`.
6. Password baru diperkuat dengan minimal 8 karakter dan kombinasi huruf besar, huruf kecil, angka, dan simbol.

## Kesesuaian dengan Dokumen Pengujian PSI
Fitur yang tercantum pada dokumen pengujian telah disiapkan pada web SIBO:

- Login admin dan anggota.
- Dashboard admin dan anggota.
- Kelola data anggota.
- Kelola data kegiatan termasuk jadwal, lokasi, kuota, dan pamflet.
- Informasi kegiatan publik.
- Pendaftaran kegiatan online.
- Kelola peserta kegiatan.
- Absensi kegiatan.
- Galeri kegiatan.
- Riwayat kegiatan anggota.
- Riwayat absensi anggota.
- Laporan data anggota.
- Laporan data kegiatan.
- Ekspor laporan PDF, Excel, dan CSV.
- Notifikasi ketidakhadiran.
- Sertifikat digital PDF otomatis.
- Profil pengguna.
- Logout.

## Catatan Pengujian
Setelah update, jalankan:

```bash
composer install
php artisan migrate
php artisan optimize:clear
php artisan storage:link
php artisan serve
```

Untuk demo OTP lokal, gunakan:

```env
MAIL_MAILER=log
LOGIN_OTP_EXPIRES_MINUTES=10
```

Kode OTP bisa dilihat di `storage/logs/laravel.log`.

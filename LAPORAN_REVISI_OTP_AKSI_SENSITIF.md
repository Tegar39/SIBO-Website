# Revisi OTP Aksi Sensitif SIBO

## Ringkasan

Alur OTP diubah agar tidak muncul setiap login. Semua role dapat login cukup dengan email dan password selama akun aktif. OTP dipakai sebagai verifikasi tambahan untuk aksi sensitif, terutama ganti password.

## Alur Baru

1. Admin, anggota, dan PAC login menggunakan email/password.
2. Admin tidak memakai OTP.
3. Anggota/PAC yang ingin mengganti password harus menekan tombol kirim OTP di halaman profil.
4. Sistem mengirim OTP ke email akun.
5. Setelah OTP valid, user diberi waktu sesuai `LOGIN_OTP_EXPIRES_MINUTES` untuk menyimpan password baru.
6. Setelah password berhasil diganti, sesi verifikasi OTP dihapus.

## File yang Diubah

- `app/Http/Controllers/Auth/AuthenticatedSessionController.php`
- `app/Http/Controllers/Auth/OtpController.php`
- `app/Http/Controllers/Auth/PasswordController.php`
- `routes/auth.php`
- `resources/views/auth/otp.blade.php`
- `resources/views/profile/partials/update-password-form.blade.php`
- `resources/views/admin/security/index.blade.php`

## Catatan Demo

Untuk demo lokal gunakan `MAIL_MAILER=log`, lalu lihat OTP di `storage/logs/laravel.log`.

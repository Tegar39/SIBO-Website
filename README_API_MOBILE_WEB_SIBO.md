# Update Web SIBO untuk Mobile Kotlin Native

Revisi ini menambahkan endpoint API Laravel agar aplikasi Android Kotlin bisa memakai database yang sama melalui backend web SIBO, bukan WebView dan bukan koneksi langsung ke MySQL.

## Alur integrasi

```text
Android Kotlin Native
        ↓ Bearer Token Sanctum
Laravel API /api/v1/...
        ↓ Eloquent
Database MySQL SIBO
```

## Endpoint utama

### Auth

```text
POST /api/v1/auth/login
POST /api/v1/auth/logout
GET  /api/v1/auth/me
```

Header untuk endpoint yang butuh login:

```text
Authorization: Bearer <token>
Accept: application/json
```

### Mobile

```text
GET  /api/v1/mobile/dashboard
GET  /api/v1/mobile/kegiatan
GET  /api/v1/mobile/kegiatan/{id}
POST /api/v1/mobile/kegiatan/{id}/daftar
GET  /api/v1/mobile/riwayat
GET  /api/v1/mobile/notifikasi
POST /api/v1/mobile/notifikasi/{id}/read
GET  /api/v1/mobile/sertifikat
GET  /api/v1/mobile/sertifikat/{id}/download
GET  /api/v1/mobile/profil
PUT  /api/v1/mobile/profil
POST /api/v1/mobile/profil/password/otp
POST /api/v1/mobile/profil/password
GET  /api/v1/mobile/pac
GET  /api/v1/mobile/pac/{pac}
GET  /api/v1/mobile/galeri
GET  /api/v1/mobile/inventory
GET  /api/v1/mobile/laporan/ringkasan
```

## Daftar kegiatan untuk orang lain

Endpoint:

```text
POST /api/v1/mobile/kegiatan/{id}/daftar
```

Body daftar diri sendiri:

```json
{
  "jenis_daftar": "self"
}
```

Body daftar orang lain:

```json
{
  "jenis_daftar": "other",
  "nama_peserta": "Nama Peserta",
  "kontak_peserta": "081234567890"
}
```

Aturan database:

- `self` hanya boleh satu kali per anggota pada kegiatan yang sama.
- `other` boleh lebih dari satu kali.
- `other` tidak boleh duplikat untuk nama + kontak yang sama oleh akun yang sama pada kegiatan yang sama.

## OTP

Login mobile tidak memakai OTP. OTP dipakai untuk aksi sensitif, yaitu ganti password anggota/PAC.

```text
POST /api/v1/mobile/profil/password/otp
POST /api/v1/mobile/profil/password
```

Untuk demo lokal, gunakan:

```env
MAIL_MAILER=log
LOGIN_OTP_EXPIRES_MINUTES=10
```

Kode OTP akan muncul di:

```text
storage/logs/laravel.log
```

## Cara menjalankan untuk Android emulator

Laravel:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Android emulator:

```properties
SIBO_API_BASE_URL=http://10.0.2.2:8000/api/v1/
```

HP fisik harus memakai IP laptop, misalnya:

```properties
SIBO_API_BASE_URL=http://192.168.1.10:8000/api/v1/
```

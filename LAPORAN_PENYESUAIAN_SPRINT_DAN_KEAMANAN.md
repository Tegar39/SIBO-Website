# Laporan Penyesuaian Sprint Backlog dan Keamanan SIBO

Dokumen ini merangkum penyesuaian aplikasi SIBO terhadap Product Backlog dan Sprint Backlog.

## Sprint 1

- Login admin dan anggota: tersedia, ditambah OTP email.
- Dashboard admin: tersedia.
- CRUD anggota: tersedia dengan pencarian dan filter PAC.
- Profil anggota: tersedia.
- Database anggota: tersedia dan terhubung ke akun user.
- Pengujian login dan anggota: disiapkan melalui validasi dan checklist manual.

## Sprint 2

- CRUD kegiatan: tersedia dengan jadwal, lokasi, kuota, status, kategori, dan pamflet.
- Informasi kegiatan publik: tersedia.
- Pendaftaran kegiatan online: tersedia untuk anggota.
- Pengelolaan peserta: tersedia untuk admin.
- Galeri kegiatan: tersedia untuk admin dan publik.
- Pengujian kegiatan dan pendaftaran: disiapkan melalui checklist manual.

## Sprint 3

- Absensi kegiatan: tersedia untuk admin.
- Riwayat kegiatan dan absensi anggota: tersedia.
- Laporan anggota, kegiatan, dan absensi: tersedia.
- Export laporan: tersedia Excel, CSV, PDF.
- Notifikasi ketidakhadiran: otomatis saat peserta tidak hadir.
- Sertifikat digital: otomatis untuk peserta hadir.
- Integrasi inventaris eksternal: tersedia service, controller, route, dan view.
- Dashboard PAC: tersedia dashboard internal dan profil PAC publik.
- Pengujian sistem keseluruhan: disediakan checklist demo UAS.

## Fitur Keamanan Tambahan

1. OTP login untuk anggota/PAC email untuk akun yang aktif.
2. Status akun: aktif, nonaktif, blokir.
3. Audit log aktivitas penting.
4. Security headers pada response web.
5. Password policy lebih kuat untuk perubahan password.
6. Rate limit verifikasi dan resend OTP.
7. Pembatasan akses sertifikat untuk admin atau pemilik sertifikat.
8. Konfigurasi sensitif dipisahkan melalui `.env.example`.

## Checklist Demo UAS

- Login admin sampai verifikasi OTP.
- Tambah anggota dan cek audit log.
- Tambah kegiatan dengan pamflet.
- Anggota daftar kegiatan.
- Admin verifikasi peserta.
- Admin input absensi.
- Anggota melihat riwayat, notifikasi, dan sertifikat.
- Admin export laporan Excel/CSV/PDF.
- Admin membuka halaman keamanan dan mengubah status akun.
- Pengunjung membuka profil organisasi, kegiatan, galeri, statistik, dan PAC.


## Revisi OTP Admin

Sesuai kebutuhan operasional, akun dengan role `admin` tidak diwajibkan memasukkan OTP. OTP tetap tersedia untuk role `anggota` dan `pac` melalui menu Admin > Keamanan.

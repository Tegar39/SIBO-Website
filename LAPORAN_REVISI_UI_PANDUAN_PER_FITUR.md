# Revisi Web SIBO - UI, Spacing, dan Panduan Per Fitur

Perubahan utama:

1. Spacing halaman auth/admin diperbaiki melalui layout utama sehingga konten tidak naik ke belakang navbar.
2. Halaman tambah peserta dibuat lebih rendah dan aman dari navbar fixed.
3. Teks informasi filter cepat dan teks penjelasan keamanan yang terlalu panjang dihapus dari halaman.
4. Panduan tombol `?` dibuat lebih detail per fitur. Pengguna dapat memilih fitur dari daftar panduan:
   - Dashboard
   - Kelola Anggota
   - Kelola Kategori
   - Kelola Kegiatan
   - Pendaftaran/Peserta
   - Absensi
   - Galeri
   - Laporan
   - Keamanan
   - Profil
   - Riwayat
   - Notifikasi
   - Sertifikat
   - Inventaris
5. Urutan deteksi halaman diperbaiki agar halaman profil anggota tidak lagi terbaca sebagai Kelola Anggota.
6. UI diberi sentuhan gradient, shadow, dan aksen warna SIBO agar tidak terlalu flat.

File yang tidak diubah:

- `.env`
- `resources/views/layouts/navigation.blade.php`
- `resources/views/auth/login.blade.php`

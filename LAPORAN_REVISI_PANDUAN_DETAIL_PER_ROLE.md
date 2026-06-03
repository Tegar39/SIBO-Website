# Revisi Panduan Detail Per Role - SIBO Web

Perubahan:

1. Tombol bantuan `?` tetap tersedia di halaman admin/anggota/PAC yang sudah login.
2. Panduan dipisahkan berdasarkan role:
   - Admin
   - Anggota
   - PAC
   - Publik
   - Mode UAS/Demo
3. Setiap role memiliki daftar fitur masing-masing.
4. Setiap fitur berisi:
   - Kapan fitur digunakan
   - Langkah penggunaan
   - Hal yang perlu diperhatikan
   - Arahan saat demo/presentasi
   - Alur besar role terkait
5. Deteksi halaman diperbaiki berdasarkan URL agar panduan langsung membuka fitur yang sesuai.

File utama yang diubah:

- resources/views/components/page-help.blade.php

Catatan:

- Tidak mengubah `.env`.
- Tidak mengubah `resources/views/layouts/navigation.blade.php`.
- Tidak mengubah `resources/views/auth/login.blade.php`.

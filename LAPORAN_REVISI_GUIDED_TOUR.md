# Revisi Guided Tour SIBO Web

Panduan penggunaan diubah dari modal dokumentasi menjadi tutorial interaktif langkah demi langkah.

## Perubahan
- Tombol `?` membuka daftar tutorial berdasarkan role: Admin, Anggota, PAC, Publik, dan UAS/Demo.
- Setiap tutorial memiliki tombol `Next`, `Back`, dan `Selesai`.
- Elemen yang sedang dijelaskan diberi highlight.
- Kotak panduan diposisikan di dekat tombol/menu/form terkait.
- Jika elemen target tidak ada di halaman, kotak panduan tetap muncul di tengah agar tutorial tidak error.

## File yang diubah
- `resources/views/components/page-help.blade.php`

## Catatan
File `.env`, `resources/views/layouts/navigation.blade.php`, dan `resources/views/auth/login.blade.php` tidak diubah.

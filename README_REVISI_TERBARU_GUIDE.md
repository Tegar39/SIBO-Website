# Revisi terbaru SIBO Web

Perubahan:
- Panduan tombol ? langsung menjalankan tutorial halaman aktif, tanpa daftar fitur.
- Target tutorial diperbaiki agar tidak mengarah ke tombol yang salah seperti hapus kategori.
- Step yang tidak sesuai halaman aktif dipisahkan ke halaman form/create/edit masing-masing.
- Posisi popover panduan diperbaiki agar tidak terpotong navbar dan lebih dekat ke elemen terkait.
- File .env, navigation.blade.php, dan login.blade.php tidak diubah.

Instalasi:
1. Backup project lama.
2. Extract ZIP ini ke folder project Laravel atau timpa file di project lama.
3. Jalankan:
   php artisan optimize:clear
   php artisan view:clear
   php artisan storage:link

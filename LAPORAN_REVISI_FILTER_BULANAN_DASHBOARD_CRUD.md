# Laporan Revisi Filter Bulanan Dashboard dan CRUD SIBO

## Ringkasan
Revisi ini mengembalikan filter pada halaman kelola data agar admin tetap bisa melihat perkembangan data per bulan tanpa harus selalu masuk ke menu laporan. Dashboard admin tetap menjadi pusat rekap bulanan, sedangkan menu laporan tetap menjadi tempat filter dan export resmi.

## Perubahan Utama

### 1. Dashboard Admin
- Dashboard tetap menggunakan filter bulan dan tahun.
- Statistik mengikuti periode yang dipilih.
- Menampilkan anggota baru, kegiatan, pendaftar, peserta disetujui, pendaftar terbaru, rekap pendaftar per kegiatan, serta kehadiran/tidak hadir per bulan.

### 2. CRUD Anggota
- Filter dikembalikan pada halaman kelola anggota.
- Filter tersedia: keyword, PAC, bulan, dan tahun.
- Digunakan untuk melihat anggota baru berdasarkan periode tertentu.

### 3. CRUD Kegiatan
- Filter dikembalikan pada halaman kelola kegiatan.
- Filter tersedia: keyword, kategori, status, bulan, dan tahun.
- Digunakan untuk memantau kegiatan per bulan langsung dari halaman kelola.

### 4. CRUD Kategori
- Filter pencarian kategori dikembalikan.
- Digunakan untuk mencari kategori tanpa masuk ke laporan.

### 5. Kelola Peserta/Pendaftaran
- Filter dikembalikan pada daftar kegiatan peserta.
- Filter tersedia: keyword, status kegiatan, bulan, dan tahun.
- Pada detail pendaftar kegiatan, filter tersedia: keyword, status pendaftar, dan jenis daftar.

## Catatan Desain Alur
- Filter cepat tetap ada di CRUD untuk membantu navigasi dan monitoring cepat.
- Filter analitik lengkap dan export tetap berada di menu Laporan.
- Tidak ada perubahan struktur database, sehingga tidak perlu migration baru.

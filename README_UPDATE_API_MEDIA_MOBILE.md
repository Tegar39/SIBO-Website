# Update API Media Mobile SIBO

Update ini membuat response API mobile mengirim URL gambar/pamflet yang lebih mudah dibaca aplikasi Android.

## Field gambar kegiatan

Endpoint kegiatan sekarang mengirim:

- `pamflet_path`
- `pamflet_url`
- `image_url`
- `gambar`
- `thumbnail`

Semua field URL mengarah ke `/storage/...` berdasarkan host request aktif. Jadi kalau Android mengakses Laravel dari `http://10.0.2.2:8000`, URL gambarnya juga ikut memakai host tersebut.

## Field galeri

Endpoint galeri sekarang mengirim:

- `file_url`
- `image_url`
- `gambar`
- `thumbnail`

## Perintah penting

```bash
php artisan storage:link
php artisan optimize:clear
php artisan serve --host=0.0.0.0 --port=8000
```

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans';
    protected $primaryKey = 'id_kegiatan';
    protected $fillable = [
        'id_kategori', 'judul', 'deskripsi', 'tanggal', 'waktu',
        'lokasi', 'kuota', 'status', 'created_by'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function pamflet()
    {
        return $this->hasOne(Pamflet::class, 'id_kegiatan');
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'id_kegiatan');
    }

    public function galeris()
    {
        return $this->hasMany(Galeri::class, 'id_kegiatan');
    }

    // Hitung jumlah peserta yang disetujui
    public function getJumlahPesertaAttribute()
    {
        return $this->pendaftarans()->where('status', 'disetujui')->count();
    }
}
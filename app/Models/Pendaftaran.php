<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';
    protected $primaryKey = 'id_daftar';
    protected $fillable = [
        'id_kegiatan', 'id_anggota', 'nama_peserta', 'kontak_peserta',
        'tgl_daftar', 'status', 'keterangan', 'created_by', 'jenis_daftar'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }

    public function absensi()
    {
        return $this->hasOne(Absensi::class, 'id_daftar');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Nama peserta (prioritas: nama_peserta, lalu nama anggota)
    public function getDisplayNameAttribute()
    {
        if ($this->nama_peserta) {
            return $this->nama_peserta;
        }
        return $this->anggota?->nama_lengkap ?? 'Peserta Tanpa Akun';
    }

    // Kontak peserta
    public function getDisplayContactAttribute()
    {
        if ($this->kontak_peserta) {
            return $this->kontak_peserta;
        }
        return $this->anggota?->kontak ?? '-';
    }
    public function certificate()
    {
        return $this->hasOne(Certificate::class, 'id_pendaftaran', 'id_daftar');
    }
}
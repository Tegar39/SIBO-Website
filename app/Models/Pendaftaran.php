<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';
    protected $primaryKey = 'id_daftar';
    protected $fillable = ['id_anggota', 'id_kegiatan', 'tgl_daftar', 'status', 'keterangan'];

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
}
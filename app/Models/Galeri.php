<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeris';
    protected $primaryKey = 'id_foto';
    protected $fillable = ['id_kegiatan', 'judul_foto', 'deskripsi', 'path_file', 'jenis_media', 'mime_type', 'ukuran_file', 'tgl_upload', 'is_unggulan'];

    protected $casts = [
        'is_unggulan' => 'boolean',
        'tgl_upload' => 'datetime',
    ];


    public function getIsVideoAttribute(): bool
    {
        return ($this->jenis_media ?? 'foto') === 'video' || str_starts_with((string) $this->mime_type, 'video/');
    }

    public function getIsFotoAttribute(): bool
    {
        return ! $this->is_video;
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }
}
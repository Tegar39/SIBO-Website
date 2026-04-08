<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeris';
    protected $primaryKey = 'id_foto';
    protected $fillable = ['id_kegiatan', 'judul_foto', 'deskripsi', 'path_file', 'tgl_upload', 'is_unggulan'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }
}
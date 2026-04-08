<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pamflet extends Model
{
    use HasFactory;

    protected $table = 'pamflets';
    protected $primaryKey = 'id_pamflet';
    protected $fillable = ['id_kegiatan', 'nama_file', 'path_file', 'tgl_upload'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }
}
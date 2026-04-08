<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';
    protected $primaryKey = 'id_absensi';
    protected $fillable = ['id_daftar', 'hadir', 'waktu_hadir', 'keterangan'];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_daftar');
    }
}
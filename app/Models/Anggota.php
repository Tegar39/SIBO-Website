<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggotas';
    protected $primaryKey = 'id_anggota';
    protected $fillable = [
        'id_user', 'nomor_anggota', 'nama_lengkap', 'tempat_lahir',
        'tgl_lahir', 'alamat', 'kontak', 'pac', 'foto_profil'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'id_anggota');
    }
}
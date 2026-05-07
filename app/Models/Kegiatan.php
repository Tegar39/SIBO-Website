<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans';
    protected $primaryKey = 'id_kegiatan';
    protected $fillable = [
        'id_kategori', 'judul', 'deskripsi', 'tanggal', 'waktu',
        'lokasi', 'kuota', 'status', 'created_by'
    ];

    // TAMBAHKAN CASTS INI
    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime',
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

    public function getJumlahPesertaAttribute()
    {
        return $this->pendaftarans()->where('status', 'disetujui')->count();
    }

    public function scopeBisaDidaftar($query)
    {
        return $query->where('status', 'aktif')
            ->where(function($q) {
                $q->whereDate('tanggal', '>', now())
                ->orWhere(function($sub) {
                    $sub->whereDate('tanggal', now()->toDateString())
                        ->whereTime('waktu', '>', now()->format('H:i:s'));
                });
            });
    }

    public function getBisaDaftarAttribute()
    {
        if ($this->status !== 'aktif') return false;
        
        $now = now('Asia/Jakarta');
        $tanggalKegiatan = $this->tanggal; // sudah jadi Carbon karena casting
        
        if ($tanggalKegiatan->isToday()) {
            $waktuKegiatan = $this->waktu ?? now()->setTime(23,59,59);
            return $now->lt($waktuKegiatan);
        }
        
        return $tanggalKegiatan->isFuture();
    }

    public function getBisaAbsenAttribute()
    {
        if ($this->status !== 'selesai') return false;
        
        $now = now('Asia/Jakarta');
        $waktuKegiatan = Carbon::parse($this->tanggal->format('Y-m-d') . ' ' . ($this->waktu ? $this->waktu->format('H:i:s') : '00:00:00'), 'Asia/Jakarta');
        $batasAbsen = $waktuKegiatan->copy()->addHour();
        
        return $now->gt($batasAbsen);
    }
}
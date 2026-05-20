<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $table = 'certificates';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'id_pendaftaran',
        'certificate_number',
        'file_path',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran', 'id_daftar');
    }
}
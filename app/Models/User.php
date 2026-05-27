<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'two_factor_enabled',
        'login_otp_code',
        'login_otp_expires_at',
        'login_otp_attempts',
        'last_login_at',
        'last_login_ip',
        'account_status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'login_otp_code',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_enabled' => 'boolean',
            'login_otp_expires_at' => 'datetime',
            'last_login_at' => 'datetime',
        ];
    }

    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'id_user');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}

<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\PendaftaranSelesai;
use App\Listeners\GenerateCertificate;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PendaftaranSelesai::class => [
            GenerateCertificate::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
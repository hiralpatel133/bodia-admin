<?php

namespace App\Providers;

use App\Services\FileMaintenanceMode;
use Illuminate\Contracts\Foundation\MaintenanceMode;
use Illuminate\Support\ServiceProvider;

class MaintenanceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MaintenanceMode::class, FileMaintenanceMode::class);
    }
}

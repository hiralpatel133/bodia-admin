<?php

namespace App\Services;

use Illuminate\Contracts\Foundation\MaintenanceMode;

class FileMaintenanceMode implements MaintenanceMode
{
    public function active(): bool
    {
        return false;
    }

    public function data(): array
    {
        return [];
    }

    public function activate(array $payload): void
    {
        // Do nothing, we don't want to activate maintenance mode
    }

    public function deactivate(): void
    {
        // Do nothing, we don't want to deactivate maintenance mode
    }
}

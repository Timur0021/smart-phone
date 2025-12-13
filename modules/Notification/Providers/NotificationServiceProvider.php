<?php

namespace Modules\Notification\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $panel = Filament::getPanels()['admin'];
        $panel->discoverResources(in: base_path('modules/Notification/Filament/Resources'), for: 'Modules\\Notification\\Filament\\Resources');
    }
}

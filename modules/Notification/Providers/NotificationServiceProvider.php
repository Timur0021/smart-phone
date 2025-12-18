<?php

namespace Modules\Notification\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        $panel = Filament::getPanels()['admin'];
        $panel->discoverResources(in: base_path('modules/Notification/Filament/Resources'), for: 'Modules\\Notification\\Filament\\Resources');
    }
}

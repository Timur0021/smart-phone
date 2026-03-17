<?php

namespace Modules\Telegram\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class TelegramServiceProvider extends ServiceProvider
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
        $panel->discoverResources(in: base_path('modules/Telegram/Filament/Resources'), for: 'Modules\\Telegram\\Filament\\Resources');
    }
}

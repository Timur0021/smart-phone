<?php

namespace Modules\NovaPoshta\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class NovaPoshtaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config/np-api.php', 'np-api');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $panel = Filament::getPanels()['admin'];
        $panel->discoverResources(in: base_path('modules/NovaPoshta/Filament/Resources'), for: 'Modules\\NovaPoshta\\Filament\\Resources');
    }
}

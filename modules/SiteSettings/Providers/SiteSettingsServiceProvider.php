<?php

namespace Modules\SiteSettings\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Livewire\Mechanisms\ComponentRegistry;

class SiteSettingsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->app->singleton(ComponentRegistry::class, CustomComponentRegistry::class);
        // Реєстрація ресурсів
    }

    public function register(): void
    {
        $panel = Filament::getPanels()['admin'];
        $panel->discoverResources(in: base_path('modules/SiteSettings/Filament/Resources'), for: 'Modules\\SiteSettings\\Filament\\Resources');
    }

}

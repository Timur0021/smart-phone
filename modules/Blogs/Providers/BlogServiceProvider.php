<?php

namespace Modules\Blogs\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
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
        $panel->discoverResources(in: base_path('modules/Blogs/Filament/Resources'), for: 'Modules\\Blogs\\Filament\\Resources');
    }
}

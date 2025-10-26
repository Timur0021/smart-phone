<?php

namespace Modules\Request\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Exceptions\DefinitionException;

class RequestServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * @throws DefinitionException
     */
    public function register(): void
    {
        $panel = Filament::getPanels()['admin'];
        $panel->discoverResources(in: base_path('modules/Request/Filament/Resources'), for: 'Modules\\Request\\Filament\\Resources');
    }

}

<?php

namespace Modules\Team\Providers;

use Filament\Facades\Filament;
use GraphQL\Type\Definition\PhpEnumType;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Nuwave\Lighthouse\Exceptions\DefinitionException;
use Nuwave\Lighthouse\Schema\TypeRegistry;

class TeamServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(base_path('Team', 'Resources/views'), 'team');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * @throws DefinitionException
     */
    public function register(): void
    {
        $panel = Filament::getPanels()['admin'];
        $this->registerGraphQLEnums();
        $panel->discoverResources(in: base_path('modules/Team/Filament/Resources'), for: 'Modules\\Team\\Filament\\Resources');
    }

    /**
     * @throws DefinitionException
     */
    protected function registerGraphQLEnums(): void
    {
       //
    }
}

<?php

namespace Modules\Pages\Providers;

use Filament\Facades\Filament;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        FilamentColor::register([
            'danger' => Color::Red,
            'gray' => Color::Zinc,
            'info' => Color::Blue,
            'fuchsia' => Color::Fuchsia,
            'success' => Color::Green,
            'warning' => Color::Amber,
            'orange' => Color::Orange,
            'cyan' => Color::Cyan,
        ]);
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
    public function register(): void
    {
        $panel = Filament::getPanels()['admin'];
        $panel->discoverResources(in: base_path('modules/Pages/Filament/Resources'), for: 'Modules\\Pages\\Filament\\Resources');
    }
}

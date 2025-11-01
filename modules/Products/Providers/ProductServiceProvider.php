<?php

namespace Modules\Products\Providers;

use Filament\Facades\Filament;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\ServiceProvider;
use Modules\Products\Models\Product;
use Modules\Products\Observers\ProductObserver;

class ProductServiceProvider extends ServiceProvider
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
        $panel->discoverResources(in: base_path('modules/Products/Filament/Resources'), for: 'Modules\\Products\\Filament\\Resources');
    }
}

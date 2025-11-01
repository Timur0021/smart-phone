<?php

namespace App\Providers;

use App\Filament\CustomComponentRegistry;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Livewire\Mechanisms\ComponentRegistry;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(ComponentRegistry::class, CustomComponentRegistry::class);
        Filament::serving(function () {
            App::setLocale('uk');
        });
    }
}

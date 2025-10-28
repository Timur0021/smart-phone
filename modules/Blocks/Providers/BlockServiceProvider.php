<?php

namespace Modules\Blocks\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Modules\Blocks\Models\Block;
use Modules\Blocks\Models\TemplateBlock;
use Modules\Blocks\Observers\BlockObserver;
use Modules\Blocks\Observers\TemplateBlockObserver;

class BlockServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Block::observe(BlockObserver::class);
        TemplateBlock::observe(TemplateBlockObserver::class);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
    public function register(): void
    {
        $panel = Filament::getPanels()['admin'];
        $panel->discoverResources(in: base_path('modules/Blocks/Filament/Resources'), for: 'Modules\\Blocks\\Filament\\Resources');
    }
}

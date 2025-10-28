<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    \Modules\Team\Providers\TeamServiceProvider::class,
    \Modules\Request\Providers\RequestServiceProvider::class,
    \Modules\Blocks\Providers\BlockServiceProvider::class,
    \Modules\Pages\Providers\PageServiceProvider::class,
];

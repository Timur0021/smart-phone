<?php

namespace Modules\Team\Filament\Resources\Admin\AdminResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Modules\Team\Models\User;

class CountUsers extends BaseWidget
{
    protected static ?string $pollingInterval = '1s';

    protected function getStats(): array
    {
        $superAdminCounts = User::whereHas('roles', fn($query) => $query->where('name', 'super_admin'))->count();
        $adminCount = User::whereHas('roles', fn($query) => $query->where('name', 'admin'))->count();
        $studentCount = User::whereHas('roles', fn($query) => $query->where('name', 'student'))->count();

        return [
            Stat::make('Супер адміністратори', $superAdminCounts)
                ->description('Загальна кількість супер адміністраторів')
                ->icon('heroicon-o-user-group'),

            Stat::make('Адміністратори', $adminCount)
                ->description('Загальна кількість адміністраторів')
                ->icon('heroicon-o-user'),

            Stat::make('Студенти', $studentCount)
                ->description('Загальна кількість студентів')
                ->icon('fas-graduation-cap')
        ];
    }
}

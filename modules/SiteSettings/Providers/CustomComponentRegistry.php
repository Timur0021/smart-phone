<?php

namespace Modules\SiteSettings\Providers;

use Livewire\Mechanisms\ComponentRegistry;

class CustomComponentRegistry extends ComponentRegistry
{
    protected function generateClassFromName($name)
    {
        $rootNamespace = '';

        $class = collect(str($name)->explode('.'))
            ->map(fn ($segment) => (string) str($segment)->studly())
            ->join('\\');

        if (empty($rootNamespace)) {
            return $class;
        }

        return '\\' . $rootNamespace . '\\' . $class;
    }
}

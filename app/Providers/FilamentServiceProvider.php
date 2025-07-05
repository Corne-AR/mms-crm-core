<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Css;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        FilamentAsset::register([
            Css::make('mms-brand', __DIR__ . '/../../public/css/mms-brand.css'),
        ]);
    }
}

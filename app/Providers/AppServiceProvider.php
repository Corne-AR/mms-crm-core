<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Css;

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
		FilamentAsset::register([
			Css::make('mms-brand', asset('css/mms-brand.css')),
		]);
	}
}

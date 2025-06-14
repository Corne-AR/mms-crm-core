<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
	public function boot()
	{
		$this->registerPolicies();

		Gate::define('viewInternalDashboard', function ($user) {
			return $user->role === 'admin' || $user->role === 'internal';
		});

		Gate::define('viewDealerDashboard', function ($user) {
			return $user->role === 'dealer' || $user->role === 'sub-dealer';
		});
	}
}

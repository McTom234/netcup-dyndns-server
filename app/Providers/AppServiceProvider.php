<?php

namespace App\Providers;

use App\Services\Netcup\ApiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ApiService::class, static fn () => new ApiService(
            config('services.netcup-ccp.customer_number'),
            config('services.netcup-ccp.api_key'),
            config('services.netcup-ccp.api_password'),
            config('services.netcup-ccp.api_endpoint'),
        ));
    }

    public function boot(): void
    {
    }
}

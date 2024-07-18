<?php

namespace DREID\LaravelJtlApi\Providers;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/jtl-api.php', 'jtl-api'
        );

        $this->publishes([__DIR__ . '/../../config/jtl-api.php' => config_path('jtl-api.php')]);

        $this->publishes([
            __DIR__ . '/../../resources/assets' => resource_path('vendor/drei-d/laravel-jtl-api/assets')
        ], 'assets');
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $router = $this->app['router'];

        //backoffice
        $router->aliasMiddleware('backoffice.permission', \App\Laravel\Middlewares\Backoffice\SpatiePermissionMiddleware::class);
    }
}

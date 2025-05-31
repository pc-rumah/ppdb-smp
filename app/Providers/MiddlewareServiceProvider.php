<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Middleware\RoleMiddleware;

class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Router $router): void
    {
        $router->aliasMiddleware('role', RoleMiddleware::class);
    }
}

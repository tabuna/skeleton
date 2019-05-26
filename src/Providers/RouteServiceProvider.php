<?php

namespace Orchids\LMS\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Orchid\Platform\Http\Middleware\AccessMiddleware;
use Orchid\Platform\Widget\WidgetContractInterface;
use Orchid\Platform\Dashboard;
use :vendor\:package_name\Models\Package;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @internal param Router $router
     */
    public function boot()
    {
        Route::middlewareGroup('dashboard', [
            AccessMiddleware::class,
        ]);

        $this->binding();

        parent::boot();
    }

    /**
     * Route binding.
     */
    public function binding()
    {

        Route::bind(':package_name', function ($value) {
			return Package::firstOrNew(['id'=>$value]);
        });

    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::domain((string) config('platform.domain'))
            ->prefix(Dashboard::prefix(':package_name'))
            ->as('platform.:package_name.')
            ->middleware(config('platform.middleware.private'))
            ->group(realpath(:package_name_PATH.'/routes/platform.php'));
    }
}

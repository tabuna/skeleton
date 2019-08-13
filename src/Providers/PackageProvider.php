<?php
namespace :vendor\:package_name\Providers;

use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;


class :package_nameProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     * After change run:  php artisan vendor:publish --provider=":vendor\:package_name\Providers\:package_nameProvider"
     */
    public function boot(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;

        $this->registerTranslations();

        $this->loadViewsFrom($this->getPath('/resources/views'), ':_package_name');

        $this->loadMigrationsFrom($this->getPath('/database/migrations'));

        View::composer('platform::dashboard', MenuComposer::class);

        $this->dashboard
            ->addPublicDirectory(':_package_name',$this->getPath('/public/'));
        View::composer('platform::layouts.app', function () {
            \Dashboard::registerResource('scripts', orchid_mix('/js/app.js', ':_package_name'))
                ->registerResource('stylesheets', orchid_mix('/css/app.css', ':_package_name'));
        });

        $this->app->booted(function () {
            $this->dashboard->registerPermissions($this->registerPermissions());
            $this->routes();
        });
    }

    /**
     * @return array
     */
    protected function registerPermissions(): ItemPermission
    {
        return ItemPermission::group(__(':package_name'))
            ->addPermission('platform.:_package_name', __(':package_name'));
    }

    /**
     * Get real path
     */
    public function getPath($path)
    {
        return realpath(__DIR__.'/../../'.$path);
    }


    /**
     * Register translations.
     *
     * @return $this
     */
    public function registerTranslations(): self
    {
        $this->loadJsonTranslationsFrom($this->getPath('/resources/lang/'));
        return $this;
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }
        Route::domain((string) config('platform.domain'))
            ->prefix(Dashboard::prefix('/:_package_name'))
            ->as('platform.:_package_name.')
            ->middleware(config('platform.middleware.private'))
            ->group($this->getPath('/routes/route.php'));
    }
}

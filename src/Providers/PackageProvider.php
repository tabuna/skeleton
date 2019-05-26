<?php
namespace :vendor\:package_name\Providers;

use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\View;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;

class PackageProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     * After change run:  php artisan vendor:publish --provider="Orchids\DemoKit\Providers\DemoKitProvider"
     */
    public function boot(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;


        $this->registerTranslations();

        $this->loadViewsFrom(realpath(:package_name_PATH.'/resources/views'), ':_package_name');

        $this->loadMigrationsFrom(realpath(:package_name_PATH.'/database/migrations'));

        View::composer('platform::dashboard', MenuComposer::class);

        $this->dashboard
            ->addPublicDirectory(':_package_name',:package_name_PATH.'/public/');
        \View::composer('platform::layouts.app', function () {
            \Dashboard::registerResource('scripts', orchid_mix('/js/app.js', ':_package_name'))
                ->registerResource('stylesheets', orchid_mix('/css/app.css', ':_package_name'));
        });

        $this->app->register(RouteServiceProvider::class);

        $this->app->booted(function () {
            $this->dashboard->registerPermissions($this->registerPermissions());
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
     * Register the service provider.
     */
    public function register()
    {

        if (! defined(':package_name_PATH')) {
            define(':package_name_PATH', realpath(__DIR__.'/../../'));
        }
    }

    /**
     * Register translations.
     *
     * @return $this
     */
    public function registerTranslations(): self
    {
        $this->loadJsonTranslationsFrom(realpath(:package_name_PATH.'/resources/lang/'));
        return $this;
    }
}
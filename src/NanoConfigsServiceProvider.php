<?php namespace NanoSoluctions\NanoConfigs;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class NanoConfigsServiceProvider extends ServiceProvider
{
    const _NAMESPACE = '\NanoSoluctions\NanoConfigs';
    const _PATH_CONTROLLERS = self::_NAMESPACE . '\Controllers';    

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if(!$this->app->routesAreCached()){
            require __DIR__.'/Routes.php';
        }

        $this->loadViewsFrom(base_path('resources/views'), 'nano');
        $this->publishes([
            __DIR__.'/Views' => base_path('resources/views/nano'),
            __DIR__.'/Migrations' => base_path('database/migrations'),
            __DIR__.'/Seeds' => base_path('database/seeds')
        ], 'migrations');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('NanoConfigs', function ($app) {
            return new NanoConfigs();
        });
    }
}
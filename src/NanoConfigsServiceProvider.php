<?php namespace NanoSoluctions\NanoConfigs;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Config;
use NanoSoluctions\NanoConfigs\Models\NanoUser;
use NanoSoluctions\NanoConfigs\NanoMiddleware;

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

        $this->app['router']->aliasMiddleware('nano', NanoMiddleware::class);

        if(!$this->app->routesAreCached()){
            require __DIR__.'/Routes.php';
        }

        $this->loadViewsFrom(__DIR__.'/Views', 'nano');
        
        $this->publishes([
            __DIR__.'/Migrations' => base_path('database/migrations'),
            __DIR__.'/Seeds' => base_path('database/seeds'),
            __DIR__.'/assets' => base_path('public/nanoassets')
        ], 'migrations');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        Config::set('auth.providers', ['nano' => [
            'driver' => 'eloquent',
            'model' => NanoUser::class,
        ]]);

        Config::set('auth.guards', ['nano' => [
            'driver' => 'session',
            'provider' => 'nano',
        ]]);

        Config::set('auth.passwods.users.provider', 'nano');
        Config::set('auth.defaults.guard', 'nano');

        $this->app->singleton('NanoConfigs', function ($app) {
            return new NanoConfigs();
        });
    }
}
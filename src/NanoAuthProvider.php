<?php namespace NanoSoluctions\NanoConfigs;

use NanoSoluctions\Auth\NanoUserProvider;
use Illuminate\Support\ServiceProvider;

class NanoAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app['auth']->extend('nano',function()
        {

            return new NanoUserProvider();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
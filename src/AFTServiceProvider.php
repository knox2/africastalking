<?php

namespace Knox\AFT;

use Illuminate\Support\ServiceProvider;

class AFTServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/aft.php' => config_path('aft.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/Config/aft.php', 'aft');


        $this->app['aft'] = $this->app->share(function($app) {
            return new AFT;
        });
    }
}

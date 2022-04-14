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
        ], 'aft');

        $this->mergeConfigFrom( __DIR__.'/Config/aft.php', 'aft');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AFT::class, function () {
            return new AFT();
        });
        $this->app->alias(AFT::class, 'AFT');
    }
}

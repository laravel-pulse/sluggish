<?php

namespace LaravelPulse\Sluggish;

use Illuminate\Support\ServiceProvider;
use LaravelPulse\Sluggish\Interfaces\SluggishInterface;
use LaravelPulse\Sluggish\Sluggish;

class SluggishServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * This method is called after all other service providers have been
     * registered, meaning you have access to all other services that have
     * been registered by the framework.
     */
    public function boot()
    {
        // Publish the configuration file
        $this->publishes([
            __DIR__ . '/../config/sluggish.php' => config_path('sluggish.php'),
        ], 'sluggish');
    }

    /**
     * Register the application services.
     *
     * This method is called when the service provider is booted and is
     * used to bind classes into the container or perform any other
     * registration.
     */
    public function register()
    {
        // Bind SluggishInterface to a singleton instance of Sluggish class
        $this->app->singleton(SluggishInterface::class, function () {
            return new Sluggish;
        });

        // Bind the alias 'Sluggish' to a new instance of the Sluggish class
        $this->app->bind('Sluggish', Sluggish::class);

        // Merge the package configuration with the existing Laravel configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/sluggish.php', 'sluggish');
    }
}

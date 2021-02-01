<?php

namespace KornellRus\LaravelTranslate;

use Illuminate\Support\ServiceProvider;

class LaravelTranslateServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'kornellrus');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'kornellrus');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laraveltranslate.php', 'laraveltranslate');

        $this->app->singleton('TranslateManager', function ($app) {
            return new LaravelTranslateManager(app());
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laraveltranslate'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laraveltranslate.php' => config_path('laraveltranslate.php'),
        ], 'laraveltranslate.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/kornellrus'),
        ], 'laraveltranslate.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/kornellrus'),
        ], 'laraveltranslate.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/kornellrus'),
        ], 'laraveltranslate.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}

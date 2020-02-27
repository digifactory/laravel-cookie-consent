<?php

namespace DigiFactory\CookieConsent;

use DigiFactory\CookieConsent\Contracts\ConsentProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class CookieConsentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Blade::if('cookieConsentNecessary', function () {
            return app(ConsentProvider::class)->forNecessary();
        });

        Blade::if('cookieConsentPreferences', function () {
            return app(ConsentProvider::class)->forPreferences();
        });

        Blade::if('cookieConsentStatistics', function () {
            return app(ConsentProvider::class)->forStatistics();
        });

        Blade::if('cookieConsentMarketing', function () {
            return app(ConsentProvider::class)->forMarketing();
        });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('cookie-consent.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'cookie-consent');

        if ($this->app instanceof Application) {
            $config = $this->app->config['cookie-consent'];

            $this->app->singleton(ConsentProvider::class, $config['provider']);
            $this->app->bind('cookie-consent', CookieConsent::class);
        }
    }
}

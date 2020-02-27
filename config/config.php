<?php

return [
    /**
     * If set to false, the CookieConsent class will always return
     * true. You can leave your Blade directives in your views.
     */
    'enabled' => env('COOKIE_CONSENT_ENABLED', true),

    /**
     * By default this package uses CookieBot to determine if certain
     * types of cookies are allowed. Of course you can use a provider
     * of your own, your provider should implement the ConsentProvider
     * interface.
     */
    'provider' => \DigiFactory\CookieConsent\Providers\CookieBot::class,
];

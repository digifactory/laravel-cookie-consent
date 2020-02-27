<?php

namespace DigiFactory\CookieConsent\Tests\Providers;

use DigiFactory\CookieConsent\Contracts\ConsentProvider;

class AllowAll implements ConsentProvider
{
    public function forNecessary(): bool
    {
        return true;
    }

    public function forPreferences(): bool
    {
        return true;
    }

    public function forStatistics(): bool
    {
        return true;
    }

    public function forMarketing(): bool
    {
        return true;
    }
}

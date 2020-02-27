<?php

namespace DigiFactory\CookieConsent\Tests\Providers;

use DigiFactory\CookieConsent\Contracts\ConsentProvider;

class DenyAll implements ConsentProvider
{
    public function forNecessary(): bool
    {
        return false;
    }

    public function forPreferences(): bool
    {
        return false;
    }

    public function forStatistics(): bool
    {
        return false;
    }

    public function forMarketing(): bool
    {
        return false;
    }
}

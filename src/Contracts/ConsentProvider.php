<?php

namespace DigiFactory\CookieConsent\Contracts;

interface ConsentProvider
{
    public function forNecessary(): bool;

    public function forPreferences(): bool;

    public function forStatistics(): bool;

    public function forMarketing(): bool;
}

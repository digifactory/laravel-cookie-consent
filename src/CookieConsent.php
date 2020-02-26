<?php

namespace DigiFactory\CookieConsent;

use DigiFactory\CookieConsent\Contracts\ConsentProvider;

class CookieConsent
{
    const CONSENT_NECESSARY = 'necessary';
    const CONSENT_PREFERENCES = 'preferences';
    const CONSENT_STATISTICS = 'statistics';
    const CONSENT_MARKETING = 'marketing';

    protected $provider;

    public function __construct(ConsentProvider $provider)
    {
        $this->provider = $provider;
    }

    public function forNecessary()
    {
        return $this->provider->forNecessary();
    }

    public function forPreferences()
    {
        return $this->provider->forPreferences();
    }

    public function forStatistics()
    {
        return $this->provider->forStatistics();
    }

    public function forMarketing()
    {
        return $this->provider->forMarketing();
    }
}
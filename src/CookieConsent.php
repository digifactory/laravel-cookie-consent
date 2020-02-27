<?php

namespace DigiFactory\CookieConsent;

use DigiFactory\CookieConsent\Contracts\ConsentProvider;
use Illuminate\Config\Repository;

class CookieConsent
{
    const CONSENT_NECESSARY = 'necessary';
    const CONSENT_PREFERENCES = 'preferences';
    const CONSENT_STATISTICS = 'statistics';
    const CONSENT_MARKETING = 'marketing';

    protected $enabled;
    protected $provider;

    public function __construct(ConsentProvider $provider, Repository $config)
    {
        $this->enabled = $config['cookie-consent']['enabled'];
        $this->provider = $provider;
    }

    public function forNecessary()
    {
        return ! $this->enabled || $this->provider->forNecessary();
    }

    public function forPreferences()
    {
        return ! $this->enabled || $this->provider->forPreferences();
    }

    public function forStatistics()
    {
        return ! $this->enabled || $this->provider->forStatistics();
    }

    public function forMarketing()
    {
        return ! $this->enabled || $this->provider->forMarketing();
    }
}

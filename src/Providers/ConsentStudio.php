<?php

namespace DigiFactory\CookieConsent\Providers;

use DigiFactory\CookieConsent\Contracts\ConsentProvider;
use Illuminate\Support\Collection;

class ConsentStudio implements ConsentProvider
{
    public function forNecessary(): bool
    {
        return $this->consentGiven()->contains('neutral');
    }

    public function forPreferences(): bool
    {
        return $this->consentGiven()->contains('functional');
    }

    public function forStatistics(): bool
    {
        return $this->consentGiven()->contains('analytics');
    }

    public function forMarketing(): bool
    {
        return $this->consentGiven()->contains('marketing');
    }

    private function consentGiven(): Collection
    {
        if (isset($_COOKIE['consent-studio__storage'])) {
            return $this->getConsentFor($_COOKIE['consent-studio__storage']);
        } else {
            //The user has not accepted cookies - set strictly necessary cookies only
            return collect('functional');
        }
    }

    private function getConsentFor($cookieConsent): Collection
    {
        $consentFor = collect();

        if (is_array($cookieConsent)) {
            if (in_array('neutral', $cookieConsent)) {
                $consentFor->push('neutral');
            }

            if (in_array('functional', $cookieConsent)) {
                $consentFor->push('functional');
            }

            if (in_array('analytics', $cookieConsent)) {
                $consentFor->push('analytics');
            }

            if (in_array('marketing', $cookieConsent)) {
                $consentFor->push('marketing');
            }
        }

        return $consentFor;
    }
}

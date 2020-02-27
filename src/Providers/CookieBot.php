<?php

namespace DigiFactory\CookieConsent\Providers;

use DigiFactory\CookieConsent\Contracts\ConsentProvider;
use DigiFactory\CookieConsent\CookieConsent;
use Illuminate\Support\Collection;

class CookieBot implements ConsentProvider
{
    public function forNecessary(): bool
    {
        return $this->consentGiven()->contains(CookieConsent::CONSENT_NECESSARY);
    }

    public function forPreferences(): bool
    {
        return $this->consentGiven()->contains(CookieConsent::CONSENT_PREFERENCES);
    }

    public function forStatistics(): bool
    {
        return $this->consentGiven()->contains(CookieConsent::CONSENT_STATISTICS);
    }

    public function forMarketing(): bool
    {
        return $this->consentGiven()->contains(CookieConsent::CONSENT_MARKETING);
    }

    private function consentGiven(): Collection
    {
        // Most of this code is taken from: https://www.cookiebot.com/en/developer/

        if (isset($_COOKIE['CookieConsent'])) {
            // The user is not within a region that requires consent - all cookies are accepted
            if ($_COOKIE['CookieConsent'] === '-1') {
                return collect([
                    CookieConsent::CONSENT_NECESSARY,
                    CookieConsent::CONSENT_PREFERENCES,
                    CookieConsent::CONSENT_MARKETING,
                    CookieConsent::CONSENT_STATISTICS,
                ]);
            } else {
                //Read current user consent in encoded JavaScript format
                $phpJson = preg_replace('/\s*:\s*([a-zA-Z0-9_]+?)([}\[,])/', ':"$1"$2', preg_replace('/([{\[,])\s*([a-zA-Z0-9_]+?):/', '$1"$2":', str_replace("'", '"', stripslashes($_COOKIE['CookieConsent']))));
                $cookieConsent = json_decode($phpJson);

                $consentFor = collect();

                if (filter_var($cookieConsent->necessary, FILTER_VALIDATE_BOOLEAN)) {
                    $consentFor->push(CookieConsent::CONSENT_NECESSARY);
                }

                if (filter_var($cookieConsent->preferences, FILTER_VALIDATE_BOOLEAN)) {
                    $consentFor->push(CookieConsent::CONSENT_PREFERENCES);
                }

                if (filter_var($cookieConsent->statistics, FILTER_VALIDATE_BOOLEAN)) {
                    $consentFor->push(CookieConsent::CONSENT_STATISTICS);
                }

                if (filter_var($cookieConsent->marketing, FILTER_VALIDATE_BOOLEAN)) {
                    $consentFor->push(CookieConsent::CONSENT_MARKETING);
                }

                return $consentFor;
            }
        } else {
            //The user has not accepted cookies - set strictly necessary cookies only
            return collect(CookieConsent::CONSENT_NECESSARY);
        }
    }
}

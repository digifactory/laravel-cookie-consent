<?php

namespace DigiFactory\CookieConsent\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DigiFactory\CookieConsent\Skeleton\SkeletonClass
 */
class CookieConsent extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cookie-consent';
    }
}

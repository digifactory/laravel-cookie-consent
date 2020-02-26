<?php

namespace DigiFactory\CookieConsent\Tests;

use DigiFactory\CookieConsent\CookieConsentServiceProvider;
use Orchestra\Testbench\TestCase;

class ExampleTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [CookieConsentServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}

<?php

namespace DigiFactory\CookieConsent\Tests;

use Orchestra\Testbench\TestCase;
use DigiFactory\CookieConsent\CookieConsentServiceProvider;

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

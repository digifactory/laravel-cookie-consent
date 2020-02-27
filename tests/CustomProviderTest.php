<?php

namespace DigiFactory\CookieConsent\Tests;

use DigiFactory\CookieConsent\Contracts\ConsentProvider;
use DigiFactory\CookieConsent\CookieConsentServiceProvider;
use DigiFactory\CookieConsent\Tests\Providers\AllowAll;
use DigiFactory\CookieConsent\Tests\Providers\DenyAll;
use Illuminate\Support\Facades\View;
use Orchestra\Testbench\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

class CustomProviderTest extends TestCase
{
    use MatchesSnapshots;

    protected function setUp(): void
    {
        parent::setUp();

        View::addLocation(__DIR__.'/stubs');
    }

    protected function getPackageProviders($app)
    {
        return [CookieConsentServiceProvider::class];
    }

    /** @test */
    public function it_allows_all_cookies()
    {
        $this->app->singleton(ConsentProvider::class, AllowAll::class);

        $view = view('consent-test')->render();

        $this->assertMatchesSnapshot($view);

        $cookieConsent = app('cookie-consent');

        $this->assertTrue($cookieConsent->forNecessary());
        $this->assertTrue($cookieConsent->forPreferences());
        $this->assertTrue($cookieConsent->forStatistics());
        $this->assertTrue($cookieConsent->forMarketing());
    }

    /** @test */
    public function it_denies_all_cookies()
    {
        $this->app->singleton(ConsentProvider::class, DenyAll::class);

        $view = view('consent-test')->render();

        $this->assertMatchesSnapshot($view);

        $cookieConsent = app('cookie-consent');

        $this->assertFalse($cookieConsent->forNecessary());
        $this->assertFalse($cookieConsent->forPreferences());
        $this->assertFalse($cookieConsent->forStatistics());
        $this->assertFalse($cookieConsent->forMarketing());
    }
}

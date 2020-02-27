<?php

namespace DigiFactory\CookieConsent\Tests;

use DigiFactory\CookieConsent\CookieConsentServiceProvider;
use Illuminate\Support\Facades\View;
use Orchestra\Testbench\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

class CookiebotProviderTest extends TestCase
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
    public function it_allows_necessary_cookies_without_cookie()
    {
        $view = view('consent-test')->render();

        $this->assertMatchesSnapshot($view);

        $cookieConsent = app('cookie-consent');

        $this->assertTrue($cookieConsent->forNecessary());
        $this->assertFalse($cookieConsent->forPreferences());
        $this->assertFalse($cookieConsent->forStatistics());
        $this->assertFalse($cookieConsent->forMarketing());
    }

    /** @test */
    public function it_does_not_allow_cookies()
    {
        $_COOKIE['CookieConsent'] = "{stamp:'digifactory/laravel-cookie-consent',necessary:false,preferences:false,statistics:false,marketing:false,ver:3,utc:1582284206975}";

        $view = view('consent-test')->render();

        $this->assertMatchesSnapshot($view);

        $cookieConsent = app('cookie-consent');

        $this->assertFalse($cookieConsent->forNecessary());
        $this->assertFalse($cookieConsent->forPreferences());
        $this->assertFalse($cookieConsent->forStatistics());
        $this->assertFalse($cookieConsent->forMarketing());
    }

    /** @test */
    public function it_allows_preference_cookies()
    {
        $_COOKIE['CookieConsent'] = "{stamp:'digifactory/laravel-cookie-consent',necessary:true,preferences:true,statistics:false,marketing:false,ver:3,utc:1582284206975}";

        $view = view('consent-test')->render();

        $this->assertMatchesSnapshot($view);

        $cookieConsent = app('cookie-consent');

        $this->assertTrue($cookieConsent->forNecessary());
        $this->assertTrue($cookieConsent->forPreferences());
        $this->assertFalse($cookieConsent->forStatistics());
        $this->assertFalse($cookieConsent->forMarketing());
    }

    /** @test */
    public function it_allows_statistics_cookies()
    {
        $_COOKIE['CookieConsent'] = "{stamp:'digifactory/laravel-cookie-consent',necessary:true,preferences:false,statistics:true,marketing:false,ver:3,utc:1582284206975}";

        $view = view('consent-test')->render();

        $this->assertMatchesSnapshot($view);

        $cookieConsent = app('cookie-consent');

        $this->assertTrue($cookieConsent->forNecessary());
        $this->assertFalse($cookieConsent->forPreferences());
        $this->assertTrue($cookieConsent->forStatistics());
        $this->assertFalse($cookieConsent->forMarketing());
    }

    /** @test */
    public function it_allows_marketing_cookies()
    {
        $_COOKIE['CookieConsent'] = "{stamp:'digifactory/laravel-cookie-consent',necessary:true,preferences:false,statistics:false,marketing:true,ver:3,utc:1582284206975}";

        $view = view('consent-test')->render();

        $this->assertMatchesSnapshot($view);

        $cookieConsent = app('cookie-consent');

        $this->assertTrue($cookieConsent->forNecessary());
        $this->assertFalse($cookieConsent->forPreferences());
        $this->assertFalse($cookieConsent->forStatistics());
        $this->assertTrue($cookieConsent->forMarketing());
    }
}

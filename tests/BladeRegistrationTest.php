<?php

namespace DigiFactory\CookieConsent\Tests;

use DigiFactory\CookieConsent\CookieConsentServiceProvider;
use Illuminate\Support\Facades\Blade;
use Orchestra\Testbench\TestCase;

class BladeRegistrationTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [CookieConsentServiceProvider::class];
    }

    /**
     * @test
     *
     * @dataProvider registeredBladeDirectives
     */
    public function it_registers_blade_directives($directive)
    {
        $directives = collect(Blade::getCustomDirectives())->keys();

        $this->assertTrue($directives->contains($directive));
    }

    public static function registeredBladeDirectives()
    {
        return [
            ['cookieConsentNecessary'],
            ['unlesscookieConsentNecessary'],
            ['elsecookieConsentNecessary'],
            ['endcookieConsentNecessary'],
            ['cookieConsentPreferences'],
            ['unlesscookieConsentPreferences'],
            ['elsecookieConsentPreferences'],
            ['endcookieConsentPreferences'],
            ['cookieConsentStatistics'],
            ['unlesscookieConsentStatistics'],
            ['elsecookieConsentStatistics'],
            ['endcookieConsentStatistics'],
            ['cookieConsentMarketing'],
            ['unlesscookieConsentMarketing'],
            ['elsecookieConsentMarketing'],
            ['endcookieConsentMarketing'],
        ];
    }
}

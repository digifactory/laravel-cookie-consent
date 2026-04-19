<?php

namespace DigiFactory\CookieConsent\Tests;

use DigiFactory\CookieConsent\CookieConsentServiceProvider;
use Illuminate\Support\Facades\Blade;
use Orchestra\Testbench\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class BladeRegistrationTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [CookieConsentServiceProvider::class];
    }

    #[DataProvider('registeredBladeDirectives')]
    public function test_it_registers_blade_directives(string $directive): void
    {
        $directives = array_keys(Blade::getCustomDirectives());

        $this->assertContains($directive, $directives);
    }

    public static function registeredBladeDirectives(): iterable
    {
        yield ['cookieConsentNecessary'];
        yield ['unlesscookieConsentNecessary'];
        yield ['elsecookieConsentNecessary'];
        yield ['endcookieConsentNecessary'];

        yield ['cookieConsentPreferences'];
        yield ['unlesscookieConsentPreferences'];
        yield ['elsecookieConsentPreferences'];
        yield ['endcookieConsentPreferences'];

        yield ['cookieConsentStatistics'];
        yield ['unlesscookieConsentStatistics'];
        yield ['elsecookieConsentStatistics'];
        yield ['endcookieConsentStatistics'];

        yield ['cookieConsentMarketing'];
        yield ['unlesscookieConsentMarketing'];
        yield ['elsecookieConsentMarketing'];
        yield ['endcookieConsentMarketing'];
    }
}

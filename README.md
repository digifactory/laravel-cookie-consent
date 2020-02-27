# Laravel Cookie Consent

[![Latest Version on Packagist](https://img.shields.io/packagist/v/digifactory/laravel-cookie-consent.svg?style=flat-square)](https://packagist.org/packages/digifactory/laravel-cookie-consent)
[![MIT Licensed](https://img.shields.io/github/license/digifactory/laravel-cookie-consent?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/digifactory/laravel-cookie-consent/master.svg?style=flat-square)](https://travis-ci.org/digifactory/laravel-cookie-consent)
[![Quality Score](https://img.shields.io/scrutinizer/g/digifactory/laravel-cookie-consent.svg?style=flat-square)](https://scrutinizer-ci.com/g/digifactory/laravel-cookie-consent)
[![StyleCI](https://styleci.io/repos/243287364/shield?branch=master)](https://styleci.io/repos/243287364)
[![Total Downloads](https://img.shields.io/packagist/dt/digifactory/laravel-cookie-consent.svg?style=flat-square)](https://packagist.org/packages/digifactory/laravel-cookie-consent)

This package makes dealing with cookie consent in your Laravel app and Blade views a piece of cake. By default the package uses [Cookiebot](https://manage.cookiebot.com/goto/signup?rid=R4INC) as its 'consent provider'. It doesn't replace the Cookiebot's (or any other consent provider's) JavaScript implementation.
Laravel v6.5 is required, this is necessary for the `unless` Blade directive.

## Installation

You can install the package via composer:

```bash
composer require digifactory/laravel-cookie-consent
```

You can publish the config file:
      
``` bash
php artisan vendor:publish --provider="DigiFactory\CookieConsent\CookieConsentServiceProvider" --tag="config"
```

## Usage

By default cookie consent is enabled. This means for all conditionals we use the consent provider to check if the user has given consent. You can disable cookie consent by creating an environment variable `COOKIE_CONSENT_ENABLED` and set it to `false`. If cookie consent is disabled all checks will return `true`, so all cookies are allowed as if the user has given consent for all types of cookies.

### Blade

You can use the following Blade directives in your views:

- `cookieConsentNecessary`
- `unlesscookieConsentNecessary`
- `elsecookieConsentNecessary`
- `endcookieConsentNecessary`
- `cookieConsentPreferences`
- `unlesscookieConsentPreferences`
- `elsecookieConsentPreferences`
- `endcookieConsentPreferences`
- `cookieConsentStatistics`
- `unlesscookieConsentStatistics`
- `elsecookieConsentStatistics`
- `endcookieConsentStatistics`
- `cookieConsentMarketing`
- `unlesscookieConsentMarketing`
- `elsecookieConsentMarketing`
- `endcookieConsentMarketing`

You can do something like this:

```html
@cookieConsentStatistics
<script>
    <!-- Put your analytics code here! -->
</script>
@endcookieConsentStatistics

@cookieConsentMarketing
    <iframe width="560" height="315" src="https://www.youtube.com/embed/fzQSE_3eLKk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
@else
    Please allow marketing cookies to view this video. Click <a href="javascript: Cookiebot.renew()">here</a> to renew or change your cookie consent.
@endcookieConsentMarketing

@unlesscookieConsentPreferences
    We cannot save your preferences because you did not allow preference cookies.
@endcookieConsentPreferences
```

### PHP

Or check for given consent in your PHP code:

```php
CookieConsent::forNecessary();
CookieConsent::forPreferences();
CookieConsent::forStatistics();
CookieConsent::forMarketing();
```

If you don't want to use the Facade then you can use `app('cookie-consent')`:

```php
app('cookie-consent')->forNecessary();
app('cookie-consent')->forPreferences();
app('cookie-consent')->forStatistics();
app('cookie-consent')->forMarketing();
```

### Implementing your own consent provider

You consent provider should implement the `ConsentProvider` contract:

```php
<?php

namespace DigiFactory\CookieConsent\Contracts;

interface ConsentProvider
{
    public function forNecessary(): bool;

    public function forPreferences(): bool;

    public function forStatistics(): bool;

    public function forMarketing(): bool;
}
```

You can override the default provider in the config: 

```php
<?php

return [
    /**
     * By default this package uses Cookiebot to determine if certain
     * types of cookies are allowed. Of course you can use a provider
     * of your own, your provider should implement the ConsentProvider
     * interface.
     */
    'provider' => \DigiFactory\CookieConsent\Providers\Cookiebot::class,
];
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email mark@digifactory.nl instead of using the issue tracker.

## Credits

- [Mark Jansen](https://github.com/digifactory)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
# Laravel Cookie Consent

[![Latest Version on Packagist](https://img.shields.io/packagist/v/digifactory/laravel-cookie-consent.svg?style=flat-square)](https://packagist.org/packages/digifactory/laravel-cookie-consent)
[![MIT Licensed](https://img.shields.io/github/license/digifactory/laravel-cookie-consent?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/digifactory/laravel-cookie-consent/master.svg?style=flat-square)](https://travis-ci.org/digifactory/laravel-cookie-consent)
[![Quality Score](https://img.shields.io/scrutinizer/g/digifactory/laravel-cookie-consent.svg?style=flat-square)](https://scrutinizer-ci.com/g/digifactory/laravel-cookie-consent)
[![StyleCI](https://styleci.io/repos/217690645/shield?branch=master)](https://styleci.io/repos/217690645)
[![Total Downloads](https://img.shields.io/packagist/dt/digifactory/laravel-cookie-consent.svg?style=flat-square)](https://packagist.org/packages/digifactory/laravel-cookie-consent)

This package makes dealing with cookie consent in your Blade views a piece of cake. By default the package uses [CookieBot](https://manage.cookiebot.com/goto/signup?rid=R4INC) as its 'consent provider'.

## Installation

You can install the package via composer:

```bash
composer require digifactory/laravel-cookie-consent
```

## Usage

``` php
@cookieConsentNecessary
User has given consent for necessary cookies!
@endcookieConsentNecessary
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
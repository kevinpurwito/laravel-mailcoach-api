# About Laravel Mailcoach API

[![Tests](https://github.com/kevinpurwito/laravel-mailcoach-api/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/kevinpurwito/laravel-mailcoach-api/actions/workflows/run-tests.yml)
[![Code Style](https://github.com/kevinpurwito/laravel-mailcoach-api/actions/workflows/php-cs-fixer.yml/badge.svg?branch=main)](https://github.com/kevinpurwito/laravel-mailcoach-api/actions/workflows/php-cs-fixer.yml)
[![Psalm](https://github.com/kevinpurwito/laravel-mailcoach-api/actions/workflows/psalm.yml/badge.svg?branch=main)](https://github.com/kevinpurwito/laravel-mailcoach-api/actions/workflows/psalm.yml)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/kevinpurwito/laravel-mailcoach-api.svg?style=flat-square)](https://packagist.org/packages/kevinpurwito/laravel-mailcoach-api)
[![Total Downloads](https://img.shields.io/packagist/dt/kevinpurwito/laravel-mailcoach-api.svg?style=flat-square)](https://packagist.org/packages/kevinpurwito/laravel-mailcoach-api)

Laravel Mailcoach API is a package to make it easier to integrate your own [Mailcoach API](https://mailcoach.app/) for
your other Laravel projects.

Refer to this [docs](https://mailcoach.app/docs/self-hosted/v5/using-the-api/subscribers)

## Installation

You can install the package via composer:

```bash
composer require kevinpurwito/laravel-mailcoach-api
```

## Configuration

The `vendor:publish` command will publish a file named `kp_mailcoach.php` within your laravel project config
folder `config/kp_mailcoach.php`.

Published Config File Contents

```php
[
    'url' => strtolower(env('KP_MAILCOACH_API_URL')),
    
    'token' => env('KP_MAILCOACH_API_TOKEN'),
];
```

Alternatively you can ignore the above publish command and add this following variables to your `.env` file.

```text
KP_MAILCOACH_API_URL=your_mailcoach_api_url
KP_MAILCOACH_API_TOKEN=your_mailcoach_api_token
```

## Auto Discovery

If you're using Laravel 5.5+ you don't need to manually add the service provider or facade. This will be
Auto-Discovered. For all versions of Laravel below 5.5, you must manually add the ServiceProvider & Facade to the
appropriate arrays within your Laravel project `config/app.php`

### Provider

```php
[
    Kevinpurwito\LaravelMailcoachApi\MailcoachApiServiceProvider::class,
];
```

### Alias / Facade

```php
[
    'MailcoachApi' => Kevinpurwito\LaravelMailcoachApi\Facades\MailcoachApi::class,
];
```

## Usage

### Using Facade

```php
use Kevinpurwito\LaravelMailcoachApi\Facades\MailcoachApi;

MailcoachApi::getSubscribers();

```

### Using Class

```php
use Kevinpurwito\LaravelMailcoachApi\MailcoachApi;

$mcApi = (new MailcoachApi());

```

> Be careful! You can only do 3 inquiries per day for 1 customerId for each item.
> For example. you can only inquire about a PLN charge for 1 customerId 3 times, after that you have to pay it or
> inquire again tomorrow.

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email [kevin.purwito@gmail.com](mailto:kevin.purwito@gmail.com)
instead of using the issue tracker.

## Credits

- [Kevin Purwito](https://github.com/kevinpurwito)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com)
by [Beyond Code](http://beyondco.de/)
with some modifications inspired from [PHP Package Skeleton](https://github.com/spatie/package-skeleton-php)
by [spatie](https://spatie.be/).

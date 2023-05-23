<p align="center">
<img src="https://app.fxapi.com/img/logo/fxapi.png" width="300"/>
</p>

# fxapi-php - PHP Foreign Exchange Rates Converter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/everapi/fxapi-php.svg?style=flat-square)](https://packagist.org/packages/everapi/fxapi-php)
[![Total Downloads](https://img.shields.io/packagist/dt/everapi/fxapi-php.svg?style=flat-square)](https://packagist.org/packages/everapi/fxapi-php)

This package is a PHP wrapper for [fxapi.com](https://fxapi.com), a foreign exchange rates API, that aims to make the usage of the API as easy as possible in your project.

## Installation

You can install the package via composer:

```bash
composer require everapi/fxapi-php
```

## Usage

Initialize the API with your API Key (get one for free at [fxapi.com](https://fxapi.com)):

```php
$fxApi = new \FxApi\FxApi\FxApiClient('YOUR-API-KEY');
```

Afterwards you can use the endpoints of the API like this:

```php
echo $fxApi->latest([
    'base_currency' => 'EUR',
    'currencies' => 'USD',
]);
```

Endpoints accessible with a free account:
- `status`
- `currencies`
- `latest`
- `historical`

These advanced endpoints currently require a paid subscription:
- `convert`
- `range`

Learn more about endpoints, parameters and response data structure in the [docs](https://fxapi.com/docs).

[docs]: https://fxapi.com/docs
[fxapi.com]: https://fxapi.com

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

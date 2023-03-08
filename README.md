# Weeyn Product Module
Weeyn catalog product module

![Packagist PHP Version](https://img.shields.io/packagist/dependency-v/weeynsoft/catalog-product/php)
![Packagist Version](https://img.shields.io/packagist/v/weeynsoft/catalog-product)
![Packagist Downloads](https://img.shields.io/packagist/dt/weeynsoft/catalog-product?label=download)
![GitHub](https://img.shields.io/github/license/weeynsoft/catalog-product)


This is the standalone product module of the [Weeyn](https://weeyn.com).

## Installation
---------------

(As Standalone Component)

1. `composer require weeynsoft/catalog-product`
2. `php artisan vendor:publish --provider="Konekt\Concord\ConcordServiceProvider"`
3. Add `Weeyn\CatalogProduct\Providers\ModuleServiceProvider::class` to modules in `config/concord.php`
4. `php artisan migrate`

## Usage
---------------

See the [Weeyn Product Module Documentation](https://weeyn.com/docs/master/catalog-product) for more details. 

## Security Issues
---------------

If you discover a security vulnerability within Weeyn, please follow our
[disclosure procedure][20].

## About Us
--------

Weeyn development is led by the [Weeyn Core Team][22] and supported by [Weeyn contributors][19].
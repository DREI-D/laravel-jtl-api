# Laravel JTL API

This Laravel package provides a wrapper for the new JTL Wawi API.

## Requirements

- Laravel 11 or 12
- PHP 8.2 or higher
- JTL-Wawi 1.10

## Installation

You can install this package via [Composer](https://packagist.org/packages/drei-d/laravel-jtl-api).

```shell
composer require drei-d/laravel-jtl-api
```

## Setup

### Preparations

First, publish the assets and config provided by this package.

```shell
php artisan vendor:publish --provider DREID\\LaravelJtlApi\\Providers\\ServiceProvider
```

This creates a new config file named `jtl-api.php` in your config directory, as well as an app icon image in your
resources directory.

Please update the config file to your needs.
It contains...

- Basic app information, such as the app name and provider
- Required permissions by your app.

As of now, permissions cannot be altered once the app is registered, please proceed with caution.

When finished, add the first two entries of the config to your `.env` file.
<br>You can leave the api key blank for now:

```dotenv
JTL_API_BASE_URL=<your api url, e.g. http://192.168.178.10:5883/api/Mandant_1>
JTL_API_KEY=
```

### App Registration

After setting up your local environment, you have to register your app in the JTL Wawi.
<br>Please start by opening the registration listener (everything until step 5) as described in
the [official documentation](https://guide.jtl-software.com/jtl-wawi/jtl-wawi-api/jtl-wawi-api-nutzen/).

To register your app, you can use the `AppRegistrationHelper` provided by this package.
<br>Use it as follows, for example in a command:

```php
$tokenDto = app(\DREID\LaravelJtlApi\Helpers\AppRegistrationHelper::class)->register();
```

Once called, you can proceed to register your app (continue at step 5) as described in
the [official documentation](https://guide.jtl-software.com/jtl-wawi/jtl-wawi-api/jtl-wawi-api-nutzen/).
The registration helper sends a checkup request every five seconds, it may take a moment to receive the token from the
JTL Wawi, when the manual registration is completed.

Afterward, a dump of the token should like something like this:
```
DREID\LaravelJtlApi\Modules\AppRegistration\DataTransferObjects\TokenDto^ {#843
  +apiKey: "0b1ee12b-2cf8-4fd5-9920-b104789621f0"
} // app/Console/Commands/RegisterAppCommand.php:31
```

Copy the api key and paste it into your `.env` file.

## Usage

Once the registration is completed successfully, you can start using the included repositories.

For example, to list all companies, run:
```php
$repository = app(\DREID\LaravelJtlApi\Modules\Company\CompanyRepository::class);
$response = $repository->queryCompanies();

dump($response->companies);
```

There are also cases, where you might want to add a request body, for example with the customer endpoint:
```php
$repository = app(\DREID\LaravelJtlApi\Modules\Customer\CustomerRepository::class);

$response = $repository->queryCustomers(
    new \DREID\LaravelJtlApi\Modules\Customer\Requests\QueryCustomersRequest(
        searchKeyWord: 'Mustermann',
        pageSize: 100
    )
);

dump($response->items);
```

Please be aware: as of now, not all endpoints are included completely or at all.
<br>We want to continue adding more - if you notice one missing that you need...
<br><br>Feel free to open a pull request!

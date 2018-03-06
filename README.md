# Convert/Compare Units of Measurement in Laravel

With the UnitConvert.io wrapper for Laravel, you can quickly and easily compare and convert units of measurement programmatically.

This package was created and developer by DevSquared - a consultant and development agency located in Pittsburg, KS, USA. [Check out our website](https://dev-squared.com/) to learn more information about us.

## Installation
UnitConvert requires an API key to use this wrapper. You can [sign up for a free account today](https://unitconvert.io) and get started.
This package can be installed through Composer.

`composer require devsquared/unitconvert-laravel`

In Laravel 5.5 and above, the package will autoregister the provider and the alias. For Laravel 5.4 and below, you must install the provider and the alias.

```
// config/app.php
'providers' => [
    ...
    DevSquared\UnitConvert\UnitConvertProvider::class,
    ...
];

'aliases' => [
    ...
    'UnitConvert' => DevSquared\UnitConvert\UnitConvertFacade::class,
    ...
];
```
Next, you will need to add your API key to the config. You can add it to your `.env` file as 

`UNITCONVERT_API_KEY=`

Optionally, you can publish the config file of this package with this command:

`php artisan vendor:publish --provider="DevSquared\UnitConvert\UnitConvertServiceProvider"`

## Usage

The UnitConvert database contains variants as people use the system. Commonly misspellings, abbreviations, and full words are all excepted strings in addition to the measurement value.
Below is an example of how to compare and convert a unit of measurement(s).

```$xslt
// Comparing a Measurement
$response = UnitConvert::compare('10mg', '==', '10 pounds');
$success = $response->getSuccess(); // Returns true
$result = $response->getResult(); // Returns false

// Converting a Measurement
$response = UnitConvert::convert('20 miles', 'kilometers');
$success = $response->getSuccess(); // Returns true
$amount = $response->getAmount(); // Returns 32.1868
$unit = $response->getUnit(); // Returns "Kilometers"
$display = $response->getDisplay(); // Returns "32.18680 Kilometers"
```

## Changelog

Please see [the changelog]() for more information on what has changed recently.

## Using this? Let us know!

We really enjoy seeing our work being used in production environments. If you decide to implement this wrapper, feel free to let us know and share your work. You can send us an email on our website: https://dev-squared.com

## License

The MIT License (MIT). Please see the [License File](LICENSE.md) for more information.
# new-relic-helper

New Relic helper package for Faith FM Laravel Projects.

## Installation

Add this library to your project's `composer.json` file:

```json
{
    "repositories": {
        ...
        "new-relic-helper": {
            "type": "vcs",
            "url": "https://github.com/faithfm/new-relic-helper"
        }
    }
}
```

Require with composer:

```bash
composer require faithfm/new-relic-helper
```

## Basic Usage

* This package automatically sets the New Relic APM name based on your Laravel APP_NAME.   (PHP applications without this package installed will typically show up in New Relic as a default application - ie: "PHP FPM DefaultApp - servername")

* By default, New Relic's APM traces are sampled for 100% of calls to each web/console request. This package allows you to select a reduced sampling rate for specific endpoints that generate high volumes of traffic - ie:

```php
use FaithFM\NewRelicHelper\NewRelicHelper;

...

NewRelicHelper::reduceTraceSampling(0.1);       // Send only 10% of traces to New Relic
```

## Notes

* It is recommended to use .env/config values for sample rates - ie add a section like the following to your `config/myapp.php` file, and create the appropriate .env variable:

```php
...
    /*
    |--------------------------------------------------------------------------
    | Sample rates for New Relic traces
    |--------------------------------------------------------------------------
    |
    */
    'nr_sample_rate' => [
        'xxx' =>env('NR_SAMPLE_RATE_XXX', 0.1),
    ],

```

* It can then be used like this:

```php
NewRelicHelper::reduceTraceSampling(config('myapp.nr_sample_rate.xxx'));

```


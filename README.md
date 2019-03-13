# Healthz module for Craft CMS 3.x

![Icon](resources/healthz.png)

A really basic healthz check module for Craft CMS.

## Background

If you running your Craft CMS servers behind a loadbalancer or you are monitoring your site with an external monitoring tools, you need an endpoint which

* answers early and doesn't walk through the whole stack
* answers with an 200 Ok even when a migration is waiting
* checks if the connection to the database and cache is available

## Requirements

* Craft CMS >= 3.0.0

## Installation

```shell
cd /path/to/project
composer require codemonauts/craft-healthz
```

Then add the module to the ```app.php``` in your Craft config directory like this:

```php
<?php
return [
    // ...
    'modules' => [
        // ...
        'healthz' => codemonauts\healthz\Healthz::class,
    ],
    'bootstrap' => ['healthz'],
];
```

## Usage

The endpoint for your monitoring system or loadbalancer is

```http(s)://yoursite.com/healthz```

The script answers with ```200 Ok``` or ```503 Not Ok```

With ❤ by [codemonauts](https://codemonauts.com)
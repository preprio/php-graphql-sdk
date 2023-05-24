# PHP + Prepr SDK

This package is an SDK for the GraphQL API.

## Basics
The SDK on [GitHub](https://github.com/preprio/php-sdk)  

Minimal PHP version: `^8.2` 

Requires `GuzzleHttp ^7.7.0` 

For Laravel projects we recommend using the Laravel providers for [REST](https://github.com/preprio/laravel-rest-sdk) or [GraphQL](https://github.com/preprio/laravel-graphql-sdk).

## Installation

You can install the SDK as a composer package.

```bash
composer require preprio/php-graphql-sdk
```

## Making your first request

Let's start with getting some content items from your Prepr Environment. 

```php
<?php

use Preprio\Prepr;

$apiRequest = new Prepr('{ENDPOINT_URL}');

$apiRequest
    ->headers([
    
    ])
    ->query('fileurl')
    ->variables([
    
    ])
    ->request();

print_r($apiRequest->getResponse());
```

```php
<?php

use Preprio\Prepr;

$apiRequest = new Prepr('{ENDPOINT_URL}');

$apiRequest
    ->headers([
    
    ])
    ->rawQuery('raw-query')
    ->variables([
    
    ])
    ->request();

print_r($apiRequest->getResponse());
```

### Debug Errors

With `$apiRequest->getRawResponse()` you can get the raw response from the Prepr API.

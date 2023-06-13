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

Let's start with getting some content items from your Prepr environment.

```php
<?php

use Preprio\Prepr;

$apiRequest = new Prepr('{ENDPOINT_URL}');

$apiRequest
    ->rawQuery('{
                  Posts( limit : 30 ) {
                    items {
                        _id
                        _slug
                        title
                    }
                  }
                }')
    ->request();

print_r($apiRequest->getResponse());
```

In the example above, we wrote all of our arguments inside the query string. However, in most applications, the arguments to fields will be dynamic.
To add these properties, use the `variables` method.

```php
<?php

use Preprio\Prepr;

$apiRequest = new Prepr('{ENDPOINT_URL}');

$apiRequest
    ->rawQuery('query ($search : String) {
                    Posts(where: { _search : $search }) {
                        items {
                            title
                        }
                    }
                }')
    ->variables([
        'search' => "amsterdam",
    ])
    ->request();

print_r($apiRequest->getResponse());
```

## Using query files

If you saved your GraphQL queries to a static file, you can use the following method to execute those:

```php
<?php

use Preprio\Prepr;

$apiRequest = new Prepr('{ENDPOINT_URL}');

$apiRequest
    ->query('query_file.graphql')
    ->request();

print_r($apiRequest->getResponse());
```

## Adding headers

In some cases, you may need to add headers to your request.
For example, when using Prepr personalization with the `Prepr-Customer-Id` header.

The example below shows how to add extra headers to the requests.

```php
<?php

use Preprio\Prepr;

$apiRequest = new Prepr('{ENDPOINT_URL}');

$apiRequest
    ->headers([
        'Prepr-Customer-Id' => 'your-customers-session-or-customer-id'
    ])
    ->request();

print_r($apiRequest->getResponse());
```

## Debug Errors

With `$apiRequest->getRawResponse()` you can get the raw response from the Prepr API.

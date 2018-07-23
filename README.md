# baseify-php-sdk
This API is used for the baseify.com Publisher API for `Product Search`.


## Installation:
[Composer](http://getcomposer.org/) to install package.

Use `composer require tmarois/baseify-php-sdk`


## Basic Usage:
```php

$baseify = (new Baseify('YOUR_CLIENT_KEY'))->productSearch([
    'domain' => 'yourdomain.com'
]);

// set the users IP address
// This allows the API to return the proper results
$baseify->user()->set('ip',$testIp);
// set the user agent (also a requirement)
$baseify->user()->set('ua',$testAgent);
// how many items do you want to limit this request to
$baseify->filter()->set('limit',10);

// send in the query request
$results = $baseify->query('car chargers');

// get a list of all the products returned
$products = $results->getProducts();

// count how many products are returned
$products->count();

// get a list of the stores in the results
$stores = $results->getStores();

```

## Resources:
* [Baseify Documentation](https://www.baseify.com/knowledgebase/developers/)


## Contributions
Accepting contributions and feedback. Send in any issues and pull requests.

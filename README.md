# baseify-php-sdk
This SDK is used for the baseify.com Publisher API for `Product Search`.


## Installation:
[Composer](http://getcomposer.org/) to install package.

Use `composer require tmarois/baseify-php-sdk`


## Configuration Usage:
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
```

## Query Usage:
```php
// send in the query request
$results = $baseify->query('car chargers');

// get a list of all the products returned
$products = $results->getProducts();

// count how many products are returned
$products->count();

// get a list of the stores in the results
$stores = $results->getStores();

// get a list of the brands in the results
$brands = $results->getBrands();

// get a list of the brands in the results
$categories = $results->getCategories();

```

## Results:

Using the `query()` method returns `Baseify\Api\ProductSearch\Results`

|Method  |Description |
|---	 |---		  |
|`getRaw()`  | Get the raw `JSON` results |
|`getStatus()` | Get the status of results |
|`getMessage()` | Get the status message of results |
|`getEndpoint()` | Get the full API URL Request |
|`getStores()` | Get an `array` of stores (pulled from products) |
|`getBrands()` | Get an `array` of brands (pulled from products) |
|`getCategories()` | Get an `array` of categories (pulled from products) |
|`getCategoryWithIds()` | Get the categories and the category ids |
|`getProducts()` | Get products returned as a `Collection` object |
|`toArray()` | Get an array of entire results |


## Product Collection:

The `getProducts()` returns results using the `Collection` object from [basephp\support](https://github.com/basephp/support), here are the highlighted useful methods.

|Method  |Description |
|---	 |---		  |
|`all()`                    | Get all items in collection |
|`has($key)`                | Returns true if the parameter is defined.  |
|`get($key, $default)`      | Get the specified value.	|
|`first()`              | Get the first item from the collection. |
|`last()`               | Get the last item from the collection. |
|`shuffle()`            | Shuffle the items in the collection. |
|`slice()`              | Slice the underlying collection array. |
|`reverse()`            | Reverse items order. |
|`remove($key)`         | Removes a item. |
|`count()`              | Returns the number of items. |
|`take($limit)`         | Take the first or last {$limit} items. |
|`map($callable)`       | Run a map over each of the items. |
|`pluck($value, $key)`  | Get the values of a given key. |
|`random($number)`      | Get one or a number of items randomly. |
|`sort($callable)`      | Sort through each item with a callback.. |
|`filter($callable)`    | Run a filter over each of the items.|
|`where($key, $operator, $value)` | Filter items by the given key value pair. |
|`whereIn($key, $values)` | Filter items by the given key value pair. |
|`push($value)`           | Push an item onto the end of the collection. |
|`pull($value)`           | Get and remove an item from the collection. |
|`put($key, $value)`      | Put an item in the collection by key. |
|`toArray()`              | Get the collection of items as a plain array. |
|`toJson()`               | Get the collection of items as JSON. |


## Resources:
* [Baseify Documentation](https://www.baseify.com/knowledgebase/developers/)
* [BasePHP Support](https://github.com/basephp/support)
* [Packagist](https://packagist.org/packages/tmarois/baseify-php-sdk)


## Contributions

Anyone can contribute to the baseify-php-sdk project. Please do so by posting issues when you've found something that is unexpected or sending a pull request for improvements.


## License

baseify-php-sdk is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

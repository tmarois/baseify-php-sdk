# Release Notes


## v1.0.7 (09/05/2018)

### Changed
* Fixed `storeName()`, `brand()`, and `categoryName()` from causing an error when passed an array. There should be no array, but for some reason the API decided to send array through brands, lets fix that issue by converting an array to string.


## v1.0.6 (09/05/2018)

### Added
* Added `aecpc()` method using the `['aecpc']` on the product array.
* Added `categoryId()` method to `Product` class.
* Added `['category_id']` to the `Product` array.
* Added `getCategoryWithIds()` method on the `Results` class

### Changed
* Change the `cpc()` method to `ecpc()` using the `['ecpc']`


## v1.0.5 (08/28/2018)

### Changed
* Removed the `filebase` requirement from `composer.json`


## v1.0.4 (08/22/2018)

### Added
* Added `subid` property into the `User` class as a new variable to pass into the API
* Added `subid` into the API call request. (using `DEFAULT` as the default value)

### Changed
* Removed `subid` property (could not use) from the `ProductSearch` class.


## v1.0.3 (08/08/2018)

### Changed
* Fixed the product array for `cpc` values. Was using `acpc` instead of `aecpc`


## v1.0.2 (07/24/2018)

### Changed
* Fixed `getBrands()`, `getStores()`, and `getCategories()` from having empty arrays.


## v1.0.1 (07/24/2018)

### Added
* Added `brand()` in `Product` object.
* Added `listPrice()` in `Product` object.
* Added `getBrands()` in `Results` object.


## v1.0.0 (07/23/2018)
* Version 1.0 - Initial Release

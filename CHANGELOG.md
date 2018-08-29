# Release Notes


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

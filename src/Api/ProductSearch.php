<?php

namespace Baseify\Api;

use Baseify\Request;
use Baseify\Api\ProductSearch\User;
use Baseify\Api\ProductSearch\Filter;
use Baseify\Api\ProductSearch\Results;

/**
* ProductSearch
*
* Main:
* kw, cuid, subid
*
* Host:
* domain, url
*
* User:
* ip, ua, language, country (testing)
*
* Filters:
* minPrice, maxPrice, price, itemsCount (defualt 15)
*
* Others:
* widget, type
*
* @see https://www.baseify.com/knowledgebase/developers/
*
*/
class ProductSearch
{

    /**
    * kw
    *
    * @var string
    */
    protected $path = 'http://search.ocra.info/api/v1/search';


    /**
    * User Details
    *
    * @see Baseify\Api\ProductSearch\User
    * @var object
    */
    protected $user;


    /**
    * User Details
    *
    * @see Baseify\Api\ProductSearch\Filter
    * @var object
    */
    protected $filter;


    /**
    * cuid
    *
    * @var string
    */
    protected $cuid;


    /**
    * subid
    *
    * @var string
    */
    protected $subid = 'DEFAULT';


    /**
    * data
    *
    * @var array
    */
    protected $data = [];


    /**
    * __construct
    *
    */
    public function __construct($cuid, $data = [])
    {
        $this->cuid = $cuid;

        $this->data = $data;

        $this->user = new User();

        $this->filter = new Filter();
    }


    /**
    * User Object
    *
    * @return Baseify\Api\ProductSearch\User
    */
    public function user()
    {
        return $this->user;
    }


    /**
    * Filter Object
    *
    * @return Baseify\Api\ProductSearch\Filter
    */
    public function filter()
    {
        return $this->filter;
    }


    /**
    * Search and Return the Product Feed
    *
    */
    protected function p($query)
    {
        $param = [
            'cuid' => $this->cuid,
            'subid' => $this->subid,
            'kw' => $query,
            'ip' => $this->user()->get('ip'),
            'ua' => rawurlencode($this->user()->get('ua'))
        ];

        if ($country = $this->user()->get('country')) {
            $param['country'] = $country;
        }

        if ($minPrice = $this->filter()->get('minPrice')) {
            $param['minPrice'] = $minPrice;
        }

        if ($maxPrice = $this->filter()->get('maxPrice')) {
            if ($maxPrice != 0) $param['minPrice'] = $maxPrice;
        }

        if ($itemsCount = $this->filter()->get('limit')) {
            $param['itemsCount'] = $itemsCount;
        }

        return array_merge($this->data, $param);
    }


    /**
    * Search and Return the Product Feed
    *
    */
    public function query($q)
    {
        return (new Results($this,((new Request($this->path,$this->p($q))))));
    }

}

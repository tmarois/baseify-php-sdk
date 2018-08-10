<?php namespace Baseify;

use Baseify\Api\ProductSearch;
use Baseify\Request;

class Baseify
{

    /**
    * $cuid
    *
    * @var string
    */
    protected $cuid;


    /**
    * __construct
    *
    */
    public function __construct($cuid)
    {
        $this->cuid = $cuid;
    }


    /**
    * getId()
    *
    */
    public function getId()
    {
        return $this->cuid;
    }


    /**
    * request()
    *
    */
    public function request($options = [])
    {
        $options = array_merge(['cuid' => $this->cuid], $options);

        return (new Request($options));
    }


    /**
    * productSearch()
    *
    * @return Baseify\Api\ProductSearch
    */
    public function productSearch($data = [])
    {
        return (new ProductSearch($this, $data));
    }

}

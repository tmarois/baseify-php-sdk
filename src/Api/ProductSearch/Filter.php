<?php

namespace Baseify\Api\ProductSearch;

class Filter
{

    /**
    * Item Counts (return how many products?)
    *
    * @var string
    */
    protected $itemCount = 15;


    /**
    * Filter a specific price
    *
    * @var int
    */
    protected $price = 0;


    /**
    * $minPrice
    *
    * @var int
    */
    protected $minPrice = 0;


    /**
    * $maxPrice
    *
    * @var int
    */
    protected $maxPrice = 0;


    /**
    * get method
    *
    */
    public function get($name)
    {
        return $this->$name ?? null;
    }


    /**
    * set method
    *
    */
    public function set($name, $value)
    {
        if (isset($this->$name))
        {
            $this->$name = $value;
        }
    }
}

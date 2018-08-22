<?php

namespace Baseify\Api\ProductSearch;

class User
{

    /**
    * Ip Address
    *
    * @var string
    */
    protected $ip = '';


    /**
    * User Agent
    *
    * @var string
    */
    protected $ua = '';


    /**
    * Subid
    *
    * @var string
    */
    protected $subid = 'DEFAULT';


    /**
    * Country (for Testing Purposes)
    *
    * @var mixed
    */
    protected $country = false;


    /**
    * $language
    *
    *
    * @var string
    */
    protected $language = '';


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

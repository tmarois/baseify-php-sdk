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

<?php

namespace Baseify\Api\ProductSearch;

use Baseify\Api\ProductSearch;
use Baseify\Request;
use Base\Support\Collection;

class Results
{

    /**
    * $productSearch
    *
    * @see Baseify\Api\ProductSearch
    */
    protected $productSearch;


    /**
    * $json
    *
    * @return array
    */
    protected $json;


    /**
    * $status
    *
    * @return string
    */
    protected $status;


    /**
    * $message
    *
    * @return string
    */
    protected $message;


    /**
    * $products
    *
    * @return array
    */
    protected $products = [];


    /**
    * __construct
    *
    */
    public function __construct(ProductSearch $productSearch, $json = [])
    {
        $this->productSearch = $productSearch;

        $this->json = $json;

        $this->status = $this->json['status'] ?? 'error';

        $this->message = $this->json['message'] ?? 'error';

        $this->products = $this->json['info']['items'] ?? [];
    }


    /**
    * getStatus
    *
    */
    public function getStatus()
    {
        return $this->status;
    }


    /**
    * getMessage
    *
    */
    public function getMessage()
    {
        return $this->message;
    }


    /**
    * getProducts
    *
    */
    public function getProducts()
    {
        return (new Collection($this->products));
    }


}

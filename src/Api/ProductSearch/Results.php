<?php

namespace Baseify\Api\ProductSearch;

use Baseify\Request;
use Base\Support\Collection;
use Baseify\Api\ProductSearch;
use Baseify\Api\ProductSearch\Product;

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
    * $feedUri
    *
    * @return string
    */
    protected $feedUri;


    /**
    * $status
    *
    * @return bool
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
    public function __construct(ProductSearch $productSearch, Request $request)
    {
        $this->productSearch = $productSearch;

        $this->json = $request->output();

        $this->feedUri = $request->getEffectiveUri();

        $this->status = $this->json['success'] ?? false;

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
    * getFeedUri
    *
    */
    public function getFeedUri()
    {
        return $this->feedUri;
    }


    /**
    * getProducts
    *
    */
    public function getProducts()
    {
        return (new Collection($this->products))->map(function($product){
            return (new Product($product));
        });
    }


}

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
    protected $endpoint;


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
    * $categories
    *
    * @return array
    */
    protected $categories = [];


    /**
    * $stores
    *
    * @return array
    */
    protected $stores = [];


    /**
    * __construct
    *
    */
    public function __construct(ProductSearch $productSearch, Request $request)
    {
        $this->productSearch = $productSearch;

        $this->json = $request->output();

        $this->endpoint = $request->getEffectiveUri();

        $this->status = $this->json['success'] ?? false;

        $this->message = $this->json['message'] ?? 'error';

        $this->products = (new Collection(($this->json['info']['items'] ?? [])));

        $this->BuildFilterList();
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
    * getEndpoint
    *
    */
    public function getEndpoint()
    {
        return $this->endpoint;
    }


    /**
    * getStores
    *
    */
    public function getStores()
    {
        return $this->stores;
    }

    /**
    * getCategories
    *
    */
    public function getCategories()
    {
        return $this->categores;
    }


    /**
    * getProducts
    *
    */
    public function getProducts()
    {
        return $this->products->map(function($product){
            return (new Product($product));
        });
    }


    /**
    * BuildFilterList
    *
    */
    protected function BuildFilterList()
    {
        foreach($this->getProducts() as $product)
        {
            if (!in_array($product->storeName(), $this->stores))
            {
                $this->stores[] = $product->storeName();
            }

            if (!in_array($product->categoryName(), $this->categories))
            {
                $this->categories[] = $product->categoryName();
            }
        }
    }


}

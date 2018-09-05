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
    * $categoryIds
    *
    * @return array
    */
    protected $categoryIds = [];


    /**
    * $stores
    *
    * @return array
    */
    protected $stores = [];


    /**
    * $brands
    *
    * @return array
    */
    protected $brands = [];


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
    * getRaw
    *
    */
    public function getRaw()
    {
        return $this->json;
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
        return array_filter($this->stores);
    }


    /**
    * getStores
    *
    */
    public function getBrands()
    {
        return array_filter($this->brands);
    }


    /**
    * getCategories
    *
    */
    public function getCategories()
    {
        return array_filter($this->categories);
    }


    /**
    * getCategoryWithIds
    *
    */
    public function getCategoryWithIds()
    {
        return array_filter($this->categoryIds);
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
    * getFilteredProducts
    *
    */
    public function getFilteredProducts($filterName, $filterValue)
    {
        return $this->getProducts->map(function($product) use ($filterName, $filterValue){
            if ($product->$filterName() == $filterValue) return $product;
        })->filter();
    }


    /**
    * BuildFilterList
    *
    */
    protected function BuildFilterList()
    {
        foreach($this->getProducts() as $product)
        {
            if ($product->storeName() != '')
            {
                if (!isset($this->stores[$product->storeName()])) {
                    $this->stores[$product->storeName()] = 1;
                }
                else {
                    $this->stores[$product->storeName()] += 1;
                }
            }

            if ($product->brand() != '')
            {
                if (!isset($this->brands[$product->brand()])) {
                    $this->brands[$product->brand()] = 1;
                }
                else {
                    $this->brands[$product->brand()] += 1;
                }
            }

            if ($product->categoryName() != '')
            {
                // lets store the category ID + category Name in this array
                $this->categoryIds[$product->categoryId()] = $product->categoryName();

                // lets store the category and their product counts
                // we can use this for filters/display for the user
                if (!isset($this->categories[$product->categoryName()])) {
                    $this->categories[$product->categoryName()] = 1;
                }
                else {
                    $this->categories[$product->categoryName()] += 1;
                }
            }
        }
    }

    /**
    * toArray
    *
    */
    public function toArray()
    {
        $products = [];
        foreach($this->getProducts() as $product)
        {
            $products[] = $product->toArray();
        }

        return $products;
    }

    /**
    * __toString
    *
    */
    public function __toString()
    {
        return json_encode($this->toArray(), 1);
    }

}

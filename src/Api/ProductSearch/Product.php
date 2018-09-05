<?php

namespace Baseify\Api\ProductSearch;

class Product
{

    /**
    * Product Array
    *
    * @var array
    */
    protected $productArray = [];


    /**
    * __construct
    *
    */
    public function __construct($productArray = [])
    {
        $this->productArray = $productArray;
    }


    /**
    * link
    *
    */
    public function link()
    {
        return ($this->productArray['item_url']) ?? '';
    }


    /**
    * image
    *
    */
    public function image()
    {
        return ($this->productArray['item_image']) ?? '';
    }


    /**
    * id
    *
    */
    public function id()
    {
        return ($this->productArray['item_id']) ?? '';
    }


    /**
    * title
    *
    */
    public function title()
    {
        return ($this->productArray['item_title']) ?? '';
    }


    /**
    * description
    *
    */
    public function description()
    {
        return ($this->productArray['description']) ?? '';
    }


    /**
    * score
    *
    */
    public function score()
    {
        return round(($this->productArray['score']) ?? 0);
    }


    /**
    * price
    *
    */
    public function price()
    {
        return ($this->productArray['item_price']) ?? 0;
    }


    /**
    * listPrice
    *
    */
    public function listPrice()
    {
        return ($this->productArray['original_price']) ?? 0;
    }


    /**
    * currency
    *
    */
    public function currency()
    {
        return ($this->productArray['item_currency_code']) ?? 'USD';
    }


    /**
    * storeLink
    *
    */
    public function storeLink()
    {
        return ($this->productArray['store_url']) ?? '';
    }


    /**
    * storeImage
    *
    */
    public function storeImage()
    {
        return ($this->productArray['store_logo']) ?? '';
    }


    /**
    * storeName
    *
    */
    public function storeName()
    {
        // Due to array being passed in brand, lets double check this one
        $store = ($this->productArray['store_name']) ?? '';
        if (is_array($store)) $store = implode(' ', $store);

        return trim($store);
    }


    /**
    * brand
    *
    */
    public function brand()
    {
        // for some reason brand can have an array passed back???
        $brand = ($this->productArray['brand']) ?? '';
        if (is_array($brand)) $brand = implode(' ', $brand);

        return trim($brand);
    }


    /**
    * categoryId
    *
    */
    public function categoryId()
    {
        return (($this->productArray['category_id']) ?? '');
    }


    /**
    * category
    *
    */
    public function categoryName()
    {
        // Due to array being passed in brand, lets double check this one
        $category = ($this->productArray['category_name']) ?? '';
        if (is_array($category)) $category = implode(' ', $category);

        return trim($category);
    }


    /**
    * freeShipping
    *
    */
    public function isFreeShipping()
    {
        return ($this->productArray['is_free_shipping']) ?? false;
    }


    /**
    * raw
    *
    */
    public function raw()
    {
        return ($this->productArray) ?? [];
    }


    /**
    * aecpc
    *
    */
    public function aecpc()
    {
        return ($this->productArray['aecpc']) ?? 0;
    }


    /**
    * ecpc
    *
    */
    public function ecpc()
    {
        return ($this->productArray['ecpc']) ?? 0;
    }


    /**
    * toArray
    *
    */
    public function toArray()
    {
        return [
            'title' => $this->title(),
            'link' => $this->link(),
            'image' => $this->image(),
            'id' => $this->id(),
            'description' => $this->description(),
            'score' => $this->score(),
            'price' => $this->price(),
            'list_price' => $this->listPrice(),
            'ecpc' => $this->ecpc(),
            'aecpc' => $this->aecpc(),
            'currency' => $this->currency(),
            'brand' => $this->brand(),
            'store_name' => $this->storeName(),
            'store_link' => $this->storeLink(),
            'store_image' => $this->storeImage(),
            'category' => $this->categoryName(),
            'category_id' => $this->categoryId(),
            'free_shipping' => $this->isFreeShipping()
        ];
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

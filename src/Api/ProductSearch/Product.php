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
        return trim(($this->productArray['store_name']) ?? '');
    }


    /**
    * brand
    *
    */
    public function brand()
    {
        return trim(($this->productArray['brand']) ?? '');
    }


    /**
    * category
    *
    */
    public function categoryName()
    {
        return trim(($this->productArray['category_name']) ?? '');
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
    * eCPC
    *
    */
    public function ecpc()
    {
        return ($this->productArray['acpc']) ?? 0;
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
            'currency' => $this->currency(),
            'brand' => $this->brand(),
            'store_name' => $this->storeName(),
            'store_link' => $this->storeLink(),
            'store_image' => $this->storeImage(),
            'category' => $this->categoryName(),
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

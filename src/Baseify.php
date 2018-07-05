<?php

namespace Baseify;

use Baseify\Api\ProductSearch;

class Baseify
{

    /**
    * ProductSearch
    *
    * @return Baseify\Api\ProductSearch
    */
    public function productSearch($cuid, $data = [])
    {
        return (new ProductSearch($cuid, $data));
    }

}

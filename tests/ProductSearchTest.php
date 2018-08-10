<?php

namespace Baseify;

use Baseify\Baseify;
use Base\Support\Collection;

class ProductSearchTest extends \PHPUnit\Framework\TestCase
{

    public function testSetup()
    {
        $testIp = '45.248.78.5';
        $testAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36';

        $baseify = (new Baseify('28a0fd38a28698b4788fcd882544bd16'))->productSearch([
            'domain' => 'discount-savings.com'
        ]);

        $baseify->user()->set('ip',$testIp);
        $baseify->user()->set('ua',$testAgent);
        $baseify->filter()->set('limit',999);

        $results = $baseify->query('Matte Lipcolor');

        // print_r($results->getEndpoint());

        // print_r($results->getRaw());

        $status = $results->getStatus();
        $products = $results->getProducts();

        $stores = $results->getStores();
        // print_r($stores);

        $brands = $results->getBrands();
        // print_r($brands);

        $categories = $results->getCategories();
        // print_r($categories);

        print_r($products->all());

        $this->assertEquals(true, $status);
        // $this->assertEquals(9, $products->count());
        $this->assertInternalType('object', $products);
        $this->assertInternalType('array', $products->all());
        $this->assertInstanceOf(Collection::class, $products);
    }



    public function testBad()
    {
        $testIp = '127.0.0.1';
        $testAgent = 'Test';

        $baseify = (new Baseify('28a0fd38a28698b4788fcd882544bd16'))->productSearch();

        $baseify->user()->set('ip',$testIp);
        $baseify->user()->set('ua',$testAgent);

        $results = $baseify->query('car chargers');

        $status = $results->getStatus();
        $product = $results->getProducts();

        $this->assertInternalType('object', $product);
        $this->assertInternalType('array', $product->all());
        $this->assertInstanceOf(Collection::class, $product);

        $this->assertEquals(false, $status);
    }

}

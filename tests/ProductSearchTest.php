<?php

namespace Baseify;

use Baseify\Baseify;
use Base\Support\Collection;

class ProductSearchTest extends \PHPUnit\Framework\TestCase
{

    public function testSetup()
    {
        $testIp = '173.92.179.208';
        $testAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36';

        $baseify = (new Baseify('ba7c6b686c25e6ac8bddefc948d40d4e'))->productSearch([
            'domain' => 'discount-savings.com',
            'widget' => 'test'
        ]);

        $baseify->user()->set('ip',$testIp);
        $baseify->user()->set('ua',$testAgent);
        $baseify->filter()->set('limit',99);

        $results = $baseify->query('Matte Lipcolor');

        // print_r($results->getEndpoint());
        // print_r($results->getRaw());

        $status      = $results->getStatus();
        $products    = $results->getProducts();
        $stores      = $results->getStores();
        $brands      = $results->getBrands();
        $categories  = $results->getCategories();
        $categoryIds = $results->getCategoryWithIds();
        // print_r($categoryIds);

        print_r($products->all());

        $this->assertEquals(true, $status);
        $this->assertInternalType('object', $products);
        $this->assertInternalType('array', $products->all());
        $this->assertInstanceOf(Collection::class, $products);
    }



    public function testBad()
    {
        $testIp = '127.0.0.1';
        $testAgent = 'Test';

        $baseify = (new Baseify('ba7c6b686c25e6ac8bddefc948d40d4e'))->productSearch();

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

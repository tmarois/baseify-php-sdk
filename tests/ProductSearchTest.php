<?php

namespace Baseify;

use Baseify\Baseify;
use Base\Support\Collection;

class ProductSearchTest extends \PHPUnit\Framework\TestCase
{

    public function testSetup()
    {
        $testIp = '173.92.179.109';
        $testAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36';

        $baseify = (new Baseify())->productSearch('28a0fd38a28698b4788fcd882544bd16',[
            'domain' => 'testing.com'
        ]);

        $baseify->user()->set('ip',$testIp);
        $baseify->user()->set('ua',$testAgent);

        $results = $baseify->query('car chargers');

        $status = $results->getStatus();
        $products = $results->getProducts();


        $this->assertEquals(true, $status);
        $this->assertInternalType('object', $products);
        $this->assertInternalType('array', $products->all());
        $this->assertInstanceOf(Collection::class, $products);
    }



    public function testBad()
    {
        $testIp = '127.0.0.1';
        $testAgent = 'Test';

        $baseify = (new Baseify())->productSearch('28a0fd38a28698b4788fcd882544bd16');

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
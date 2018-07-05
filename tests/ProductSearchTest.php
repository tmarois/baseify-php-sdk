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

        $baseify = (new Baseify())->productSearch('28a0fd38a28698b4788fcd882544bd16',[
            'domain' => 'discount-savings.com'
        ]);

        $baseify->user()->set('ip',$testIp);
        $baseify->user()->set('ua',$testAgent);

        $results = $baseify->query('car chargers')->getProducts();

        $this->assertInternalType('object', $results);
        $this->assertInternalType('array', $results->all());
        $this->assertInstanceOf(Collection::class, $results);
    }

}

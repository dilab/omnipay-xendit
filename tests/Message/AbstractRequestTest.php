<?php
/**
 * Created by PhpStorm.
 * User: xuding
 * Date: 6/8/18
 * Time: 2:40 PM
 */

namespace Omnipay\Tests\TestCase;

use Omnipay\Tests\TestCase;
use Omnipay\Xendit\Message\AbstractRequest;

class AbstractRequestTest extends TestCase
{
    public function test_getRequestUrl()
    {
        $request = $this->getMockForAbstractClass(AbstractRequest::class, [
            $this->getHttpClient(),
            $this->getHttpRequest()
        ]);

        $expected = 'https://api.xendit.co/v2/invoices';

        $this->assertEquals($expected, $request->getEndPoint());
    }
}

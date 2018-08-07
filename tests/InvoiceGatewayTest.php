<?php
/**
 * Created by PhpStorm.
 * User: xuding
 * Date: 7/8/18
 * Time: 8:55 AM
 */

namespace Omnipay\Tests\TestCase;

use Omnipay\Tests\TestCase;
use Omnipay\Xendit\InvoiceGateway;

class InvoiceGatewayTest extends TestCase
{

    /** @var InvoiceGateway */
    protected $gateway;

    /** @var array */
    private $options;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new InvoiceGateway($this->getHttpClient(), $this->getHttpRequest());

        $this->gateway->setSecretApiKey('123456');

        $this->options = [
            'currency' => 'IDR',
            'amount' => 13000.00,
            'description' => 'Trip to Bali',
            'transactionId' => 'demo_1475801962607',
            'card' => [
                'email' => 'sample_email@xendit.co',
            ]
        ];
    }

    public function testPurchaseSuccess()
    {
        $this->setMockHttpResponse('InvoicePending.txt');

        $response = $this->gateway->purchase($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
    }

    public function testPurchaseFailure()
    {
        $this->setMockHttpResponse('InvoicePaid.txt');

        $response = $this->gateway->purchase($this->options)->send();

        $this->assertTrue($response->isSuccessful());
    }
}

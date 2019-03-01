<?php
/**
 * Created by PhpStorm.
 * User: xuding
 * Date: 6/8/18
 * Time: 11:40 AM
 */

namespace Omnipay\Tests\TestCase;

use Guzzle\Http\Message\Response;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Tests\TestCase;
use Omnipay\Xendit\Message\InvoicePurchaseRequest;
use Omnipay\Xendit\Message\InvoicePurchaseResponse;
use Guzzle\Http\Client as HttpClient;

class InvoicePurchaseRequestTest extends TestCase
{
    /**
     * @var InvoicePurchaseRequest
     */
    public $request;

    /**
     * @var HttpClient
     */
    public $httpClient;

    public function setUp()
    {
        parent::setUp();

        $this->request = new InvoicePurchaseRequest(
            $this->getHttpClient(),
            $this->getHttpRequest()
        );

        $this->request->initialize([
            'currency' => 'IDR',
            'amount' => 13000.00,
            'description' => 'Trip to Bali',
            'transactionId' => 'demo_1475801962607',
            'card' => [
                'email' => 'sample_email@xendit.co',
            ],
            'returnUrl' => 'https://mysite.com/success'
        ]);

        $this->request->setSecretApiKey('123456');
    }

    public function test_getData()
    {
        $expected = [
            'external_id' => 'demo_1475801962607',
            'amount' => (int)13000,
            'payer_email' => 'sample_email@xendit.co',
            'description' => 'Trip to Bali',
            'success_redirect_url' => 'https://mysite.com/success'
        ];

        $this->assertSame(
            $expected,
            $this->request->getData()
        );
    }

    public function test_guard_minimum_amount()
    {
        $this->request->setAmount(10000.00);

        $this->setExpectedException(InvalidRequestException::class);

        $this->request->getData();
    }

}

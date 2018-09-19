<?php
/**
 * Created by PhpStorm.
 * User: xuding
 * Date: 19/9/18
 * Time: 10:43 AM
 */

namespace Omnipay\Tests\TestCase;

use Omnipay\Tests\TestCase;
use Omnipay\Xendit\Message\InvoiceCompletePurchaseRequest;
use Omnipay\Xendit\Message\InvoiceCompletePurchaseResponse;

class InvoiceCompletePurchaseRequestTest extends TestCase
{
    /**
     * @var InvoiceCompletePurchaseRequest
     */
    public $request;

    protected function setUp()
    {
        parent::setUp();
        $this->request = new InvoiceCompletePurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'currency' => 'IDR',
            'amount' => 13000.00,
            'description' => 'Trip to Bali',
            'transactionId' => 'demo_1475801962607',
            'card' => [
                'email' => 'sample_email@xendit.co',
            ],
            'secretApiKey' => '123456'
        ]);
    }


    public function testGetData()
    {
        $expected = [
            'id' => '5ba072fde9b835175f8ce41f',
            'external_id' => '1277',
            'user_id' => '5881cdcd3a5f5c587bd72c79',
            'is_high' => false,
            'payment_method' => 'CREDIT_CARD',
            'status' => 'PAID',
            'merchant_name' => 'PT Spacebib Tekno Indonesia',
            'amount' => 12000,
            'paid_amount' => 12000,
            'payer_email' => 'thedilab@gmail.com',
            'description' => 'Registration Test',
            'adjusted_received_amount' => 12000,
            'created' => "2018-09-18T03:37:33.476Z",
            'updated' => "2018-09-18T03:39:11.027Z"
        ];

        $this->getHttpRequest()->request->replace($expected);

        $this->assertSame(
            $expected,
            $this->request->getData()
        );
    }

    public function testSendData()
    {
        $data = [
            'id' => '5ba072fde9b835175f8ce41f',
            'external_id' => '1277',
            'user_id' => '5881cdcd3a5f5c587bd72c79',
            'is_high' => false,
            'payment_method' => 'CREDIT_CARD',
            'status' => 'PAID',
            'merchant_name' => 'PT Spacebib Tekno Indonesia',
            'amount' => 12000,
            'paid_amount' => 12000,
            'payer_email' => 'thedilab@gmail.com',
            'description' => 'Registration Test',
            'adjusted_received_amount' => 12000,
            'created' => "2018-09-18T03:37:33.476Z",
            'updated' => "2018-09-18T03:39:11.027Z"
        ];

        $this->assertInstanceOf(InvoiceCompletePurchaseResponse::class,$this->request->sendData($data));
    }

}

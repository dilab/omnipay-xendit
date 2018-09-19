<?php
/**
 * Created by PhpStorm.
 * User: xuding
 * Date: 19/9/18
 * Time: 10:43 AM
 */

namespace Omnipay\Tests\TestCase;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Tests\TestCase;
use Omnipay\Xendit\Message\InvoiceCompletePurchaseResponse;

class InvoiceCompletePurchaseResponseTest extends TestCase
{
    /**
     * @var AbstractResponse
     */
    public $response;

    public function test_pending()
    {
        $callback = [
            'id' => $transactionRef = '5ba072fde9b835175f8ce41f',
            'external_id' => $transactionId = '1277',
            'user_id' => '5881cdcd3a5f5c587bd72c79',
            'is_high' => false,
            'payment_method' => 'CREDIT_CARD',
            'status' => 'PENDING',
            'merchant_name' => 'PT Spacebib Tekno Indonesia',
            'amount' => 12000,
            'paid_amount' => 12000,
            'payer_email' => 'thedilab@gmail.com',
            'description' => 'Registration Test',
            'adjusted_received_amount' => 12000,
            'created' => "2018-09-18T03:37:33.476Z",
            'updated' => "2018-09-18T03:39:11.027Z"
        ];

        $this->response = new InvoiceCompletePurchaseResponse($this->getMockRequest(), $callback);

        $this->assertTrue($this->response->isPending());
        $this->assertFalse($this->response->isSuccessful());
        $this->assertEquals($transactionRef, $this->response->getTransactionReference());
        $this->assertEquals($transactionId, $this->response->getTransactionId());
    }

    public function test_success()
    {
        $callback = [
            'id' => $transactionRef = '5ba072fde9b835175f8ce41f',
            'external_id' => $transactionId = '1277',
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

        $this->response = new InvoiceCompletePurchaseResponse($this->getMockRequest(), $callback);

        $this->assertFalse($this->response->isPending());
        $this->assertTrue($this->response->isSuccessful());
        $this->assertEquals($transactionRef, $this->response->getTransactionReference());
        $this->assertEquals($transactionId, $this->response->getTransactionId());
    }
}

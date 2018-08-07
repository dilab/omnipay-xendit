<?php
/**
 * Created by PhpStorm.
 * User: xuding
 * Date: 6/8/18
 * Time: 3:42 PM
 */

namespace Omnipay\Tests\TestCase;

use Omnipay\Tests\TestCase;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Xendit\Message\InvoicePurchaseResponse;

class InvoicePurchaseResponseTest extends TestCase
{
    /**
     * @var AbstractResponse
     */
    public $response;

    public function test_pending()
    {
        $httpResponse = '
        {
            "id": "' . ($transactionRef = '59d4c981997f96da6b69d24a') . '",
            "external_id": "' . ($transactionId = 'demo - 1475801962607') . '",
            "user_id": "59d4c95053db7ba6123971b1",
            "status": "PENDING",
            "merchant_name": "Xendit",
            "merchant_profile_picture_url": "https://du8nwjtfkinx.cloudfront.net/xendit.png",
            "amount": 13000,
            "payer_email": "sample_email@xendit.co",
            "description": "Trip to Bali",
            "expiry_date": "2017-10-05T11:44:00.736Z",
            "invoice_url": "' . ($redirectUrl = 'https://invoice-staging.xendit.co/web/invoices/57f6f439b33bed606c4dae86') . '",
            "available_banks": [
                {
                    "bank_code": "MANDIRI",
                    "collection_type": "POOL",
                    "bank_account_number": "88464100767",
                    "transfer_amount": 13000,
                    "bank_branch": "Virtual Account",
                    "account_holder_name": "XENDIT",
                    "identity_amount": 0
                },
                {
                    "bank_code": "BCA",
                    "collection_type": "POOL",
                    "bank_account_number": "02938103212",
                    "transfer_amount": 13000,
                    "bank_branch": "Virtual Account",
                    "account_holder_name": "XENDIT",
                    "identity_amount": 0
                },
                {
                    "bank_code": "BNI",
                    "collection_type": "POOL",
                    "bank_account_number": "26215100282",
                    "transfer_amount": 13000,
                    "bank_branch": "Virtual Account",
                    "account_holder_name": "XENDIT",
                    "identity_amount": 0
                },
                {
                    "bank_code": "BRI",
                    "collection_type": "POOL",
                    "bank_account_number": "8808104859",
                    "transfer_amount": 13000,
                    "bank_branch": "Virtual Account",
                    "account_holder_name": "XENDIT",
                    "identity_amount": 0
                }
            ],
            "available_retail_outlets": [
                {
                    "retail_outlet_name": "ALFAMART",
                    "payment_code": "ALFA123456",
                    "transfer_amount": 54000
                }
            ],
            "should_exclude_credit_card": false,
            "should_send_email": false,
            "created": "2017-10-04T11:44:01.137Z",
            "updated": "2017-10-04T11:44:01.137Z"
        }
        ';

        $this->response = new InvoicePurchaseResponse($this->getMockRequest(), $httpResponse);

        $this->assertTrue($this->response->isPending());
        $this->assertFalse($this->response->isSuccessful());
        $this->assertTrue($this->response->isRedirect());
        $this->assertEquals($transactionRef, $this->response->getTransactionReference());
        $this->assertEquals($transactionId, $this->response->getTransactionId());
        $this->assertSame($redirectUrl, $this->response->getRedirectUrl());
        $this->assertSame('GET', $this->response->getRedirectMethod());
    }

    public function test_success()
    {
        $httpResponse = '
        {
            "id": "59d4c981997f96da6b69d24a",
            "external_id": "demo-1475801962607",
            "user_id": "59d4c95053db7ba6123971b1",
            "status": "PAID",
            "merchant_name": "Xendit",
            "merchant_profile_picture_url": "https://du8nwjtfkinx.cloudfront.net/xendit.png",
            "amount": 13000,
            "payer_email": "sample_email@xendit.co",
            "description": "Trip to Bali",
            "expiry_date": "2017-10-05T11:44:00.736Z",
            "invoice_url": "https://invoice-staging.xendit.co/web/invoices/57f6f439b33bed606c4dae86",
            "available_banks": [
                {
                    "bank_code": "MANDIRI",
                    "collection_type": "POOL",
                    "bank_account_number": "88464100767",
                    "transfer_amount": 13000,
                    "bank_branch": "Virtual Account",
                    "account_holder_name": "XENDIT",
                    "identity_amount": 0
                },
                {
                    "bank_code": "BCA",
                    "collection_type": "POOL",
                    "bank_account_number": "02938103212",
                    "transfer_amount": 13000,
                    "bank_branch": "Virtual Account",
                    "account_holder_name": "XENDIT",
                    "identity_amount": 0
                },
                {
                    "bank_code": "BNI",
                    "collection_type": "POOL",
                    "bank_account_number": "26215100282",
                    "transfer_amount": 13000,
                    "bank_branch": "Virtual Account",
                    "account_holder_name": "XENDIT",
                    "identity_amount": 0
                },
                {
                    "bank_code": "BRI",
                    "collection_type": "POOL",
                    "bank_account_number": "8808104859",
                    "transfer_amount": 13000,
                    "bank_branch": "Virtual Account",
                    "account_holder_name": "XENDIT",
                    "identity_amount": 0
                }
            ],
            "available_retail_outlets": [
                {
                    "retail_outlet_name": "ALFAMART",
                    "payment_code": "ALFA123456",
                    "transfer_amount": 54000
                }
            ],
            "should_exclude_credit_card": false,
            "should_send_email": false,
            "created": "2017-10-04T11:44:01.137Z",
            "updated": "2017-10-04T11:44:01.137Z"
        }
        ';

        $this->response = new InvoicePurchaseResponse($this->getMockRequest(), $httpResponse);

        $this->assertFalse($this->response->isPending());
        $this->assertTrue($this->response->isSuccessful());
        $this->assertFalse($this->response->isRedirect());
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: xuding
 * Date: 6/8/18
 * Time: 11:06 AM
 */

namespace Omnipay\Xendit\Message;


use Omnipay\Common\Exception\InvalidRequestException;

class InvoicePurchaseRequest extends AbstractRequest
{
    const MIN_AMOUNT = 11000;

    public function sendData($data)
    {
        $response = $this->httpClient
            ->request(
                'POST',
                $this->getEndPoint(),
                [
                    'Authorization' => 'Basic ' . base64_encode($this->getSecretApiKey() . ':'),
                    'Content-Type' => 'application/json'
                ],
                json_encode($data)
            )
            ->getBody()
            ->getContents();

        return new InvoicePurchaseResponse($this, $response);
    }

    public function getData()
    {
        $this->guardAmount(intval($this->getAmount()));

        return [
            'external_id' => (string)$this->getTransactionId(),
            'amount' => intval($this->getAmount()),
            'payer_email' => $this->getCard()->getEmail(),
            'description' => $this->getDescription(),
            'success_redirect_url' => $this->getReturnUrl()
        ];
    }

    private function guardAmount($amount)
    {
        if ($amount < self::MIN_AMOUNT) {
            throw new InvalidRequestException('The minimum amount to create an invoice is 11000');
        }
    }
}
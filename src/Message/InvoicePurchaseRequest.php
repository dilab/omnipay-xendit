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
        $this->httpClient->setConfig([
            CURLOPT_USERPWD => $this->getSecretApiKey() . ':'
        ]);

        $response = $this->httpClient
            ->post(
                $this->getEndPoint(),
                ['Content-Type' => 'application/json'],
                json_encode($data),
                ['exceptions' => false]
            )
            ->send()
            ->getBody(true);

        return new InvoicePurchaseResponse($this, $response);
    }

    public function getData()
    {
        $this->guardAmount(intval($this->getAmount()));

        return [
            'external_id' => $this->getTransactionId(),
            'amount' => intval($this->getAmount()),
            'payer_email' => $this->getCard()->getEmail(),
            'description' => $this->getDescription()
        ];
    }

    private function guardAmount($amount)
    {
        if ($amount < self::MIN_AMOUNT) {
            throw new InvalidRequestException('The minimum amount to create an invoice is 11000');
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: xuding
 * Date: 6/8/18
 * Time: 11:06 AM
 */

namespace Omnipay\Xendit\Message;


use Omnipay\Common\Message\ResponseInterface;

class InvoiceCompletePurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        return $this->httpRequest->request->all();
    }

    public function sendData($data)
    {
        return new InvoiceCompletePurchaseResponse($this, $data);
    }

}
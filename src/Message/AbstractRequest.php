<?php
/**
 * Created by PhpStorm.
 * User: xuding
 * Date: 6/8/18
 * Time: 12:03 PM
 */

namespace Omnipay\Xendit\Message;


abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    private $endPoint = 'https://api.xendit.co/v2/invoices';

    public function getEndPoint()
    {
        return $this->endPoint;
    }

    public function getSecretApiKey()
    {
        return $this->getParameter('secretApiKey');
    }

    public function setSecretApiKey($serverApiKey)
    {
        return $this->setParameter('secretApiKey', $serverApiKey);
    }
}
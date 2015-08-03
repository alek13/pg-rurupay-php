<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Response;

use Alek\PaymentGate\RuRuPay\Client\Callback\Response;

class CancelPayment extends Response
{
    /**
     * @param Body\Xml        $xml
     * @param Data\CancelPayment $bodyData
     */
    protected function renderXmlResponseBody(Body\Xml $xml, Data\CancelPayment $bodyData)
    {
        $xml->append($xml->responseBody(), 'Date', $bodyData->date->format('Y-m-d H:i:s'));
        $xml->append($xml->responseBody(), 'ExternalId', $bodyData->id);
        $xml->append($xml->responseBody(), 'Id', $bodyData->externalId);
    }
}

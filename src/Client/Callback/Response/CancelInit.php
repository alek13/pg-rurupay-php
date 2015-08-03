<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Response;

use Alek\PaymentGate\RuRuPay\Client\Callback\Response;

class CancelInit extends Response
{
    /**
     * @param Body\Xml        $xml
     * @param Data\CancelInit $bodyData
     */
    protected function renderXmlResponseBody(Body\Xml $xml, Data\CancelInit $bodyData)
    {
        $xml->append($xml->responseBody(), 'Date', $bodyData->date->format('Y-m-d H:i:s'));
        $xml->append($xml->responseBody(), 'ExternalId', $bodyData->id);
        $xml->append($xml->responseBody(), 'Id', $bodyData->externalId);
    }
}
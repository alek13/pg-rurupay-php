<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Response;

use Alek\PaymentGate\RuRuPay\Client\Callback\Response;

class Payment extends Response
{
    /**
     * @param Body\Xml     $xml
     * @param Data\Payment $bodyData
     */
    protected function renderXmlResponseBody(Body\Xml $xml, Data\Payment $bodyData)
    {
        $xml->append($xml->responseBody(), 'Amount', $bodyData->amount);
        $xml->append($xml->responseBody(), 'Date', $bodyData->date->format('Y-m-d H:i:s'));
        $xml->append($xml->responseBody(), 'ExternalId', $bodyData->id);
        $xml->append($xml->responseBody(), 'Info', $bodyData->info);
        $xml->append($xml->responseBody(), 'Id', $bodyData->externalId);
    }
}
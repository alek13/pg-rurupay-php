<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Response;

use Alek\PaymentGate\RuRuPay\Client\Callback\Response;

class Init extends Response
{
    /**
     * @param Body\Xml  $xml
     * @param Data\Init $bodyData
     */
    protected function renderXmlResponseBody(Body\Xml $xml, Data\Init $bodyData)
    {
        $xml->append($xml->responseBody(), 'Amount', $bodyData->amount);
        $xml->append($xml->responseBody(), 'Date', $bodyData->date->format('Y-m-d H:i:s'));
        $xml->append($xml->responseBody(), 'ExternalId', $bodyData->id);
        $xml->append($xml->responseBody(), 'Info', $bodyData->info);
        $xml->append($xml->responseBody(), 'Id', $bodyData->externalId);
    }
}
<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Response\Body;

use DOMDocument;

class Xml extends DOMDocument
{
    const VERSION = '1.0';
    const ENCODING = 'utf-8';
    const XMLNS = 'http://ruru.service.provider';
    const XMLNS_I = 'http://www.w3.org/2001/XMLSchema-instance';

    /**
     * @var \DOMElement
     */
    private $serviceResponse = null;
    /**
     * @var \DOMElement
     */
    private $responseBody = null;

    /**
     * Creates a new DOMDocument object
     */
    public function __construct()
    {
        parent::__construct(self::VERSION, self::ENCODING);
        $this->formatOutput = true;

        $this->serviceResponse = $this->append($this, 'ServiceResponse', null, [
            'xmlns'   => self::XMLNS,
            'xmlns:i' => self::XMLNS_I,
        ]);

//        if ($willCallback === null || $willCallback === false) {
//            $this->responseBody = $this->serviceResponse->appendChild(new \DOMElement('ResponseBody'));
//        }
    }

    /**
     * @return \DOMElement
     */
    public function &serviceResponse()
    {
        return $this->serviceResponse;
    }

    /**
     * @return \DOMElement
     */
    public function &responseBody()
    {
        return $this->responseBody;
    }

    /**
     * @param int $errorCode
     *
     * @return $this
     */
    public function appendErrorCode($errorCode)
    {
        $this->append($this->serviceResponse, 'ErrorCode', $errorCode);
        return $this;
    }

    /**
     * @param string $errorDescription
     *
     * @return $this
     */
    public function appendErrorDescription($errorDescription)
    {
        $this->append($this->serviceResponse, 'ErrorDescription', $errorDescription);
        return $this;
    }

    /**
     * @param $willCallback
     *
     * @return $this
     */
    public function appendWillCallback($willCallback)
    {
        if ($willCallback !== null) {
            $this->append($this->serviceResponse, 'WillCallback', $willCallback ? 'true' : 'false');
        }
        return $this;
    }

    /**
     * @param string $signature
     *
     * @return $this
     */
    public function appendSignature($signature)
    {
        $this->append($this->serviceResponse, 'Signature', $signature);
        return $this;
    }

    public function appendResponseBody()
    {
        return $this->responseBody = $this->append($this->serviceResponse, 'ResponseBody');
    }

    /**
     * @param \DOMNode $toNode
     * @param string   $childName
     * @param mixed    $value
     * @param array    $attributes
     *
     * @return \DOMElement
     */
    public function append(\DOMNode $toNode, $childName, $value = null, array $attributes = [])
    {
        /** @var \DOMElement $xmlElement */
        $xmlElement = $toNode->appendChild(new \DOMElement($childName));
        if ($value !== null) {
            $xmlElement->appendChild(new \DOMText($value));
        }
        foreach ($attributes as $name => $value) {
            $xmlElement->setAttribute($name, $value);
        }

        return $xmlElement;
    }

}
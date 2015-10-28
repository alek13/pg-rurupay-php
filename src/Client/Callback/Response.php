<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback;


use Alek\PaymentGate\RuRuPay\Signer;
use Colibri\Util\String;

abstract class Response
{
    /**
     * @var Signer
     */
    private $signer;
    /**
     * @var int
     */
    private $errorCode = 0;
    /**
     * @var string
     */
    private $errorDescription = 'success';
    /**
     * @var bool|null
     */
    private $willCallback = false;


    /**
     * Response constructor.
     *
     * @param Signer $signer
     * @param int    $errorCode
     * @param string $errorDescription
     * @param bool   $willCallback
     */
    public function __construct(Signer $signer = null, $errorCode = 0, $errorDescription = 'success',
                                $willCallback = false)
    {
        $this->signer           = $signer;
        $this->errorCode        = $errorCode;
        $this->errorDescription = $errorDescription;
        $this->willCallback     = self::isWillCallbackNeeded() ? $willCallback : null;
    }

    /**
     * Factory method
     *
     * @param string $action one of Action::<CONST>-ants
     * @param Signer $signer just instance of Signer
     *
     * @return Response
     * @throws Exception
     */
    public static function create($action, Signer $signer)
    {
        $className = __NAMESPACE__ . '\\Response\\' . Action::getClassName($action);

        return new $className($signer);
    }


    /**
     * @param Response\Data\Init|Response\Data\Payment|Response\Data\CancelInit|Response\Data\CancelPayment $bodyData
     *
     * @return string
     */
    public function render($bodyData = null)
    {
        /** @var Response\Body\Xml */
        $xml = new Response\Body\Xml();

        $xml->appendErrorCode($this->errorCode);
        $xml->appendErrorDescription($this->errorDescription);
        if ($this->willCallback !== null) {
            $xml->appendWillCallback($this->willCallback);
        }
        $xml->appendSignature($this->calcSignature($bodyData));
        if ($this->willCallback === null || $this->willCallback === false) {
            $xml->appendResponseBody();
        }
        if ($bodyData !== null) {
            $this->renderXmlResponseBody($xml, $bodyData);
        }

        return $xml->saveXML();
    }

    /**
     * @return string
     */
    private static function getClass()
    {
        return String::lastPart(get_called_class(), '\\');
    }

    /**
     * @return string
     */
    private static function getAction()
    {
        return strtolower(self::getClass());
    }

    /**
     * @return bool
     */
    private static function isWillCallbackNeeded()
    {
        return in_array(static::getAction(), [Action::INIT, Action::PAYMENT]);
    }

    /**
     * @param Response\Body\Xml                                                                             $xml
     * @param Response\Data\Init|Response\Data\Payment|Response\Data\CancelInit|Response\Data\CancelPayment $bodyData
     */
    protected function renderXmlResponseBody(/** @noinspection PhpUnusedParameterInspection */
        Response\Body\Xml $xml, $bodyData
    )
    {
        throw new \BadMethodCallException('You must override method ' . __METHOD__ . ' in ' . get_called_class());
    }

    /**
     * @param Response\Data\AbstractCancelData|Response\Data\AbstractPurchaseData $bodyData
     *
     * @return null
     */
    private function calcSignature($bodyData)
    {
        $signatureParams = [
                'ErrorCode'        => $this->errorCode,
                'ErrorDescription' => $this->errorDescription,
            ] + (array)$bodyData;
        if ($bodyData) {
            $signatureParams['date'] = $bodyData->date->format('Y-m-d H:i:s');
        }

        return $this->signer->sign($signatureParams);
    }

}
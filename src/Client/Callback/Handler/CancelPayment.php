<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Handler;

use Alek\PaymentGate\RuRuPay\Client\Callback\Exception;
use Alek\PaymentGate\RuRuPay\Client\Callback\Handler;
use Alek\PaymentGate\RuRuPay\Client\Callback\Listener;
use Alek\PaymentGate\RuRuPay\Client\Callback\Response;

class CancelPayment extends Handler
{
    /**
     * @var Listener\CancelPayment
     */
    private $listener = null;

    /**
     * @return array
     */
    static function requiredParams()
    {
        return [
            'externalId' => Exception\Code::TRANSACTION_NOT_VALID,
            'reason'     => Exception\Code::INTERNAL_ERROR, // нет подходящей ошибки
        ];
    }

    /**
     * @return array
     */
    static function optionalParams()
    {
        return [
            'externalId' => self::PARAM_CANNOT_BE_EMPTY,
        ];
    }

    /**
     * @param Listener\CancelPayment $cancelPaymentListener
     *
     * @return CancelInit
     */
    public function setListener(Listener\CancelPayment $cancelPaymentListener)
    {
        $this->listener = $cancelPaymentListener;

        return $this;
    }

    /**
     * @param Handler $callbackHandler
     * @param int     $externalId
     * @param array   $additionalParams
     *
     * @throws Exception
     */
    public function onBeforeRun(Handler $callbackHandler, $externalId, array $additionalParams)
    {
        /** @var Handler\CancelPayment $callbackHandler */
        $this->listener->onBeforeRun($callbackHandler, $externalId, $additionalParams);
    }

    /**
     * @param int   $externalId
     * @param array $requiredParams
     * @param array $optionalParams
     * @param array $additionalParams
     *
     * @return Response\Data\CancelPayment
     */
    public function onSuccess($externalId, array $requiredParams, array $optionalParams, array $additionalParams)
    {
        list($reason) = array_values($requiredParams);

        return $this->listener->onSuccess($externalId, $reason);
    }

    /**
     * @param array     $input
     * @param Exception $callbackException
     *
     * @throws Exception
     */
    public function onFailure(array $input, Exception $callbackException)
    {
        $this->listener->onFailure($input, $callbackException);
    }
}
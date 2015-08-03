<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Handler;

use Alek\PaymentGate\RuRuPay\Client\Callback\Exception;
use Alek\PaymentGate\RuRuPay\Client\Callback\Handler;
use Alek\PaymentGate\RuRuPay\Client\Callback\Listener;
use Alek\PaymentGate\RuRuPay\Client\Callback\Response;

class Payment extends Handler
{
    /**
     * @var Listener\Payment
     */
    private $listener;

    /**
     * @return array
     */
    static function requiredParams()
    {
        return [
            'code'       => Exception\Code::SERVICE_OR_PRODUCT_UNAVAILABLE, // это не верно, но наиболее подходящая
            'amount'     => Exception\Code::AMOUNT_NOT_VALID,
            'date'       => Exception\Code::DATE_NOT_VALID,
//          'externalId' => Exception\Code::TRANSACTION_NOT_VALID,
        ];
    }

    /**
     * @return array
     */
    static function optionalParams()
    {
        return [
            'externalId' => self::PARAM_CANNOT_BE_EMPTY,
            'account'    => self::PARAM_CAN_BE_EMPTY,
        ];
    }

    /**
     * @param Listener\Payment $paymentListener
     *
     * @return Payment
     */
    public function setListener(Listener\Payment $paymentListener)
    {
        $this->listener = $paymentListener;

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
        /** @var Handler\Payment $callbackHandler */
        $this->listener->onBeforeRun($callbackHandler, $externalId, $additionalParams);
    }

    /**
     * @param int   $externalId
     * @param array $requiredParams
     * @param array $optionalParams
     * @param array $additionalParams
     *
     * @return Response\Data\Payment
     */
    public function onSuccess($externalId, array $requiredParams, array $optionalParams, array $additionalParams)
    {
        list($code, $amount, $date) = array_values($requiredParams);
        list($account, $ourId) = array_values($optionalParams);

        return $this->listener->onSuccess($externalId, $ourId, $code, $account, $amount, $date, $additionalParams);
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
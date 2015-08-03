<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Handler;

use Alek\PaymentGate\RuRuPay\Client\Callback\Exception;
use Alek\PaymentGate\RuRuPay\Client\Callback\Handler;
use Alek\PaymentGate\RuRuPay\Client\Callback\Listener;
use Alek\PaymentGate\RuRuPay\Client\Callback\Response;

class Init extends Handler
{
    /**
     * @var Listener\Init
     */
    private $listener;

    /**
     * @return array
     */
    public static function requiredParams()
    {
        return [
            'code'   => Exception\Code::SERVICE_OR_PRODUCT_UNAVAILABLE, // это не верно, но наиболее подходящая
            'amount' => Exception\Code::AMOUNT_NOT_VALID,
            'date'   => Exception\Code::DATE_NOT_VALID,
        ];
    }

    /**
     * @return array
     */
    public static function optionalParams()
    {
        return [
            'account'    => self::PARAM_CAN_BE_EMPTY,
            'externalId' => Exception\Code::TRANSACTION_NOT_VALID,
        ];
    }

    /**
     * @param Listener\Init $initListener
     *
     * @return Init
     */
    public function setListener(Listener\Init $initListener)
    {
        $this->listener = $initListener;

        return $this;
    }

    /**
     * @param Handler $callbackHandler
     * @param int     $externalId
     * @param array   $additionalParams
     */
    public function onBeforeRun(Handler $callbackHandler, $externalId, array $additionalParams)
    {
        /** @var Handler\Init $callbackHandler */
        $this->listener->onBeforeRun($callbackHandler, $externalId, $additionalParams);
    }

    /**
     * @param int   $externalId
     * @param array $requiredParams
     * @param array $optionalParams
     * @param array $additionalParams
     *
     * @return Response\Data\Init
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
     */
    public function onFailure(array $input, Exception $callbackException)
    {
        $this->listener->onFailure($input, $callbackException);
    }
}
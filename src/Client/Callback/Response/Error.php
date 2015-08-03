<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Response;


use Alek\PaymentGate\RuRuPay\Client\Callback\Exception;
use Alek\PaymentGate\RuRuPay\Client\Callback\Response;

class Error extends Response
{
    /**
     * @param Exception $callbackException
     *
     * @return Error
     */
    public static function fromException(Exception $callbackException)
    {
        return new self(null, $callbackException->getCode(), $callbackException->getMessage(), null);
    }
}
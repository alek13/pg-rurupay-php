<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Response;


use Alek\PaymentGate\RuRuPay\Client\Callback\Exception;
use Alek\PaymentGate\RuRuPay\Client\Callback\Response;
use Alek\PaymentGate\RuRuPay\Signer;

class Error extends Response
{
    /**
     * @param Exception $callbackException
     * @param Signer    $signer
     *
     * @return Error
     */
    public static function fromException(Exception $callbackException, Signer $signer)
    {
        return new self($signer, $callbackException->getCode(), $callbackException->getMessage(), null);
    }
}
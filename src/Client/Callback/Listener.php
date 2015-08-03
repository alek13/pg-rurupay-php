<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback;


interface Listener
{
    /**
     * @param array     $input
     * @param Exception $callbackException
     */
    function onFailure(array $input, Exception $callbackException);
}
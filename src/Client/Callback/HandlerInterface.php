<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback;


interface HandlerInterface
{
    static function requiredParams();
    static function optionalParams();
}
<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback;

use Alek\PaymentGate\RuRuPay\Exception as PackageException;

class Exception extends PackageException
{
    /**
     * Construct the exception.
     *
     * @param int        $code     The Exception code
     * @param \Exception $previous [optional] The previous exception used for the exception chaining
     */
    public function __construct($code, \Exception $previous = null)
    {
        $message = Exception\Code::getMessage($code);
        parent::__construct($message, $code, $previous);
    }
}
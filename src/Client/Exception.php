<?php
namespace Alek\PaymentGate\RuRuPay\Client;

use Alek\PaymentGate\RuRuPay\Exception as PackageException;
use Alek\PaymentGate\RuRuPay\Soap\OperationResult;
use Alek\PaymentGate\RuRuPay\Soap\PreInitResult;
use Alek\PaymentGate\RuRuPay\Soap\TransactionStatus;

class Exception extends PackageException
{
    /**
     * @var OperationResult|PreInitResult
     */
    private $result;

    /**
     * Construct the exception. Note: The message is NOT need.
     *
     * @param PreInitResult|OperationResult|TransactionStatus $result   The Result of Gate Response
     * @param \Exception                                      $previous [optional] The previous exception used for the
     *                                                                  exception chaining
     */
    public function __construct($result, \Exception $previous = null)
    {
        $this->result = $result;
        $code         = $result->ErrorCode;
        $message      = Exception\Code::getMessage($code);
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return OperationResult|PreInitResult
     */
    public function getResult()
    {
        return $this->result;
    }
}
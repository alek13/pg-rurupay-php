<?php

namespace Alek\PaymentGate\RuRuPay\Soap;

class GetTransactionStatusResponse
{

    /**
     * @var TransactionStatus $GetTransactionStatusResult
     * @access public
     */
    public $GetTransactionStatusResult = null;

    /**
     * @param TransactionStatus $GetTransactionStatusResult
     * @access public
     */
    public function __construct($GetTransactionStatusResult)
    {
      $this->GetTransactionStatusResult = $GetTransactionStatusResult;
    }

}

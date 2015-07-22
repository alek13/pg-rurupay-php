<?php

namespace Alek\PaymentGate\RuRuPay\Soap;

class InitResponse
{

    /**
     * @var OperationResult $InitResult
     * @access public
     */
    public $InitResult = null;

    /**
     * @param OperationResult $InitResult
     * @access public
     */
    public function __construct($InitResult)
    {
      $this->InitResult = $InitResult;
    }

}

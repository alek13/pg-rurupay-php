<?php

namespace Alek\PaymentGate\RuRuPay\Soap;

class ReserveCallbackResponse
{

    /**
     * @var OperationResult $ReserveCallbackResult
     * @access public
     */
    public $ReserveCallbackResult = null;

    /**
     * @param OperationResult $ReserveCallbackResult
     * @access public
     */
    public function __construct($ReserveCallbackResult)
    {
      $this->ReserveCallbackResult = $ReserveCallbackResult;
    }

}

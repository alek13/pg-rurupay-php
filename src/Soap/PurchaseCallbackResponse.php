<?php

namespace Alek\PaymentGate\RuRuPay\Soap;

class PurchaseCallbackResponse
{

    /**
     * @var OperationResult $PurchaseCallbackResult
     * @access public
     */
    public $PurchaseCallbackResult = null;

    /**
     * @param OperationResult $PurchaseCallbackResult
     * @access public
     */
    public function __construct($PurchaseCallbackResult)
    {
      $this->PurchaseCallbackResult = $PurchaseCallbackResult;
    }

}

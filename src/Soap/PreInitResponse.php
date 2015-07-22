<?php

namespace Alek\PaymentGate\RuRuPay\Soap;

class PreInitResponse
{

    /**
     * @var PreInitResult $PreInitResult
     * @access public
     */
    public $PreInitResult = null;

    /**
     * @param PreInitResult $PreInitResult
     * @access public
     */
    public function __construct($PreInitResult)
    {
      $this->PreInitResult = $PreInitResult;
    }

}

<?php

namespace Alek\PaymentGate\RuRuPay\Soap;

class OperationResult
{

    /**
     * @var int $ErrorCode
     * @access public
     */
    public $ErrorCode = null;

    /**
     * @var int $Id
     * @access public
     */
    public $Id = null;

    /**
     * @var string $Info
     * @access public
     */
    public $Info = null;

    /**
     * @var string $Signature
     * @access public
     */
    public $Signature = null;

    /**
     * @var int $TimeOut1
     * @access public
     */
    public $TimeOut1 = null;

    /**
     * @var int $TimeOut2
     * @access public
     */
    public $TimeOut2 = null;

    /**
     * @param int $ErrorCode
     * @param int $Id
     * @param int $TimeOut1
     * @param int $TimeOut2
     * @access public
     */
    public function __construct($ErrorCode, $Id, $TimeOut1, $TimeOut2)
    {
      $this->ErrorCode = $ErrorCode;
      $this->Id = $Id;
      $this->TimeOut1 = $TimeOut1;
      $this->TimeOut2 = $TimeOut2;
    }

}

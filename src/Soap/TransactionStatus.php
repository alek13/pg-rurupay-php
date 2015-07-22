<?php

namespace Alek\PaymentGate\RuRuPay\Soap;

class TransactionStatus
{

    /**
     * @var string $Description
     * @access public
     */
    public $Description = null;

    /**
     * @var int $ErrorCode
     * @access public
     */
    public $ErrorCode = null;

    /**
     * @var int $Reason
     * @access public
     */
    public $Reason = null;

    /**
     * @var string $Signature
     * @access public
     */
    public $Signature = null;

    /**
     * @var int $TransactionId
     * @access public
     */
    public $TransactionId = null;

    /**
     * @param int $ErrorCode
     * @param int $Reason
     * @param int $TransactionId
     * @access public
     */
    public function __construct($ErrorCode, $Reason, $TransactionId)
    {
      $this->ErrorCode = $ErrorCode;
      $this->Reason = $Reason;
      $this->TransactionId = $TransactionId;
    }

}

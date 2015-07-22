<?php

namespace Alek\PaymentGate\RuRuPay\Soap;

class PreInitResult
{

    /**
     * @var float $Amount
     * @access public
     */
    public $Amount = null;

    /**
     * @var float $AmountWithCommission
     * @access public
     */
    public $AmountWithCommission = null;

    /**
     * @var float $Commission
     * @access public
     */
    public $Commission = null;

    /**
     * @var int $ErrorCode
     * @access public
     */
    public $ErrorCode = null;

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
     * @var int $TransactionId
     * @access public
     */
    public $TransactionId = null;

    /**
     * @param float $Amount
     * @param float $AmountWithCommission
     * @param float $Commission
     * @param int $ErrorCode
     * @param int $TransactionId
     * @access public
     */
    public function __construct($Amount, $AmountWithCommission, $Commission, $ErrorCode, $TransactionId)
    {
      $this->Amount = $Amount;
      $this->AmountWithCommission = $AmountWithCommission;
      $this->Commission = $Commission;
      $this->ErrorCode = $ErrorCode;
      $this->TransactionId = $TransactionId;
    }

}

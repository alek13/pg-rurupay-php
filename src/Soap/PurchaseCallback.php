<?php

namespace Alek\PaymentGate\RuRuPay\Soap;

class PurchaseCallback
{

    /**
     * @var int $trnId
     * @access public
     */
    public $trnId = null;

    /**
     * @var string $spTrnId
     * @access public
     */
    public $spTrnId = null;

    /**
     * @var string $spTrnDate
     * @access public
     */
    public $spTrnDate = null;

    /**
     * @var string $info
     * @access public
     */
    public $info = null;

    /**
     * @var int $amount
     * @access public
     */
    public $amount = null;

    /**
     * @var int $spId
     * @access public
     */
    public $spId = null;

    /**
     * @var int $result
     * @access public
     */
    public $result = null;

    /**
     * @var string $errorDescription
     * @access public
     */
    public $errorDescription = null;

    /**
     * @var string $signature
     * @access public
     */
    public $signature = null;

    /**
     * @param int $trnId
     * @param string $spTrnId
     * @param string $spTrnDate
     * @param string $info
     * @param int $amount
     * @param int $spId
     * @param int $result
     * @param string $errorDescription
     * @param string $signature
     * @access public
     */
    public function __construct($trnId, $spTrnId, $spTrnDate, $info, $amount, $spId, $result, $errorDescription, $signature)
    {
      $this->trnId = $trnId;
      $this->spTrnId = $spTrnId;
      $this->spTrnDate = $spTrnDate;
      $this->info = $info;
      $this->amount = $amount;
      $this->spId = $spId;
      $this->result = $result;
      $this->errorDescription = $errorDescription;
      $this->signature = $signature;
    }

}

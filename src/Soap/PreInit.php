<?php

namespace Alek\PaymentGate\RuRuPay\Soap;

class PreInit
{

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
     * @var string $phone
     * @access public
     */
    public $phone = null;

    /**
     * @var string $info
     * @access public
     */
    public $info = null;

    /**
     * @var string $spAccount
     * @access public
     */
    public $spAccount = null;

    /**
     * @var int $productId
     * @access public
     */
    public $productId = null;

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
     * @var Parameter[] $parameters
     * @access public
     */
    public $parameters = null;

    /**
     * @var string $signature
     * @access public
     */
    public $signature = null;

    /**
     * @param string $spTrnId
     * @param string $spTrnDate
     * @param string $phone
     * @param string $info
     * @param string $spAccount
     * @param int $productId
     * @param int $amount
     * @param int $spId
     * @param Parameter[] $parameters
     * @param string $signature
     * @access public
     */
    public function __construct($spTrnId, $spTrnDate, $phone, $info, $spAccount, $productId, $amount, $spId, $parameters, $signature)
    {
      $this->spTrnId = $spTrnId;
      $this->spTrnDate = $spTrnDate;
      $this->phone = $phone;
      $this->info = $info;
      $this->spAccount = $spAccount;
      $this->productId = $productId;
      $this->amount = $amount;
      $this->spId = $spId;
      $this->parameters = $parameters;
      $this->signature = $signature;
    }

}

<?php

namespace Alek\PaymentGate\RuRuPay\Soap;

class GetTransactionStatus
{

    /**
     * @var int $trnId
     * @access public
     */
    public $trnId = null;

    /**
     * @var int $spId
     * @access public
     */
    public $spId = null;

    /**
     * @var string $signature
     * @access public
     */
    public $signature = null;

    /**
     * @param int $trnId
     * @param int $spId
     * @param string $signature
     * @access public
     */
    public function __construct($trnId, $spId, $signature)
    {
      $this->trnId = $trnId;
      $this->spId = $spId;
      $this->signature = $signature;
    }

}

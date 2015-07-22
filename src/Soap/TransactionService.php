<?php

namespace Alek\PaymentGate\RuRuPay\Soap;

class TransactionService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     * @access private
     */
    private static $classmap = array(
      'PreInitResult' => 'Alek\PaymentGate\RuRuPay\Soap\PreInitResult',
      'TransactionStatus' => 'Alek\PaymentGate\RuRuPay\Soap\TransactionStatus',
      'PreInit' => 'Alek\PaymentGate\RuRuPay\Soap\PreInit',
      'Parameter' => 'Alek\PaymentGate\RuRuPay\Soap\Parameter',
      'PreInitResponse' => 'Alek\PaymentGate\RuRuPay\Soap\PreInitResponse',
      'Init' => 'Alek\PaymentGate\RuRuPay\Soap\Init',
      'InitResponse' => 'Alek\PaymentGate\RuRuPay\Soap\InitResponse',
      'OperationResult' => 'Alek\PaymentGate\RuRuPay\Soap\OperationResult',
      'ReserveCallback' => 'Alek\PaymentGate\RuRuPay\Soap\ReserveCallback',
      'ReserveCallbackResponse' => 'Alek\PaymentGate\RuRuPay\Soap\ReserveCallbackResponse',
      'PurchaseCallback' => 'Alek\PaymentGate\RuRuPay\Soap\PurchaseCallback',
      'PurchaseCallbackResponse' => 'Alek\PaymentGate\RuRuPay\Soap\PurchaseCallbackResponse',
      'GetTransactionStatus' => 'Alek\PaymentGate\RuRuPay\Soap\GetTransactionStatus',
      'GetTransactionStatusResponse' => 'Alek\PaymentGate\RuRuPay\Soap\GetTransactionStatusResponse');

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     * @access public
     */
    public function __construct(array $options = array(), $wsdl = './wsdl/TransactionService.svc.wsdl')
    {
      foreach (self::$classmap as $key => $value) {
        if (!isset($options['classmap'][$key])) {
          $options['classmap'][$key] = $value;
        }
      }
      
      parent::__construct($wsdl, $options);
    }

    /**
     * @param PreInit $parameters
     * @access public
     * @return PreInitResponse
     */
    public function PreInit(PreInit $parameters)
    {
      return $this->__soapCall('PreInit', array($parameters));
    }

    /**
     * @param Init $parameters
     * @access public
     * @return InitResponse
     */
    public function Init(Init $parameters)
    {
      return $this->__soapCall('Init', array($parameters));
    }

    /**
     * @param ReserveCallback $parameters
     * @access public
     * @return ReserveCallbackResponse
     */
    public function ReserveCallback(ReserveCallback $parameters)
    {
      return $this->__soapCall('ReserveCallback', array($parameters));
    }

    /**
     * @param PurchaseCallback $parameters
     * @access public
     * @return PurchaseCallbackResponse
     */
    public function PurchaseCallback(PurchaseCallback $parameters)
    {
      return $this->__soapCall('PurchaseCallback', array($parameters));
    }

    /**
     * @param GetTransactionStatus $parameters
     * @access public
     * @return GetTransactionStatusResponse
     */
    public function GetTransactionStatus(GetTransactionStatus $parameters)
    {
      return $this->__soapCall('GetTransactionStatus', array($parameters));
    }

}

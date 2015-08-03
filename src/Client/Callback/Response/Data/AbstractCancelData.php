<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Response\Data;


abstract class AbstractCancelData
{
    /**
     * @var \DateTime [optional] дата регистрации транзакции. Date of transaction payment registered
     */
    public $date;
    /**
     * @var int [optional] id транзакции в базе "нашего" магазина (id платежа). ID of Merchant ("our" ID)
     */
    public $id;
    /**
     * @var int [required] id транзакции в шлюзе RuRuPay. ID of Gate RuRuPay
     */
    public $externalId;
}
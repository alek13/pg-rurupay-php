<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Response\Data;

/**
 *
 * !!! Порядок объявления пременных важен !!!
 */
abstract class AbstractPurchaseData
{
    /**
     * @var int [optional] сумма в копейках. in coins.
     */
    public $amount;
    /**
     * @var \DateTime [optional] дата регистрации транзакции. Date of transaction payment registered
     */
    public $date;
    /**
     * @var int [optional] id транзакции в базе "нашего" магазина (id платежа). ID of Merchant ("our" ID)
     */
    public $id;
    /**
     * @var string [optional] (< 128 chars)
     */
    public $info;
    /**
     * @var int [required] id транзакции в шлюзе RuRuPay. ID of Gate RuRuPay
     */
    public $externalId;
}
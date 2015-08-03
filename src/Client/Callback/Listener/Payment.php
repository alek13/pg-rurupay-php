<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Listener;

use Alek\PaymentGate\RuRuPay\Client\Callback\Exception;
use Alek\PaymentGate\RuRuPay\Client\Callback\Handler;
use Alek\PaymentGate\RuRuPay\Client\Callback\Listener;
use Alek\PaymentGate\RuRuPay\Client\Callback\Response;

interface Payment extends Listener
{
    /**
     * @param Handler\Payment $callbackHandler
     * @param int             $externalId
     * @param array           $additionalParams
     */
    function onBeforeRun(Handler\Payment $callbackHandler, $externalId, array $additionalParams);

    /**
     * @param int       $externalId       ID на стороне шлюза RuRuPay
     * @param int       $ourId            ID на нашей стороне
     * @param string    $code             Код слуги (строка 20 смволов, допустимые символы: a-Z_0-9)
     * @param string    $account          [optional=null] Идентификатор  клиента в  услуге (Например, номер телефона
     *                                    абонента при оплате услуг связи). Строка 64 симвоа
     * @param int       $amount           в копейках
     * @param \DateTime $date             Дата регистрации запроса на стороне шлюза RuRuPay
     * @param array     $additionalParams [optional=array()] Дополнительные параметры определяемые Магазином(нами)
     *
     * @return Response\Data\Payment
     * @throws Exception
     */
    function onSuccess($externalId, $ourId, $code, $account, $amount, \DateTime $date, array $additionalParams);
}
<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Listener;

use Alek\PaymentGate\RuRuPay\Client\Callback\Exception;
use Alek\PaymentGate\RuRuPay\Client\Callback\Handler;
use Alek\PaymentGate\RuRuPay\Client\Callback\Listener;
use Alek\PaymentGate\RuRuPay\Client\Callback\Response;

interface CancelInit extends Listener
{
    /**
     * @param Handler\CancelInit $callbackHandler
     * @param int                $externalId
     * @param array              $additionalParams
     */
    function onBeforeRun(Handler\CancelInit $callbackHandler, $externalId, array $additionalParams);

    /**
     * @param int $externalId   ID на стороне шлюза RuRuPay
     * @param int $reason       Код причины отказа от резервирования или оплаты
     *                          Допустимые значения:
     *                          0 – клиент отказался от резервирования или оплаты
     *                          1 – технический сбой
     *                          2 – ошибка источника средств
     *
     * @return Response\Data\CancelInit
     * @throws Exception
     */
    public function onSuccess($externalId, $reason);
}
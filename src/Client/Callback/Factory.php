<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback;

use Alek\PaymentGate\RuRuPay\Signer;
use Alek\PaymentGate\RuRuPay\Client\Callback\Handler;
use Colibri\Pattern\Helper;

/**
 * Class Factory for callback handlers
 */
class Factory extends Helper
{
    /**
     * @param Signer $signer
     *
     * @return Handler\Init|Handler\Payment|Handler\CancelInit|Handler\CancelPayment
     * @throws Exception
     */
    public static function create(Signer $signer)
    {
        list($action, $input) = self::getAction();

        $className = __NAMESPACE__ . '\\Handler\\' . Action::getClassName($action);

        return new $className($action, $input, $signer);
    }

    /**
     * @return array [$action, $params]
     * @throws Exception
     */
    private static function getAction()
    {
        $input = $_GET;
        if (!isset($input['action'])) {
            throw new Exception(Exception\Code::ACTION_NOT_VALID);
        }
        $action = strtolower($input['action']);

        return [$action, $input];
    }
}
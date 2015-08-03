<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback;

use Colibri\Util\Enum;

/**
 * Class Action of callback
 */
class Action extends Enum
{
    const INIT = 'init';
    const PAYMENT = 'payment';
    const CANCEL_INIT = 'cancelinit';
    const CANCEL_PAYMENT = 'cancelpayment';

    private static $classNames = [
        self::INIT           => 'Init',
        self::PAYMENT        => 'Payment',
        self::CANCEL_INIT    => 'CancelInit',
        self::CANCEL_PAYMENT => 'CancelPayment',
    ];

    /**
     * Returns name of class for handle callback
     *
     * @param string $action one of Action::<const>-s
     *
     * @return string
     * @throws Exception
     */
    public static function getClassName($action)
    {
        if (!Action::isValid($action)) {
            throw new Exception(Exception\Code::ACTION_NOT_VALID);
        }

        return self::$classNames[$action];
    }
}
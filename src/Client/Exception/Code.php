<?php
namespace Alek\PaymentGate\RuRuPay\Client\Exception;


use Colibri\Util\Enum;

class Code extends Enum
{
    const UNKNOWN = 0;
    const INTERNAL = 1;
    const UNKNOWN_OPERATOR = 2;
    const WRONG_DATE = 3;
    const WRONG_CHANNEL = 17;
    const WRONG_SERVICE = 18;
    const PAYMENT_ROUTE_ERROR = 20;
    const PAYMENT_ROUTE_NOT_FOUND = 21;
    const NO_PHONE = 22;
    const WRONG_AMOUNT = 24;
    const CLIENT_ACCESS_ERROR = 27;
    const NO_RIGHTS = 28;
    const WRONG_PARTNER = 29;
    const TRANSACTION_TIMEOUT = 30;
    const TRANSACTION_OF_ANOTHER_USER = 31;
    const TRANSACTION_NOT_FOUND = 32;
    const TRANSACTION_WRONG_STATUS = 35;
    const CUSTOMER_NO_ACCOUNT = 36;
    const CUSTOMER_NOT_FOUND = 37;
    const AMOUNT_TOO_LOW = 38;
    const AMOUNT_TOO_HIGH = 39;
    const TRANSACTION_NOT_FOUND2 = 60;
    const TRANSACTION_COMPLETE_WITH_ERROR = 61;
    const SIGN_ERROR = 600;

    /**
     * @var array messages for codes
     */
    private static $messages = [
        self::UNKNOWN                         => 'Unknown error',
        self::INTERNAL                        => 'Internal error',
        self::UNKNOWN_OPERATOR                => 'Can`t resolve operator by phone number',
        self::WRONG_DATE                      => 'Incorrect date format',
        self::WRONG_CHANNEL                   => 'wrong channel of purchase initiation',
        self::WRONG_SERVICE                   => 'Service not found or not active',
        self::PAYMENT_ROUTE_ERROR             => 'Ошибка определения маршрута оплаты услуги или комиссии с нее по источнику средств',
        self::PAYMENT_ROUTE_NOT_FOUND         => 'Available service payment route not found',
        self::NO_PHONE                        => 'Customer phone not specified',
        self::WRONG_AMOUNT                    => 'Incorrect amount format',
        self::CLIENT_ACCESS_ERROR             => 'Client access error (check certificate)',
        self::NO_RIGHTS                       => 'No rights for purchase initiation',
        self::WRONG_PARTNER                   => 'Partner not found or not active',
        self::TRANSACTION_TIMEOUT             => 'Timeout while handle transaction (purchase timeout or reserve timeout)',
        self::TRANSACTION_OF_ANOTHER_USER     => 'Transaction belongs to another user (customer)',
        self::TRANSACTION_NOT_FOUND           => 'Transaction not found',
        self::TRANSACTION_WRONG_STATUS        => 'Current transaction status not permit for this operation',
        self::CUSTOMER_NO_ACCOUNT             => 'Customer(user) does not have account number',
        self::CUSTOMER_NOT_FOUND              => 'Customer(user) not found',
        self::AMOUNT_TOO_LOW                  => 'Amount low then minimal',
        self::AMOUNT_TOO_HIGH                 => 'Amount high then maximal',
        self::TRANSACTION_NOT_FOUND2          => 'Transaction not found',
        self::TRANSACTION_COMPLETE_WITH_ERROR => 'Transaction complete with error',
        self::SIGN_ERROR                      => 'Error of sign',
    ];

    /**
     * Returns message for code
     *
     * @param $code
     *
     * @return string
     */
    public static function getMessage($code)
    {
        return static::$messages[static::isValid($code) ? $code : self::UNKNOWN];
    }
}
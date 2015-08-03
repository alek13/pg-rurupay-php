<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback\Exception;

use Colibri\Util\Enum;

class Code extends Enum
{
    const TRANSACTION_TIMEOUT = 30;
    const CUSTOMER_NOT_VALID = 100;
    const CUSTOMER_WRONG_ACCOUNT = 101;
    const TRANSACTION_EXTERNAL_NOT_VALID = 102;
    const TRANSACTION_NOT_VALID = 103;
    const DATE_NOT_VALID = 104;
    const FRAUD_LIMIT = 200;
    const AMOUNT_TOO_LOW = 201;
    const AMOUNT_TOO_HIGH = 202;
    const AMOUNT_NOT_VALID = 203;
    const SERVICE_OR_PRODUCT_UNAVAILABLE = 204;
    const ADDITIONAL_PARAM_NOT_VALID = 300;
    const CALLBACK_NOT_EXPECTED = 400;
    const ACTION_NOT_VALID = 500;
    const SIGN_NOT_VALID = 600;
    const INTERNAL_ERROR = 999;

    private static $messages = [
        self::TRANSACTION_TIMEOUT            => 'Transaction timeout (purchase timeout or reserve timeout)',
        self::CUSTOMER_NOT_VALID             => 'Customer not valid for this payment',
        self::CUSTOMER_WRONG_ACCOUNT         => 'Account not belongs to customer or not found',
        self::TRANSACTION_EXTERNAL_NOT_VALID => 'Payment Gate transaction id (`id` in request) empty or not valid',
        self::TRANSACTION_NOT_VALID          => 'Client(merchant) transaction id (`externalId` in request) empty or not valid',
        self::DATE_NOT_VALID                 => 'Date empty or not valid',
        self::FRAUD_LIMIT                    => 'Fraud limits reached',
        self::AMOUNT_TOO_LOW                 => 'Amount low then minimal',
        self::AMOUNT_TOO_HIGH                => 'Amount high then maximal',
        self::AMOUNT_NOT_VALID               => 'Payment amount not valid',
        self::SERVICE_OR_PRODUCT_UNAVAILABLE => 'Service or Product unavailable (service limit, product is not in stock, ...)',
        self::ADDITIONAL_PARAM_NOT_VALID     => 'Additional parameter not valid (see `ErrorDescription` field)',
        self::CALLBACK_NOT_EXPECTED          => 'Callback not expected (wrong callback flow)',
        self::ACTION_NOT_VALID               => 'Action not valid',
        self::SIGN_NOT_VALID                 => 'Signature expected or not valid',
        self::INTERNAL_ERROR                 => 'Internal error',
    ];

    private static $extendedMessages = [];

    /**
     * Returns message for code
     *
     * @param $code
     *
     * @return string
     */
    public static function getMessage($code)
    {
        return static::isValid($code)
            ? static::$messages[$code]
            : (static::isValidExtended($code)
                ? static::$extendedMessages[$code]
                : static::$messages[self::INTERNAL_ERROR]
            );
    }

    /**
     * @param $code
     *
     * @return bool
     */
    public static function isValidExtended($code)
    {
        return in_array($code, array_keys(static::$extendedMessages));
    }

    /**
     * @param array $errorMessages
     */
    public static function extend(array $errorMessages)
    {
        static::$extendedMessages = static::$extendedMessages + $errorMessages;
    }
}
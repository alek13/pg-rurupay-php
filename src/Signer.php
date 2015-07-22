<?php
namespace Alek\PaymentGate\RuRuPay;


class Signer
{
    /**
     * @var string  secret key for make signature
     */
    private $secretKey;

    /**
     * Signer constructor.
     * @param $secretKey
     */
    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @param array $params
     * @return string
     */
    public function sign(array $params)
    {
        return base64_encode(hash_hmac('sha1', implode('', $params), base64_decode($this->secretKey), true));
    }

    public function verify($signature, array $params)
    {
//        var_dump($this->sign($params));
//        var_dump($signature);
//        if ($signature !== $this->sign($params)) {
//            throw new Signer\Exception('RuRuPay signature not valid');
//        }

        throw new \BadMethodCallException('Sorry, Method not implemented yet');
    }
}
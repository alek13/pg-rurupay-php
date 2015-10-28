<?php
namespace Alek\PaymentGate\RuRuPay\Client\Callback;

use Alek\PaymentGate\RuRuPay\Signer;

abstract class Handler implements HandlerInterface
{
    const PARAM_CANNOT_BE_EMPTY = true;
    const PARAM_CAN_BE_EMPTY = false;

    /**
     * @var string
     */
    protected $action;
    /**
     * @var array
     */
    protected $input;
    /**
     * @var Signer
     */
    private static $signer;

    /**
     * Callback constructor.
     *
     * @param string $action
     * @param array  $input
     * @param Signer $signer
     */
    public function __construct($action, array $input, Signer $signer)
    {
        $this->action = $action;
        $this->input  = $input;
        self::$signer = $signer;
    }

    /**
     * @return Response
     */
    public function run()
    {
        return $this->tryRun(function () {

            list($externalId, $additionalParams) = self::extractBaseInput($this->input);
            $this->onBeforeRun($this, $externalId, $additionalParams);

            list($requiredParams, $optionalParams) = self::extractInput($this->input);
            $response = Response::create($this->action, self::$signer);

            $data = $this->onSuccess($externalId, $requiredParams, $optionalParams, $additionalParams);

            return $response->render($data);
        });
    }

    /**
     * @param $callback
     *
     * @return Response
     */
    private function tryRun($callback)
    {
        try {
            return $this->catchAnyException(function () use ($callback) {
                return $callback();
            });
        } catch (Exception $callbackException) {

            $this->onFailure($this->input, $callbackException);

            return Response\Error::fromException($callbackException, self::$signer)->render();
        }
    }

    /**
     * @param $callback
     *
     * @return mixed
     * @throws Exception
     */
    private function catchAnyException($callback)
    {
        try {
            return $callback();
        } catch (Exception $exc) {
            throw $exc;
        } catch (\Exception $exc) {
            throw new Exception(Exception\Code::INTERNAL_ERROR, $exc);
        }
    }

    /**
     * @param $input
     *
     * @return array
     * @throws Exception
     */
    private static function extractBaseInput($input)
    {
        if (!isset($input['id'])) {
            throw new Exception(Exception\Code::TRANSACTION_EXTERNAL_NOT_VALID);
        }
        $externalId       = $input['id'];
        $additionalParams = self::extractAdditionalParams($input);

        return [$externalId, $additionalParams];
    }

    /**
     * @param array $input
     *
     * @return array
     * @throws Exception
     */
    private static function extractInput(array $input)
    {
        self::verifySignature($input);
        $requiredParams = self::extractRequiredParams($input);
        $optionalParams = self::extractOptionalParams($input);

        return [$requiredParams, $optionalParams];
    }

    /**
     * @param array $input
     *
     * @return array
     */
    private static function extractAdditionalParams(array &$input)
    {
        if (!isset($input['params'])) {
            return [];
        }
        $additionalParams = [];
        $params           = explode(';', $input['params']);
        foreach ($params as $param) {
            list($key, $value) = explode(' ', $param, 2);
            $additionalParams[trim($key)] = trim($value);
        }
        unset($input['params']);

        return $additionalParams;
    }

    /**
     * @param array $input
     *
     * @return array
     * @throws Exception
     */
    private static function extractRequiredParams(array $input)
    {
        $required = static::requiredParams();
        $requiredParams = [];
        foreach ($required as $name => $errorCode) {
            if (!isset($input[$name]) || $input[$name] === '') {
                throw new Exception($errorCode);
            }
            $requiredParams[$name] = self::valueOrDate($name, $input[$name]);
        }

        return $requiredParams;
    }

    /**
     * @param array $input
     *
     * @return array
     * @throws Exception
     */
    private static function extractOptionalParams(array $input)
    {
        $optional = static::optionalParams();
        $optionalParams = [];
        foreach ($optional as $name => $cannotBeEmpty) {
            if (!isset($input[$name])) {
                $optionalParams[$name] = null;
            } else {
                if ($cannotBeEmpty && empty($input[$name])) {
                    throw new Exception($cannotBeEmpty);
                }
                $optionalParams[$name] = self::valueOrDate($name, $input[$name]);
            }
        }

        return $optionalParams;
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return mixed|\DateTime
     */
    private static function valueOrDate($name, &$value)
    {
        return $name == 'date'
            ? \DateTime::createFromFormat('Y-m-d H:i:s', $value)
            : $value;
    }

    /**
     * @param array $input
     *
     * @throws Exception
     */
    private static function verifySignature(array $input)
    {
        try {
            //$signature = $input['signature'];
            unset($input['signature']);
            //self::$signer->verify();
        } catch (Signer\Exception $exc) {
            throw new Exception(Exception\Code::SIGN_NOT_VALID, $exc);
        }
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param Handler $callbackHandler
     * @param int     $externalId
     * @param array   $additionalParams
     *
     * @throws Exception
     */
    abstract protected function onBeforeRun(Handler $callbackHandler, $externalId, array $additionalParams);

    /**
     * @param int   $externalId
     * @param array $requiredParams
     * @param array $optionalParams
     * @param array $additionalParams
     *
     * @return Response\Data\Init|Response\Data\Payment|Response\Data\CancelInit|Response\Data\CancelPayment
     */
    abstract protected function onSuccess($externalId, array $requiredParams, array $optionalParams,  array $additionalParams);

    /**
     * @param array     $input
     * @param Exception $callbackException
     *
     * @throws Exception
     */
    abstract protected function onFailure(array $input, Exception $callbackException);
}
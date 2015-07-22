<?php
namespace Alek\PaymentGate\RuRuPay;


/**
 * Class Client
 */
class Client
{
    /**
     * By default get in-library saved WSDL`s
     */
    const WSDL_DEFAULT_PATH = './wsdl/TransactionService.svc.wsdl';
    /**
     * @var
     */
    private $partnerId;
    /**
     * @var Soap\TransactionService
     */
    private $soapService = null;
    /**
     * @var Signer
     */
    private $signer = null;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $credentials = $config['credentials'];
        $this->setCredentials($credentials);

        $soapConfig         = $config['soap'];
        $soapConfig['wsdl'] = isset($soapConfig['wsdl']) ? $soapConfig['wsdl'] : static::WSDL_DEFAULT_PATH;
        $this->soapService  = new Soap\TransactionService($soapConfig['options'], $soapConfig['wsdl']);
    }

    /**
     * @param array $credentialsConfig
     *
     * @return $this
     */
    public function setCredentials(array $credentialsConfig)
    {
        $this->partnerId = $credentialsConfig['partnerId'];
        $this->signer    = new Signer($credentialsConfig['secretKey']);

        return $this;
    }

    /**
     * @param string    $phone                 телефон покупателя
     * @param int       $productId             id услуги (в RuRuPay)
     * @param int       $amount                сумма в копейках
     * @param string    $transactionId         id транзакции магазина (id счёта)
     * @param \DateTime $transactionDate       дата платежа (в магазине)
     * @param string    $account               номер счёта клиента в магазине
     * @param string    $info                  информация, отправляемая клиенту в момент подтверждения списания
     * @param array     $additionalParams      дополнительные параметры (не используется, Зарезервирова но для будущих
     *                                         версий)
     *
     * @return Soap\PreInitResult
     */
    public function preInit($phone, $productId, $amount, $transactionId = null, \DateTime $transactionDate = null,
                            $account = null, $info = null, array $additionalParams = [])
    {
        $transactionDate = $transactionDate ? $transactionDate->format('Y-m-d H:i:s') : null;

        $signature = $this->signer->sign([
            $transactionId, $transactionDate, $phone, $info, $account, $productId, $amount, $this->partnerId,
        ]);


        //$paramClass = $this->soap_ns . '';
        $result = $this->soapService->PreInit(
            new Soap\PreInit(
                $transactionId,
                $transactionDate,
                $phone,
                $info,
                $account,
                $productId,
                $amount,
                $this->partnerId,
                self::buildAdditionalParams($additionalParams),
                $signature
            )
        )->PreInitResult;

//        $this->signer->verify($result->Signature, [
//            $result->Amount,
//            $result->AmountWithCommission,
//            $result->Commission,
//            $result->ErrorCode,
//            $result->Info,
//            $result->TransactionId
//        ]);

        return $result;
    }

    /**
     * @param string    $phone                 телефон покупателя
     * @param int       $productId             id услуги (в RuRuPay)
     * @param int       $amount                сумма в копейках
     * @param int       $transactionExternalId id транзакции (в RuRuPay)
     * @param string    $transactionId         id транзакции магазина (id платежа)
     * @param \DateTime $transactionDate       дата платежа (в магазине)
     * @param string    $account               номер счёта клиента в магазине
     * @param string    $info                  информация, отправляемая клиенту в момент подтверждения списания
     * @param array     $additionalParams      дополнительные параметры (не используется, Зарезервирова но для будущих
     *                                         версий)
     *
     * @return Soap\OperationResult
     */
    public function init($phone, $productId, $amount, $transactionExternalId = null, $transactionId = null,
                         \DateTime $transactionDate = null,
                         $account = null, $info = null, array $additionalParams = [])
    {
        $transactionDate = $transactionDate ? $transactionDate->format('Y-m-d H:i:s') : null;

        $signature = $this->signer->sign([
            $transactionId, $transactionDate, $phone, $info, $account, $productId, $amount, $this->partnerId, $transactionExternalId,
        ]);

        $result = $this->soapService->Init(
            new Soap\Init(
                $transactionId,
                $transactionDate,
                $phone,
                $info,
                $account,
                $productId,
                $amount,
                $this->partnerId,
                self::buildAdditionalParams($additionalParams),
                $transactionExternalId,
                $signature
            )
        )->InitResult;

//        $this->signer->verify($result->Signature, [
//        ]);

        return $result;
    }

    /**
     * @param int       $transactionExternalId id транзакции (в RuRuPay)
     * @param int       $result                код ошибки магазина, либо 0 в случае успеха
     * @param string    $errorDescription      описание ошибки магазина
     * @param string    $transactionId         id транзакции магазина
     * @param \DateTime $transactionDate       дата платежа (в магазине)
     * @param string    $info                  информация, отправляемая клиенту в момент подтверждения списания
     * @param int       $amount                сумма покупки в копейках Целое число
     *
     * @return Soap\OperationResult
     */
    public function reserveCallback($transactionExternalId, $result = 0, $errorDescription = 'success',
                                    $transactionId = null, $transactionDate = null, $info = null, $amount = null)
    {
        $transactionDate = $transactionDate ? $transactionDate->format('Y-m-d H:i:s') : null;

        $signature = $this->signer->sign([
            $transactionExternalId, $transactionId, $transactionDate, $info, $amount, $this->partnerId, $result, $errorDescription,
        ]);

        $result = $this->soapService->ReserveCallback(
            new Soap\ReserveCallback(
                $transactionExternalId,
                $transactionId,
                $transactionDate,
                $info,
                $amount,
                $this->partnerId,
                $result,
                $errorDescription,
                $signature
            )
        )->ReserveCallbackResult;

        return $result;
    }

    // @todo   this is the same as above
    /**
     * @param int       $transactionExternalId id транзакции (в RuRuPay)
     * @param int       $result                код ошибки магазина, либо 0 в случае успеха
     * @param string    $errorDescription      описание ошибки магазина
     * @param string    $transactionId         id транзакции магазина
     * @param \DateTime $transactionDate       дата платежа (в магазине)
     * @param string    $info                  информация, отправляемая клиенту в момент подтверждения списания
     * @param int       $amount                сумма покупки в копейках Целое число
     *
     * @return Soap\OperationResult
     */
    public function purchaseCallback($transactionExternalId, $result = 0, $errorDescription = 'success',
                                     $transactionId = null, $transactionDate = null, $info = null, $amount = null)
    {
        $transactionDate = $transactionDate ? $transactionDate->format('Y-m-d H:i:s') : null;

        $signature = $this->signer->sign([
            $transactionExternalId, $transactionId, $transactionDate, $info, $amount, $this->partnerId,
        ]);

        $result = $this->soapService->PurchaseCallback(
            new Soap\PurchaseCallback(
                $transactionExternalId,
                $transactionId,
                $transactionDate,
                $info,
                $amount,
                $this->partnerId,
                $result,
                $errorDescription,
                $signature
            )
        )->PurchaseCallbackResult;

        return $result;
    }

    /**
     * @param int $transactionExternalId id транзакции (в RuRuPay)
     *
     * @return Soap\TransactionStatus
     */
    public function getTransactionStatus($transactionExternalId)
    {
        $signature = $this->signer->sign([
            $transactionExternalId, $this->partnerId,
        ]);

        $result = $this->soapService->GetTransactionStatus(
            new Soap\GetTransactionStatus(
                $transactionExternalId,
                $this->partnerId,
                $signature
            )
        )->GetTransactionStatusResult;

        return $result;
    }

    /**
     * @param array $additionalParams
     *
     * @return array
     */
    private
    static function buildAdditionalParams(array $additionalParams)
    {
        $params = [];
        foreach ($additionalParams as $name => $value) {
            $p        = new Soap\Parameter();
            $p->Name  = $name;
            $p->Value = $value;
            $params[] = $p;
        }

        return $params;
    }
}
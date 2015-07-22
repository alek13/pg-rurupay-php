<?php
namespace Alek\PaymentGate\RuRuPay\Command;

use Alek\PaymentGate\RuRuPay\Client as ServiceClient;
use Colibri\Util\String;
use Symfony\Component\Console\Command\Command;

abstract class Client extends Command
{
    /**
     * @var \Alek\PaymentGate\RuRuPay\Client
     */
    protected $client;

    /**
     * Client commands constructor.
     */
    public function __construct()
    {
        $this->setName('client:' . $this->getSubName());

        parent::__construct();

        $config       = include('rurupay.config.php');
        $this->client = new ServiceClient($config);
    }

    /**
     * @return string
     */
    protected function getSubName()
    {
        return String::snake(
            String::lastPart(get_called_class(), '\\'),
            '-'
        );
    }

}
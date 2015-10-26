<?php
namespace Alek\PaymentGate\RuRuPay\Command;

use Alek\PaymentGate\RuRuPay\Client as ServiceClient;
use Colibri\Util\String;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
        $this->client = new ServiceClient($config['api']);
    }

    /**
     * @return string
     */
    protected function getSubName()
    {
        return String::snake(self::getClassName(), '-');
    }

    /**
     * @return string
     */
    private function getClassName()
    {
        return String::lastPart(get_called_class(), '\\');
    }

    /**
     * @use ::makeConfigure()
     */
    final protected function configure()
    {
        $this->makeConfigure();
    }

    /**
     * Configures the current command.
     */
    abstract protected function makeConfigure();

    /**
     * @param InputInterface $input
     *
     * @return array
     */
    protected function &getParams(InputInterface $input)
    {
        $params = $input->getArguments();
        unset($params['command']);
        foreach ($params as &$param) {
            if ($param === 'null') {
                $param = null;
            }
        }

        return $params;
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|int null or 0 if everything went fine, or an error code
     *
     * @throws \LogicException When this abstract method is not implemented
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $params = $this->getParams($input);

        $result = call_user_func_array([$this->client, self::getClassName()], $params);
        $this->output($result, $output);
    }

    protected function output($result, OutputInterface $output)
    {
        foreach ($result as $name => $value) {
            if (strtolower($name) != 'signature') {
                $output->writeln("  <info>$name</info>: $value");
            }
        }
    }
}
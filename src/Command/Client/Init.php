<?php
namespace Alek\PaymentGate\RuRuPay\Command\Client;

use Alek\PaymentGate\RuRuPay\Command\Client;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Init extends Client
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this
            ->setDescription('< not implemented >')
            ->addArgument('phone', InputArgument::REQUIRED, 'phone')
            ->addArgument('product_id', InputArgument::REQUIRED, 'product_id')
            ->addArgument('amount', InputArgument::REQUIRED, 'amount')
            ->addArgument('transaction_external_id', InputArgument::OPTIONAL, '...')
            ->addArgument('transaction_id', InputArgument::OPTIONAL, '...')
            ->addArgument('transaction_date', InputArgument::OPTIONAL, '...')
            ->addArgument('account', InputArgument::OPTIONAL, '...')
            ->addArgument('info', InputArgument::OPTIONAL, '...')
            ->addArgument('additional_params', InputArgument::OPTIONAL | InputArgument::IS_ARRAY, '...')
        ;
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
        $arguments = $input->getArguments();
        unset($arguments['command']);

        var_dump($arguments);
//        call_user_func_array([$this->client, 'init']);
//        $result = $this->client->init();
    }


}
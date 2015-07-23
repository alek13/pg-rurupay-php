<?php
namespace Alek\PaymentGate\RuRuPay\Command\Client;

use Alek\PaymentGate\RuRuPay\Command\Client;
use Symfony\Component\Console\Input\InputArgument;

class Init extends Client
{
    /**
     * Configures the current command.
     */
    protected function makeConfigure()
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
}
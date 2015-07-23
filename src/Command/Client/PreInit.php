<?php
namespace Alek\PaymentGate\RuRuPay\Command\Client;

use Alek\PaymentGate\RuRuPay\Command\Client;
use Symfony\Component\Console\Input\InputArgument;

class PreInit extends Client
{
    /**
     * Configures the current command.
     */
    protected function makeConfigure()
    {
        $this
            ->setDescription('Call PreInit Api method. (check full cost & commission, and if you want pre-init)')
            ->addArgument('phone', InputArgument::REQUIRED, 'Phone number of customer')
            ->addArgument('product_id', InputArgument::REQUIRED, 'ID of product, that customer want to buy. (in RuRuPay DB)')
            ->addArgument('amount', InputArgument::REQUIRED, 'Amount in coins (*100). !int!')
            ->addArgument('transaction_id', InputArgument::OPTIONAL, 'ID of transaction in "our" DB')
            ->addArgument('transaction_date', InputArgument::OPTIONAL, 'Date of transaction on "our" side')
            ->addArgument('account', InputArgument::OPTIONAL, 'Account number of customer ("our" side)')
            ->addArgument('info', InputArgument::OPTIONAL, 'Info string, that sends to customer ')
            ->addArgument('additional_params', InputArgument::OPTIONAL | InputArgument::IS_ARRAY, '...')
        ;
    }
}
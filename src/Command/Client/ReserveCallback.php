<?php
namespace Alek\PaymentGate\RuRuPay\Command\Client;

use Alek\PaymentGate\RuRuPay\Command\Client;
use Symfony\Component\Console\Input\InputArgument;

class ReserveCallback extends Client
{

    /**
     * Configures the current command.
     */
    protected function makeConfigure()
    {
        $this
            ->setDescription('')
            ->addArgument('transaction_external_id', InputArgument::REQUIRED, 'ID of transaction (in RuRuPay DB)')
            ->addArgument('result', InputArgument::REQUIRED, 'ID of transaction (in RuRuPay DB)', 0)
            ->addArgument('error_description', InputArgument::REQUIRED, 'ID of transaction (in RuRuPay DB)', 0)
            ->addArgument('transaction_id', InputArgument::OPTIONAL, 'ID of transaction in "our" DB')
            ->addArgument('transaction_date', InputArgument::OPTIONAL, 'Date of transaction on "our" side')
            ->addArgument('info', InputArgument::OPTIONAL, 'Info string, that sends to customer ')
            ->addArgument('account', InputArgument::OPTIONAL, 'Account number of customer ("our" side)')
        ;
    }
}
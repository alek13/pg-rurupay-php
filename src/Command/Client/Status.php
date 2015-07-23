<?php
namespace Alek\PaymentGate\RuRuPay\Command\Client;

use Alek\PaymentGate\RuRuPay\Command\Client;
use Alek\PaymentGate\RuRuPay\Soap\TransactionStatus;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Status extends Client
{
    /**
     * Configures the current command.
     */
    protected function makeConfigure()
    {
        $this
            ->setDescription('Retrieve the status of transaction')
            ->addArgument('transaction_id', InputArgument::REQUIRED, 'ID of transaction in Gate RuRuPay');
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
        $transactionId = $input->getArgument('transaction_id');
        $result        = $this->client->getTransactionStatus($transactionId);

        $this->output($result, $output);
    }

    /**
     * @param TransactionStatus $result
     * @param OutputInterface   $output
     */
    protected function output($result, OutputInterface $output)
    {
        $output->writeln("  <comment>ID:</comment> <info>$result->TransactionId</info>");
        $output->writeln("  <comment>Error:</comment> <info>$result->ErrorCode</info> $result->Description");
        $output->writeln("  <comment>Reason:</comment> <info>$result->Reason</info>");
    }
}
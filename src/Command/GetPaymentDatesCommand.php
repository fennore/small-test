<?php

namespace App\Command;

use DateTime;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Data\PaymentDatesList;
use App\Utils\{ExportSimpleList,PaymentDatesCalculator};

class GetPaymentDatesCommand extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:get-payment-dates')
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a file with all the payment dates for the remainder of the year.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $today = new DateTime();
        $paymentDatesList = new PaymentDatesList(new PaymentDatesCalculator());
        $exporter = new ExportSimpleList($paymentDatesList);
        $exporter->exportAsCsv('sales-payment-dates');
        $output->writeln(sprintf('List for the remaining payment dates for %s created.', $today->format('Y')));
        $output->writeln(sprintf('The list can be found in %s.', 'var/sales-payment-dates.csv'));
    }
}

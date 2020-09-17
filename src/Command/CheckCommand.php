<?php

namespace GlobalFmt\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckCommand extends Command
{
    protected static $defaultName = 'check';

    protected function configure()
    {
        $this
            ->setDescription('Check if the monitored files have changed')
            ->setHelp('This command will go through your site and check if you have modified files that you should contribute back')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'System check',
            '============',
            '',
        ]);

        // do some checking

        return Command::SUCCESS;
    }
}

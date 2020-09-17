<?php

namespace GlobalFmt\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CopyCommand extends Command
{
    protected static $defaultName = 'copy';

    protected function configure()
    {
        $this
            ->setDescription('Copy all monitored files in the site folder')
            ->setHelp('This command will copy all monitored files in the site folder')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'System copy',
            '============',
            '',
        ]);

        // do some checking

        return Command::SUCCESS;
    }
}

<?php

namespace GlobalFmt\Command;

use GlobalFmt\ScannerTemplates;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ScanCommand extends Command
{
    protected static $defaultName = 'scan';

    protected function configure(): void
    {
        $this
            ->setDescription('Check if the monitored files have changed')
            ->setHelp('Scan your site and check if you have modified files that you should contribute back')
            ->addArgument('project_dir', InputArgument::REQUIRED, 'The project dir');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $scanner = new ScannerTemplates();
        $scanner->setDirFrom(__DIR__ . '/../../templates');
        // @phpstan-ignore-next-line
        $scanner->setDirTo($input->getArgument('project_dir'));
        $scanner->scan();

        $files = $scanner->getFlaggedFiles();
        foreach ($files as $file) {
            $display = "[ " . strtoupper($file['status']) ." ] ";
            $display .= $file['file']->getRealPath();
            $output->writeln($display);
        }

        return Command::SUCCESS;
    }
}

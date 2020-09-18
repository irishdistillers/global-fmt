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

    protected function configure()
    {
        $this
            ->setDescription('Check if the monitored files have changed')
            ->setHelp('Scan your site and check if you have modified files that you should contribute back')
            ->addArgument('project_dir', InputArgument::REQUIRED, 'The project dir')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->scanner = new ScannerTemplates();
        $this->scanner->setDirFrom(__DIR__ . '/../../templates');
        $this->scanner->setDirTo($input->getArgument('project_dir'));
        $this->scanner->scan();


        // $files = $this->scanner->getFlaggedFiles();
        // foreach($files as $file) {
        //     $output->writeln(hash_file('md5', $file['file']->getRealPath()));
        //     $output->writeln($file['file']->getRealPath());
        // }

        // $output->writeln("======");

        // $files = $this->scanner->getScannedFiles();
        // foreach($files as $file) {
        //     $output->writeln(hash_file('md5', $file['file']->getRealPath()));
        //     $output->writeln($file['file']->getRealPath());
        // }



        // $output->writeln([
        //     'System check',
        //     '============',
        //     __DIR__,
        //     basename(__DIR__),
        //     dirname(__FILE__)
        // ]);




        // $output->writeln([
        //     'System check',
        //     '============',
        //     '',
        // ]);

        // do some checking

        return Command::SUCCESS;
    }
}

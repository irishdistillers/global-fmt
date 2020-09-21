<?php

namespace GlobalFmt\Command;

use GlobalFmt\ScannerTemplates;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ScanCommand extends Command
{
    protected static $defaultName = 'scan';

    /**
     * @var string
     */
    protected static $templatesDir = __DIR__ . '/../../templates';

    protected function configure(): void
    {
        $this
            ->setDescription('Check if the monitored files have changed')
            ->setHelp('Scan your site and check if you have modified files that you should contribute back')
            ->addOption(
                'dir_from',
                null,
                InputOption::VALUE_REQUIRED,
                'Name of the directory to get templates from?',
                1
            )
            ->addOption(
                'dir_to',
                null,
                InputOption::VALUE_REQUIRED,
                'Directory path to watch for changes?',
                1
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // @phpstan-ignore-next-line
        $dirFrom = $this->getProjectName($input->getOption('dir_from'));

        $scanner = new ScannerTemplates();
        $scanner->setDirFrom($dirFrom);
        // @phpstan-ignore-next-line
        $scanner->setDirTo($input->getOption('dir_to'));
        $scanner->scan();

        $files = $scanner->getFlaggedFiles();
        foreach ($files as $file) {
            $display = "[ " . strtoupper($file['status']) . " ] ";
            $display .= $file['file']->getRealPath();
            $output->writeln($display);
        }

        return Command::SUCCESS;
    }

    private function getProjectName(string $projectName): string
    {
        $dir = (string)realpath(self::$templatesDir . '/' . $projectName);

        if (is_dir($dir)) {
            return $dir;
        }

        return (string)realpath(self::$templatesDir . '/default');
    }
}

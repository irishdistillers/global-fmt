<?php

namespace Templateschecker\Command;

use Templateschecker\ScannerTemplates;
use Templateschecker\ScannerStatus;
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
            )
            ->addOption(
                'show',
                null,
                InputOption::VALUE_OPTIONAL,
                'Show all results by default or specific status (ok,different,missing)?',
                ''
            )
        ;
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

        $output->writeln(PHP_EOL);

        // @phpstan-ignore-next-line
        $onlyShowList = $this->getShowStatus($input->getOption('show'));

        $anomalyCounter = $this->getAnomalyCounter();

        $files = $scanner->getFlaggedFiles();

        foreach ($files as $file) {
            if (in_array($file['status'], $onlyShowList)) {
                if (isset($anomalyCounter[$file['status']])) {
                    $anomalyCounter[$file['status']]++;
                }

                $display = "[ " . strtoupper($file['status']) . " ] ";
                $display .= $file['dirto_file'] . PHP_EOL;
                $display .= "► ". $file['file']->getRealPath() . PHP_EOL;
                $output->writeln(str_repeat("--", 40));
                $output->writeln($display);
            }
        }

        $this->displayTotalResult(
            $output,
            $anomalyCounter
        );

        if ($anomalyCounter[ScannerStatus::getStatusMissing()] > 0 ||
            $anomalyCounter[ScannerStatus::getStatusDifferent()] > 0) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    /**
    * @param array<string, int> $data
    */
    private function displayTotalResult(OutputInterface $output, array $data): void
    {
        $output->writeln(PHP_EOL);
        $output->writeln(str_repeat("=", 40));
        $output->writeln(" RESULT " . PHP_EOL);

        foreach ($data as $item => $content) {
            $display = "[ " . strtoupper($item) . " ] ";
            $display .= $content;
            $output->writeln($display);
        }

        $output->writeln(PHP_EOL);
    }

    /**
    * @return array<string, int>
    */
    private function getAnomalyCounter(): array
    {
        $data = [];
        foreach (ScannerStatus::getAll() as $item) {
            $data[$item] = 0;
        }

        return $data;
    }

    private function getProjectName(string $projectName): string
    {
        $dir = (string)realpath(self::$templatesDir . '/' . $projectName);

        if (is_dir($dir)) {
            return $dir;
        }

        return (string)realpath(self::$templatesDir . '/default');
    }

    /**
    * @return array<int, string>
    */
    private function getShowStatus(string $option): array
    {
        if (!empty($option)) {
            return explode(',', $option);
        }

        return ScannerStatus::getAll();
    }
}

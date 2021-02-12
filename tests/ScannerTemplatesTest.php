<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Templateschecker\ScannerTemplates;
use Templateschecker\ScannerStatus;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

final class ScannerTemplatesTest extends TestCase
{
    /**
     * @var GlobalTemplateschecker\ScannerTemplates
     */
    protected $scanner;

    CONST FIXTURES_PATH = __DIR__ . '/fixtures/templates';

    protected function setUp(): void
    {
        $this->scanner = new ScannerTemplates();
        $this->scanner->setDirFrom(self::FIXTURES_PATH);
        $this->scanner->setDirTo(__DIR__ . '/fixtures/ProjectFiles');
        $this->scanner->scan();
    }

    public function testFlaggedFilesAreSplInfoObjects(): void
    {
        $files = $this->scanner->getFlaggedFiles();

        foreach ($files as $file) {
            $this->assertContainsOnlyInstancesOf(
                SplFileInfo::class,
                [$file['file']]
            );
        }
    }

    public function testScannedFilesAreSplInfoObjects(): void
    {
        $files = $this->scanner->getScannedFiles();

        foreach ($files as $file) {
            $this->assertContainsOnlyInstancesOf(
                SplFileInfo::class,
                [$file['file']]
            );
        }
    }

    private function retrievesFixtures() {

        $finder = new Finder();
        $finder->in(self::FIXTURES_PATH)
            ->files()
            ->ignoreVCSIgnored(true) //Ignore anything in the templates/.gitignore
            ->ignoreDotFiles(false);

        return $finder;
    }

    public function testScanReturnCorrectCountOfItems(): void
    {
        $files = $this->scanner->getScannedFiles();

        $this->assertCount(
            count($this->retrievesFixtures()),
            $files
        );
    }

    public function testScanFlaggedAllItems(): void
    {
        $files = $this->scanner->getFlaggedFiles();

        $this->assertCount(
            count($this->retrievesFixtures()),
            $files
        );
    }

    public function testCheckFlaggedItemsStatus(): void
    {
        $files = $this->scanner->getFlaggedFiles();

        foreach($files as $file) {

            switch ($file['file']->getFilename()) {
                case '.file2.txt':
                    $this->assertEquals(
                        '.file2.txt is ' . $file['status'],
                        '.file2.txt is ' . ScannerStatus::getStatusMissing()
                    );
                    break;
                
                case 'file1.php':
                    $this->assertEquals(
                        'file1.php is ' . $file['status'],
                        'file1.php is ' . ScannerStatus::getStatusOk()
                    );
                    break;

                case 'file4.html':
                    $this->assertEquals(
                        'file4.html is ' . $file['status'],
                        'file4.html is ' . ScannerStatus::getStatusDifferent()
                    );
                    break;
                
                case '.some_hidden_file':
                    $this->assertEquals(
                        '.some_hidden_file is ' . $file['status'],
                        '.some_hidden_file is ' . ScannerStatus::getStatusMissing()
                    );
                    break;   
            }

        }
    }
}

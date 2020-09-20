<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GlobalFmt\ScannerTemplates;
use GlobalFmt\ScannerStatus;
use Symfony\Component\Finder\SplFileInfo;

final class ScannerTemplatesTest extends TestCase
{
    /**
     * @var GlobalFmt\ScannerTemplates
     */
    protected $scanner;

    protected function setUp(): void
    {
        $this->scanner = new ScannerTemplates();
        $this->scanner->setDirFrom(__DIR__ . '/fixtures/templates');
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

    public function testScanReturnCorrectCountOfItems(): void
    {
        $files = $this->scanner->getScannedFiles();

        $this->assertCount(
            2,
            $files
        );
    }

    public function testScanFlaggedAllItems(): void
    {
        $files = $this->scanner->getFlaggedFiles();

        $this->assertCount(
            2,
            $files
        );
    }

    public function testCheckFlaggedItemsStatus(): void
    {
        $files = $this->scanner->getFlaggedFiles();

        $this->assertEquals(
            $files['88acd44838c14a25591df9e28d2e5ff8']['status'],
            ScannerStatus::getStatusOk()
        );

        $this->assertEquals(
            $files['10400c6faf166902b52fb97042f1e0eb']['status'],
            ScannerStatus::getStatusMissing()
        );
    }
}

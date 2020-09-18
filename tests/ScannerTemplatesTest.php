<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GlobalFmt\ScannerTemplates;
use Symfony\Component\Finder\SplFileInfo;

final class ScannerTemplatesTest extends TestCase
{
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

        foreach($files as $file) {
            $this->assertContainsOnlyInstancesOf(
                SplFileInfo::class,
                [ $file['file'] ]
            );
        }
    }

    public function testScannedFilesAreSplInfoObjects(): void
    {
        $files = $this->scanner->getScannedFiles();

        foreach($files as $file) {
            $this->assertContainsOnlyInstancesOf(
                SplFileInfo::class,
                [ $file['file'] ]
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

    public function testScanFlaggedIllegalItems(): void
    {
        $files = $this->scanner->getFlaggedFiles();

        $this->assertCount(
            1,
            $files
        );
    }
}

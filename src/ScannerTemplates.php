<?php

declare(strict_types=1);

namespace GlobalFmt;

final class ScannerTemplates implements IScanner
{
    use TScanner;

    protected $dirFrom;
    protected $dirTo;

    public function setDirFrom(string $dir): void
    {
        if (!empty($dir)) {
            $this->dirFrom = $dir;
        }
    }

    public function setDirTo(string $dir): void
    {
        if (!empty($dir)) {
            $this->dirTo = $dir;
        }
    }

    public function scan(): void
    {
        $this->retrievesScannedFiles();
        $this->retrievesFlaggedFiles();
    }
}

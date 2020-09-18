<?php

declare(strict_types=1);

namespace GlobalFmt;

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Finder\Finder;

trait TScanner
{
    protected $scannedFiles = [];
    protected $flaggedFiles = [];

    public function getFlaggedFiles(): array
    {
        return $this->flaggedFiles;
    }

    public function getScannedFiles(): array
    {
        return $this->scannedFiles;
    }

    private function retrievesDirFromFiles(): void
    {
        $finder = new Finder();

        foreach ($finder->in($this->dirFrom)->files() as $file) {
            $hash = $this->getHashFile($file->getRealPath());
            $this->scannedFiles[$hash]['file'] = $file;
        }
    }

    private function comparesAllDirFiles(): void
    {
        foreach ($this->scannedFiles as $hash => $scannedFile) {
            $finder = new Finder();
            foreach ($finder->in($this->dirTo)->files()->name($scannedFile['file']->getFilename()) as $file) {
                $hash = $this->getHashFile($file->getRealPath());
                $this->flaggedFiles[$hash]['file'] = $file;

                if (!$this->scannedFiles[$hash]) {
                    $this->flaggedFiles[$hash]['status'] = false;
                } else {
                    $this->flaggedFiles[$hash]['status'] = true;
                }
            }
        }
    }

    private function getHashFile(string $filename, string $algo = 'md5'): string
    {
        if (!file_exists($filename)) {
            return 0;
        }
        return hash_file($algo, $filename);
    }
}

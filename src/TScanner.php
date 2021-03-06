<?php

declare(strict_types=1);

namespace Templateschecker;

use Templateschecker\ScannerStatus;
use Symfony\Component\Finder\Finder;

trait TScanner
{
    /**
     * @var array<array>
     */
    protected $scannedFiles;

    /**
     * @var array<array>
     */
    protected $flaggedFiles;

    /**
     * @return array<array>
     */
    public function getFlaggedFiles(): array
    {
        return $this->flaggedFiles;
    }

    /**
     * @return array<array>
     */
    public function getScannedFiles(): array
    {
        return $this->scannedFiles;
    }

    private function retrievesScannedFiles(): void
    {
        $finder = new Finder();
        $finder->in($this->dirFrom)
            ->files()
            ->ignoreDotFiles(false);

        foreach ($finder as $file) {
            $hash = $this->getHashFile((string) $file->getRealPath());
            $this->scannedFiles[$hash]['file'] = $file;
        }
    }

    private function retrievesFlaggedFiles(): void
    {
        foreach ($this->scannedFiles as $hash => $scannedFile) {
            $newFile = $this->dirTo . '/' . $scannedFile['file']->getRelativePathname();
            $filesSimilar = $this->isSimilarFiles($newFile, $scannedFile['file']->getRealPath());

            if (!file_exists($newFile)) {
                $this->flaggedFiles[$hash]['file'] = $scannedFile['file'];
                $this->flaggedFiles[$hash]['dirto_file'] = $newFile;
                $this->flaggedFiles[$hash]['status'] = ScannerStatus::getStatusMissing();
            } elseif ($filesSimilar !== true) {
                $this->flaggedFiles[$hash]['file'] = $scannedFile['file'];
                $this->flaggedFiles[$hash]['dirto_file'] = $newFile;
                $this->flaggedFiles[$hash]['status'] = ScannerStatus::getStatusDifferent();
            } else {
                $this->flaggedFiles[$hash]['file'] = $scannedFile['file'];
                $this->flaggedFiles[$hash]['dirto_file'] = $newFile;
                $this->flaggedFiles[$hash]['status'] = ScannerStatus::getStatusOk();
            }
        }
    }

    private function isSimilarFiles(string $filePath1, string $filePath2): bool
    {
        $hashFile1 = $this->getHashFile($filePath1);
        $hashFile2 = $this->getHashFile($filePath2);

        if ($hashFile1 != $hashFile2) {
            return false;
        }

        return true;
    }

    private function getHashFile(string $filename, string $algo = 'md5'): string
    {
        if (!file_exists($filename)) {
            return (string)0;
        }
        return (string)hash_file($algo, $filename);
    }
}

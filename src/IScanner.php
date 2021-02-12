<?php

namespace Templateschecker;

interface IScanner
{
    public function setDirTo(string $dir): void;
    public function setDirFrom(string $dir): void;
    public function scan(): void;
}

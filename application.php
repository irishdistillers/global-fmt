#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use GlobalFmt\Command\CheckCommand;
use GlobalFmt\Command\CopyCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new CheckCommand());
$application->add(new CopyCommand());

$application->run();

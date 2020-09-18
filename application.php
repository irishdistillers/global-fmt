#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use GlobalFmt\Command\ScanCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new ScanCommand());

$application->run();

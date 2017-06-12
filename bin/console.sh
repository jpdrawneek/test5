#!/usr/bin/env php
<?php
require __DIR__.'/../vendor/autoload.php';
 
use test5\Console\Application as CA;
use test5\Console\Command;
 
$application = new CA();
$application->add(new Command($application->containerGet('application.runner')));
 
$application->run();

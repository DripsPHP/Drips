<?php

use Drips\CLI\Command;
use Drips\EnvironmentCmd;
use Drips\ControllerCmd;
use Drips\PackageCmd;


Command::register('env', EnvironmentCmd::class);
Command::register('controller', ControllerCmd::class);
Command::register('package', PackageCmd::class);